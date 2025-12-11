<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\FeedbackReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FeedbackController extends Controller
{
    public function index(Request $request)
    {
        // FILTER PERIODE
        // Default: 30 Hari Terakhir agar data tidak terlalu berat
        $startDate = $request->input('start_date', Carbon::now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->format('Y-m-d'));

        // Query Dasar (Filter Tanggal)
        $baseQuery = FeedbackReview::with('customer')
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);

        // DATA TAB 1: FEEDBACK (Masukan Teks)
        // Ambil yang kolom 'feedback'-nya tidak kosong
        $feedbacks = (clone $baseQuery)
            ->whereNotNull('feedback')
            ->where('feedback', '!=', '')
            ->latest()
            ->get();

        // DATA TAB 2: RATING (Bintang & Review)
        // Ambil yang kolom 'rating'-nya tidak kosong
        $reviews = (clone $baseQuery)
            ->whereNotNull('rating')
            ->latest()
            ->get();

        // STATISTIK RATING
        $avgRating = $reviews->avg('rating') ?? 0;
        $totalRatingCount = $reviews->count();
        
        // Distribusi Bintang (5, 4, 3, 2, 1)
        $starDistribution = [
            5 => $reviews->where('rating', 5)->count(),
            4 => $reviews->where('rating', 4)->count(),
            3 => $reviews->where('rating', 3)->count(),
            2 => $reviews->where('rating', 2)->count(),
            1 => $reviews->where('rating', 1)->count(),
        ];

        return view('owner.feedback', [
            'title' => 'Feedback & Rating',
            'feedbacks' => $feedbacks,
            'reviews' => $reviews,
            'avgRating' => $avgRating,
            'totalRatingCount' => $totalRatingCount,
            'starDistribution' => $starDistribution,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);
    }
}