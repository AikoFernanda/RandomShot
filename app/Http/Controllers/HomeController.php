<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\FeedbackReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Tambahkan ini jika pakai DB::raw (opsional di cara 1)

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Home Page';

        // ambil 4 menu favorit (menu terbanyak di transaksi)
        $favoriteMenus = Menu::withSum('transactionDetails as total_terjual', 'quantity') // hitung total qty
        ->orderByDesc('total_terjual') // urut dari yang terbanyak terjual
        ->take('4') // ambil 4 keatas
        ->get();

        // ambil 3 review terbaru dengan rating tertinggi >=4
        $reviews = FeedbackReview::with('customer')
        ->where('rating', '>=', 4)
        ->latest()
        ->limit(3)
        ->get();

        return view('home', compact('title', 'favoriteMenus', 'reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
