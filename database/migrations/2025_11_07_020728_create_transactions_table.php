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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('transaction_id');
            $table->foreignId('customer_id')->constrained('users', 'user_id'); // secara eksplisit memberi tahu constrained() nama primary key custom di tabel tersebut
            $table->foreignId('admin_id')->nullable()->constrained('users', 'user_id');
            $table->string('no_invoice')->nullable()->unique();
            $table->enum('metode_pembayaran', ['Cash', 'Cashless']);
            $table->integer('total_transaksi');
            $table->enum('status_transaksi', ['Paid', 'Pending', 'Unpaid', 'Expired', 'Cancelled'])->default('Unpaid');
            $table->string('bukti_pembayaran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
