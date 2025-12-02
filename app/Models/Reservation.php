<?php

namespace App\Models;

use App\Models\Transaction;
use App\Models\Table;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    /** @use HasFactory<\Database\Factories\ReservationFactory> */
    use HasFactory;

    /**
     * Beri tahu model bahwa nama primary key-nya BUKAN 'id'.
     */
    protected $primaryKey = 'reservation_id';

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    
    protected $fillable = [
        'transaction_id',
        'table_id',
        'waktu_mulai',
        'waktu_selesai',
        'status_reservasi',
        'tanggal_reservasi'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'transaction_id');
    }

    public function table()
    {
        return $this->belongsTo(Table::class, 'table_id', 'table_id');
    }
}
