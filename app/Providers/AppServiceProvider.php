<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // Import View
use App\Models\Transaction; // Import Model
use App\Models\TransactionDetail; // Import Model
use Illuminate\Support\Facades\Auth; // Import Auth

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // paksa saat production https
        if (env('APP_ENV') === 'production') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        // untuk notif profil, jika ada unpaid transaction
        // View Composer: Jalankan fungsi ini setiap kali view 'components.header' dipanggil
        View::composer('components.header', function ($view) {
            $hasUnpaid = false;

            // Cek jika user login (sesuaikan dengan logic loginmu, misal session('user_id'))
            if (session()->has('user_id')) {
                $hasUnpaid = Transaction::where('customer_id', session('user_id'))
                    ->where('status_transaksi', 'Unpaid')
                    ->exists();
            }

            // Kirim variabel $hasUnpaid ke view
            $view->with('hasUnpaid', $hasUnpaid);
        });

        // Mengirim data ke SEMUA view yang ada di dalam folder 'components' (termasuk layout-admin dan HeaderAdmin)
        // Atau bisa pakai view('*') untuk ke semua halaman
        View::composer('*', function ($view) {

            // 1. Hitung Transaksi Pending (Unpaid)
            $pendingTrxCount = Transaction::where('status_transaksi', 'Pending')->count();

            // 2. Hitung Pesanan Menu (Menunggu Dibuat)
            // Syarat: Status Pesanan 'Menunggu Dibuat' DAN Transaksinya sudah 'Paid'
            $pendingOrdersCount = TransactionDetail::where('status_pesanan', 'Menunggu Dibuat')
                ->whereHas('transaction', function ($q) {
                    $q->where('status_transaksi', 'Paid');
                })
                ->count();

                // dd("Total TRX: $pendingTrxCount", "Total Order: $pendingOrdersCount");
            // Kirim kedua variabel ke View
            $view->with('pendingTrxCount', $pendingTrxCount);
            $view->with('pendingOrdersCount', $pendingOrdersCount);
        });
    }
}
