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
        Schema::create('operational_costs', function (Blueprint $table) {
            $table->id('operational_cost_id');
            $table->foreignId('owner_id')->constrained('users', 'user_id');
            $table->enum('kategori', ['Tagihan Utilitas', 'Perlengkapan Habis Pakai', 'Gaji Karyawan', 'Sewa Tempat', 'Internet dan Telepon', 'Perawatan dan Perbaikan', 'Bahan Baku Kafe', 'Pemasaran dan Promosi', 'Biaya Lain-lain']);
            $table->string('deskripsi')->nullable();
            $table->integer(('total_biaya'));
            $table->timestamp('tanggal_biaya');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operational_costs');
    }
};
