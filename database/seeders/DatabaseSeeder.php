<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     * DatabaseSeeder akan men-seed apa pun yang kamu panggil di dalam run()
     * DatabaseSeeder sebagai induk dari segala seed
     */
    public function run(): void
    {
        // User::factory(10)->create();
        //     User::factory()->create([
        //         'name' => 'Test User',
        //         'email' => 'test@example.com',
        //     ]);
        // 

        /**
         * di cmd langsung: php artisan db:seed
         * db:seed → Laravel menjalankan DatabaseSeeder 
         * DatabaseSeeder → memanggil semua seeder dalam $this->call()
         * Seeder-seeder itu → melakukan insert data ke tabel masing-masing
         */

        $this->call([
            UserSeeder::class,
            MenuSeeder::class,
            TableSeeder::class,
        ]);
    }
}
