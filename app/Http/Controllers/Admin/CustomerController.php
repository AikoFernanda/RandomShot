<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Query Dasar: Ambil user 'customer' & urutkan dari yang terbaru
        $query = User::where('peran', 'customer')->latest();

        // Logika Pencarian (Nama atau No HP)
        // Pakai 'orWhere' agar placeholder search di view ("Cari Nama, No HP") berfungsi.
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('no_telepon', 'like', "%{$search}%");
            });
        }

        // Pagination Fixed (10 per halaman)
        //    withQueryString() penting agar saat pindah ke halaman 2, hasil pencarian tidak hilang.
        $customers = $query->paginate(10)->withQueryString();

        return view('admin.customer_data', [
            'title' => 'Data Pelanggan',
            'customers' => $customers
        ]);
    }

    /**
     * Update status customer via Fetch/AJAX.
     */
    public function updateStatus(Request $request, $id)
    {
        // Keamanan: Pastikan yang diedit benar-benar 'customer' (bukan admin/owner)
        $customer = User::where('peran', 'customer')->findOrFail($id);

        // 2. Validasi Input
        $request->validate([
            'status' => ['required', Rule::in(['Aktif', 'Nonaktif'])],
        ]);

        // 3. Simpan Perubahan
        $customer->status = $request->status;
        $customer->save();

        return response()->json(['success' => true]);
    }
}