<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test_auth extends Model
{
    use HasFactory;

    /**
     * Beri tahu Laravel nama tabel yang benar.
     */
    protected $table = 'test_customers'; // WAJIB ADA: Memberi tahu tabel yang benar

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'nama',
        'email',
        'password',
        'alamat',
        'no_telepon'
    ]; // WAJIB ADA: Izin untuk mengisi kolom-kolom ini, kebalikannya guarded (yang tidak boleh diisi)
    
}