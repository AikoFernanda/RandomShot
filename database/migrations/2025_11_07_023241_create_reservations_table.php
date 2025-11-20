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
            $table->foreignId('transaction_detail_id')->constrained('transaction_details', 'transaction_detail_id');
            $table->dateTime('waktu_mulai');
            $table->dateTime('waktu_selesai');
            $table->enum('status', ['Checked-in', 'Menunggu Check-in', 'Selesai'])->default("Menunggu Check-in");
            $table->timestamps();

            // Membuat batasan unik gabungan (waktu_mulai + detail transaksi)
            $table->unique(['waktu_mulai', 'transaction_detail_id']);
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
