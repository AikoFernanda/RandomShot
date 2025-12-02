<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Admin;
use App\Models\Transaction;
use App\Models\FeedbackReview;
use App\Models\OperationalCost;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

        /**
     * Beri tahu model bahwa nama primary key-nya BUKAN 'id'.
     */
    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
        'no_telepon',
        'jenis_kelamin',
        'alamat',
        'peran',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    /**
     * Satu Customer "hasMany" (punya banyak) Transaction.
     */
    public function transactions()
    {
        // Parameter 1: Model yang dituju
        // Parameter 2: Nama foreign key di tabel 'transactions'
        // Parameter 3: Nama primary key di tabel INI ('customers')
        return $this->hasMany(Transaction::class, 'customer_id', 'user_id');
    }

    public function adminTransactions()
    {
        return $this->hasMany(Transaction::class, 'admin_id', 'user_id');
    }

    public function feedbackreview()
    {
        return $this->hasOne(FeedbackReview::class, 'customer_id', 'user_id');
    }

    public function admin()
    {
        return $this->hasOne(Admin::class, 'user_id', 'user_id');
    }

    public function operationalcosts()
    {
        return $this->hasMany(OperationalCost::class, 'owner_id', 'user_id');
    }
}
