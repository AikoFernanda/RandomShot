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

class PaymentController extends Controller
{
    public function index(Transaction $transaction) // sudah otomatis melakukan SELECT * FROM transactions WHERE transaction_id = .... fitur laravel Route Model Binding
    {
        return view('invoice', [
            'title' => 'Invoice #' . $transaction->no_invoice,
            'transaction' => $transaction
        ]);
    }
    public function processPayment(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'transaction_id' => 'required|exists:transactions,transaction_id',
            'proof' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB (jpeg,png,jpg)
        ]);

        // 2. Ambil Transaksi
        $transaction = Transaction::find($request->transaction_id);

        // 3. Proses Upload File (Langsung ke Public Folder)
        if ($request->hasFile('proof')) {
            $file = $request->file('proof');
            // Nama file unik: time_invoice.jpg
            $filename = time() . '_' . $transaction->no_invoice . '.' . $file->getClientOriginalExtension();

            // Pindahkan ke public/uploads/payment_proofs
            $file->move(public_path('uploads/payment_proofs'), $filename);

            // Simpan path ke database
            $transaction->bukti_pembayaran = 'uploads/payment_proofs/' . $filename;
            // Ubah status pembayaran
            $transaction->status_transaksi = 'Pending';
        }

        // 4. Update Status Transaksi
        // ubah jadi 'Pending', menunggu admin yang memvalidasi dan merubah ke 'Paid'.
        // tapi bukti sudah terupload.
        $transaction->save();

        // 5. Redirect ke Halaman Invoice
        return redirect()->route('customer.invoice', $transaction->transaction_id)
            ->with('success', 'Bukti pembayaran berhasil diunggah! Mohon tunggu konfirmasi admin.');
    }

    public function cancelTransaction(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'transaction_id' => 'required|exists:transactions,transaction_id',
        ]);

        // 2. Cari Transaksi
        $transaction = Transaction::find($request->transaction_id);

        // 3. Cek Keamanan
        if (!$transaction || $transaction->customer_id != session('user_id') || $transaction->status_transaksi != 'Unpaid') {
            return redirect()->back()->with('error', 'Tidak bisa membatalkan pesanan ini.');
        }

        try {
            DB::beginTransaction();

            // 4. Load Detail Transaksi BESERTA Menu-nya (Eager Loading)
            // Ini lebih efisien daripada Menu::find() di dalam loop
            $transaction->load('transactionDetails.menu');

            // 5. Kembalikan Stok Menu
            foreach ($transaction->transactionDetails as $detail) {
                // Cek apakah relasi menu ada (jaga-jaga jika menu terhapus soft-delete)
                if ($detail->menu) {
                    $detail->menu->increment('stok', $detail->quantity);
                }
            }

            // 6. Hapus Reservasi (Jika ada)
            // Gunakan relasi, lebih aman daripada query manual
            if ($transaction->reservations()->exists()) {
                $transaction->reservations()->delete();
            }

            // 7. Hapus Detail & Transaksi Utama
            $transaction->transactionDetails()->delete();
            $transaction->delete();

            DB::commit();

            return redirect()->route('home')->with('success', 'Pesanan dibatalkan. Silakan pesan kembali.');
        } catch (\Exception $e) {
            DB::rollBack();
            // Log::error('Cancel Transaction Error: ' . $e->getMessage()); 
            return redirect()->back()->with('error', 'Gagal membatalkan pesanan.');
        }
    }
}
