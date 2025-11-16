<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionDetail;    // Untuk berinteraksi dengan tabel 'users'
use Illuminate\Support\Facades\Session; // import session
use Illuminate\Support\Facades\Hash; // import facede hash
use Illuminate\Validation\Rule; // <-- PENTING: Import 'Rule'

class ProfileActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Gunakan findOrFail() agar otomatis 404 jika ID tidak ada
        // $user_id = $request->session()->get('user_id');

        // $user = TransactionDetail::findOrFail($user_id);

        return view('profile.table-activity', [
            'title' => 'User Activity',
            // 'user' => $user
        ]);
    }

    public function index2(Request $request)
    {
        // Gunakan findOrFail() agar otomatis 404 jika ID tidak ada
        // $user_id = $request->session()->get('user_id');

        // $user = TransactionDetail::findOrFail($user_id);

        return view('profile.cafe-activity', [
            'title' => 'User Activity',
            // 'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
