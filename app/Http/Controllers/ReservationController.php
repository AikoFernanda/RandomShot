<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;
use App\Models\Reservation;
use Carbon\Carbon; // Import Carbon untuk mengelola tanggal

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Table::query();

        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        $tables = $query->get();

        return view('reservation.table_reservation', [
            'title' => 'Reservation Page',
            'tables' => $tables
        ]);
    }

    public function store(Request $request)
    {
        // validate
        $request->validate([
            'table_id' => 'required|integer',
            'tanggal_pemesanan' => 'required|date',
            'selected_slots' => 'required|json'
        ]);

        // ambil data dari db dan request post form
        $table = Table::find($request->table_id);
        $selectedSlots = json_decode($request->selected_slots, true); // Ubah JSON jadi array

        // Hitung total harga reservasi
        $totalReservationPrice = 0;
        foreach ($selectedSlots as $slot) {
            $totalReservationPrice += $slot['price'];
        }

        // susun data disimpan session
        $reservationData = [
            'table_id' => $table->table_id,
            'nama' => $table->nama,
            'nama_gambar' => $table->nama_gambar,
            'tanggal_pemesanan' => $request->tanggal_pemesanan,
            'slots' => $selectedSlots,
            'total_price' => $totalReservationPrice
        ];

        // simpan ke session 'cart.reservation'
        session()->put('cart.reservation', $reservationData); // // INI ADALAH PENJAGA, mengoverwrite cart.reservation untuk mencegah dalam sesi ada 2 reservasi meja.

        return redirect()->route('cafe')->with('success', 'Meja Berhasil ditambahkan! Silahkan tambah menu yang diinginkan.');
    }
    
    /**
     * Display the specified resource.
    */
    public function show($id)
    {
        // Cari meja berdasarkan ID yang diklik
        $table = Table::findorFail($id);
        
        // Ambil SEMUA slot yang sudah dibooking untuk meja ini
        $bookedSlot = Reservation::whereHas('transactionDetail', function ($query) use ($id) { // Cari Reservasi yg mn relasi ke table transaction_details (model function transactionDetail())
            $query->where('item_id', $id)
            ->where('item_type', 'table');
        })->select('waktu_mulai')
        ->get(); // memiliki 'item_id' = $id DAN 'item_type' = 'Table
        
        $bookedSlotByDate = $bookedSlot
        ->groupBy(function ($booking) {
            // Ambil TANGGAL (YYYY-MM-DD) dari 'waktu_mulai'
            return Carbon::parse($booking->waktu_mulai)->format('Y-m-d');
        })
        ->map(function ($day) {
            // Ambil JAM (HH:MM:SS) dari 'waktu_mulai'
            return $day->pluck('waktu_mulai')->map(function ($datetime) {
                return Carbon::parse($datetime)->format('H:i:s');
            });
        });
        
        return view('reservation.table_detail', [
            'title' => 'Detail Page',
            'table' => $table,
            'bookedSlot' => $bookedSlot,
            'bookedSlotsJS' => $bookedSlotByDate->toJson(),
            
            'hargaSiang' => $table->tarif_per_jam_siang,
            'hargaSore' => $table->tarif_per_jam_sore,   // Asumsi nama kolom
            'hargaMalam' => $table->tarif_per_jam_malam  // Asumsi nama kolom
            
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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

/**
 * whereHas('transactionDetail', ...): Ini adalah perintah untuk "memfilter Reservation berdasarkan isi dari transactionDetail".
 * function ($query) use ($id): Ini adalah Closure (fungsi anonim) yang berisi filter untuk tabel transaction_details.
 * $query: Merujuk ke query builder untuk transaction_details.
 * use ($id): Ini penting agar kita bisa menggunakan variabel $id (dari URL) di dalam Closure ini.
 * $query->where(...): Ini adalah filter yang Anda inginkan, yang diterapkan pada tabel transaction_details.
 */
