<?php

namespace App\Http\Controllers;

use App\Models\FeedbackReview;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB; 

class FeedbackReviewController extends Controller
{
    public function index(Request $request) {
        $userReview = null;

        if(session()->has('user_id')) {
            $userReview = FeedbackReview::where('customer_id', session('user_id'))->first();
        }

        // base query dengan eager loading customer
        $query = FeedbackReview::with('customer')->latest();
        
        // logika filter waktu
        if ($request->has('filter')) {
            switch ($request->filter) {
                case 'hari':
                    $query->where('created_at', '>=', Carbon::now()->subDay());
                    break;
                case 'minggu':
                    $query->where('created_at', '>=', Carbon::now()->subWeek());
                    break;
                case 'bulan':
                    $query->where('created_at', '>=', Carbon::now()->subMonth());
                    break;
            }
        }

        // ambil data (pagination)
        $reviews = $query->paginate(10)->withQueryString();

        // hitung statistik (untuk sidebar kiri)
        $totalReviews = FeedbackReview::count();
        $averageRating = FeedbackReview::avg('rating') ?? 0;

        // hitung persentase bintang 
        $starCounts = FeedbackReview::select('rating', DB::raw('count(*) as total'))
        ->groupBy('rating')
        ->pluck('total', 'rating')
        ->toArray();

        return view('review',compact(
            'reviews', 
            'totalReviews', 
            'averageRating', 
            'starCounts',
            'userReview'
            ));
    }

    public function store(Request $request) {
        $customer_id = session('user_id');

        if (!$customer_id) {
            return redirect()->route('login')->with('error', 'Silakan Masuk terlebih dahulu');
        }

        //validasi input
        $request->validate([
            'rating'=>'required|numeric|min:1|max:5',
            'review'=>'nullable|string|max:500'
        ]);

        /// LOGIKA CREATE OR UPDATE
        // Cari data berdasarkan 'customer_id', lalu update/buat dengan data di array kedua
        FeedbackReview::updateOrCreate(
            ['customer_id' => $customer_id], 
            [
                'rating' => $request->rating,
                'review' => $request->review
            ]
        );

        return back()->with('success', 'Ulasan Anda berhasil disimpan!');
    }
}
