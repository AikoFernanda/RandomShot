<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule; // menentukan kolom ID mana yang harus di-ignore

class TableController extends Controller
{
    public function index(Request $request)
    {
        $query = Table::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%");
        }

        $tables = $query->orderBy('nama', 'asc')->paginate(10)->withQueryString();

        return view('admin.data-meja', [
            'title' => 'Kelola Meja Biliar',
            'tables' => $tables
        ]);
    }

    public function store(Request $request)
    {
        // 1. Hapus dd() supaya kode jalan
        // dd("MASUK PAK EKO! Data:", $request->all()); 

        $request->validate([
            'nama' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tables', 'nama') 
            ],
            'kategori' => 'required|string',
            'tarif_per_jam_siang' => 'required|numeric|min:0',
            'tarif_per_jam_sore' => 'required|numeric|min:0',
            'tarif_per_jam_malam' => 'required|numeric|min:0',
            
            // PERBAIKAN 1: Sesuaikan dengan name="status" di View
            'status' => 'required|string', 
            
            'deskripsi' => 'nullable|string',
            
            // PERBAIKAN 2: Sesuaikan dengan name="gambar" di View
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048' 
        ]);

        $namaGambar = null;
        
        // PERBAIKAN 3: Cek file 'gambar'
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaGambar = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $namaGambar);
        }

        Table::create([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'tarif_per_jam_siang' => $request->tarif_per_jam_siang,
            'tarif_per_jam_sore' => $request->tarif_per_jam_sore,
            'tarif_per_jam_malam' => $request->tarif_per_jam_malam,
            'status' => $request->status, 
            'nama_gambar' => $namaGambar
        ]);

        return redirect()->back()->with('success', 'Meja berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $table = Table::findOrFail($id);
    
        $request->validate([
            'nama' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tables', 'nama')->ignore($id, 'table_id') 
            ],            
            'kategori' => 'required|string',
            'tarif_per_jam_siang' => 'required|numeric|min:0',
            'tarif_per_jam_sore' => 'required|numeric|min:0',
            'tarif_per_jam_malam' => 'required|numeric|min:0',
            
            'status' => 'required|string',
            
            'deskripsi' => 'nullable|string',

            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = [
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'tarif_per_jam_siang' => $request->tarif_per_jam_siang,
            'tarif_per_jam_sore' => $request->tarif_per_jam_sore,
            'tarif_per_jam_malam' => $request->tarif_per_jam_malam,
            'status' => $request->status,
        ];

        if ($request->hasFile('gambar')) {
            if ($table->nama_gambar && File::exists(public_path('img/' . $table->nama_gambar))) {
                File::delete(public_path('img/' . $table->nama_gambar));
            }

            $file = $request->file('gambar');
            $namaGambar = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $namaGambar);
            
            $data['nama_gambar'] = $namaGambar;
        }

        $table->update($data);

        return redirect()->back()->with('success', 'Meja berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $table = Table::findOrFail($id);

        if ($table->nama_gambar && File::exists(public_path('img/' . $table->nama_gambar))) {
            File::delete(public_path('img/' . $table->nama_gambar));
        }

        $table->delete();

        return redirect()->back()->with('success', 'Meja berhasil dihapus!');
    }
}