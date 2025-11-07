<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationalCost extends Model
{
    /** @use HasFactory<\Database\Factories\OperationalCostFactory> */
    use HasFactory;

    protected $primaryKey = 'operational_cost_id';

    protected $fillable = [
        'kategori',
        'deskripsi',
        'total_biaya'
    ];
}
