<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SaleReportController extends Controller
{
    public function index(Request $request)
    {
        // 1. INISIALISASI QUERY
        // Kita mulai dengan query dasar ke tabel Transaction
        $query = Transaction::with(['customer']); // Eager load customer biar ringan

        // 2. LOGIKA FILTER

        // A. Filter Periode & Tanggal
        $period = $request->input('period', '1_week'); // Default 1 minggu terakhir
        $customDate = $request->input('date');

        if ($customDate) {
            // Jika user pilih tanggal spesifik, abaikan periode
            $query->whereDate('created_at', $customDate);
            $startDate = Carbon::parse($customDate);
            $endDate = Carbon::parse($customDate)->endOfDay();
        } else {
            // Gunakan Periode
            $endDate = Carbon::now();
            
            if ($period == 'today') {
                $startDate = Carbon::today();
            } elseif ($period == '1_week') {
                $startDate = Carbon::now()->subDays(7);
            } elseif ($period == '1_month') {
                $startDate = Carbon::now()->subMonth();
            } elseif ($period == '3_months') {
                $startDate = Carbon::now()->subMonths(3);
            } else {
                $startDate = Carbon::now()->subDays(7); // Default fallback
            }

            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        // B. Filter Status Pembayaran
        $status = $request->input('status', 'all');
        if ($status !== 'all') {
            // Mapping status dari dropdown ke database (sesuaikan dengan isi DB kamu)
            // Misal: 'lunas' -> 'Paid', 'pending' -> 'Unpaid'
            $dbStatus = match($status) {
                'lunas' => 'Paid',
                'pending' => 'Unpaid',
                'gagal' => 'Cancelled', // Asumsi ada status Failed/Cancelled
                default => 'Paid'
            };
            $query->where('status_transaksi', $dbStatus);
        }

        // C. Filter Tipe Penjualan (Cafe vs Meja)
        // Ini agak tricky karena 1 transaksi bisa campuran (Cafe + Meja).
        // Kita gunakan whereHas untuk mengecek isi detailnya.
        $type = $request->input('type', 'all');
        if ($type === 'cafe') {
            // Hanya tampilkan transaksi yang punya pesanan menu
            $query->whereHas('transactionDetails', function($q) {
                $q->whereNotNull('menu_id');
            });
        } elseif ($type === 'reservation') {
            // Hanya tampilkan transaksi yang punya reservasi meja
            $query->whereHas('reservations');
        }


        // 3. EKSEKUSI DATA SUMMARY (KARTU ATAS)
        // Kita clone query agar filter tetap berlaku, tapi kita hitung sum/count nya
        $summaryQuery = clone $query;
        
        $totalRevenue = $summaryQuery->where('status_transaksi', 'Paid')->sum('total_transaksi'); // Hanya hitung yang lunas
        
        $summaryQuery = clone $query; // Reset clone
        $totalTransactions = $summaryQuery->count();

        // Rata-rata Transaksi (AOV)
        $avgRevenue = $totalTransactions > 0 ? $totalRevenue / $totalTransactions : 0;

        // Total Item Terjual (Butuh join ke detail)
        $summaryQuery = clone $query;
        // Ambil ID transaksi yang lolos filter
        $transactionIds = $summaryQuery->pluck('transaction_id');
        $totalItemsSold = TransactionDetail::whereIn('transaction_id', $transactionIds)->sum('quantity');


        // 4. EKSEKUSI DATA GRAFIK (LINE CHART)
        // Grouping by Date
        $chartQuery = clone $query;
        $dailyData = $chartQuery
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_transaksi) as total'))
            ->where('status_transaksi', 'Paid') // Grafik hanya uang masuk (Lunas)
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $chartLabels = [];
        $chartData = [];
        
        // Isi tanggal kosong dengan 0 agar grafik rapi
        $periodRange = \Carbon\CarbonPeriod::create($startDate, $endDate);
        foreach ($periodRange as $dt) {
            $dateString = $dt->format('Y-m-d');
            $chartLabels[] = $dt->format('d M'); 
            
            $found = $dailyData->firstWhere('date', $dateString);
            $chartData[] = $found ? $found->total : 0;
        }


        // 5. EKSEKUSI DATA TABEL (PAGINATION)
        // Urutkan dari terbaru
        $transactions = $query->latest()->paginate(10)->withQueryString();


        return view('owner.sale-report', [
            'title' => 'Laporan Penjualan',
            
            // Data Filter (untuk menjaga state dropdown)
            'filters' => [
                'period' => $period,
                'date' => $customDate,
                'status' => $status,
                'type' => $type
            ],

            // Data Summary
            'totalRevenue' => $totalRevenue,
            'totalTransactions' => $totalTransactions,
            'avgRevenue' => $avgRevenue,
            'totalItemsSold' => $totalItemsSold,

            // Data Grafik
            'chartLabels' => $chartLabels,
            'chartData' => $chartData,

            // Data Tabel
            'transactions' => $transactions
        ]);
    }

    // Tambahkan method ini di paling bawah class
    public function show($id)
    {
        // Ambil transaksi beserta relasi detail-nya
        $transaction = Transaction::with([
            'customer', 
            'transactionDetails.menu', // Untuk lihat pesan menu apa
            'reservations.table'       // Untuk lihat booking meja apa
        ])->findOrFail($id);

        return view('owner.transaction-detail', [
            'title' => 'Detail Transaksi #' . $transaction->no_invoice,
            'trx' => $transaction
        ]);
    }
}