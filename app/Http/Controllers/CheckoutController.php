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
    public function index()
    {
        $reservationData = session()->get('cart.reservation', []);
        $itemsData = session()->get('cart.items', []);
        $selectedTable = session()->get('cart.selected_table', []);
        $totalPrice = 0;

        if ($reservationData) {
            $totalPrice += $reservationData['total_price'];
        }

        if ($itemsData) {
            foreach ($itemsData as $item) {
                $totalPrice += $item['harga'] * $item['qty'];
            }
        }

        return view('payment', [
            'title' => 'Payment',
            'totalPrice' => $totalPrice,
            'reservationData' => $reservationData,
            'itemsData' => $itemsData,
            'selectedTable' => $selectedTable
        ]);
    }

    public function processCheckout(Request $request)
    {
        $reservationData = session()->get('cart.reservation', []);
        $itemsData = session()->get('cart.items', []);
        $selectedTable = session()->get('cart.selected_table', []);
        $totalPrice = 0;
        $errorMessage = '';


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

                $isBooked = Reservation::query()

                    // PERBAIKAN KRITIS: Menggunakan transaction_detail_id di KEDUA SISI JOIN
                    ->join('transaction_details', function ($join) use ($mejaYgDipesan) {
                        // Relasi FK di reservations = PK di transaction_details
                        $join->on('reservations.transaction_detail_id', '=', 'transaction_details.transaction_detail_id')
                            ->where('transaction_details.item_type', '=', 'table')
                            ->where('transaction_details.item_id', $mejaYgDipesan); // Filter table ID di dalam join
                    })

                    // Filter waktu mulai di tabel reservations
                    ->where('reservations.waktu_mulai', $waktuMulaiStr)

                    ->exists();

                if ($isBooked) {
                    $errorMessage = 'Jadwal ' . $reservationData['nama'] . ' pada pukul ' . $slot['time'] . ' telah dipesan oleh pengguna lain.';
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
                'status_transaksi' => "Pending"
            ]);

            // buat nomor invoice
            $invoice_prefix = 'INV-' . now()->format('Ymd') . '-';
            $no_invoice = $invoice_prefix . str_pad($transaction->transaction_id, 5, '0', STR_PAD_LEFT);

            // update nomor invoice
            $transaction->update([
                'no_invoice' => $no_invoice
            ]);


            // dd($transaction->transaction_id);

            // buat detail transaksi dan reservasi untuk MEJA (jika ada)
            if ($reservationData) {
                $table = Table::find($reservationData['table_id']);
                if ($table) {
                    $detail = TransactionDetail::create([
                        'transaction_id' => $transaction->transaction_id,
                        'item_id' => $reservationData['table_id'],
                        'item_type' => 'table',
                        'quantity' => count($reservationData['slots']), // quantity untuk meja adalah jumlah jam (3 = 3 jam)
                        'deskripsi' => null,
                        'meja_tujuan' => $reservationData['nama'],
                        'status_pesanan' => 'Dijadwalkan',
                        'harga' => $reservationData['total_price']
                    ]);

                    // buat reservasi
                    foreach ($reservationData['slots'] as $slot) {
                        $waktuMulaiStr = $reservationData['tanggal_pemesanan'] . ' ' . $slot['startTimeDB'];
                        // Hitung waktu selesai dengan menambahkan 1 jam menggunakan Carbon
                        $carbonMulai = Carbon::parse($waktuMulaiStr);
                        $waktuSelesaiStr = $carbonMulai->addHour()->format('Y-m-d H:i:s');
                        $reservation = Reservation::create([
                            'transaction_detail_id' => $detail->transaction_detail_id,
                            'waktu_mulai' => $waktuMulaiStr,
                            'waktu_selesai' => $waktuSelesaiStr,
                            'status' => 'Menunggu Check-in'
                        ]);
                    }
                }
            }

            // buat detail transaksi MENU dan kurangi stok MENU (jika ada)
            if ($itemsData) {
                // Tentukan meja tujuan, berdasarkan reservasi atau pilihan meja
                $mejaTujuan = $reservationData ? $reservationData['nama'] : ($selectedTable['nama'] ?? null);
                $statusPesananMenu = $reservationData ? 'Dijadwalkan' : 'Menunggu Dibuat';
                foreach ($itemsData as $item) {
                    $menu = Menu::find($item['menu_id']);
                    if ($menu) {
                        $menu->decrement('stok', $item['qty']); // DECREMENT untuk mengurangi stok dengan aman

                        $detail = TransactionDetail::create([
                            'transaction_id' => $transaction->transaction_id,
                            'item_id' => $item['menu_id'],
                            'item_type' => 'menu',
                            'quantity' => $item['qty'],
                            'deskripsi' => null,
                            'meja_tujuan' => $mejaTujuan,
                            'status_pesanan' => $statusPesananMenu,
                            'harga' => $item['harga'] * $item['qty']
                        ]);
                    }
                }
            }

            // 5. Commit dan Bersihkan Session (DI SINI TEMPATNYA)
            session()->forget('cart');
            DB::commit();

            // RETURN SUKSES RESPONSE
            return redirect()->route('customer.payment', ['transaction' => $transaction->transaction_id])
                ->with('success', 'Pesanan berhasil dibuat. Silakan selesaikan pembayaran.');
        } catch (\Exception $e) {
            DB::rollBack();

            // LOG ERROR UNTUK DEBUGGING SERVER
            Log::error('Checkout Failed: ' . $e->getMessage());

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
