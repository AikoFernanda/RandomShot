<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory;

    /**
     * Beri tahu model bahwa nama primary key-nya BUKAN 'id'.
     */
    protected $primaryKey = 'transaction_detail_id';

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_id',
        'transaction_id',
        'item_id',
        'item_type',
        'jumlah_item',
        'deksripsi',
        'meja_tujuan',
        'status_pesanan',
        'harga'
    ];
    // olom created_at dan updated_at yang dibuat otomatis oleh $table->timestamps(); tidak perlu didefinisikan dalam $fillable.
    // hanya perlu fokus mendefinisikan kolom-kolom yang datanya berasal dari input pengguna atau logika aplikasi spesifik ke dalam properti $fillable. Kolom timestamps biarkan Laravel yang urus.
}
