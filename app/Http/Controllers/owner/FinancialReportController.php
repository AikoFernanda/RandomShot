<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\OperationalCost;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FinancialReportController extends Controller
{
    public function index(Request $request)
    {
        // FILTER PERIODE
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));

        // PEMASUKAN (REVENUE)
        // Hanya transaksi status 'Paid'
        $incomeQuery = Transaction::where('status_transaksi', 'Paid')
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);

        $totalIncome = $incomeQuery->sum('total_transaksi');

        // Rincian Pemasukan (Cafe vs Meja)
        // 1. Cafe (Punya menu_id)
        $incomeCafe = TransactionDetail::whereHas('transaction', function ($q) use ($startDate, $endDate) {
            $q->where('status_transaksi', 'Paid')
                ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        })->whereNotNull('menu_id')->sum('harga');

        // 2. Meja (Sisanya atau hitung dari reservasi)
        // simpelny Total Income - Cafe Income = Meja Income (Asumsi cuma ada 2 sumber)
        $incomeTable = $totalIncome - $incomeCafe;


        // PENGELUARAN (EXPENSE)
        $expenseQuery = OperationalCost::whereBetween('tanggal_biaya', [$startDate, $endDate]);

        $totalExpense = $expenseQuery->sum('total_biaya');

        // Rincian Pengeluaran per Kategori
        $expenseDetails = $expenseQuery->select('kategori', DB::raw('SUM(total_biaya) as total'))
            ->groupBy('kategori')
            ->orderByDesc('total')
            ->get();


        // LABA BERSIH (NET PROFIT) 
        $netProfit = $totalIncome - $totalExpense;


        // DATA GRAFIK (COMPARISON)
        // bandingkan Income vs Expense per hari
        $chartLabels = [];
        $incomeData = [];
        $expenseData = [];

        $period = \Carbon\CarbonPeriod::create($startDate, $endDate);

        // Ambil data harian biar query tidak diulang dalam loop (Optimasi)
        $dailyIncome = Transaction::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_transaksi) as total'))
            ->where('status_transaksi', 'Paid')
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->groupBy('date')
            ->get();

        // ambil DATE()-nya saja supaya jam tidak mengganggu grouping
        $dailyExpense = OperationalCost::select(
            DB::raw('DATE(tanggal_biaya) as date'),
            DB::raw('SUM(total_biaya) as total')
        )
            ->whereBetween('tanggal_biaya', [$startDate, $endDate])
            ->groupBy('date')
            ->get();

        foreach ($period as $dt) {
            $dateStr = $dt->format('Y-m-d');
            $chartLabels[] = $dt->format('d M');

            $inc = $dailyIncome->firstWhere('date', $dateStr);
            $incomeData[] = $inc ? $inc->total : 0;

            $exp = $dailyExpense->firstWhere('date', $dateStr);
            $expenseData[] = $exp ? $exp->total : 0;
        }

        return view('owner.financial-report', [
            'title' => 'Laporan Keuangan (Laba Rugi)',
            'startDate' => $startDate,
            'endDate' => $endDate,

            // Summary
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
            'netProfit' => $netProfit,

            // Rincian
            'incomeCafe' => $incomeCafe,
            'incomeTable' => $incomeTable,
            'expenseDetails' => $expenseDetails,

            // Chart
            'chartLabels' => $chartLabels,
            'incomeData' => $incomeData,
            'expenseData' => $expenseData
        ]);
    }
}
