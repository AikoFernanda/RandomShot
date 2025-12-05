<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- WRAPPER UTAMA --}}
    <div class="min-h-screen bg-[#0e0f0b] text-[#F4EFE7] font-poppins">

        {{-- 1. HERO BANNER --}}
        <div class="relative w-full h-[400px] md:h-[500px] overflow-hidden group">
            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-1000 group-hover:scale-105"
                style="background-image: url('{{ asset('img/bgreservasi.png') }}');">
            </div>
            <div class="absolute inset-0 bg-gradient-to-r from-black via-black/60 to-transparent"></div>

            <div class="absolute inset-0 flex flex-col justify-center px-6 md:px-16 container mx-auto">
                <span class="text-[#e9d9c9] font-bold tracking-widest uppercase mb-2 animate-fadeIn">Reservasi
                    Online</span>
                <h1 class="text-5xl md:text-7xl font-bebas text-white leading-tight drop-shadow-lg mb-4">
                    RANDOM SHOT<br>POOL & CAFE
                </h1>
                <p class="text-gray-300 max-w-xl text-base md:text-lg leading-relaxed border-l-4 border-[#e9d9c9] pl-4">
                    Tempat hiburan terbaik dengan meja berkualitas profesional.
                    Booking sekarang sebelum kehabisan slot!
                </p>
            </div>
        </div>

        {{-- 2. FILTER KATEGORI --}}
        <div class="sticky top-20 z-30 bg-[#0e0f0b]/90 backdrop-blur-md border-b border-white/10 py-4">
            <div class="container mx-auto px-6 flex justify-start md:justify-center overflow-x-auto no-scrollbar gap-3">
                @php
                    $activeClass =
                        'bg-[#e9d9c9] text-black border-[#e9d9c9] shadow-[0_0_15px_rgba(233,217,201,0.3)] font-bold';
                    $inactiveClass =
                        'bg-white/5 text-gray-400 border-white/10 hover:bg-white/10 hover:text-white hover:border-white/30';
                @endphp

                <a href="{{ route('reservation', ['kategori' => 'Biliar']) }}"
                    class="px-6 py-2.5 rounded-full text-sm transition-all duration-300 border whitespace-nowrap {{ request('kategori') == 'Biliar' ? $activeClass : $inactiveClass }}">🎱
                    Meja Biliar</a>
                <a href="{{ route('reservation', ['kategori' => 'Tenis']) }}"
                    class="px-6 py-2.5 rounded-full text-sm transition-all duration-300 border whitespace-nowrap {{ request('kategori') == 'Tenis' ? $activeClass : $inactiveClass }}">🏓
                    Meja Tenis</a>
                <a href="{{ route('reservation', ['kategori' => 'Playstation']) }}"
                    class="px-6 py-2.5 rounded-full text-sm transition-all duration-300 border whitespace-nowrap {{ request('kategori') == 'Playstation' ? $activeClass : $inactiveClass }}">🎮
                    PlayStation</a>
            </div>
        </div>

        {{-- 3. GRID DAFTAR MEJA --}}
        <div class="container mx-auto px-6 md:px-12 py-12">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl md:text-4xl font-bebas text-white">DAFTAR <span class="text-[#e9d9c9]">MEJA</span>
                </h2>
                <p class="text-sm text-gray-400 hidden md:block">Pilih meja favoritmu</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($tables as $table)
                    <div
                        class="group relative bg-[#1a1a19] border border-white/10 rounded-2xl overflow-hidden hover:-translate-y-2 transition-all duration-300 hover:shadow-2xl hover:shadow-[#e9d9c9]/10">
                        <div class="h-56 overflow-hidden relative">
                            <img src="{{ asset('img/' . $table->nama_gambar) }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                alt="{{ $table->nama }}">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-[#1a1a19] via-transparent to-transparent">
                            </div>
                            <div
                                class="absolute top-4 right-4 bg-black/60 backdrop-blur-sm border border-white/10 px-3 py-1 rounded-lg">
                                <span class="text-[#e9d9c9] font-bold text-xs">Mulai</span>
                                <span
                                    class="text-white font-bold text-sm block">Rp{{ number_format($table->tarif_per_jam_siang, 0, ',', '.') }}<span
                                        class="text-[10px] font-normal text-gray-400">/jam</span></span>
                            </div>
                        </div>
                        <div class="p-6 relative">
                            <h3
                                class="text-2xl font-bebas text-white mb-2 group-hover:text-[#e9d9c9] transition-colors">
                                {{ $table->nama }}</h3>
                            <div class="flex gap-3 mb-6 opacity-60 grayscale group-hover:grayscale-0 transition-all">
                                <img src="{{ asset('img/wifi.png') }}" class="w-5 h-5" title="WiFi">
                                <img src="{{ asset('img/cafe.png') }}" class="w-5 h-5" title="Cafe">
                                <img src="{{ asset('img/parking.png') }}" class="w-5 h-5" title="Parkir">
                            </div>
                            <a href="{{ route('reservation.detail', $table->table_id) }}"
                                class="block w-full text-center py-3 rounded-xl bg-white/5 border border-white/10 text-white font-bold text-sm hover:bg-[#e9d9c9] hover:text-black hover:border-[#e9d9c9] transition-all duration-300">LIHAT
                                DETAIL & BOOKING</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- 4. SECTION ULASAN --}}
        <div class="border-t border-white/10 bg-[#141414]">
            <div class="container mx-auto px-6 md:px-12 py-16">

                <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
                    <div>
                        <h2 class="text-4xl font-bebas text-white mb-2">APA KATA MEREKA?</h2>
                        <p class="text-gray-400">Ulasan jujur dari pelanggan setia kami.</p>
                    </div>

                    <a href="{{ route('review') }}"
                        class="group flex items-center gap-2 text-[#e9d9c9] font-bold text-sm hover:text-white transition">
                        LIHAT SEMUA ULASAN
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    {{-- Card Rating Statistik --}}
                    <div class="lg:col-span-1 bg-[#1a1a19] border border-white/10 p-8 rounded-2xl">
                        <div class="flex items-baseline gap-2 mb-1">
                            <span class="text-6xl font-bebas text-white">{{ number_format($averageRating, 1) }}</span>
                            <span class="text-xl text-gray-500">/ 5.0</span>
                        </div>

                        {{-- Bintang Rata-rata --}}
                        <div class="flex text-yellow-400 mb-4 text-xl">
                            @for ($i = 1; $i <= 5; $i++)
                                <span>{{ $i <= round($averageRating) ? '★' : '☆' }}</span>
                            @endfor
                        </div>

                        <p class="text-sm text-gray-400 mb-8">Berdasarkan {{ $totalReviews }} ulasan pelanggan</p>

                        {{-- Bar Statistik --}}
                        <div class="space-y-3">
                            @for ($i = 5; $i >= 1; $i--)
                                @php
                                    // Hitung persentase bar
                                    $count = $starCounts[$i] ?? 0;
                                    $percentage = $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
                                @endphp
                                <div class="flex items-center gap-3 text-xs">
                                    <span class="w-3">{{ $i }}</span>
                                    <div class="flex-1 h-1.5 bg-white/10 rounded-full overflow-hidden">
                                        <div class="h-full bg-[#e9d9c9]" style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <span class="w-6 text-right text-gray-500">{{ $count }}</span>
                                </div>
                            @endfor
                        </div>
                    </div>

                    {{-- Card Ulasan Individual --}}
                    <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">

                        @forelse($displayReviews as $review)
                            <div
                                class="bg-[#1a1a19] border border-white/5 p-6 rounded-2xl hover:border-white/20 transition duration-300 flex flex-col justify-between h-full">
                                <div>
                                    <div class="flex items-start justify-between mb-4">
                                        <div class="flex items-center gap-3">
                                            {{-- Avatar Inisial --}}
                                            <div
                                                class="w-10 h-10 rounded-full bg-gradient-to-br {{ $loop->iteration % 2 == 0 ? 'from-purple-500 to-indigo-500' : 'from-orange-500 to-red-500' }} flex items-center justify-center text-white font-bold text-xs uppercase shadow-md">
                                                {{ substr($review->customer->nama ?? 'User', 0, 2) }}
                                            </div>
                                            <div>
                                                <p class="font-bold text-white text-sm">
                                                    {{ $review->customer->nama ?? 'Pengguna' }}</p>
                                                <p class="text-[10px] text-gray-500">
                                                    {{ $review->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>

                                        {{-- Bintang Individual --}}
                                        <div class="flex text-yellow-400 text-xs">
                                            @for ($j = 1; $j <= 5; $j++)
                                                <span>{{ $j <= $review->rating ? '★' : '☆' }}</span>
                                            @endfor
                                        </div>
                                    </div>

                                    {{-- Isi Review --}}
                                    <p class="text-gray-300 text-sm leading-relaxed italic">
                                        "{{ $review->review ?? ($review->feedback ?? 'Rating tanpa ulasan.') }}"
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-2 text-center py-10 border border-dashed border-white/10 rounded-2xl">
                                <p class="text-gray-500">Belum ada ulasan yang ditampilkan.</p>
                            </div>
                        @endforelse

                    </div>
                </div>

            </div>
        </div>

    </div>

    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

</x-Layout>
