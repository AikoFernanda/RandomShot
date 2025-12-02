<?php

use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Robot ini akan jalan tiap menit
Schedule::call(function () {
    
    // Tentukan batas waktu (misal transaksi dibuat 15 menit yang lalu)
    $batas_waktu = Carbon::now()->subMinutes(15);

    // Cari transaksi yang 'Unpaid' dan sudah lewat batas waktu
    $expiredTransactions = Transaction::where('status_transaksi', 'Unpaid') // <-- PERBAIKAN TYPO: 'Unpaid'
        ->where('created_at', '<', $batas_waktu)
        ->with('transactionDetails') // Load detail menu biar bisa balikin stok
        ->get();

    foreach ($expiredTransactions as $transaction) {
        
        // --- A. KEMBALIKAN STOK MENU (Jika ada) ---
        foreach ($transaction->transactionDetails as $detail) {
            
            // Cek jika ini adalah menu (punya menu_id)
            if ($detail->menu_id) {
                $menu = Menu::find($detail->menu_id);
                if ($menu) {
                    // Kembalikan stok sebanyak yang dipesan
                    $menu->increment('stok', $detail->quantity); 
                }
            }
        }

        // --- B. HAPUS DATA ---
        // Hapus reservasi meja (jika ada)
        $transaction->reservations()->delete();
        
        // Hapus detail transaksi
        $transaction->transactionDetails()->delete();

        // Hapus permanen data transaksi utama
        $transaction->delete();
        
        // (Opsional) Log untuk memantau di storage/logs/laravel.log
        // \Log::info("Transaksi {$transaction->transaction_id} otomatis dibatalkan karena expired.");
    }

})->everyMinute(); 