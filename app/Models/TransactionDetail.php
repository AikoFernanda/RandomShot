<?php

namespace App\Models;

use App\Models\Transaction;
use App\Models\Reservation;
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
        'transaction_id',
        'item_id',
        'item_type',
        'quantity',
        'deskripsi',
        'meja_tujuan',
        'status_pesanan',
        'harga'
    ];
    // kolom created_at dan updated_at yang dibuat otomatis oleh $table->timestamps(); tidak perlu didefinisikan dalam $fillable.
    // hanya perlu fokus mendefinisikan kolom-kolom yang datanya berasal dari input pengguna atau logika aplikasi spesifik ke dalam properti $fillable. Kolom timestamps biarkan Laravel yang urus.

    public function reservation() {
        return $this->hasOne(Reservation::class, 'transaction_detail_id', 'transaction_detail_id');
    }

    public function transaction() {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'transaction_id'); //transaction_detail_id
    }

        /**
    * Berdasarkan nama function 'item' itu, Laravel secara otomatis mencari dua kolom di tabel transaction_details yang cocok dengan pola:
    * [nama_fungsi]_id -> menjadi item_id
    * [nama_fungsi]_type -> menjadi item_type
    */
    public function item()
    {
        return $this->morphTo();
        // Buka file Service Provider utamamu: app/Providers/AppServiceProvider.php 
        // tambahkan use relation, cari fungsi boot(). Di dalamnya, "daftarkan" semua "nama panggilan" (nickname) model.
        // Tambahkan Relation::morphMap([...]).
    }
}

// function item:
// Ini disebut Relasi Polimorfik (Polymorphic Relationship).
// Polymorphic: Berasal dari bahasa Yunani, "Poli" (Banyak) dan "Morph" (Bentuk).
// Artinya: Satu relasi yang bisa memiliki "banyak bentuk". Dalam kasusmu, item_id bisa "berbentuk" Menu atau "berbentuk" Table.
// Ini adalah kuncinya: TIDAK BISA menggunakan Foreign Key di level database.

// tidak bisa menulis ini di migrasimu: $table->foreignId('item_id')->constrained(???); // <-- Gagal, mau ke 'menus' atau 'tables'?
// Database tidak bisa menangani FK yang ambigu.
// Jadi, relasi ini 100% diatur oleh APLIKASI-mu (Laravel), bukan oleh DATABASE-mu (MySQL).

// Saat Laravel melihat fungsi bernama item() yang memanggil morphTo(), dia tidak mencari satu kolom. Dia secara otomatis mencari dua kolom di tabelmu:
// [nama_fungsi]_type -> item_type
// [nama_fungsi]_id -> item_id

// Cara Kerjanya: Saat memanggil $detail->item, Laravel akan:
// Melihat ke kolom item_type (misal, isinya "App\Models\Menu").
// Melihat ke kolom item_id (misal, isinya "10").
// Menggabungkannya menjadi satu query di belakang layar: "Tolong cari di tabel menus data dengan id 10."