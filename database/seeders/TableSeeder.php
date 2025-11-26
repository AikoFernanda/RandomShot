<?php

namespace Database\Seeders;

use App\Models\Table;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kita buat array data meja/unit rental
        $tables = [
            [
                'nama' => 'Meja Biliar 01',
                'kategori' => 'Biliar',
                'deskripsi' => 'Meja biliar standar turnamen, karpet biru.',
                'tarif_per_jam_siang' => 25000,
                'tarif_per_jam_sore' => 35000,
                'tarif_per_jam_malam' => 45000,
                'nama_gambar' => 'meja2.png',
                'status' => 'Tersedia',
            ],
            [
                'nama' => 'Tenis Meja',
                'kategori' => 'Tenis',
                'deskripsi' => 'Ruangan private AC, meja kualitas internasional.',
                'tarif_per_jam_siang' => 10000,
                'tarif_per_jam_sore' => 20000,
                'tarif_per_jam_malam' => 35000,
                'nama_gambar' => 'tenis.jpeg',
                'status' => 'Tersedia',
            ],
            [
                'nama' => 'Playstation 4',
                'kategori' => 'Playstation',
                'tarif_per_jam_siang' => 5000,
                'tarif_per_jam_sore' => 10000,
                'tarif_per_jam_malam' => 15000,
                'nama_gambar' => 'ps4.jpeg',
                'status' => 'Tersedia',
            ],
        ];

        // Looping untuk memasukkan data ke database
        foreach ($tables as $table) {
            Table::create($table);
        }
    }
}
