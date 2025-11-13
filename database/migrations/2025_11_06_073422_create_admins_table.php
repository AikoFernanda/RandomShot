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
            $table->id('admin_id');
            $table->foreignId('user_id')->constrained('users', 'user_id');
            $table->integer('gaji_bulanan')->nullable();
            $table->date('tanggal_mulai')->nullable(); // menyimpan tipe tanggal (dalam format YYYY-MM-DD, kolom itu sebagai string (teks) seperti 2025-01-10)
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
