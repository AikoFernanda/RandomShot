<?php

namespace App\Models;

use App\Models\User;
use App\Models\TransactionDetail;
use App\Models\Reservation;
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
        // Parameter 3: Nama primary key di tabel 'users'
        return $this->belongsTo(User::class, 'customer_id', 'user_id');
    }

    public function transaction_details() {
        return $this->hasMany(TransactionDetail::class, 'transaction_id', 'transaction_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id', 'user_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'transaction_id', 'transaction_id');
    }
}
