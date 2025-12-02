<?php

namespace App\Models;

use App\Models\TransactionDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /** @use HasFactory<\Database\Factories\MenuFactory> */
    use HasFactory;

    /**
     * Beri tahu model bahwa nama primary key-nya BUKAN 'id'.
     */
    protected $primaryKey = 'menu_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    
    protected $fillable = [
        'nama',
        'kategori',
        'deskripsi',
        'harga',
        'stok',
        'nama_gambar'
    ];

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class, 'menu_id','menu_id');
    }
}
