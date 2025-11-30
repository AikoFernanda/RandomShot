<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationalCost extends Model
{
    /** @use HasFactory<\Database\Factories\OperationalCostFactory> */
    use HasFactory;

    protected $primaryKey = 'operational_cost_id';

    protected $fillable = [
        'owner_id',
        'kategori',
        'deskripsi',
        'total_biaya',
        'tanggal_biaya'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id', 'user_id');
    }
}
