<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // Import View
use App\Models\Transaction; // Import Model
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
    }
}