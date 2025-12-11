<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
// use App\Models\TransactionDetail;
// use App\Models\Reservation; tidak perlu karena sudah berelasi di model
use App\Models\Menu;
use Illuminate\Support\Facades\DB; // Import DB untuk fitur Transaction Database

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // query dan eager load 'customer' semua dari yg terbaru
        $query = Transaction::with('customer')->latest();

        // logika searching
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;

            $query->where(function($q) use ($search) {
                // cari berdasarkan invoice
                $q->where('no_invoice', 'like', "%{$search}%")
                // atau berdasarkan nama customer (pakai whereHas relasi) 
                ->orWhereHas('customer', function($subQ) use ($search) { // whereHas fitur Laravel untuk mencari data berdasarkan kolom di tabel relasinya
                    $subQ->where('nama', 'like', "%{$search}%");
                });
            });
        }

        // filter status optional
        if ($request->has('status') && $request->status != '') {
            $query->where('status_transaksi', $request->status);
        }

        // pagination (max 10)
        $transactions = $query->paginate(10)->withQueryString(); // agar saat mencari "Budi" lalu klik halaman 2 pada pagination, pencarian "Budi" tetap terbawa.

        return view('admin.data-transaksi', [
            'title' => 'Transaction Page',
            'transactions' => $transactions
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // ambil transaksi dan relasi detail
        $transaction = Transaction::with([
            'customer',
            'transactionDetails.menu', // dari tabel transactions->transaction_details->menus
            'reservations.table'       // ...
        ])->findOrFail($id);

        return view('admin.transaction-detail', [
            'title' => 'Detail Transaksi #' . $transaction->no_invoice,
            'transaction' => $transaction
        ]);
    }

        /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all()); debug
        $transaction = Transaction::findOrFail($id);

        // VALIDASI Jika status sudah Cancelled, tolak perubahan apapun.
        if ($transaction->status_transaksi == 'Cancelled') {
            return redirect()->back()->with('error', 'Transaksi yang sudah dibatalkan tidak dapat diubah lagi statusnya.');
        }

        //validasi input status
        $request->validate([
            'status_transaksi' => 'required|in:Unpaid,Paid,Pending,Cancelled'
        ]);

        // update status
        $newStatus = $request->status_transaksi;

        $adminId = session('user_id');

        // DB Transaction agar jika ada error di tengah jalan, semua perubahan dibatalkan (Rollback)
        DB::beginTransaction();

        try {
            // LOGIKA KHUSUS JIKA STATUS DIUBAH MENJADI 'CANCELLED'
            if ($newStatus == 'Cancelled') {
                
                // RESTOCK MENU (Kembalikan stok)
                // Ambil semua detail menu di transaksi ini
                $details = $transaction->transactionDetails; 
                
                foreach ($details as $detail) {
                    // Cek apakah menu masih ada di database (takutnya menu udah dihapus master datanya)
                    if ($detail->menu) {
                        $detail->menu->increment('stok', $detail->quantity);
                    }
                }

                // HAPUS DATA RELASI (Transaction Details & Reservation)
                // Hapus semua detail menu
                $transaction->transactionDetails()->delete();
                
                // Hapus semua reservasi meja terkait
                $transaction->reservations()->delete();
            }

            // 3. UPDATE STATUS DAN ADMIN ID TRANSAKSI UTAMA
            $transaction->update([
                'status_transaksi' => $newStatus,
                'admin_id' => $adminId
            ]);

            DB::commit(); // Simpan perubahan permanen

            $msg = $newStatus == 'Cancelled' 
                ? 'Transaksi dibatalkan. Stok menu telah dikembalikan & detail pesanan dihapus.' // msg jika cancelled
                : 'Status transaksi berhasil diperbarui.';                                       // msg jika bukan cancelled

            return redirect()->back()->with('success', $msg);
        } catch (\Exception $e) {
            DB::rollback(); // Batalkan semua perubahan jika error
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * 
     */
    public function destroy($id)
    {
        //
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
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }
}
