<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Kita inject Request di sini
    public function index(Request $request)
    {
        // 1. Ambil ID user dari session MELALUI object Request
        // Ini lebih aman dan eksplisit
        $user_id = $request->session()->get('user_id');

        // 2. Ambil data transaksi
        $transaction_history = Transaction::where('customer_id', $user_id)
            ->latest()
            ->get();

        return view('profile.transaction_history', [
            'title' => 'Riwayat Transaksi',
            'transactionHistory' => $transaction_history
        ]);
    }

    /**
     * Menampilkan detail satu transaksi spesifik.
     */
    public function show(Request $request)
    {
        // Validasi input agar tidak error jika ID kosong
        $request->validate([
            'transaction_id' => 'required|exists:transactions,transaction_id'
        ]);

        // PERBAIKAN: Gunakan first() atau find() untuk dapat 1 objek
        // find() lebih ringkas jika mencari berdasarkan primary key
        $transaction = Transaction::find($request->input('transaction_id'));

        // Jika transaksi tidak ditemukan (opsional, karena sudah divalidasi 'exists')
        if (!$transaction) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }

        // 1. Cek Otorisasi (Keamanan)
        if ($transaction->customer_id != $request->session()->get('user_id')) {
            abort(403, 'Unauthorized action.');
        }

        // 2. Load Relasi (Eager Loading)
        $transaction->load([
            'transactionDetails.menu',
            'reservations.table'
        ]);

        // 3. Siapkan Data untuk View
        $itemsData = $transaction->transactionDetails;
        $reservationData = $transaction->reservations->first();

        $selectedTable = null;
        if ($reservationData) {
            $selectedTable = $reservationData->table->nama_meja ?? 'Meja Terhapus';
        } elseif ($itemsData->isNotEmpty()) {
            $selectedTable = $itemsData->first()->meja_tujuan;
        }

        return view('profile.transaction-detail', [
            'title' => 'Detail Transaksi #' . $transaction->no_invoice,
            'transaction' => $transaction,
            'itemsData' => $itemsData,
            'reservationData' => $reservationData,
            'selectedTable' => $selectedTable
        ]);
    }
}
