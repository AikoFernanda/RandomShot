<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil Data Owner
        $owners = User::where('peran', 'Owner')->get();

        // 2. Ambil Data Employee
        $query = User::where('peran', 'Employee');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $employees = $query->latest()->paginate(10)->withQueryString();

        return view('owner.data-admin', [
            'title' => 'Kelola Data Admin',
            'owners' => $owners,
            'employees' => $employees
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'no_telepon' => 'required|string|max:15',
            'alamat' => 'nullable|string|max:500',
            'peran' => 'required|in:Owner,Employee',
            'jenis_kelamin' => 'required|in:Pria,Wanita,Unknown',
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
            'peran' => $request->peran,
            'status' => 'Aktif',
            'jenis_kelamin' => $request->jenis_kelamin
        ]);

        return redirect()->back()->with('success', 'Akun berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($id, 'user_id')],
            'password' => 'nullable|min:6',
            'no_telepon' => 'nullable|string|max:15',
            'alamat' => 'nullable|string|max:500',
            'peran' => 'required|in:Owner,Employee',
            'status' => 'required|in:Aktif,Nonaktif',
            'jenis_kelamin' => 'required|in:Pria,Wanita,Unknown'
        ]);

        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
            'peran' => $request->peran,
            'status' => $request->status,
            'jenis_kelamin' => $request->jenis_kelamin
        ];

        // Update Password jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->back()->with('success', 'Data akun berhasil diperbarui!');
    }

    public function destroy($id)
    {
        if ($id == session('user_id')) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun sendiri!');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Akun berhasil dihapus!');
    }
}