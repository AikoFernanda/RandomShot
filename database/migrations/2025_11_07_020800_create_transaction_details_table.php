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
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id('transaction_detail_id');
            $table->foreignId('transaction_id')->constrained('transactions', 'transaction_id');
            $table->foreignId('menu_id')->constrained('menus', 'menu_id');
            $table->enum('menu_type', ['Makanan', 'Minuman']);
            $table->integer('quantity');
            $table->string('deskripsi')->nullable();
            $table->string('meja_tujuan');
            $table->enum('status_pesanan', ['Selesai', 'Menunggu Dibuat', 'Dijadwalkan'])->default('Menunggu Dibuat');
            $table->integer('harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
    }
};
