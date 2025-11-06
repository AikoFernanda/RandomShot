<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void // Fungsi up berisi instruksi untuk membuat perubahan pada databasemu. Kapan dijalankan: Saat kamu mengetik php artisan migrate
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('no_telepon')->unique();
            $table->string('alamat')->nullable();
            $table->enum('jenis_kelamin', ['Pria', 'Wanita', 'Unknown'])->default('Unknown'); // ->default('...'); Setelah enum(), bisa juga ditambahkan nilai defaultnya
            $table->enum('peran', ['Employee', 'Owner'])->default('Employee');
            $table->integer('gaji_bulanan')->nullable();
            $table->date('tanggal_mulai'); // menyimpan tipe tanggal (dalam format YYYY-MM-DD, kolom itu sebagai string (teks) seperti 2025-01-10)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void // Fungsi down berisi instruksi yang berkebalikan persis dengan fungsi up. Tujuannya adalah untuk membatalkan (undo) apa pun yang dilakukan oleh up. Kapan dijalankan: Saat kamu mengetik php artisan migrate:rollback
    {
        Schema::dropIfExists('admins');
    }
};
