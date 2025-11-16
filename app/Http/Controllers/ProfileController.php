<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;    // Untuk berinteraksi dengan tabel 'users'
use Illuminate\Support\Facades\Session; // import session
use Illuminate\Support\Facades\Hash; // import facede hash
use Illuminate\Validation\Rule; // <-- PENTING: Import 'Rule'

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Gunakan findOrFail() agar otomatis 404 jika ID tidak ada
        $user_id = $request->session()->get('user_id');

        $user = User::findOrFail($user_id);

        return view('profile.profile', [
            'title' => 'User Profile',
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user_id = $request->session()->get('user_id');

        if (!$user_id) {
            // kembalikan JSON error agar ditangkap 'fetch'
            return response()->json(['success' => false, 'message' => 'Sesi tidak ditemukan.'], 401);
        }

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                // Beri tahu 'ignore' nama PK
                Rule::unique('users', 'email')->ignore($user_id, 'user_id'),
            ],
            'no_telepon' => 'required|numeric',
            'jenis_kelamin' => 'required|string|in:Pria,Wanita',
            'password' => 'nullable|string'
        ]);

        // Gunakan 'where' untuk mencari PK custom
        $user = User::where('user_id', $user_id)->first();

        // Jika user-nya (anehnya) tidak ada
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User tidak ditemukan.'], 404);
        }

        $user->fill([
            'nama' => $validatedData['nama'],
            'email' => $validatedData['email'],
            'no_telepon' => $validatedData['no_telepon'],
            'jenis_kelamin' => $validatedData['jenis_kelamin']
        ]);

        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Profil Berhasil Diperbarui'
        ]);
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
