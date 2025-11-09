<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory;

    /**
     * Beri tahu model bahwa nama primary key-nya BUKAN 'id'.
     */
    protected $primaryKey = 'transaction_id';

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_id',
        'admin_id',
        'no_invoice',
        'metode_pembayaran',
        'total_transaksi',
        'status_transaksi'
    ];

    /**
     * Satu Transaction "belongsTo" (dimiliki oleh) satu Customer.
     */
    public function customer()
    {
        // Parameter 1: Model yang dituju
        // Parameter 2: Nama foreign key di tabel INI ('transactions')
        // Parameter 3: Nama primary key di tabel 'customers'
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    public function transaction_details() {
        return $this->hasMany(TransactionDetail::class, 'transaction_id', 'transaction_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'admin_id');
    }

    public function reservation()
    {
        return $this->hasOne(Reservation::class, 'transaction_id', 'transaction_id');
    }
}
