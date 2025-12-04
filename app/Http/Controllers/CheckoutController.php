<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Menu;
use App\Models\Table;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Transaction $transaction)
    {
        // load relasi agar data tersedia (Eager loading biar hemat query)
        // Model trnasaction ada method 'transactionDetails dan reservations
        $transaction->load(['transactionDetails.menu', 'reservations.table']); // Laravel mengambil Detail Transaksi DAN mengambil semua Menu yang terkait sekaligus dalam 1 kali jalan. di View tinggal panggil {{ $detail->menu->nama }}, datanya sudah siap

        // 2. Data Total Transaksi
        $totalPrice = $transaction->total_transaksi;

        // Ambil Data Meja/Reservasi (dari tabel reservations), ambil reservasi pertama (1 transaksi maks 1 reservasi meja)
        $reservationData = $transaction->reservations->first();;

        // Ambil Data Menu (dari tabel transaction_details)
        $itemsData = $transaction->transactionDetails;

        // 4. Tentukan Selected Table (Alamat Meja)
        // Prioritas: Nama Meja dari Reservasi > Nama Meja dari input menu > null
        $selectedTable = null;

        if ($reservationData) {
            $selectedTable = $reservationData->table->nama ?? 'Terjadi kesalahan sistem'; // Ambil dari relasi table
        } elseif ($itemsData->isNotEmpty()) {
            $selectedTable = $itemsData->first()->meja_tujuan;
        }

        return view('payment', [
            'title' => 'Payment',
            'transaction' => $transaction, // Kirim object transaction utuh (praktis)
            'totalPrice' => $transaction->total_transaksi,
            'reservationData' => $reservationData,
            'itemsData' => $itemsData,
            'selectedTable' => $selectedTable,
        ]);
    }

    public function processCheckout(Request $request)
    {
        $reservationData = session()->get('cart.reservation', []);
        $itemsData = session()->get('cart.items', []);
        $selectedTable = session()->get('cart.selected_table', []);
        $totalPrice = 0;
        $errorMessage = '';

        if (!$reservationData && !$itemsData) {
            $errorMessage = 'Keranjang anda kosong';
            return redirect()->route('customer.cart')->with('error', $errorMessage);
        }

        // validasi stock menu
        $stokCukup = true;
        $errorMessage = 'Stok menu berikut tidak mencukupi: ';
        $itemBermasalah = [];
        if ($itemsData) {
            foreach ($itemsData as $item) {
                $menu = Menu::find($item['menu_id']);
                if (!$menu || $menu->stok < $item['qty']) {
                    $stokCukup = false;
                    $itemBermasalah[] = $item['nama'] . '(Stok: ' . ($menu ? $menu->stok : 0) . ')';
                }
            }
            if (!$stokCukup) {
                $errorMessage .= implode(', ', $itemBermasalah); // Operator .= berarti append (menambahkan ke string sebelumnya).
                return redirect()->route('customer.cart')->with('error', $errorMessage);
            }
        }


        // validasi jadwal meja
        if ($reservationData) {
            // Ambil ID meja yang sedang dipesan (dari session)
            $mejaYgDipesan = $reservationData['table_id'];

            foreach ($reservationData['slots'] as $slot) {
                $waktuMulaiStr = $reservationData['tanggal_pemesanan'] . ' ' . $slot['startTimeDB'];

                $isBooked = Reservation::where('table_id', $mejaYgDipesan)
                    ->where('waktu_mulai', $waktuMulaiStr)
                    ->exists();

                if ($isBooked) {
                    $errorMessage = 'Jadwal ' . $reservationData['nama'] . ' pada pukul ' . $slot['time'] . ' telah dipesan.';
                    return redirect()->route('customer.cart')->with('error', $errorMessage);
                }
            }
        }

        // DB transacton
        try {
            DB::beginTransaction();

            // hitung ulang total harga (wajib di sever side)
            $reservationData = session()->get('cart.reservation', []);
            $itemsData = session()->get('cart.items', []);
            $selectedTable = session()->get('cart.selected_table');
            $totalPrice = 0;

            // hitung ulang total price
            if ($reservationData) {
                $totalPriceTable = $reservationData['total_price'];
                $totalPrice += $totalPriceTable;
            }

            if ($itemsData) {
                $totalPriceItems = 0;
                foreach ($itemsData as $item) {
                    $totalPriceItems += ($item['qty']) * ($item['harga']);
                }
                $totalPrice += $totalPriceItems;
            }

            // buat transaksi utama
            $transaction = Transaction::create([
                'customer_id' => session()->get('user_id'),
                'admin_id' => null,
                'no_invoice' => null,
                'metode_pembayaran' => 'Cashless',
                'total_transaksi' => $totalPrice,
                'status_transaksi' => "Unpaid"
            ]);

            // buat nomor invoice
            $invoice_prefix = 'INV-' . now()->format('Ymd') . '-';
            $no_invoice = $invoice_prefix . str_pad($transaction->transaction_id, 5, '0', STR_PAD_LEFT);

            // update nomor invoice
            $transaction->update([
                'no_invoice' => $no_invoice
            ]);


            // dd($transaction->transaction_id);

            if ($itemsData) {

                // Jika ada reservasi, menu dijadwalkan
                // Jika tidak, menu langsung dibuat
                $mejaTujuan  = $reservationData['nama'] ?? ($selectedTable['nama'] ?? null);
                $statusMenu  = $reservationData ? 'Dijadwalkan' : 'Menunggu Dibuat';

                foreach ($itemsData as $item) {
                    $menu = Menu::find($item['menu_id']);

                    if ($menu) {

                        // kurangi stok
                        if ($menu->stok < $item['qty']) {
                            return redirect()->route('customer.cart')
                                ->with('error', "Stok menu {$menu->nama} tidak mencukupi.");
                        }

                        $menu->decrement('stok', $item['qty']);

                        TransactionDetail::create([
                            'transaction_id' => $transaction->transaction_id,
                            'menu_id'        => $item['menu_id'],
                            'quantity'       => $item['qty'],
                            'deskripsi'      => $item['note']??null,
                            'meja_tujuan'    => $mejaTujuan,
                            'status_pesanan' => $statusMenu,
                            'harga'          => $menu->harga * $item['qty']
                        ]);
                    }
                }
            }

            if ($reservationData) {

                foreach ($reservationData['slots'] as $slot) {

                    $mulai = $reservationData['tanggal_pemesanan'] . ' ' . $slot['startTimeDB'];
                    $selesai = Carbon::parse($mulai)->addHour()->format('Y-m-d H:i:s');

                    Reservation::create([
                        'transaction_id'    => $transaction->transaction_id,
                        'table_id'          => $reservationData['table_id'],
                        'waktu_mulai'       => $mulai,
                        'waktu_selesai'     => $selesai,
                        'status_reservasi'  => 'Menunggu Check-in',
                        'tanggal_reservasi' => $reservationData['tanggal_pemesanan'],
                        'harga'             => $slot['price']
                    ]);
                }
            }

            // 5. Commit dan Bersihkan Session
            DB::commit();
            session()->forget('cart');


            // RETURN SUKSES RESPONSE
            return redirect()->route('customer.payment', [
                'transaction' => $transaction,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            // LOG ERROR UNTUK DEBUGGING SERVER
            Log::error('Checkout Failed: ' . $e->getMessage());
            // dd($e->getMessage()); // DEBUGGING 

            // RETURN ERROR RESPONSE
            return redirect()->route('customer.cart')->with('error', 'Gagal memproses pesanan akibat kesalahan sistem. Silakan coba lagi.');
        }
    }

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
