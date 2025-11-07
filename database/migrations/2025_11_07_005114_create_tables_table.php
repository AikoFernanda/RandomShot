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
        Schema::create('tables', function (Blueprint $table) {
            $table->id('table_id');
            $table->string('nama')->unique();
            $table->enum('kategori', ['Biliar', 'Tenis', 'Playstation']);
            $table->string('deskripsi')->nullable();
            $table->integer('tarif_per_jam_siang');
            $table->integer('tarif_per_jam_sore');
            $table->integer('tarif_per_jam_malam');
            $table->string('nama_gambar')->nullable();
            $table->enum('status', ['Tersedia', 'Dalam Perbaikan'])->default('Tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tables');
    }
};
