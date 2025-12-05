<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    {{-- 1. HERO SECTION: Pintu Masuk Utama --}}
    <section id="landing" class="relative h-screen flex items-center justify-center overflow-hidden">

        {{-- Background: Image + Gradient Overlay --}}
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('img/bghome.png') }}" class="w-full h-full object-cover opacity-60 animate-zoom-slow"
                alt="Background Home">
            <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/40 to-[#0e0f0b]"></div>
        </div>

        {{-- Content Hero --}}
        <div class="container mx-auto px-6 relative z-10 text-center pt-20">

            <h1 class="text-[#F4EFE7] text-lg md:text-xl font-medium tracking-[0.3em] mb-4 uppercase animate-fade-in-up">
                Bukan Sekadar Main, Ini Gaya Hidup
            </h1>

            <h2
                class="text-[#F4EFE7] text-7xl md:text-9xl font-bebas leading-none mb-6 drop-shadow-2xl animate-fade-in-up delay-100">
                RANDOM SHOT<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#F4EFE7] to-[#9CA3AF]">POOL &
                    CAFE</span>
            </h2>

            <p
                class="text-gray-300 text-lg md:text-2xl max-w-2xl mx-auto mb-10 font-light leading-relaxed animate-fade-in-up delay-200">
                Meja dan Kopi premium. Suasana tak tertandingi.
                <span class="block mt-2 text-white font-medium">Amankan mejamu sebelum penuh.</span>
            </p>

            {{-- CTA UTAMA: Langsung ke Katalog Meja --}}
            <div class="flex flex-col md:flex-row gap-5 justify-center items-center animate-fade-in-up delay-300">
                <a href="{{ route('reservation') }}"
                    class="group relative px-10 py-5 bg-[#F4EFE7] text-black font-bold text-xl rounded-full hover:bg-white hover:scale-105 transition duration-300 shadow-[0_0_30px_rgba(244,239,231,0.4)] flex items-center gap-3">
                    <span>Booking Meja Sekarang</span>
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 transition-transform group-hover:translate-x-1" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>

                {{-- Tombol Sekunder (Lebih halus) --}}
                <a href="#layanan"
                    class="px-8 py-5 text-gray-400 hover:text-white font-medium text-lg transition duration-300 flex items-center gap-2 group">
                    Lihat Fasilitas
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 group-hover:translate-y-1 transition-transform" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </a>
            </div>

        </div>
    </section>

    {{-- 2. LAYANAN SECTION: Jalur Cepat ke Kategori --}}
    <section id="layanan" class="py-24 bg-[#0e0f0b] text-[#F4EFE7]">
        <div class="container mx-auto px-6">

            <div class="text-center mb-16">
                <h3 class="text-[#e9d9c9] font-bold tracking-widest uppercase mb-2">PILIH PERMAINANMU</h3>
                <h2 class="text-5xl md:text-6xl font-bebas">Klik untuk Lihat Ketersediaan</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">

                <a href="{{ route('reservation', ['kategori' => 'Biliar']) }}"
                    class="group block relative bg-[#1a1a19] border border-white/5 rounded-3xl overflow-hidden hover:border-[#e9d9c9] transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-[#e9d9c9]/10">
                    <div class="h-72 overflow-hidden relative">
                        <img src="{{ asset('img/biliar.jpeg') }}" alt="Meja Biliar"
                            class="w-full h-full object-cover transition duration-700 group-hover:scale-110 opacity-80 group-hover:opacity-100">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#1a1a19] via-transparent to-transparent">
                        </div>
                        <div class="absolute bottom-4 left-4 right-4">
                            <h3
                                class="text-4xl font-bebas text-white mb-1 group-hover:text-[#e9d9c9] transition-colors">
                                BILIAR</h3>
                            <p class="text-sm text-gray-300 line-clamp-2">Meja standar turnamen, karpet mulus, stick
                                lurus.</p>
                        </div>
                        {{-- Badge Harga --}}
                        <div
                            class="absolute top-4 right-4 bg-black/60 backdrop-blur border border-white/10 px-3 py-1 rounded-full">
                            <span class="text-[#e9d9c9] font-bold text-xs">Mulai 20rb/jam</span>
                        </div>
                    </div>
                    <div
                        class="p-6 bg-[#1a1a19] group-hover:bg-[#252525] transition-colors flex justify-between items-center border-t border-white/5">
                        <span
                            class="text-sm font-bold text-gray-400 group-hover:text-white uppercase tracking-wider">Cek
                            Slot Kosong</span>
                        <div
                            class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-white group-hover:bg-[#e9d9c9] group-hover:text-black transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </div>
                    </div>
                </a>

                <a href="{{ route('reservation', ['kategori' => 'Tenis']) }}"
                    class="group block relative bg-[#1a1a19] border border-white/5 rounded-3xl overflow-hidden hover:border-[#e9d9c9] transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-[#e9d9c9]/10">
                    <div class="h-72 overflow-hidden relative">
                        <img src="{{ asset('img/tenis.jpeg') }}" alt="Meja Tenis"
                            class="w-full h-full object-cover transition duration-700 group-hover:scale-110 opacity-80 group-hover:opacity-100">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#1a1a19] via-transparent to-transparent">
                        </div>
                        <div class="absolute bottom-4 left-4 right-4">
                            <h3
                                class="text-4xl font-bebas text-white mb-1 group-hover:text-[#e9d9c9] transition-colors">
                                TENIS MEJA</h3>
                            <p class="text-sm text-gray-300 line-clamp-2">Area luas, meja standar ITTF, cocok buat
                                keringetan.</p>
                        </div>
                        <div
                            class="absolute top-4 right-4 bg-black/60 backdrop-blur border border-white/10 px-3 py-1 rounded-full">
                            <span class="text-[#e9d9c9] font-bold text-xs">Mulai 10rb/jam</span>
                        </div>
                    </div>
                    <div
                        class="p-6 bg-[#1a1a19] group-hover:bg-[#252525] transition-colors flex justify-between items-center border-t border-white/5">
                        <span
                            class="text-sm font-bold text-gray-400 group-hover:text-white uppercase tracking-wider">Cek
                            Slot Kosong</span>
                        <div
                            class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-white group-hover:bg-[#e9d9c9] group-hover:text-black transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </div>
                    </div>
                </a>

                <a href="{{ route('reservation', ['kategori' => 'Playstation']) }}"
                    class="group block relative bg-[#1a1a19] border border-white/5 rounded-3xl overflow-hidden hover:border-[#e9d9c9] transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-[#e9d9c9]/10">
                    <div class="h-72 overflow-hidden relative">
                        <img src="{{ asset('img/ps4.jpeg') }}" alt="PS4"
                            class="w-full h-full object-cover transition duration-700 group-hover:scale-110 opacity-80 group-hover:opacity-100">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#1a1a19] via-transparent to-transparent">
                        </div>
                        <div class="absolute bottom-4 left-4 right-4">
                            <h3
                                class="text-4xl font-bebas text-white mb-1 group-hover:text-[#e9d9c9] transition-colors">
                                PLAYSTATION</h3>
                            <p class="text-sm text-gray-300 line-clamp-2">TV 42 Inch, Sofa empuk, Game FIFA/PES terbaru.
                            </p>
                        </div>
                        <div
                            class="absolute top-4 right-4 bg-black/60 backdrop-blur border border-white/10 px-3 py-1 rounded-full">
                            <span class="text-[#e9d9c9] font-bold text-xs">Mulai 8rb/jam</span>
                        </div>
                    </div>
                    <div
                        class="p-6 bg-[#1a1a19] group-hover:bg-[#252525] transition-colors flex justify-between items-center border-t border-white/5">
                        <span
                            class="text-sm font-bold text-gray-400 group-hover:text-white uppercase tracking-wider">Cek
                            Slot Kosong</span>
                        <div
                            class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-white group-hover:bg-[#e9d9c9] group-hover:text-black transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </section>

    {{-- 3. VALUE PROPOSITION --}}
    <section class="py-24 bg-[#1a1a19] text-[#F4EFE7] border-t border-white/5">
        <div class="container mx-auto px-6 max-w-6xl">
            <div class="flex flex-col lg:flex-row items-center gap-16">

                {{-- Gambar --}}
                <div class="w-full lg:w-1/2 relative group">
                    <div
                        class="absolute -inset-4 bg-[#e9d9c9]/20 rounded-2xl rotate-3 group-hover:rotate-6 transition-transform duration-500">
                    </div>
                    <img src="{{ asset('img/main.jpeg') }}" alt="Suasana Cafe"
                        class="relative rounded-2xl shadow-2xl w-full h-[400px] object-cover grayscale group-hover:grayscale-0 transition duration-500">
                </div>

                {{-- Teks --}}
                <div class="w-full lg:w-1/2 space-y-8">
                    <div>
                        <h2 class="text-5xl md:text-6xl font-bebas mb-4 leading-none">
                            LEBIH DARI SEKADAR<br>
                            <span class="text-[#e9d9c9]">TEMPAT MAIN.</span>
                        </h2>
                        <p class="text-gray-400 text-lg leading-relaxed">
                            Kami menggabungkan keseruan olahraga biliar dengan kenyamanan cafe modern. Tempat yang pas
                            buat nongkrong, kerja remote, atau sekadar melepas penat.
                        </p>
                    </div>

                    <div class="space-y-6">
                        <div class="flex gap-4 items-start">
                            <div
                                class="w-12 h-12 rounded-xl bg-[#e9d9c9]/10 flex items-center justify-center text-[#e9d9c9] shrink-0 border border-[#e9d9c9]/20">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-xl mb-1 text-white">Cafe & Kopi Premium</h4>
                                <p class="text-gray-400 text-sm">Lapar saat main? Tinggal pesan lewat QRIS di meja.</p>
                            </div>
                        </div>

                        <div class="flex gap-4 items-start">
                            <div
                                class="w-12 h-12 rounded-xl bg-[#e9d9c9]/10 flex items-center justify-center text-[#e9d9c9] shrink-0 border border-[#e9d9c9]/20">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-xl mb-1 text-white">Komunitas Seru</h4>
                                <p class="text-gray-400 text-sm">Temukan lawan tanding baru atau gabung turnamen
                                    mingguan kami.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 4. FINAL CTA --}}
    <section class="py-32 bg-[#0e0f0b] text-center px-6 relative overflow-hidden border-t border-white/5">
        {{-- Elemen Dekorasi --}}
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-[#e9d9c9]/5 rounded-full blur-[100px] pointer-events-none">
        </div>

        <div class="relative z-10 max-w-4xl mx-auto">

            @guest
                {{-- TAMPILAN UNTUK PENGUNJUNG (BELUM LOGIN) --}}
                <span class="text-[#e9d9c9] font-bold tracking-[0.2em] uppercase mb-4 block animate-pulse">Membership
                    Access</span>
                <h2 class="text-5xl md:text-7xl font-bebas text-white mb-6 drop-shadow-2xl leading-tight">
                    GABUNG SEKARANG &<br>NIKMATI KEMUDAHANNYA
                </h2>
                <p class="text-gray-400 text-lg md:text-xl mb-10 max-w-2xl mx-auto leading-relaxed">
                    Login untuk akses booking meja instan, simpan riwayat pesanan, dan dapatkan promo khusus member Random
                    Shot.
                </p>

                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('login') }}"
                        class="inline-block px-12 py-4 bg-[#e9d9c9] hover:bg-white text-black font-bold text-xl rounded-xl shadow-[0_0_20px_rgba(233,217,201,0.3)] transition transform hover:-translate-y-1">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                        class="inline-block px-12 py-4 border border-white/30 hover:bg-white/10 text-white font-bold text-xl rounded-xl backdrop-blur-sm transition">
                        Daftar Akun Baru
                    </a>
                </div>
            @endguest

            @auth
                {{-- TAMPILAN UNTUK MEMBER (SUDAH LOGIN) --}}
                <h2 class="text-6xl md:text-8xl font-bebas text-white mb-6 drop-shadow-2xl">
                    JANGAN SAMPAI KEHABISAN SLOT
                </h2>
                <p class="text-gray-400 text-lg md:text-xl mb-10 max-w-2xl mx-auto">
                    Halo, <span class="text-[#e9d9c9] font-bold">{{ Auth::user()->name ?? 'Member' }}</span>! Meja
                    favoritmu mungkin sedang diperebutkan orang lain sekarang.
                </p>

                <a href="{{ route('reservation') }}"
                    class="inline-block px-12 py-5 bg-[#C1121F] hover:bg-[#A00F1B] text-white font-bold text-xl rounded-2xl shadow-[0_0_30px_rgba(193,18,31,0.4)] transition transform hover:-translate-y-1 hover:scale-105">
                     AMANKAN MEJAMU SEKARANG
                </a>
            @endauth

        </div>
    </section>
</x-Layout>
