<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation; // tambahkan user relation
use Illuminate\Support\ServiceProvider;

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
        //
        // tambahkan relation::morphMap 
        Relation::morphMap([
            'menu' => \App\Models\Menu::class,
            'table' => \App\Models\Table::class,
            // Nanti  bisa tambahkan 'admin', 'customer', dll. jika dibutuhkan di sini
            // Ini untuk kasus relasi model antara detail transaksi, table, dan menu
            // MorphMap adalah "buku terjemahan" di mana kamu memberi tahu Laravel: "Hei Laravel, jika kamu lihat string 'menu' di database, itu maksudnya adalah Model App\Models\Menu."
        ]);
        // coba di tinker:
        // $detail = App\Models\TransactionDetail::find(2)
        // $detail->item  
        // $detail // ini akan menampilkan perilaku 'lazy loading' laravel
    }
}
