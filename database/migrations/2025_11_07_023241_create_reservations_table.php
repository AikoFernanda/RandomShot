<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id('reservation_id');
            $table->foreignId('transaction_id')->constrained('transactions', 'transaction_id');
            $table->foreignId('table_id')->constrained('tables', 'table_id');
            $table->dateTime('waktu_mulai');
            $table->dateTime('waktu_selesai');
            $table->enum('status_reservasi', ['Checked-in', 'Menunggu Check-in', 'Selesai'])->default("Menunggu Check-in");
            $table->date('tanggal_reservasi');
            $table->integer('harga');
            $table->timestamps();

            // Membuat batasan unik gabungan (waktu_mulai + table_id)
            $table->unique(['waktu_mulai', 'table_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
