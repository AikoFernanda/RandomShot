<x-layout-owner>
    <x-slot:title>{{ $title }}</x-slot:title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <section class="min-h-screen text-[#F4EFE7]">

        {{-- HEADER & FILTER --}}
        <div class="flex flex-col lg:flex-row items-start lg:items-end justify-between mb-8 gap-4">
            <div>
                <h1 class="text-4xl font-bebas tracking-wide text-[#F4EFE7]">Laporan Laba Rugi</h1>
                <p class="text-gray-400 text-sm mt-1">Profit & Loss Statement</p>
            </div>

            {{-- FORM FILTER RENTANG WAKTU --}}
            <form method="GET" action="{{ route('owner.laporan.keuangan') }}" class="flex flex-wrap items-end gap-3 bg-[#3C3D37] p-3 rounded-xl border border-white/5 shadow-lg">
                <div>
                    <label class="text-[10px] text-gray-400 uppercase font-bold px-1">Dari Tanggal</label>
                    <input type="date" name="start_date" value="{{ $startDate }}" 
                        class="bg-[#181C14] text-white text-xs p-2 rounded border border-white/10 focus:border-[#e9d9c9] outline-none [color-scheme:dark]">
                </div>
                <div>
                    <label class="text-[10px] text-gray-400 uppercase font-bold px-1">Sampai Tanggal</label>
                    <input type="date" name="end_date" value="{{ $endDate }}" 
                        class="bg-[#181C14] text-white text-xs p-2 rounded border border-white/10 focus:border-[#e9d9c9] outline-none [color-scheme:dark]">
                </div>
                <button type="submit" class="bg-[#e9d9c9] hover:bg-white text-black font-bold text-xs px-4 py-2.5 rounded transition shadow-lg">
                    Tampilkan
                </button>
            </form>
        </div>

        {{-- 1. KARTU SUMMARY (3 PILAR UTAMA) --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            
            {{-- Pemasukan --}}
            <div class="bg-[#3C3D37] border-l-4 border-green-500 rounded-r-xl p-6 shadow-lg">
                <div class="flex justify-between items-start">
                    <p class="text-xs text-gray-400 uppercase font-bold tracking-widest">Total Pemasukan</p>
                    <span class="text-green-500 bg-green-500/10 px-2 py-1 rounded text-xs font-bold">+ Income</span>
                </div>
                <p class="text-3xl font-bebas text-white mt-2 tracking-wide">Rp {{ number_format($totalIncome, 0, ',', '.') }}</p>
            </div>

            {{-- Pengeluaran --}}
            <div class="bg-[#3C3D37] border-l-4 border-red-500 rounded-r-xl p-6 shadow-lg">
                <div class="flex justify-between items-start">
                    <p class="text-xs text-gray-400 uppercase font-bold tracking-widest">Total Beban</p>
                    <span class="text-red-500 bg-red-500/10 px-2 py-1 rounded text-xs font-bold">- Expense</span>
                </div>
                <p class="text-3xl font-bebas text-white mt-2 tracking-wide">Rp {{ number_format($totalExpense, 0, ',', '.') }}</p>
            </div>

            {{-- Laba Bersih --}}
            <div class="bg-gradient-to-br from-[#3C3D37] to-[#181C14] border-l-4 {{ $netProfit >= 0 ? 'border-[#e9d9c9]' : 'border-red-600' }} rounded-r-xl p-6 shadow-xl relative overflow-hidden group">
                <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:opacity-20 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-[#e9d9c9]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <div class="flex justify-between items-start relative z-10">
                    <p class="text-xs text-[#e9d9c9] uppercase font-bold tracking-widest">Laba Bersih (Net Profit)</p>
                </div>
                <p class="text-4xl font-bebas {{ $netProfit >= 0 ? 'text-[#e9d9c9]' : 'text-red-500' }} mt-2 tracking-wide relative z-10">
                    Rp {{ number_format($netProfit, 0, ',', '.') }}
                </p>
            </div>
        </div>


        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- 2. TABEL LAPORAN LABA RUGI (ACCOUNTING STYLE) --}}
            <div class="lg:col-span-2 bg-[#F4EFE7] text-black rounded-xl overflow-hidden shadow-2xl">
                
                {{-- Header Kertas --}}
                <div class="bg-[#e9d9c9] p-6 text-center border-b border-black/10">
                    <h2 class="text-2xl font-bebas tracking-wide">LAPORAN LABA RUGI</h2>
                    <p class="text-sm font-bold opacity-70 uppercase tracking-widest">Periode: {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</p>
                </div>

                <div class="p-8 space-y-6">
                    
                    {{-- SECTION: PENDAPATAN --}}
                    <div>
                        <h3 class="font-bold text-lg border-b-2 border-black/10 pb-2 mb-3">PENDAPATAN (REVENUE)</h3>
                        <div class="space-y-2 text-sm pl-4">
                            <div class="flex justify-between">
                                <span>Penjualan Cafe & Makanan</span>
                                <span class="font-mono">Rp {{ number_format($incomeCafe, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Pendapatan Sewa Meja</span>
                                <span class="font-mono">Rp {{ number_format($incomeTable, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <div class="flex justify-between font-bold text-green-700 bg-green-50 mt-3 p-2 rounded">
                            <span>TOTAL PENDAPATAN</span>
                            <span>Rp {{ number_format($totalIncome, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    {{-- SECTION: BEBAN --}}
                    <div>
                        <h3 class="font-bold text-lg border-b-2 border-black/10 pb-2 mb-3">BEBAN OPERASIONAL (EXPENSE)</h3>
                        <div class="space-y-2 text-sm pl-4">
                            @forelse($expenseDetails as $expense)
                                <div class="flex justify-between border-b border-dashed border-gray-300 pb-1 last:border-0">
                                    <span>{{ $expense->kategori }}</span>
                                    <span class="font-mono text-red-600">(Rp {{ number_format($expense->total, 0, ',', '.') }})</span>
                                </div>
                            @empty
                                <div class="text-gray-400 italic">Tidak ada pengeluaran tercatat.</div>
                            @endforelse
                        </div>
                        <div class="flex justify-between font-bold text-red-700 bg-red-50 mt-3 p-2 rounded">
                            <span>TOTAL BEBAN</span>
                            <span>(Rp {{ number_format($totalExpense, 0, ',', '.') }})</span>
                        </div>
                    </div>

                    {{-- TOTAL AKHIR --}}
                    <div class="border-t-4 border-double border-black pt-4 mt-6">
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-bold uppercase tracking-widest">LABA / (RUGI) BERSIH</span>
                            <span class="text-3xl font-bebas {{ $netProfit >= 0 ? 'text-black' : 'text-red-600' }}">
                                Rp {{ number_format($netProfit, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                </div>
            </div>


            {{-- 3. GRAFIK PERBANDINGAN (BAR CHART) --}}
            <div class="flex flex-col gap-6">
                
                {{-- Grafik --}}
                <div class="bg-[#3C3D37] border border-white/5 rounded-xl p-6 shadow-lg">
                    <h3 class="text-lg font-bebas text-[#e9d9c9] mb-4">Grafik Arus Kas Harian</h3>
                    <div class="w-full h-64">
                        <canvas id="financeChart"></canvas>
                    </div>
                </div>

                {{-- Insight Kecil --}}
                <div class="bg-[#3C3D37] border border-white/5 rounded-xl p-6 shadow-lg">
                    <h3 class="text-lg font-bebas text-white mb-2">Analisis Singkat</h3>
                    <ul class="text-sm text-gray-400 space-y-3 list-disc pl-4">
                        <li>
                            Margin keuntungan periode ini adalah 
                            <span class="font-bold text-[#e9d9c9]">
                                {{ $totalIncome > 0 ? round(($netProfit / $totalIncome) * 100, 1) : 0 }}%
                            </span> dari total pendapatan.
                        </li>
                        <li>
                            Pengeluaran terbesar adalah 
                            <span class="font-bold text-red-400">
                                {{ $expenseDetails->first()->kategori ?? 'Belum ada data' }}
                            </span>.
                        </li>
                    </ul>
                </div>

            </div>

        </div>

    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('financeChart').getContext('2d');
            
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($chartLabels),
                    datasets: [
                        {
                            label: 'Pemasukan',
                            data: @json($incomeData),
                            backgroundColor: '#4ade80', // Green
                            borderRadius: 4,
                        },
                        {
                            label: 'Pengeluaran',
                            data: @json($expenseData),
                            backgroundColor: '#ef4444', // Red
                            borderRadius: 4,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { 
                        legend: { position: 'bottom', labels: { color: '#9ca3af' } }
                    },
                    scales: {
                        y: { 
                            beginAtZero: true, 
                            grid: { color: 'rgba(255,255,255,0.05)' },
                            ticks: { color: '#9ca3af', font: {size: 10} }
                        },
                        x: { 
                            grid: { display: false },
                            ticks: { color: '#9ca3af', font: {size: 10} }
                        }
                    }
                }
            });
        });
    </script>
</x-layout-owner>