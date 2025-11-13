<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) // <-- Injeksi 'Request'
    {

        // 1. Ambil dari request ('per_page'), jika tidak ada, default-nya 10.
        $perPage = $request->input('per_page', 10);
        // 2. Mulai query
        $query = User::where('peran', 'customer');

        // 3. Cek apakah ada input 'search'
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;

            // 4. Tambahkan filter 'where' ke query (Cari di kolom 'nama')
            $query->where(function ($q) use ($searchTerm) {
                $q->where('nama', 'like', '%' . $searchTerm . '%');
            });
        }

        // 5. Gunakan variabel $perPage di paginate()
        $customers = $query->paginate($perPage);

        // 6. Kembalikan view (sama seperti sebelumnya)
        return view('admin.customer_data', [
            'title' => 'Data Customer',
            'customers' => $customers
            // 'perPage' => $perPage // Opsional
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(Request $request, $id)
    {
        // Cari customer berdasarkan ID, atau gagal (404)
        $customer = User::findOrFail($id);

        // Validasi data yang masuk (pastikan hanya 'Aktif' atau 'Nonaktif')
        $request->validate([
            'status' => 'required|string|in:Aktif,Nonaktif',
        ]);

        // Update kolom status di database
        $customer->status = $request->status;
        $customer->save();

        // Kembalikan respons JSON yang akan dibaca oleh fetch()
        return response()->json(['success' => true]);
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
