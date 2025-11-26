<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            [
                'nama' => 'Kopi Kapal Api',
                'kategori' => 'Minuman',
                'nama_gambar' => 'kopi-kapal-api.png',
                'harga' => 5000,
                'stok' => 50,
            ],
            [
                'nama' => 'Es Teh Manis',
                'kategori' => 'Minuman',
                'nama_gambar' => 'es-teh.png',
                'harga' => 3000,
                'stok' => 100,
            ],
            [
                'nama' => 'Kopi Oplet',
                'kategori' => 'Minuman',
                'nama_gambar' => 'kopi-oplet.png',
                'harga' => 5000,
                'stok' => 20,
            ],
            [
                'nama' => 'Kopi Good Day',
                'kategori' => 'Minuman',
                'nama_gambar' => 'kopi-good-day.png',
                'harga' => 5000,
                'stok' => 80,
            ],
            [
                'nama' => 'Kopi Liong',
                'kategori' => 'Minuman',
                'nama_gambar' => 'kopi-liong.png',
                'harga' => 5000,
                'stok' => 40,
            ],
            [
                'nama' => 'Kopi Indocafe',
                'kategori' => 'Minuman',
                'nama_gambar' => 'kopi-indocafe.png',
                'harga' => 5000,
                'stok' => 60,
            ],
            [
                'nama' => 'Es Milo',
                'kategori' => 'Minuman',
                'nama_gambar' => 'es-milo.png',
                'harga' => 5000,
                'stok' => 30,
            ],
            [
                'nama' => 'Es Good Day Freeze',
                'kategori' => 'Minuman',
                'nama_gambar' => 'es-good-day-freeze.png',
                'harga' => 10000,
                'stok' => 70,
            ],
        ];

        // Looping untuk memasukkan data ke database
        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
