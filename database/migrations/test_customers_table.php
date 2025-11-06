<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void // down untuk create table
    {
        Schema::create('test_customers', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('alamat')->nullable();
            $table->string('no_telepon');
            $table->timestamps(); // membuat 2 kolom otomatis dibuat(created_at) dan diupdate(updated_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void // down untuk delete table
    {
        Schema::dropIfExists('test_customers');
    }
};