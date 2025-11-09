<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Menghubungkan Model-mu ke "Pabrik Data Palsu"-nya (Factory). berguna ada fitur untuk membuat data palsu (seperti Customer::factory()->count(50)->create())
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    // tidak perlu kita tulis  protected $table = 'nama_tabel'; untuk beri tahu tabel yang benar, karena laravel sudah menganggap model ini berinteraksi dengan tabel(customers) yang bernama bentuk jamak snake_case dari nama modelnya(Customer) dan itu valid sesuai tujuan model kita dibuat

    /**
     * Beri tahu model bahwa nama primary key-nya BUKAN 'id'.
     */
    protected $primaryKey = 'customer_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'no_telepon',
        'email',
        'password',
        'jenis_kelamin',
        'alamat'
    ];

    /**
     * Satu Customer "hasMany" (punya banyak) Transaction.
     */
    public function transactions()
    {
        // Parameter 1: Model yang dituju
        // Parameter 2: Nama foreign key di tabel 'transactions'
        // Parameter 3: Nama primary key di tabel INI ('customers')
        return $this->hasMany(Transaction::class, 'customer_id', 'customer_id');
    }

    public function feedbackreview()
    {
        return $this->hasOne(FeedbackReview::class, 'customer_id', 'customer_id');
    }

}

// relasi juga harus ada di model bukan di tabel database aja
// pakai syntax hasmany, belongto, dll cek dokumentasi laravel Eloquent ORM/relationship
// Relasi di database (Foreign Key) dan relasi di Model (Eloquent) adalah dua hal yang berbeda tapi saling melengkapi.