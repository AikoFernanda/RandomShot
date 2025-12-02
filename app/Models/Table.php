<?php

namespace App\Models;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    /** @use HasFactory<\Database\Factories\TableFactory> */
    use HasFactory;

    /**
     * Beri tahu model bahwa nama primary key-nya BUKAN 'id'.
     */
    protected $primaryKey = 'table_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'nama',
        'kategori',
        'deskripsi',
        'tarif_per_jam_siang',
        'tarif_per_jam_sore',
        'tarif_per_jam_malam',
        'nama_gambar',
        'status_meja'
    ];

    /**
     * Dapatkan semua detail transaksi untuk meja ini.
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'table_id', 'table_id');
    }
}
