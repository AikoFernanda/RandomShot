<x-layout-owner>
    <x-slot:title>{{ $title }}</x-slot:title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <section class="min-h-screen text-[#F4EFE7]">

        {{-- HEADER --}}
        <div class="mb-8">
            <h1 class="text-4xl font-bebas tracking-wide text-[#F4EFE7]">Laporan Penjualan</h1>
            <p class="text-gray-400 text-sm mt-1">Rekapitulasi transaksi penjualan dan pendapatan.</p>
        </div>

        {{-- FILTER SECTION --}}
        <form method="GET" action="{{ route('owner.laporan.penjualan') }}" class="mb-10">
            <div
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 bg-[#3C3D37] p-5 rounded-xl border border-white/5 shadow-lg">

                {{-- 1. Periode --}}
                <div class="flex flex-col gap-2">
                    <label class="text-xs font-bold text-gray-400 uppercase">Periode</label>
                    <select name="period"
                        class="bg-[#181C14] border border-white/10 text-white text-sm rounded-lg p-2.5 focus:border-[#e9d9c9] focus:outline-none transition">
                        <option value="today" {{ $filters['period'] == 'today' ? 'selected' : '' }}>Hari Ini</option>
                        <option value="1_week" {{ $filters['period'] == '1_week' ? 'selected' : '' }}>1 Minggu Terakhir
                        </option>
                        <option value="1_month" {{ $filters['period'] == '1_month' ? 'selected' : '' }}>1 Bulan Terakhir
                        </option>
                        <option value="3_months" {{ $filters['period'] == '3_months' ? 'selected' : '' }}>3 Bulan
                            Terakhir</option>
                    </select>
                </div>

                {{-- 2. Tanggal Custom --}}
                <div class="flex flex-col gap-2">
                    <label class="text-xs font-bold text-gray-400 uppercase">Tanggal Spesifik</label>
                    <input type="date" name="date" value="{{ $filters['date'] }}"
                        class="bg-[#181C14] border border-white/10 text-white text-sm rounded-lg p-2.5 focus:border-[#e9d9c9] focus:outline-none transition [color-scheme:dark]">
                </div>

                {{-- 3. Status --}}
                <div class="flex flex-col gap-2">
                    <label class="text-xs font-bold text-gray-400 uppercase">Status Bayar</label>
                    <select name="status"
                        class="bg-[#181C14] border border-white/10 text-white text-sm rounded-lg p-2.5 focus:border-[#e9d9c9] focus:outline-none transition">
                        <option value="all" {{ $filters['status'] == 'all' ? 'selected' : '' }}>Semua Status</option>
                        <option value="lunas" {{ $filters['status'] == 'lunas' ? 'selected' : '' }}>Lunas (Paid)
                        </option>
                        <option value="pending" {{ $filters['status'] == 'pending' ? 'selected' : '' }}>Pending (Unpaid)
                        </option>
                    </select>
                </div>

                {{-- 4. Tipe --}}
                <div class="flex flex-col gap-2">
                    <label class="text-xs font-bold text-gray-400 uppercase">Tipe Transaksi</label>
                    <select name="type"
                        class="bg-[#181C14] border border-white/10 text-white text-sm rounded-lg p-2.5 focus:border-[#e9d9c9] focus:outline-none transition">
                        <option value="all" {{ $filters['type'] == 'all' ? 'selected' : '' }}>Semua Tipe</option>
                        <option value="cafe" {{ $filters['type'] == 'cafe' ? 'selected' : '' }}>Pesanan Cafe</option>
                        <option value="reservation" {{ $filters['type'] == 'reservation' ? 'selected' : '' }}>Reservasi
                            Meja</option>
                    </select>
                </div>

                {{-- 5. Tombol Filter --}}
                <div class="flex items-end">
                    <button type="submit"
                        class="w-full bg-[#e9d9c9] hover:bg-white text-black font-bold text-sm rounded-lg px-5 py-2.5 transition duration-300 shadow-lg hover:shadow-xl">
                        Terapkan Filter
                    </button>
                </div>
            </div>
        </form>


        {{-- KARTU SUMMARY --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
            {{-- Pendapatan --}}
            <div class="bg-[#3C3D37] border-l-4 border-[#e9d9c9] rounded-r-xl p-5 shadow-lg">
                <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest">Total Pendapatan</p>
                <p class="text-2xl font-bold text-white mt-1">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            </div>
            {{-- Transaksi --}}
            <div class="bg-[#3C3D37] border-l-4 border-blue-500 rounded-r-xl p-5 shadow-lg">
                <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest">Total Transaksi</p>
                <p class="text-2xl font-bold text-white mt-1">{{ $totalTransactions }}</p>
            </div>
            {{-- Rata-rata --}}
            <div class="bg-[#3C3D37] border-l-4 border-purple-500 rounded-r-xl p-5 shadow-lg">
                <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest">Rata-rata Transaksi</p>
                <p class="text-2xl font-bold text-white mt-1">Rp {{ number_format($avgRevenue, 0, ',', '.') }}</p>
            </div>
            {{-- Item Terjual --}}
            <div class="bg-[#3C3D37] border-l-4 border-green-500 rounded-r-xl p-5 shadow-lg">
                <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest">Item Terjual</p>
                <p class="text-2xl font-bold text-white mt-1">{{ $totalItemsSold }} <span
                        class="text-sm font-normal text-gray-500">Pcs</span></p>
            </div>
        </div>


        {{-- GRAFIK PENJUALAN --}}
        <div class="bg-[#3C3D37] border border-white/5 rounded-xl p-6 shadow-lg mb-10">
            <h2 class="text-xl font-bold font-bebas text-[#e9d9c9] mb-6">Grafik Tren Pendapatan</h2>
            <div class="w-full h-80">
                <canvas id="salesChart"></canvas>
            </div>
        </div>


        {{-- TABEL RINCIAN TRANSAKSI --}}
        <div class="bg-[#3C3D37] border border-white/5 rounded-xl shadow-lg overflow-hidden">
            <div class="p-6 border-b border-white/5 flex justify-between items-center">
                <h2 class="text-xl font-bold font-bebas text-white">Rincian Transaksi</h2>
                <span class="text-xs text-gray-400 bg-white/5 px-3 py-1 rounded-full">{{ $transactions->total() }} Data
                    Ditemukan</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-400 uppercase bg-[#2A2B25]">
                        <tr>
                            <th class="px-6 py-3">Tanggal</th>
                            <th class="px-6 py-3">No. Invoice</th>
                            <th class="px-6 py-3">Pelanggan</th>
                            <th class="px-6 py-3 text-center">Status</th>
                            <th class="px-6 py-3 text-center">Metode</th>
                            <th class="px-6 py-3 text-right">Total</th>
                            <th class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($transactions as $trx)
                            <tr class="hover:bg-white/5 transition">
                                <td class="px-6 py-4 text-gray-300">{{ $trx->created_at->format('d M Y, H:i') }}</td>
                                <td class="px-6 py-4 font-mono text-[#e9d9c9] font-bold">#{{ $trx->no_invoice }}</td>
                                <td class="px-6 py-4 font-bold">{{ $trx->customer->nama ?? 'Guest' }}</td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="px-2 py-1 rounded text-[10px] font-bold uppercase border
                                        {{ $trx->status_transaksi == 'Paid' ? 'bg-green-500/20 text-green-400 border-green-500/30' : 'bg-yellow-500/20 text-yellow-400 border-yellow-500/30' }}">
                                        {{ $trx->status_transaksi == 'Paid' ? 'LUNAS' : 'PENDING' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center text-gray-400">{{ $trx->metode_pembayaran ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-right font-bold text-white">Rp
                                    {{ number_format($trx->total_transaksi, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('owner.transaksi.detail', $trx->transaction_id) }}"
                                        class="text-[#e9d9c9] hover:text-white underline text-xs font-bold transition">
                                        Lihat Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-gray-500">
                                    Tidak ada data transaksi pada periode ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            <div class="p-4 border-t border-white/5">
                {{ $transactions->links('pagination::tailwind') }}
            </div>
        </div>

    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('salesChart').getContext('2d');

            // Gradient Emas
            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(233, 217, 201, 0.5)');
            gradient.addColorStop(1, 'rgba(0, 0, 0, 0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($chartLabels),
                    datasets: [{
                        label: 'Pendapatan',
                        data: @json($chartData),
                        borderColor: '#e9d9c9',
                        backgroundColor: gradient,
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 3,
                        pointBackgroundColor: '#181C14',
                        pointBorderColor: '#e9d9c9',
                        pointBorderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(255,255,255,0.05)'
                            },
                            ticks: {
                                color: '#9ca3af'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#9ca3af'
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-layout-owner>
