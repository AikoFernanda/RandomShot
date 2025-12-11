<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Reservation;
use App\Models\FeedbackReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PerformanceController extends Controller
{
    public function index(Request $request)
    {
        // FILTER JANGKA PENDEK
        $periodFilter = $request->input('period', 'today'); 
        $endDate = Carbon::now();
        
        if ($periodFilter == 'today') {
            $startDate = Carbon::today();
            $chartLabelType = 'hour';
        } elseif ($periodFilter == 'yesterday') {
            $startDate = Carbon::yesterday();
            $endDate = Carbon::yesterday()->endOfDay();
            $chartLabelType = 'hour';
        } elseif ($periodFilter == 'this_week') {
            $startDate = Carbon::now()->startOfWeek();
            $chartLabelType = 'day';
        } else {
            // Default 7 Hari Terakhir
            $startDate = Carbon::now()->subDays(6);
            $chartLabelType = 'day';
        }

        // KARTU SUMMARY (Realtime Hari Ini) 
        $todayDate = Carbon::today();
        $revenueToday = Transaction::whereDate('created_at', $todayDate)->where('status_transaksi', 'Paid')->sum('total_transaksi');
        $trxToday = Transaction::whereDate('created_at', $todayDate)->where('status_transaksi', 'Paid')->count();
        $reservationsToday = Reservation::whereDate('tanggal_reservasi', $todayDate)->count();
        $cafeOrdersToday = TransactionDetail::whereHas('transaction', function($q) use ($todayDate) {
                $q->whereDate('created_at', $todayDate)->where('status_transaksi', 'Paid');
            })->whereNotNull('menu_id')->count();


        // GRAFIK TREN
        $chartLabels = [];
        $chartData = [];

        if ($chartLabelType == 'hour') {
            // Per Jam
            $hourlyData = Transaction::select(
                    DB::raw('HOUR(created_at) as hour'), 
                    DB::raw('SUM(total_transaksi) as total')
                )
                ->where('status_transaksi', 'Paid')
                ->whereDate('created_at', $startDate) // Filter Hari Ini
                ->groupBy('hour')
                ->get();

            // Loop dari jam 0 (12 Malam) sampai jam 23 (11 Malam)            
            for ($i = 0; $i <= 23; $i++) { 
                $chartLabels[] = sprintf('%02d:00', $i); // Label jadi: 00:00, 01:00 ... 23:00
                $found = $hourlyData->firstWhere('hour', $i);
                $chartData[] = $found ? $found->total : 0;
            }
        } else {
            // Per Hari
            $dailyData = Transaction::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_transaksi) as total'))
                ->where('status_transaksi', 'Paid')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('date')
                ->orderBy('date', 'asc')
                ->get();

            $period = \Carbon\CarbonPeriod::create($startDate, $endDate);
            foreach ($period as $dt) {
                $chartLabels[] = $dt->format('d M');
                $dateString = $dt->format('Y-m-d');
                $found = $dailyData->firstWhere('date', $dateString);
                $chartData[] = $found ? $found->total : 0;
            }
        }

        // DATA PIE CHART
        // Menghitung komposisi Berapa kali orang pesan menu vs Berapa kali orang reservasi meja
        $totalTrxReservasi = Reservation::whereBetween('created_at', [$startDate, $endDate])->count();
        $totalTrxMenu = TransactionDetail::whereHas('transaction', function($q) use ($startDate, $endDate) {
                $q->where('status_transaksi', 'Paid')
                  ->whereBetween('created_at', [$startDate, $endDate]);
            })->whereNotNull('menu_id')->count();


        // TOP RANKING
        
        // 1. Top Menu
        $topMenus = TransactionDetail::select('menu_id', DB::raw('SUM(quantity) as total_qty'))
            ->whereHas('transaction', function($q) use ($startDate, $endDate) {
                $q->where('status_transaksi', 'Paid')
                  ->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->whereNotNull('menu_id')
            ->with('menu')
            ->groupBy('menu_id')
            ->orderByDesc('total_qty')
            ->limit(5)
            ->get();

        // 2. Top Meja
        $topTables = Reservation::select('table_id', DB::raw('COUNT(*) as total_res'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->with('table')
            ->groupBy('table_id')
            ->orderByDesc('total_res')
            ->limit(5)
            ->get();

        // 3. Top Customer
        $topCustomers = Transaction::select('customer_id', DB::raw('COUNT(*) as total_trx'), DB::raw('SUM(total_transaksi) as total_spend'))
            ->where('status_transaksi', 'Paid')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->with('customer')
            ->groupBy('customer_id')
            ->orderByDesc('total_spend')
            ->limit(5)
            ->get();

        // 4. Feedback
        $feedbacks = [];
        if(class_exists('App\Models\FeedbackReview')) {
             $feedbacks = \App\Models\FeedbackReview::with('customer')->latest()->limit(5)->get();
        }

        return view('owner.performance', [
            'title' => 'Performa Operasional',
            'selectedPeriod' => $periodFilter,
            'revenueToday' => $revenueToday,
            'trxToday' => $trxToday,
            'reservationsToday' => $reservationsToday,
            'cafeOrdersToday' => $cafeOrdersToday,
            'chartLabels' => $chartLabels,
            'chartData' => $chartData,
            
            'pieData' => [$totalTrxMenu, $totalTrxReservasi], 
            
            'topMenus' => $topMenus,
            'topTables' => $topTables,
            'topCustomers' => $topCustomers,
            'feedbacks' => $feedbacks,
            
            'chartTitle' => $chartLabelType == 'hour' ? 'Tren Jam Sibuk (Hourly)' : 'Tren Pendapatan Harian'
        ]);
    }
}