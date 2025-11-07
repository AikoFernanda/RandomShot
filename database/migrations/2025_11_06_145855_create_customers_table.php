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
        Schema::create('customers', function (Blueprint $table) {
            $table->id('customer_id');
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('no_telepon')->unique();
            $table->string('alamat')->nullable();
            $table->enum('jenis_kelamin', ['Pria', 'Wanita', 'Unknown'])->default('Unknown'); // ->default('...'); Setelah enum(), bisa juga ditambahkan nilai defaultnya
            $table->timestamps(); // default timezone utc, WIB adalah UTC+7 (7 jam lebih cepat dari jam dunia).
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
