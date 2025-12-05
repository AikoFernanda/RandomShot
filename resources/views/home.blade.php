<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    {{-- {{ dd($reviews, $favoriteMenus) }} --}}
    <section id="home" class="relative min-h-screen flex items-center justify-center overflow-hidden" x-data>

        {{-- Background --}}
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('img/bghome.png') }}" class="w-full h-full object-cover opacity-60 animate-zoom-slow"
                alt="Background Home">
            <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/40 to-[#0e0f0b]"></div>
        </div>

        {{-- Hero Content --}}
        <div class="container mx-auto px-6 relative z-10 text-center pt-10 md:pt-14">

            <h1
                class="text-[#F4EFE7] text-lg md:text-xl font-semibold tracking-[0.35em] mb-6 uppercase animate-fade-in-up">
                Waktu Luangmu, Tempat Serumu
            </h1>

            <h2
                class="text-[#F4EFE7] text-5xl md:text-7xl lg:text-8xl font-bebas leading-none mb-8 drop-shadow-2xl 
               animate-fade-in-up delay-100">
                RANDOM SHOT<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#F4EFE7] via-[#C1C1C1] to-[#9CA3AF]">
                    POOL & CAFE
                </span>
            </h2>

            <p
                class="text-gray-200 text-base md:text-xl max-w-xl md:max-w-3xl mx-auto mb-10 font-normal leading-relaxed 
               animate-fade-in-up delay-200">
                Main biliar di meja standar turnamen, nikmati kopi premium,<br class="hidden md:block">
                dan temukan tempat nongkrong paling asik di Bogor.
            </p>

            <p class="text-white text-lg md:text-2xl font-bold mb-12 animate-fade-in-up delay-250">
                Amankan mejamu sebelum penuh
            </p>

            {{-- CTA Buttons --}}
            <div
                class="flex flex-col md:flex-row gap-5 justify-center items-center animate-fade-in-up delay-300 mb-20 md:mb-24">

                <a href="{{ route('reservation') }}"
                    class="px-8 py-4 bg-[#F4EFE7] text-black font-bold text-base md:text-lg rounded-full 
                   hover:bg-white hover:scale-105 transition duration-300 
                   shadow-[0_0_30px_rgba(244,239,231,0.4)] flex items-center gap-3 group">
                    Booking Meja Sekarang
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:translate-x-1 transition"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </a>

                <button @click="document.getElementById('menu').scrollIntoView({ behavior: 'smooth' })"
                    class="px-8 py-4 border-2 border-white/40 text-white font-bold text-base md:text-lg rounded-full 
                   hover:bg-white/10 hover:border-white/60 transition duration-300 backdrop-blur-sm">
                    Lihat Menu & Fasilitas
                </button>

            </div>
        </div>

        {{-- Scroll Down Indicator --}}
        <div class="absolute bottom-8 md:bottom-12 left-1/2 -translate-x-1/2 z-10 animate-bounce">
            <button @click="document.getElementById('layanan').scrollIntoView({ behavior: 'smooth' })"
                class="p-2 rounded-full bg-black/30 hover:bg-black/40 backdrop-blur-md transition-all 
               text-white/60 hover:text-white border border-white/10 hover:border-white/30 
               shadow-lg hover:shadow-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-8 md:w-8" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
            </button>
        </div>
    </section>

    {{-- 
        SECTION LAYANAN / FASILITAS
    --}}
    <section id="layanan" class="py-20 bg-[#0e0f0b] text-[#F4EFE7]">
        <div class="container mx-auto px-6">

            <div class="text-center mb-16">
                <h3 class="text-[#e9d9c9] font-bold tracking-widest uppercase mb-2 text-xs">Fasilitas Kami</h3>
                <h2 class="text-3xl md:text-4xl font-bebas">Apa yang ada di Random Shot?</h2>
                <div class="w-20 h-1 bg-[#e9d9c9] mx-auto mt-4 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">

                <!-- Card 1: Biliar -->
                <div
                    class="group bg-[#1a1a19] border border-white/5 rounded-2xl overflow-hidden hover:border-[#e9d9c9]/50 transition duration-300 hover:-translate-y-2">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ asset('img/biliar.jpeg') }}" alt="Meja Biliar"
                            class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                        <div
                            class="absolute top-4 right-4 bg-black/70 backdrop-blur-md px-3 py-1 rounded-lg border border-white/10">
                            <span class="text-[#e9d9c9] font-bold text-sm">POPULER</span>
                        </div>
                    </div>
                    <div class="p-8 text-center">
                        <h3 class="text-2xl font-bebas mb-2 tracking-wide">MEJA BILIAR</h3>
                        <p class="text-gray-400 text-sm mb-6">Meja standar turnamen dengan karpet baru dan stick
                            berkualitas.</p>
                        <div class="border-t border-white/10 pt-4">
                            <p class="text-xs text-gray-500 uppercase tracking-widest mb-1">Mulai Dari</p>
                            <p class="text-xl font-bold text-[#e9d9c9]">Rp 20.000 <span
                                    class="text-sm font-normal text-gray-500">/ jam</span></p>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Tenis Meja -->
                <div
                    class="group bg-[#1a1a19] border border-white/5 rounded-2xl overflow-hidden hover:border-[#e9d9c9]/50 transition duration-300 hover:-translate-y-2">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ asset('img/tenis.jpeg') }}" alt="Meja Tenis"
                            class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    </div>
                    <div class="p-8 text-center">
                        <h3 class="text-2xl font-bebas mb-2 tracking-wide">MEJA TENIS</h3>
                        <p class="text-gray-400 text-sm mb-6">Area luas dan nyaman untuk bermain pingpong santai maupun
                            kompetitif.</p>
                        <div class="border-t border-white/10 pt-4">
                            <p class="text-xs text-gray-500 uppercase tracking-widest mb-1">Mulai Dari</p>
                            <p class="text-xl font-bold text-[#e9d9c9]">Rp 10.000 <span
                                    class="text-sm font-normal text-gray-500">/ jam</span></p>
                        </div>
                    </div>
                </div>

                <!-- Card 3: PS4 -->
                <div
                    class="group bg-[#1a1a19] border border-white/5 rounded-2xl overflow-hidden hover:border-[#e9d9c9]/50 transition duration-300 hover:-translate-y-2">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ asset('img/ps4.jpeg') }}" alt="PS4"
                            class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    </div>
                    <div class="p-8 text-center">
                        <h3 class="text-2xl font-bebas mb-2 tracking-wide">PLAYSTATION 4</h3>
                        <p class="text-gray-400 text-sm mb-6">TV LED 42 Inch dengan sofa empuk dan koleksi game terbaru.
                        </p>
                        <div class="border-t border-white/10 pt-4">
                            <p class="text-xs text-gray-500 uppercase tracking-widest mb-1">Mulai Dari</p>
                            <p class="text-xl font-bold text-[#e9d9c9]">Rp 8.000 <span
                                    class="text-sm font-normal text-gray-500">/ jam</span></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- 
        SECTION INFO / FEATURE (Zig-Zag Layout)
    --}}
    <section class="py-20 bg-[#1a1a19] text-[#F4EFE7] border-t border-white/5">
        <div class="container mx-auto px-6 max-w-6xl">

            <div class="flex flex-col lg:flex-row items-center gap-16">

                {{-- Gambar (Kiri) --}}
                <div class="w-full lg:w-1/2 relative">
                    <div class="absolute -inset-4 bg-[#e9d9c9]/10 rounded-2xl rotate-3"></div>
                    <img src="{{ asset('img/main.jpeg') }}" alt="Suasana Cafe"
                        class="relative rounded-2xl shadow-2xl w-full object-cover transform hover:scale-[1.01] transition duration-500">
                </div>

                {{-- Teks (Kanan) --}}
                <div class="w-full lg:w-1/2 space-y-8">
                    <div>
                        <h2 class="text-4xl md:text-5xl font-bebas mb-4 leading-none">
                            LEBIH DARI SEKADAR<br>
                            <span class="text-[#e9d9c9]">TEMPAT MAIN.</span>
                        </h2>
                        <p class="text-gray-400 text-base">
                            Kami menggabungkan keseruan olahraga biliar dengan kenyamanan cafe modern. Tempat yang pas
                            buat nongkrong, kerja remote, atau sekadar melepas penat.
                        </p>
                    </div>

                    <div class="space-y-6">
                        {{-- Poin 1 --}}
                        <div class="flex gap-4 items-start">
                            <div
                                class="w-12 h-12 rounded-full bg-[#e9d9c9]/10 flex items-center justify-center text-[#e9d9c9] shrink-0 mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg mb-1">Cafe & Resto</h4>
                                <p class="text-gray-400 text-sm leading-relaxed">Indomie kekinian, camilan gurih,
                                    hingga kopi susu gula aren yang creamy siap menemani permainanmu.</p>
                            </div>
                        </div>

                        {{-- Poin 2 --}}
                        <div class="flex gap-4 items-start">
                            <div
                                class="w-12 h-12 rounded-full bg-[#e9d9c9]/10 flex items-center justify-center text-[#e9d9c9] shrink-0 mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg mb-1">Turnamen Rutin</h4>
                                <p class="text-gray-400 text-sm leading-relaxed">Uji skill kamu di turnamen biliar dan
                                    tenis meja yang kami adakan secara berkala untuk berbagai level.</p>
                            </div>
                        </div>

                        {{-- Poin 3 --}}
                        <div class="flex gap-4 items-start">
                            <div
                                class="w-12 h-12 rounded-full bg-[#e9d9c9]/10 flex items-center justify-center text-[#e9d9c9] shrink-0 mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg mb-1">Fasilitas Lengkap</h4>
                                <p class="text-gray-400 text-sm leading-relaxed">Parkiran luas, WiFi kencang, Mushola,
                                    dan Toilet bersih untuk kenyamanan maksimal.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- 
        SECTION TESTIMONIALS
    --}}
    <section class="py-20 bg-[#0e0f0b] text-[#F4EFE7]">
        <div class="container mx-auto px-6 max-w-7xl">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bebas mb-4">KATA MEREKA</h2>
                <p class="text-gray-400">Apa kata pelanggan setia tentang Random Shot Pool & Cafe</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($reviews as $review)
                    <div
                        class="bg-[#1a1a19] p-8 rounded-2xl border border-white/5 relative hover:border-[#e9d9c9]/30 transition duration-300 {{ $loop->iteration == 2 ? 'md:-translate-y-4' : '' }}">
                        <div class="text-4xl text-[#e9d9c9] absolute top-4 left-6 font-serif opacity-30">"</div>

                        {{-- Isi Review --}}
                        <p class="text-gray-300 italic mb-6 relative z-10 text-sm leading-relaxed line-clamp-4">
                            {{ $review->review ?? ($review->feedback ?? '-') }}
                        </p>

                        <div class="flex items-center gap-4 mt-auto">
                            {{-- Avatar Inisial --}}
                            <div
                                class="w-12 h-12 rounded-full bg-gradient-to-br {{ $loop->iteration % 2 == 0 ? 'from-purple-500 to-blue-500' : 'from-red-500 to-orange-500' }} flex items-center justify-center font-bold text-white shadow-lg">
                                {{ substr($review->customer->nama ?? 'User', 0, 2) }}
                            </div>

                            <div>
                                <p class="font-bold text-sm text-white">{{ $review->customer->nama ?? 'Pelanggan' }}
                                </p>
                                {{-- Bintang Dinamis --}}
                                <div class="flex text-yellow-500 text-xs mt-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span>{{ $i <= $review->rating ? '★' : '☆' }}</span>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    {{-- Fallback jika belum ada review --}}
                    <div class="col-span-3 text-center py-10 border border-dashed border-white/10 rounded-2xl">
                        <p class="text-gray-500 italic">Belum ada ulasan yang ditampilkan.</p>
                        <a href="{{ route('review') }}" class="text-[#e9d9c9] text-sm mt-2 hover:underline">Jadilah
                            yang pertama mengulas!</a>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('review') }}"
                    class="text-gray-400 hover:text-[#e9d9c9] text-sm font-bold tracking-widest transition border-b border-transparent hover:border-[#e9d9c9] pb-1">
                    LIHAT SEMUA ULASAN &rarr;
                </a>
            </div>
        </div>
    </section>

    {{-- 
        SECTION GALERI/PORTFOLIO
    --}}
    <section class="py-20 bg-[#1a1a19] text-[#F4EFE7] border-t border-white/5">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bebas mb-4">GALERI RANDOM SHOT</h2>
                <p class="text-gray-400">Lihat suasana dan fasilitas kami lebih dekat</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-7xl mx-auto">
                <div class="group relative overflow-hidden rounded-xl aspect-square">
                    <img src="{{ asset('img/biliar.jpeg') }}" alt="Gallery 1"
                        class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    <div
                        class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                        <p class="text-white font-bold">Meja Biliar</p>
                    </div>
                </div>
                <div class="group relative overflow-hidden rounded-xl aspect-square">
                    <img src="{{ asset('img/main.jpeg') }}" alt="Gallery 2"
                        class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    <div
                        class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                        <p class="text-white font-bold">Area Cafe</p>
                    </div>
                </div>
                <div class="group relative overflow-hidden rounded-xl aspect-square">
                    <img src="{{ asset('img/ps4.jpeg') }}" alt="Gallery 3"
                        class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    <div
                        class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                        <p class="text-white font-bold">PS4 Corner</p>
                    </div>
                </div>
                <div class="group relative overflow-hidden rounded-xl aspect-square">
                    <img src="{{ asset('img/tenis.jpeg') }}" alt="Gallery 4"
                        class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    <div
                        class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                        <p class="text-white font-bold">Tenis Meja</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 
        SECTION MENU MAKANAN & MINUMAN (DINAMIS)
    --}}
    <section id="menu" class="py-20 bg-[#0e0f0b] text-[#F4EFE7]">
        <div class="container mx-auto px-6 max-w-7xl">
            <div class="text-center mb-16">
                <h3 class="text-[#e9d9c9] font-bold tracking-widest uppercase mb-2 text-xs">Menu Favorit</h3>
                <h2 class="text-4xl md:text-5xl font-bebas">NIKMATI SAMBIL MAIN</h2>
                <div class="w-20 h-1 bg-[#e9d9c9] mx-auto mt-4 rounded-full"></div>
            </div>

            {{-- Grid Menu Dinamis --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">

                {{-- Kolom Makanan --}}
                <div>
                    <h3 class="text-2xl font-bebas mb-6 text-[#e9d9c9] flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Makanan
                    </h3>
                    <div class="space-y-4">
                        @foreach ($favoriteMenus->where('kategori', 'Makanan') as $menu)
                            <div
                                class="flex justify-between items-center border-b border-white/10 pb-3 hover:bg-white/5 p-2 rounded transition">
                                <div>
                                    <h4 class="font-bold text-base">{{ $menu->nama }}</h4>
                                    {{-- Jika ada deskripsi singkat menu, bisa ditampilkan di sini --}}
                                    <p class="text-gray-500 text-sm italic line-clamp-1">Best seller choice</p>
                                </div>
                                <span class="text-[#e9d9c9] font-bold whitespace-nowrap">
                                    Rp{{ number_format($menu->harga / 1000, 0) }}K
                                </span>
                            </div>
                        @endforeach

                        @if ($favoriteMenus->where('kategori', 'Makanan')->isEmpty())
                            <p class="text-gray-500 italic">Belum ada menu makanan favorit.</p>
                        @endif
                    </div>
                </div>

                {{-- Kolom Minuman --}}
                <div>
                    <h3 class="text-2xl font-bebas mb-6 text-[#e9d9c9] flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        Minuman
                    </h3>
                    <div class="space-y-4">
                        @foreach ($favoriteMenus->where('kategori', 'Minuman') as $menu)
                            <div
                                class="flex justify-between items-center border-b border-white/10 pb-3 hover:bg-white/5 p-2 rounded transition">
                                <div>
                                    <h4 class="font-bold text-base">{{ $menu->nama }}</h4>
                                    <p class="text-gray-500 text-sm italic line-clamp-1">Fresh & cold</p>
                                </div>
                                <span class="text-[#e9d9c9] font-bold whitespace-nowrap">
                                    Rp{{ number_format($menu->harga / 1000, 0) }}K
                                </span>
                            </div>
                        @endforeach

                        @if ($favoriteMenus->where('kategori', 'Minuman')->isEmpty())
                            <p class="text-gray-500 italic">Belum ada menu minuman favorit.</p>
                        @endif
                    </div>
                </div>

            </div>

            <div class="text-center mt-12">
                <a href="{{ route('cafe') }}"
                    class="inline-block px-8 py-3 border border-[#e9d9c9] text-[#e9d9c9] font-bold rounded-full hover:bg-[#e9d9c9] hover:text-black transition duration-300">
                    Lihat Menu Lengkap
                </a>
            </div>
        </div>
    </section>

    {{-- 
    SECTION JAM OPERASIONAL & INFO PENTING
--}}
    <section class="py-20 bg-[#1a1a19] text-[#F4EFE7] border-t border-white/5">
        <div class="container mx-auto px-6 max-w-7xl">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bebas mb-4">JAM BUKA & INFO PENTING</h2>
                <p class="text-gray-400">Yang perlu kamu tahu sebelum datang</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">

                {{-- JAM OPERASIONAL --}}
                <div class="bg-[#0e0f0b] border-2 border-[#e9d9c9]/30 rounded-2xl p-8 text-center">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-[#e9d9c9]/10 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#e9d9c9]" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bebas text-[#e9d9c9] mb-6">JAM OPERASIONAL</h3>

                    <div class="space-y-4 text-left">
                        <div class="flex justify-between items-center py-3 border-b border-white/10">
                            <span class="font-semibold">Senin - Minggu</span>
                            <span class="text-[#e9d9c9] font-bold">10.00 PM - 02.00 PM</span>
                        </div>
                        <div class="flex justify-between items-center py-3">
                            <span class="font-semibold">Hari Libur Nasional</span>
                            <span class="text-[#e9d9c9] font-bold">10.00 PM - 04.00 PM</span>
                        </div>
                    </div>

                    <div class="mt-6 p-4 bg-[#C1121F]/10 border border-[#C1121F]/30 rounded-lg">
                        <p class="text-sm text-gray-300">
                            <span class="font-bold text-[#C1121F]">⚠️ Tips:</span> Booking H-1 sangat dianjurkan saat
                            weekend!
                        </p>
                    </div>
                </div>

                {{-- HARGA FASILITAS --}}
                <div class="bg-[#0e0f0b] border border-white/10 rounded-2xl p-8">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-[#e9d9c9]/10 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#e9d9c9]" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bebas text-[#e9d9c9] mb-6 text-center">HARGA MAIN</h3>

                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-3 border-b border-white/10">
                            <div>
                                <span class="font-semibold block">Meja Biliar</span>
                                <span class="text-xs text-gray-500">Per jam/meja</span>
                            </div>
                            <span class="text-[#e9d9c9] font-bold text-xl">Rp 20K</span>
                        </div>
                        <div class="flex justify-between items-center py-3 border-b border-white/10">
                            <div>
                                <span class="font-semibold block">Meja Tenis</span>
                                <span class="text-xs text-gray-500">Per jam/meja</span>
                            </div>
                            <span class="text-[#e9d9c9] font-bold text-xl">Rp 10K</span>
                        </div>
                        <div class="flex justify-between items-center py-3">
                            <div>
                                <span class="font-semibold block">PlayStation 4</span>
                                <span class="text-xs text-gray-500">Per jam/unit</span>
                            </div>
                            <span class="text-[#e9d9c9] font-bold text-xl">Rp 8K</span>
                        </div>
                    </div>

                    {{-- <div class="mt-6 p-4 bg-green-500/10 border border-green-500/30 rounded-lg">
                        <p class="text-sm text-gray-300 text-center">
                            <span class="font-bold text-green-400">💰 Promo Member:</span> Sewa 3 jam dapat diskon 10%
                        </p>
                    </div> --}}
                </div>

            </div>

            {{-- INFO TAMBAHAN --}}
            <div class="mt-12 grid grid-cols-1 md:grid-cols-4 gap-6 max-w-6xl mx-auto">

                <div
                    class="bg-[#0e0f0b] border border-white/5 rounded-xl p-6 text-center hover:border-[#e9d9c9]/30 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#e9d9c9] mx-auto mb-3"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <h4 class="font-bold mb-2">Booking Online</h4>
                    <p class="text-gray-400 text-sm">Via website 24/7</p>
                </div>

                <div
                    class="bg-[#0e0f0b] border border-white/5 rounded-xl p-6 text-center hover:border-[#e9d9c9]/30 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#e9d9c9] mx-auto mb-3"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    <h4 class="font-bold mb-2">Kebersihan Terjaga</h4>
                    <p class="text-gray-400 text-sm">Sanitasi rutin</p>
                </div>

                <div
                    class="bg-[#0e0f0b] border border-white/5 rounded-xl p-6 text-center hover:border-[#e9d9c9]/30 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#e9d9c9] mx-auto mb-3"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <h4 class="font-bold mb-2">Pembayaran Fleksibel</h4>
                    <p class="text-gray-400 text-sm">Cash & e-wallet</p>
                </div>

                <div
                    class="bg-[#0e0f0b] border border-white/5 rounded-xl p-6 text-center hover:border-[#e9d9c9]/30 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#e9d9c9] mx-auto mb-3"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <h4 class="font-bold mb-2">Event & Turnamen</h4>
                    <p class="text-gray-400 text-sm">Rutin setiap bulan</p>
                </div>

            </div>
        </div>
    </section>

    {{-- 
        SECTION FAQ
    --}}
    <section class="py-20 bg-[#0e0f0b] text-[#F4EFE7] border-t border-white/5">
        <div class="container mx-auto px-6 max-w-4xl">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bebas mb-4">PERTANYAAN UMUM</h2>
                <p class="text-gray-400">Yang sering ditanyakan tentang Random Shot</p>
            </div>

            <div class="space-y-4" x-data="{ open: null }">
                {{-- FAQ 1 --}}
                <div class="bg-[#1a1a19] border border-white/5 rounded-xl overflow-hidden">
                    <button @click="open = open === 1 ? null : 1"
                        class="w-full p-6 text-left flex justify-between items-center hover:bg-white/5 transition">
                        <span class="font-bold text-base">Berapa harga sewa meja biliar per jam?</span>
                        <svg class="w-6 h-6 transition-transform" :class="open === 1 ? 'rotate-180' : ''"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open === 1" x-collapse class="px-6 pb-6">
                        <p class="text-gray-400 text-sm">Harga sewa meja biliar mulai dari Rp 20.000 per jam. Kami juga
                            punya paket hemat untuk sewa lebih lama.</p>
                    </div>
                </div>

                {{-- FAQ 2 --}}
                <div class="bg-[#1a1a19] border border-white/5 rounded-xl overflow-hidden">
                    <button @click="open = open === 2 ? null : 2"
                        class="w-full p-6 text-left flex justify-between items-center hover:bg-white/5 transition">
                        <span class="font-bold text-base">Apakah bisa booking meja di hari yang sama?</span>
                        <svg class="w-6 h-6 transition-transform" :class="open === 2 ? 'rotate-180' : ''"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open === 2" x-collapse class="px-6 pb-6">
                        <p class="text-gray-400 text-sm">Bisa! Tapi kami sangat menyarankan untuk booking H-1 karena
                            slot cepat penuh, terutama saat weekend dan malam hari.</p>
                    </div>
                </div>

                {{-- FAQ 3 --}}
                <div class="bg-[#1a1a19] border border-white/5 rounded-xl overflow-hidden">
                    <button @click="open = open === 3 ? null : 3"
                        class="w-full p-6 text-left flex justify-between items-center hover:bg-white/5 transition">
                        <span class="font-bold text-base">Jam buka Random Shot?</span>
                        <svg class="w-6 h-6 transition-transform" :class="open === 3 ? 'rotate-180' : ''"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open === 3" x-collapse class="px-6 pb-6">
                        <p class="text-gray-400 text-sm">Kami buka setiap hari pukul 14.00 - 24.00 WIB (Senin-Jumat)
                            dan 10.00 - 01.00 WIB (Sabtu-Minggu).</p>
                    </div>
                </div>

                {{-- FAQ 4 --}}
                <div class="bg-[#1a1a19] border border-white/5 rounded-xl overflow-hidden">
                    <button @click="open = open === 4 ? null : 4"
                        class="w-full p-6 text-left flex justify-between items-center hover:bg-white/5 transition">
                        <span class="font-bold text-base">Apakah ada tempat parkir?</span>
                        <svg class="w-6 h-6 transition-transform" :class="open === 4 ? 'rotate-180' : ''"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open === 4" x-collapse class="px-6 pb-6">
                        <p class="text-gray-400 text-sm">Ada! Kami punya parkiran luas yang bisa menampung mobil dan
                            motor. Gratis untuk semua pengunjung.</p>
                    </div>
                </div>

                {{-- FAQ 5 --}}
                <div class="bg-[#1a1a19] border border-white/5 rounded-xl overflow-hidden">
                    <button @click="open = open === 5 ? null : 5"
                        class="w-full p-6 text-left flex justify-between items-center hover:bg-white/5 transition">
                        <span class="font-bold text-base">Boleh bawa makanan dari luar?</span>
                        <svg class="w-6 h-6 transition-transform" :class="open === 5 ? 'rotate-180' : ''"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open === 5" x-collapse class="px-6 pb-6">
                        <p class="text-gray-400 text-sm">Untuk menjaga kebersihan dan kenyamanan bersama, kami tidak
                            mengizinkan makanan dari luar. Tapi tenang, menu kami enak dan harganya terjangkau kok!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 
        SECTION LOKASI/MAP
    --}}
    <section class="py-20 bg-[#1a1a19] text-[#F4EFE7]">
        <div class="container mx-auto px-6 max-w-7xl">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bebas mb-4">KUNJUNGI KAMI</h2>
                <p class="text-gray-400">Jl. Raya Bogor No. 123, Kota Bogor, Jawa Barat</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
                {{-- Info Kontak --}}
                <div class="space-y-6">
                    <div class="bg-[#0e0f0b] p-6 rounded-xl border border-white/5">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 rounded-full bg-[#e9d9c9]/10 flex items-center justify-center text-[#e9d9c9] shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg mb-1">Alamat</h4>
                                <p class="text-gray-400 text-sm">Jl. Raya Bogor No. 123<br>Kota Bogor, Jawa Barat 16128
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-[#0e0f0b] p-6 rounded-xl border border-white/5">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 rounded-full bg-[#e9d9c9]/10 flex items-center justify-center text-[#e9d9c9] shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg mb-1">Jam Operasional</h4>
                                <p class="text-gray-400 text-sm">Setiap Hari: 10.00 - 24.00 hingga 00.00 - 02.00 WIB
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-[#0e0f0b] p-6 rounded-xl border border-white/5">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 rounded-full bg-[#e9d9c9]/10 flex items-center justify-center text-[#e9d9c9] shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg mb-1">Kontak</h4>
                                <p class="text-gray-400 text-sm">WhatsApp: +62 812-3456-7890<br>Instagram:
                                    @randomshot.poolcafe</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Google Maps Embed --}}
                <div class="rounded-xl overflow-hidden border border-white/5 h-[400px]">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.4567890123456!2d106.8123456789012!3d-6.5987654321098!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMzUnNTUuNiJTIDEwNsKwNDgnNDQuNCJF!5e0!3m2!1sid!2sid!4v1234567890123!5m2!1sid!2sid"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        class="grayscale hover:grayscale-0 transition duration-500">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA SECTION --}}
    <section class="py-20 bg-[#0e0f0b] text-center px-6 relative overflow-hidden border-t border-white/5">
        <div
            class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-[#e9d9c9]/5 rounded-full blur-3xl -z-10 pointer-events-none">
        </div>

        <h2 class="text-4xl md:text-6xl font-bebas text-white mb-6">TUNGGU APA LAGI?</h2>
        <p class="text-gray-400 text-base mb-10 max-w-2xl mx-auto">
            Slot meja cepat penuh di jam sibuk. Amankan mejamu sekarang sebelum keduluan yang lain!
        </p>
        <a href="{{ route('reservation') }}"
            class="inline-block px-10 py-4 bg-[#C1121F] hover:bg-[#A00F1B] text-white font-bold text-lg rounded-xl shadow-lg shadow-red-900/30 transition transform hover:-translate-y-1">
            Booking Meja Sekarang
        </a>
    </section>
</x-Layout>
