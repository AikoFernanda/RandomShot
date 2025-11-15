<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'nama' => 'aiko',
                'email' => 'aiko@gmail.com',
                'password' => bcrypt('aiko123'),
                'no_telepon' => '08123456789',
                'alamat' => 'Jalan Terusan Surabaya',
                'peran' => 'Employee'
            ],
            [
                'nama' => 'anggi',
                'email' => 'anggi@gmail.com',
                'password' => bcrypt('anggi123'),
                'no_telepon' => '08123456788',
                'alamat' => 'Batu',
                'peran' => 'Customer'
            ],
            [
                'nama' => 'afra',
                'email' => 'afra@gmail.com',
                'password' => bcrypt('afra123'),
                'no_telepon' => '08123456787',
                'alamat' => 'Jalan Lupa',
                'peran' => 'Customer'
            ]
        ];

        // create gabisa insert banyak array, pakai User::insert ([[]]) kalo mau banyak sekaligus
        foreach($users as $user) {
            User::create($user);
        }
    }
}
