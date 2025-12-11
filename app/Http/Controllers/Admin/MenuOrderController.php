<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MenuOrderController extends Controller
{
    public function index(Request $request)
    {
        // Query Dasar Ambil TransactionDetail + Relasinya
        $query = TransactionDetail::with(['transaction.customer', 'menu']);

        // Filter Hanya ambil dari Transaksi yang 'Paid'
        $query->whereHas('transaction', function($q) {
            $q->where('status_transaksi', 'Paid');
        });

        // Filter Status Pesanan:
        // Hanya tampilkan 'Menunggu Dibuat' dan 'Selesai'
        // Status 'Dijadwalkan' otomatis TIDAK masuk di sini.
        $query->whereIn('status_pesanan', ['Menunggu Dibuat', 'Selesai']);

        // 4. Logika Pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                // Cari Nama Menu
                $q->whereHas('menu', function($m) use ($search) {
                    $m->where('nama', 'like', "%{$search}%");
                })
                // Atau No Invoice
                ->orWhereHas('transaction', function($t) use ($search) {
                    $t->where('no_invoice', 'like', "%{$search}%");
                })
                // Atau Nama Customer
                ->orWhereHas('transaction.customer', function($c) use ($search) {
                    $c->where('nama', 'like', "%{$search}%");
                });
            });
        }

        // Sorting: Prioritaskan yang 'Menunggu Dibuat', baru urutkan tanggal
        $query->orderByRaw("FIELD(status_pesanan, 'Menunggu Dibuat', 'Selesai')")
              ->latest(); // created_at desc

        // Pagination
        $orders = $query->paginate(10)->withQueryString();

        return view('admin.order_data', [
            'title' => 'Daftar Pesanan Menu',
            'orders' => $orders
        ]);
    }

    /**
     * Update Status Pesanan via AJAX
     */
    public function updateStatus(Request $request, $id)
    {
        $order = TransactionDetail::findOrFail($id);

        $request->validate([
            'status' => ['required', Rule::in(['Menunggu Dibuat', 'Selesai'])]
        ]);

        $order->status_pesanan = $request->status;
        $order->save();

        return response()->json(['success' => true]);
    }
}