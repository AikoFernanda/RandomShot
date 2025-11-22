<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon; // Digunakan untuk manipulasi waktu/tanggal

class ProfileActivityController extends Controller
{
    /**
     * Mengambil riwayat transaksi (meja dan menu) yang pernah dipesan oleh pengguna.
     * View ini menampilkan SEMUA aktivitas.
     */
    public function index()
    {
        // 1. Ambil ID pengguna yang sedang login
        $customerId = session()->get('user_id');
         dd($customerId);
        if (!$customerId) {
            return redirect()->route('login')->with('error', 'Silakan login untuk melihat riwayat aktivitas.');
        }

        // 2. Ambil semua Transaksi dengan Eager Loading
        $transactions = Transaction::where('customer_id', $customerId)
            
            // Eager load details, item polymorphic (Menu/Table), dan reservations
            ->with(['transaction_details.item', 'transaction_details.reservation']) 
            
            // Urutkan dari transaksi terbaru (asumsi transaction_id adalah PK)
            ->latest('transaction_id') 
            ->get();

        // 3. Transformasi Data untuk Tampilan
        $activities = $transactions->flatMap(function ($transaction) {
            
            return $transaction->transaction_details->map(function ($detail) use ($transaction) {
                
                $isTable = $detail->item_type === 'App\Models\Table';
                $slotGroups = collect();

                // --- LOGIKA PENGELOMPOKAN SLOTS RESERVASI ---
                if ($isTable && $detail->reservation->isNotEmpty()) {
                    
                    $slotGroups = $detail->reservation
                        ->groupBy(function($reservation) {
                            // Kunci grup adalah tanggal pemesanan (e.g., '2025-11-19')
                            return Carbon::parse($reservation->waktu_mulai)->format('Y-m-d');
                        })
                        ->map(function ($reservationsPerDay) {
                            // Hitung waktu mulai dan selesai berdasarkan slot pertama dan terakhir di hari itu
                            $firstSlot = $reservationsPerDay->sortBy('waktu_mulai')->first();
                            $lastSlot = $reservationsPerDay->sortBy('waktu_mulai')->last();

                            return [
                                'tanggal' => Carbon::parse($firstSlot->waktu_mulai)->format('d/m/Y'),
                                'waktu_mulai' => Carbon::parse($firstSlot->waktu_mulai)->format('H.i'),
                                'waktu_selesai' => Carbon::parse($lastSlot->waktu_selesai)->format('H.i'),
                                'jumlah_slot' => $reservationsPerDay->count(),
                            ];
                        })
                        ->values(); // Reset keys agar menjadi array biasa
                }
                // --- AKHIR LOGIKA PENGELOMPOKAN SLOTS ---

                return [
                    // DATA TRANSAKSI UTAMA
                    'no_invoice' => $transaction->no_invoice,
                    'tanggal_transaksi' => $transaction->created_at->format('d M Y'),
                    
                    // DATA ITEM
                    'item_id' => $detail->item_id,
                    'item_type' => $detail->item_type,
                    // Gunakan nama meja tujuan atau nama item dari relasi polymorphic
                    'nama_item' => $detail->meja_tujuan ?? ($detail->item->nama ?? 'Item Tidak Dikenal'), 
                    'qty' => $detail->quantity, // qty bisa jadi jumlah jam (meja) atau jumlah menu

                    // DATA SPESIFIK RESERVASI
                    'is_reservation' => $isTable,
                    'slot_groups' => $slotGroups, // Koleksi slot yang sudah digrupkan
                    
                    // STATUS & HARGA
                    'status_pesanan' => $detail->status_pesanan,
                    'harga_total' => $detail->harga,
                    'gambar_src' => $isTable 
                        ? (asset('img/biliar.jpeg')) // Placeholder untuk Meja
                        : (asset('img/menu/' . $detail->item->nama_gambar ?? 'default.jpg')), // Asumsi item->nama_gambar
                ];
            });
        });

        // Pisahkan aktivitas untuk tampilan Reservasi Meja (halaman index)
        $reservasiActivities = $activities->filter(fn($activity) => $activity['is_reservation']);

        return view('profile.table-activity', [
            'title' => 'Aktivitas Saya',
            'activities' => $reservasiActivities, // Hanya kirim reservasi untuk index (default)
        ]);
    }
    
    /**
     * Mengambil riwayat transaksi Menu Cafe.
     * View ini digunakan untuk halaman Menu Cafe (customer.profile.activity.cafe).
     */
    public function index2()
    {
        // Panggil index() untuk mendapatkan semua aktivitas
        $allActivities = $this->index()->getData()['activities'];
        
        // Filter hanya untuk item Menu Cafe
        $cafeActivities = $allActivities->filter(fn($activity) => !$activity['is_reservation']);

        return view('profile.cafe-activity', [ // Asumsi ada view berbeda untuk cafe
            'title' => 'Aktivitas Menu Cafe',
            'activities' => $cafeActivities, 
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
