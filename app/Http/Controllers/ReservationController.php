<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Table;
use App\Models\Reservation;
use App\Models\FeedbackReview;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB; 

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

        // ambil 3 review terbaru dengan rating tertinggi >=4
        $displayReviews = FeedbackReview::with('customer')
        ->where('rating', '>=', 4)
        ->latest()
        ->limit(3)
        ->get();

        // hitung statistik
        $totalReviews = FeedbackReview::count();
        $averageRating = FeedbackReview::avg('rating') ?? 0;

        // hitung persentase bintang
        $starCounts = FeedbackReview::select('rating', DB::raw('count(*) as total'))
        ->groupBy('rating')
        ->pluck('total', 'rating')
        ->toArray();

        return view('reservation.table_reservation', [
            'title' => 'Reservation Page',
            'tables' => $tables,
            'displayReviews' => $displayReviews,
            'totalReviews' => $totalReviews,
            'averageRating' => $averageRating,
            'starCounts' => $starCounts
        ]);
    }

    public function show($id)
    {
        // 1. Cari meja
        $table = Table::findOrFail($id);
        
        // 2. Ambil booking yang relevan (hari ini ke depan)
        $bookedData = Reservation::where('table_id', $id)
            ->whereDate('waktu_mulai', '>=', Carbon::today())
            ->get();
        
        // 3. Format data untuk JavaScript (Grouping by Date)
        $bookedSlotsByDate = $bookedData
            ->groupBy(function ($reservation) {
                // Key: Tanggal (Y-m-d)
                return Carbon::parse($reservation->waktu_mulai)->format('Y-m-d');
            })
            ->map(function ($reservations) {
                // Value: Array Jam Mulai (H:i)
                return $reservations->map(function ($reservation) {
                    return Carbon::parse($reservation->waktu_mulai)->format('H:i');
                })->toArray(); // Pastikan jadi array murni
            });
        
        return view('reservation.table_detail', [
            'title' => 'Detail Meja',
            'table' => $table,
            'hargaSiang' => $table->tarif_per_jam_siang,
            'hargaSore' => $table->tarif_per_jam_sore,
            'hargaMalam' => $table->tarif_per_jam_malam,
            'bookedSlotsJS' => $bookedSlotsByDate, // Kirim Collection langsung, blade akan otomatis json_encode di @json atau di script
            // Tambahkan data unpaid transaction
            'hasUnpaid' => false, // Default false
            'unpaidTransactionId' => null
        ]);
    }

    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'table_id' => 'required|exists:tables,table_id',
            'tanggal_pemesanan' => 'required|date|after_or_equal:today', // Jangan boleh booking masa lalu
            'selected_slots' => 'required' // json validation bisa tricky, cukup required dulu
        ]);

        // 2. Decode JSON
        $selectedSlots = json_decode($request->selected_slots, true);
        
        // Cek jika decode gagal atau kosong
        if (!$selectedSlots || count($selectedSlots) === 0) {
            return redirect()->back()->with('error', 'Silakan pilih slot waktu terlebih dahulu.');
        }

        $table = Table::find($request->table_id);

        // 3. Hitung Total
        $totalReservationPrice = 0;
        foreach ($selectedSlots as $slot) {
            $totalReservationPrice += $slot['price'];
        }

        // 4. Simpan ke Session
        $reservationData = [
            'table_id' => $table->table_id,
            'nama' => $table->nama,
            'nama_gambar' => $table->nama_gambar,
            'tanggal_pemesanan' => $request->tanggal_pemesanan,
            'slots' => $selectedSlots,
            'total_price' => $totalReservationPrice
        ];

        session()->put('cart.reservation', $reservationData);

        // 5. Redirect ke Cart/Menu
        return redirect()->route('cafe')->with('success', 'Meja berhasil dipilih! Silakan lanjut pilih menu.');
    }
}