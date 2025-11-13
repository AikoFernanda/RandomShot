<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackReview extends Model
{
    /** @use HasFactory<\Database\Factories\FeedbackReviewFactory> */
    use HasFactory;

    protected $primaryKey = 'feedback_review_id';

    protected $fillable = [
        'customer_id',
        'feedback',
        'review',
        'rating'
    ];

    public function customer() {
        return $this->belongsTo(User::class, 'customer_id', 'user_id');
    }
}