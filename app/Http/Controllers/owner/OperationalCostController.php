<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\OperationalCost;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OperationalCostController extends Controller
{
    // Daftar Kategori sesuai Enum Database
    private $categories = [
        'Tagihan Utilitas',
        'Perlengkapan Habis Pakai',
        'Gaji Karyawan',
        'Sewa Tempat',
        'Internet dan Telepon',
        'Perawatan dan Perbaikan',
        'Bahan Baku Kafe',
        'Pemasaran dan Promosi',
        'Biaya Lain-lain'
    ];

    public function index(Request $request)
    {
        $query = OperationalCost::query();

        // 1. Filter Kategori
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        // 2. Filter Periode (Bulan ini, dll)
        if ($request->has('period') && $request->period != '') {
            $period = $request->period;
            if ($period == 'this_month') {
                $query->whereMonth('tanggal_biaya', Carbon::now()->month)
                      ->whereYear('tanggal_biaya', Carbon::now()->year);
            } elseif ($period == 'last_month') {
                $query->whereMonth('tanggal_biaya', Carbon::now()->subMonth()->month)
                      ->whereYear('tanggal_biaya', Carbon::now()->subMonth()->year);
            } elseif ($period == 'this_year') {
                $query->whereYear('tanggal_biaya', Carbon::now()->year);
            }
        }

        // 3. Sorting (Terbaru)
        $costs = $query->orderBy('tanggal_biaya', 'desc')
                       ->orderBy('created_at', 'desc')
                       ->paginate(10)
                       ->withQueryString();

        // Hitung Total Biaya (Untuk Summary Card kecil di atas tabel)
        $totalCostCurrentView = $query->sum('total_biaya');

        return view('owner.operational', [
            'title' => 'Biaya Operasional',
            'costs' => $costs,
            'categories' => $this->categories,
            'totalCost' => $totalCostCurrentView
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string',
            'total_biaya' => 'required|numeric|min:0',
            'tanggal_biaya' => 'required|date',
            'deskripsi' => 'nullable|string|max:500',
        ]);

        OperationalCost::create([
            'owner_id' => session('user_id'), // Ambil dari session login
            'kategori' => $request->kategori,
            'total_biaya' => $request->total_biaya,
            'tanggal_biaya' => $request->tanggal_biaya,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->back()->with('success', 'Data biaya berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $cost = OperationalCost::findOrFail($id);

        $request->validate([
            'kategori' => 'required|string',
            'total_biaya' => 'required|numeric|min:0',
            'tanggal_biaya' => 'required|date',
            'deskripsi' => 'nullable|string|max:500',
        ]);

        $cost->update([
            'kategori' => $request->kategori,
            'total_biaya' => $request->total_biaya,
            'tanggal_biaya' => $request->tanggal_biaya,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->back()->with('success', 'Data biaya berhasil diperbarui!');
    }

    public function destroy($id)
    {
        OperationalCost::destroy($id);
        return redirect()->back()->with('success', 'Data biaya berhasil dihapus!');
    }
}