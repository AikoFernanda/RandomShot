<x-layout-owner>
    <x-slot:title>{{ $title }}</x-slot:title>
    {{-- Chart.js CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <section class="min-h-screen text-[#F4EFE7]">

        {{--  BAGIAN 1: LIVE MONITORING (SELALU HARI INI)  --}}
        <div class="mb-12">
            {{-- Header Section 1 --}}
            <div class="flex items-center gap-3 mb-6">
                <div class="relative flex h-6 w-6">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#e9d9c9] opacity-75"></span>
                    <span
                        class="relative inline-flex rounded-full h-6 w-6 bg-[#e9d9c9]/80 border-2 border-[#181C14]"></span>
                </div>
                <div>
                    <h1 class="text-3xl font-bebas text-[#F4EFE7] tracking-wide">Real-time Monitor</h1>
                    <p class="text-gray-400 text-xs tracking-wider uppercase">Data hari ini · Tidak terpengaruh filter
                    </p>
                </div>
            </div>

            {{-- GRID KARTU REALTIME --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                {{-- Omset --}}
                <div
                    class="bg-gradient-to-br from-[#3C3D37] to-[#2A2B25] border-l-4 border-[#e9d9c9] rounded-r-xl p-5 shadow-xl flex flex-col justify-between group hover:from-[#3C3D37] hover:to-[#3C3D37] transition duration-500">
                    <div>
                        <div class="flex justify-between items-start">
                            <p class="text-[10px] text-[#e9d9c9] uppercase font-bold tracking-widest">Omset Masuk</p>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#e9d9c9] opacity-50"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="text-3xl font-bebas tracking-wider text-white mt-2">Rp
                            {{ number_format($revenueToday, 0, ',', '.') }}</p>
                    </div>
                    <div class="mt-4 flex items-center gap-2">
                        <span class="relative flex h-2 w-2">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#e9d9c9] opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-[#e9d9c9]"></span>
                        </span>
                        <span class="text-[10px] text-[#e9d9c9]/80 font-medium tracking-wider uppercase">Live
                            Update</span>
                    </div>
                </div>

                @php
                    $cardStyle =
                        'bg-[#3C3D37] border border-white/5 rounded-xl p-5 shadow-lg hover:bg-white/5 hover:border-[#e9d9c9]/30 transition duration-300 group';
                    $labelStyle =
                        'text-[10px] text-gray-500 uppercase font-bold tracking-widest group-hover:text-[#e9d9c9]/70 transition';
                    $valueStyle =
                        'text-2xl font-bebas tracking-wider text-white mt-1 group-hover:text-[#e9d9c9] transition';
                    $unitStyle = 'text-sm font-poppins font-normal text-gray-500 ml-1';
                @endphp

                {{-- Transaksi --}}
                <div class="{{ $cardStyle }}">
                    <div class="flex justify-between items-start">
                        <p class="{{ $labelStyle }}">Total Transaksi</p>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-gray-600 group-hover:text-[#e9d9c9]/50 transition" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                    <p class="{{ $valueStyle }}">{{ $trxToday }} <span class="{{ $unitStyle }}">Struk</span>
                    </p>
                </div>

                {{-- Reservasi --}}
                <div class="{{ $cardStyle }}">
                    <div class="flex justify-between items-start">
                        <p class="{{ $labelStyle }}">Reservasi Meja</p>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-gray-600 group-hover:text-[#e9d9c9]/50 transition" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <p class="{{ $valueStyle }}">{{ $reservationsToday }} <span
                            class="{{ $unitStyle }}">Booked</span></p>
                </div>

                {{-- Pesanan Menu --}}
                <div class="{{ $cardStyle }}">
                    <div class="flex justify-between items-start">
                        <p class="{{ $labelStyle }}">Pesanan Menu</p>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-gray-600 group-hover:text-[#e9d9c9]/50 transition" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <p class="{{ $valueStyle }}">{{ $cafeOrdersToday }} <span
                            class="{{ $unitStyle }}">Item</span></p>
                </div>
            </div>
        </div>


        {{--  PEMISAH  --}}
        <div class="relative flex py-8 items-center mb-2">
            <div class="flex-grow border-t border-[#e9d9c9]/20"></div>
            <span class="flex-shrink-0 mx-6 text-[#e9d9c9]/60 text-[10px] uppercase tracking-[0.2em] font-bold">Analisis
                Historis & Tren</span>
            <div class="flex-grow border-t border-[#e9d9c9]/20"></div>
        </div>


        {{-- ANALISIS PERIODE (FILTER BERLAKU)  --}}
        <div class="mb-8">

            {{-- HEADER SECTION 2 & FILTER --}}
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-4 mb-8">
                <div>
                    <h2 class="text-3xl font-bebas text-[#e9d9c9] tracking-wide">Tren Kinerja</h2>
                    <p class="text-gray-400 text-xs mt-1 tracking-wider">
                        Data di bawah ini menyesuaikan dengan periode yang dipilih.
                    </p>
                </div>

                {{-- FORM FILTER ELEGANT --}}
                <form method="GET" action="{{ route('owner.performance') }}" class="flex items-center gap-3 bg-[#181C14] p-1.5 rounded-lg border border-[#e9d9c9]/20 shadow-sm">
                    <span class="text-[10px] text-[#e9d9c9]/70 uppercase font-bold px-3 tracking-wider">Mode Pantau:</span>
                    
                    <div class="relative group">
                        <select name="period" class="appearance-none bg-[#3C3D37] text-[#F4EFE7] text-xs font-bold py-2 pl-4 pr-10 rounded border border-transparent group-hover:border-[#e9d9c9]/30 cursor-pointer focus:outline-none focus:border-[#e9d9c9]/50 transition tracking-wide" onchange="this.form.submit()">
                            
                            {{-- Opsi 1: HARI INI (Mode Detail Jam) --}}
                            <option value="today" {{ $selectedPeriod == 'today' ? 'selected' : '' }} class="bg-[#3C3D37]">
                                Hari Ini (Live Monitor)
                            </option>
                            
                            {{-- Opsi 2: 7 HARI TERAKHIR (Mode Tren Harian) --}}
                            <option value="last_7_days" {{ $selectedPeriod == 'last_7_days' ? 'selected' : '' }} class="bg-[#3C3D37]">
                                7 Hari Terakhir (Tren)
                            </option>

                        </select>
                        
                        {{-- Ikon Panah --}}
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-[#e9d9c9]">
                            <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                </form>
            </div>

            {{-- GRID GRAFIK (LINE & PIE) --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                {{-- Line Chart --}}
                <div class="lg:col-span-2 bg-[#3C3D37] border border-white/5 rounded-xl p-6 shadow-lg">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold font-bebas tracking-wide text-[#e9d9c9]">{{ $chartTitle }}</h3>
                        {{-- Badge Indikator Elegant --}}
                        @if ($selectedPeriod == 'today' || $selectedPeriod == 'yesterday')
                            <span
                                class="text-[9px] bg-[#e9d9c9]/10 text-[#e9d9c9] px-2 py-0.5 rounded-full border border-[#e9d9c9]/20 uppercase tracking-wider font-bold">Mode:
                                Per Jam</span>
                        @else
                            <span
                                class="text-[9px] bg-white/5 text-gray-400 px-2 py-0.5 rounded-full border border-white/5 uppercase tracking-wider font-bold">Mode:
                                Harian</span>
                        @endif
                    </div>
                    <div class="w-full h-72">
                        <canvas id="mainChart"></canvas>
                    </div>
                </div>

                {{-- Pie Chart --}}
                <div class="bg-[#3C3D37] border border-white/5 rounded-xl p-6 shadow-lg flex flex-col justify-between">
                    <h3 class="text-xl font-bold font-bebas text-center mb-4 text-[#e9d9c9] tracking-wide">Komposisi
                        Transaksi</h3>
                    <div class="relative h-48 w-full flex justify-center">
                        <canvas id="pieChart"></canvas>
                    </div>
                    {{-- Custom Legend Elegant --}}
                    <div class="mt-6 space-y-2 text-xs">
                        <div
                            class="flex justify-between items-center px-4 py-3 bg-[#181C14] rounded-lg border border-white/5">
                            <span class="flex items-center gap-3"><span
                                    class="w-2 h-2 rounded-full bg-[#e9d9c9]"></span> <span
                                    class="text-gray-300 font-bold tracking-wide">Cafe & FnB</span></span>
                            <span class="font-mono font-bold text-[#e9d9c9] text-sm">{{ $pieData[0] }}</span>
                        </div>
                        <div
                            class="flex justify-between items-center px-4 py-3 bg-[#181C14] rounded-lg border border-white/5">
                            <span class="flex items-center gap-3"><span
                                    class="w-2 h-2 rounded-full bg-[#52525b] border border-white/10"></span> <span
                                    class="text-gray-400 font-bold tracking-wide">Reservasi Meja</span></span>
                            <span class="font-mono font-bold text-gray-500 text-sm">{{ $pieData[1] }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. GRID TOP RANKINGS (4 KOTAK) --}}
            @php
                $rankingCardStyle = 'bg-[#3C3D37] border border-white/5 rounded-xl p-6 shadow-lg flex flex-col h-full';
                $rankingHeaderStyle = 'flex justify-between items-center mb-5 border-b border-[#e9d9c9]/10 pb-3';
                $rankingTitleStyle = 'font-bebas text-xl text-[#e9d9c9] tracking-wide flex items-center gap-2';
                $rankingMetaStyle = 'text-[9px] text-gray-500 uppercase tracking-widest font-bold';
                $listItemStyle = 'flex justify-between items-center group py-2 border-b border-white/5 last:border-0';
                $listNumberStyle = 'font-bebas text-lg text-[#e9d9c9]/30 w-6 group-hover:text-[#e9d9c9]/70 transition';
                $listMainTextStyle =
                    'text-sm font-bold text-gray-200 group-hover:text-[#e9d9c9] transition tracking-wide';
                $listSubTextStyle = 'text-[10px] text-gray-500 tracking-wider';
                $listValueBadgeStyle =
                    'text-xs font-mono bg-[#181C14] border border-white/5 px-2.5 py-1 rounded text-[#e9d9c9]/80 group-hover:text-[#e9d9c9] group-hover:border-[#e9d9c9]/20 transition';
            @endphp

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- A. TOP MENU --}}
                <div class="{{ $rankingCardStyle }}">
                    <div class="{{ $rankingHeaderStyle }}">
                        <h3 class="{{ $rankingTitleStyle }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-70" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            Menu Favorit
                        </h3>
                        <span class="{{ $rankingMetaStyle }}">Periode Ini</span>
                    </div>
                    <div class="space-y-1 flex-1 overflow-y-auto pr-2 custom-scrollbar">
                        @forelse($topMenus as $menu)
                            <div class="{{ $listItemStyle }}">
                                <div class="flex items-center gap-3">
                                    <span class="{{ $listNumberStyle }}">{{ $loop->iteration }}</span>
                                    <div>
                                        <p class="{{ $listMainTextStyle }}">{{ $menu->menu->nama ?? '-' }}</p>
                                        <p class="{{ $listSubTextStyle }}">{{ $menu->menu->kategori ?? '-' }}</p>
                                    </div>
                                </div>
                                <span class="{{ $listValueBadgeStyle }}">{{ $menu->total_qty }}x</span>
                            </div>
                        @empty
                            <p class="text-center text-xs text-gray-500 py-6 italic">Belum ada data penjualan.</p>
                        @endforelse
                    </div>
                </div>

                {{-- B. TOP MEJA --}}
                <div class="{{ $rankingCardStyle }}">
                    <div class="{{ $rankingHeaderStyle }}">
                        <h3 class="{{ $rankingTitleStyle }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-70" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                            Meja Populer
                        </h3>
                        <span class="{{ $rankingMetaStyle }}">Periode Ini</span>
                    </div>
                    <div class="space-y-1 flex-1 overflow-y-auto pr-2 custom-scrollbar">
                        @forelse($topTables as $tbl)
                            <div class="{{ $listItemStyle }}">
                                <div class="flex items-center gap-3">
                                    <span class="{{ $listNumberStyle }}">{{ $loop->iteration }}</span>
                                    <div>
                                        <p class="{{ $listMainTextStyle }}">{{ $tbl->table->nama ?? '-' }}</p>
                                        <p class="{{ $listSubTextStyle }}">{{ $tbl->table->kategori ?? '-' }}</p>
                                    </div>
                                </div>
                                <span class="{{ $listValueBadgeStyle }}">{{ $tbl->total_res }}x</span>
                            </div>
                        @empty
                            <p class="text-center text-xs text-gray-500 py-6 italic">Belum ada data reservasi.</p>
                        @endforelse
                    </div>
                </div>

                {{-- C. TOP CUSTOMER --}}
                <div class="{{ $rankingCardStyle }}">
                    <div class="{{ $rankingHeaderStyle }}">
                        <h3 class="{{ $rankingTitleStyle }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-70" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Sultan Cafe
                        </h3>
                        <span class="{{ $rankingMetaStyle }}">Top Spender</span>
                    </div>
                    <div class="space-y-1 flex-1 overflow-y-auto pr-2 custom-scrollbar">
                        @forelse($topCustomers as $cust)
                            <div class="{{ $listItemStyle }}">
                                <div class="flex items-center gap-4">
                                    {{-- Avatar Elegant --}}
                                    <div
                                        class="w-8 h-8 rounded-full bg-gradient-to-tr from-[#e9d9c9] to-[#C5A992] p-[1px]">
                                        <div
                                            class="w-full h-full rounded-full bg-[#2A2B25] flex items-center justify-center text-xs font-bold text-[#e9d9c9]">
                                            {{ substr($cust->customer->nama ?? 'G', 0, 1) }}
                                        </div>
                                    </div>
                                    <div>
                                        <p class="{{ $listMainTextStyle }}">{{ $cust->customer->nama ?? 'Guest' }}
                                        </p>
                                        <p class="{{ $listSubTextStyle }}">{{ $cust->total_trx }} Transaksi</p>
                                    </div>
                                </div>
                                <span
                                    class="text-sm font-mono font-bold text-[#e9d9c9] tracking-wide">Rp{{ number_format($cust->total_spend / 1000, 0) }}k</span>
                            </div>
                        @empty
                            <p class="text-center text-xs text-gray-500 py-6 italic">Belum ada data pelanggan.</p>
                        @endforelse
                    </div>
                </div>

                {{-- D. FEEDBACK (SELALU TERBARU) --}}
                <div class="{{ $rankingCardStyle }}">
                    <div class="{{ $rankingHeaderStyle }}">
                        <h3 class="{{ $rankingTitleStyle }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-70" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                            Kata Mereka
                        </h3>
                        <a href="{{ route('owner.feedback') }}"
                            class="text-[9px] text-[#e9d9c9]/70 hover:text-[#e9d9c9] hover:underline cursor-pointer uppercase tracking-widest font-bold transition">Lihat
                            Semua</a>
                    </div>
                    <div class="space-y-3 flex-1 overflow-y-auto pr-2 custom-scrollbar">
                        @forelse($feedbacks as $fb)
                            <div
                                class="bg-[#181C14] p-3 rounded-lg border border-white/5 group hover:border-[#e9d9c9]/20 transition">
                                <div class="flex justify-between items-start mb-2">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-5 h-5 rounded-full bg-[#e9d9c9]/20 flex items-center justify-center text-[9px] font-bold text-[#e9d9c9]">
                                            {{ substr($fb->customer->nama ?? 'A', 0, 1) }}
                                        </div>
                                        <span
                                            class="text-xs font-bold text-[#e9d9c9] tracking-wide group-hover:underline">{{ $fb->customer->nama ?? 'Anonim' }}</span>
                                    </div>
                                    <span
                                        class="text-[9px] text-gray-600 uppercase tracking-wider">{{ $fb->created_at->diffForHumans(null, true) }}</span>
                                </div>
                                <p class="text-xs text-gray-400 italic line-clamp-2 leading-relaxed pl-7">
                                    "{{ $fb->feedback ?? ($fb->feedback ?? '-') }}"</p>
                            </div>
                        @empty
                            <p class="text-center text-xs text-gray-500 py-6 italic">Belum ada masukan terbaru.</p>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>

    </section>

    {{-- SCROLLBAR HALUS DI CARD --}}
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(233, 217, 201, 0.3);
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(233, 217, 201, 0.5);
        }
    </style>

    {{-- SCRIPT CHART JS --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // CHART LINE (PENDAPATAN)
            const ctx = document.getElementById('mainChart').getContext('2d');

            const lineColor = '#e9d9c9';

            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(233, 217, 201, 0.4)');
            gradient.addColorStop(1, 'rgba(0, 0, 0, 0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($chartLabels),
                    datasets: [{
                        label: 'Pendapatan',
                        data: @json($chartData),
                        borderColor: lineColor,
                        backgroundColor: gradient,
                        borderWidth: 2,
                        fill: true,
                        tension: 0.3,
                        pointRadius: 3,
                        pointBackgroundColor: '#e9d9c9',
                        pointBorderColor: '#181C14',
                        pointBorderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#181C14',
                            titleColor: '#e9d9c9',
                            bodyColor: '#F4EFE7',
                            borderColor: 'rgba(233, 217, 201, 0.2)',
                            borderWidth: 1,
                            titleFont: {
                                family: 'Bebas Neue',
                                size: 14
                            },
                            bodyFont: {
                                family: 'Poppins',
                                size: 12
                            },
                            callbacks: {
                                label: function(context) {
                                    return ' Rp ' + new Intl.NumberFormat('id-ID').format(context.raw);
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(255,255,255,0.03)'
                            },
                            ticks: {
                                color: '#6b7280',
                                font: {
                                    family: 'Poppins',
                                    size: 10
                                },
                                maxTicksLimit: 6
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#6b7280',
                                font: {
                                    family: 'Poppins',
                                    size: 10
                                },
                                maxTicksLimit: 8
                            }
                        }
                    }
                }
            });

            // PIE CHART (DOUGHNUT ELEGANT)
            const ctxPie = document.getElementById('pieChart').getContext('2d');
            new Chart(ctxPie, {
                type: 'doughnut',
                data: {
                    labels: ['Cafe', 'Meja'],
                    datasets: [{
                        data: @json($pieData),
                        backgroundColor: [
                            '#e9d9c9', // Emas
                            '#52525b' // Abu-abu Gelap
                        ],
                        borderColor: '#3C3D37',
                        borderWidth: 2,
                        hoverOffset: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '75%',
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#181C14',
                            bodyColor: '#F4EFE7',
                            borderColor: 'rgba(233, 217, 201, 0.2)',
                            borderWidth: 1,
                            bodyFont: {
                                family: 'Poppins',
                                size: 12
                            },
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += context.raw + ' Transaksi';
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-layout-owner>
