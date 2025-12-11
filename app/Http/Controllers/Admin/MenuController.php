<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; // Untuk hapus file gambar
use Illuminate\Validation\Rule;

class MenuController extends Controller
{
    /**
     * Tampilkan daftar menu dengan pencarian & pagination
     */
    public function index(Request $request)
    {
        $query = Menu::query();

        // Logika Pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%");
            });
        }

        // Urutkan terbaru & Pagination
        $menus = $query->latest()->paginate(10)->withQueryString();

        return view('admin.data-menu', [
            'title' => 'Kelola Menu',
            'menus' => $menus
        ]);
    }

    /**
     * Simpan menu baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => [
                'required',
                'string',
                'max:255',
                // Cek unik di tabel 'tables', kolom 'nama'. 
                // Karena ini CREATE, tidak perlu ignore($id).
                Rule::unique('menus', 'nama') 
            ],
            'kategori' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048' // Max 2MB
        ]);

        // Upload Gambar
        $namaGambar = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            // Nama unik: waktu_namafile.ext
            $namaGambar = time() . '_' . $file->getClientOriginalName();
            // Simpan ke public/img/menu
            $file->move(public_path('img/menu'), $namaGambar);
        }

        Menu::create([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
            'nama_gambar' => $namaGambar
        ]);

        return redirect()->back()->with('success', 'Menu berhasil ditambahkan!');
    }

    /**
     * Update menu yang sudah ada
     */
    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'nama' => [
                'required',
                'string',
                'max:255',
                //  PERLU ignore, supaya meja ini tidak bentrok dengan namanya sendiri
                Rule::unique('menus', 'nama')->ignore($id, 'menu_id') 
            ],            
            'kategori' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Data yang akan diupdate
        $data = [
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
        ];

        // Cek jika ada upload gambar baru
        if ($request->hasFile('gambar')) {
            // 1. Hapus gambar lama jika ada
            if ($menu->nama_gambar && File::exists(public_path('img/menu/' . $menu->nama_gambar))) {
                File::delete(public_path('img/menu/' . $menu->nama_gambar));
            }

            // 2. Upload gambar baru
            $file = $request->file('gambar');
            $namaGambar = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/menu'), $namaGambar);

            // 3. Masukkan ke array data
            $data['nama_gambar'] = $namaGambar;
        }

        $menu->update($data);

        return redirect()->back()->with('success', 'Menu berhasil diperbarui!');
    }

    /**
     * Hapus menu
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        // Hapus gambar dari folder
        if ($menu->nama_gambar && File::exists(public_path('img/menu/' . $menu->nama_gambar))) {
            File::delete(public_path('img/menu/' . $menu->nama_gambar));
        }

        $menu->delete();

        return redirect()->back()->with('success', 'Menu berhasil dihapus!');
    }
}