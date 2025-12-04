{{-- Landing --}}
<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <section id="home" class="relative min-h-screen flex items-center justify-center overflow-hidden">
        
        {{-- Background Image Fixed (Parallax Effect Sederhana) --}}
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('img/bghome.png') }}" class="w-full h-full object-cover opacity-60" alt="Background Home">
            {{-- Gradient Overlay agar teks lebih pop-up --}}
            <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/40 to-[#0e0f0b]"></div>
        </div>

        {{-- Content Hero --}}
        <div class="container mx-auto px-6 relative z-10 text-center pt-20">
            
            <h1 class="text-[#F4EFE7] text-xl md:text-2xl font-light tracking-[0.3em] mb-4 uppercase animate-fade-in-up">
                Waktu Luangmu, Tempat Serumu
            </h1>
            
            <h2 class="text-[#F4EFE7] text-6xl md:text-8xl lg:text-9xl font-bebas leading-none mb-8 drop-shadow-2xl animate-fade-in-up delay-100">
                RANDOM SHOT<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#F4EFE7] to-gray-400">POOL & CAFE</span>
            </h2>

            <p class="text-gray-300 text-lg md:text-xl max-w-2xl mx-auto mb-10 font-light leading-relaxed animate-fade-in-up delay-200">
                Main biliar di meja standar turnamen, nikmati kopi premium, dan temukan tempat nongkrong paling asik di Bogor.
            </p>

            <div class="flex flex-col md:flex-row gap-4 justify-center items-center animate-fade-in-up delay-300">
                <a href="/reservation" 
                   class="px-8 py-4 bg-[#F4EFE7] text-black font-bold text-lg rounded-full hover:bg-white hover:scale-105 transition duration-300 shadow-[0_0_20px_rgba(244,239,231,0.3)]">
                   Booking Meja Sekarang
                </a>
                <a href="#layanan" 
                   class="px-8 py-4 border border-white/30 text-white font-bold text-lg rounded-full hover:bg-white/10 transition duration-300 backdrop-blur-sm">
                   Lihat Menu & Fasilitas
                </a>
            </div>

        </div>

        {{-- Scroll Indicator--}}
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-10 animate-bounce">
            <a href="#layanan" class="text-white/50 hover:text-white transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
            </a>
        </div>
    </section>

    <section id="layanan" class="py-24 bg-[#0e0f0b] text-[#F4EFE7]">
        <div class="container mx-auto px-6">
            
            <div class="text-center mb-20">
                <h3 class="text-[#e9d9c9] font-bold tracking-widest uppercase mb-2">Fasilitas Kami</h3>
                <h2 class="text-5xl md:text-6xl font-bebas">Apa yang ada di Random Shot?</h2>
                <div class="w-24 h-1 bg-[#e9d9c9] mx-auto mt-6 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">

                <!-- Card 1: Biliar -->
                <div class="group bg-[#1a1a19] border border-white/5 rounded-2xl overflow-hidden hover:border-[#e9d9c9]/50 transition duration-300 hover:-translate-y-2">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ asset('img/biliar.jpeg') }}" alt="Meja Biliar" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                        <div class="absolute top-4 right-4 bg-black/70 backdrop-blur-md px-3 py-1 rounded-lg border border-white/10">
                            <span class="text-[#e9d9c9] font-bold text-sm">POPULER</span>
                        </div>
                    </div>
                    <div class="p-8 text-center">
                        <h3 class="text-2xl font-bebas mb-2 tracking-wide">MEJA BILIAR</h3>
                        <p class="text-gray-400 text-sm mb-6">Meja standar turnamen dengan karpet baru dan stick berkualitas.</p>
                        <div class="border-t border-white/10 pt-4">
                            <p class="text-xs text-gray-500 uppercase tracking-widest mb-1">Mulai Dari</p>
                            <p class="text-xl font-bold text-[#e9d9c9]">Rp 20.000 <span class="text-sm font-normal text-gray-500">/ jam</span></p>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Tenis Meja -->
                <div class="group bg-[#1a1a19] border border-white/5 rounded-2xl overflow-hidden hover:border-[#e9d9c9]/50 transition duration-300 hover:-translate-y-2">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ asset('img/tenis.jpeg') }}" alt="Meja Tenis" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    </div>
                    <div class="p-8 text-center">
                        <h3 class="text-2xl font-bebas mb-2 tracking-wide">MEJA TENIS</h3>
                        <p class="text-gray-400 text-sm mb-6">Area luas dan nyaman untuk bermain pingpong santai maupun kompetitif.</p>
                        <div class="border-t border-white/10 pt-4">
                            <p class="text-xs text-gray-500 uppercase tracking-widest mb-1">Mulai Dari</p>
                            <p class="text-xl font-bold text-[#e9d9c9]">Rp 10.000 <span class="text-sm font-normal text-gray-500">/ jam</span></p>
                        </div>
                    </div>
                </div>

                <!-- Card 3: PS4 -->
                <div class="group bg-[#1a1a19] border border-white/5 rounded-2xl overflow-hidden hover:border-[#e9d9c9]/50 transition duration-300 hover:-translate-y-2">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ asset('img/ps4.jpeg') }}" alt="PS4" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    </div>
                    <div class="p-8 text-center">
                        <h3 class="text-2xl font-bebas mb-2 tracking-wide">PLAYSTATION 4</h3>
                        <p class="text-gray-400 text-sm mb-6">TV LED 42 Inch dengan sofa empuk dan koleksi game terbaru.</p>
                        <div class="border-t border-white/10 pt-4">
                            <p class="text-xs text-gray-500 uppercase tracking-widest mb-1">Mulai Dari</p>
                            <p class="text-xl font-bold text-[#e9d9c9]">Rp 8.000 <span class="text-sm font-normal text-gray-500">/ jam</span></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    
    {{-- 
        SECTION INFO / FEATURE
    --}}
    <section class="py-24 bg-[#1a1a19] text-[#F4EFE7] border-t border-white/5">
        <div class="container mx-auto px-6 max-w-6xl">
            
            <div class="flex flex-col lg:flex-row items-center gap-16">
                
                {{-- Gambar (Kiri) --}}
                <div class="w-full lg:w-1/2 relative">
                    <div class="absolute -inset-4 bg-[#e9d9c9]/10 rounded-2xl rotate-3"></div>
                    <img src="{{ asset('img/main.jpeg') }}" alt="Suasana Cafe" class="relative rounded-2xl shadow-2xl w-full object-cover transform hover:scale-[1.01] transition duration-500">
                </div>

                {{-- Teks (Kanan) --}}
                <div class="w-full lg:w-1/2 space-y-8">
                    <div>
                        <h2 class="text-5xl md:text-6xl font-bebas mb-4 leading-none">
                            LEBIH DARI SEKADAR<br>
                            <span class="text-[#e9d9c9]">TEMPAT MAIN.</span>
                        </h2>
                        <p class="text-gray-400 text-lg">
                            Kami menggabungkan keseruan olahraga biliar dengan kenyamanan cafe modern. Tempat yang pas buat nongkrong, kerja remote, atau sekadar melepas penat.
                        </p>
                    </div>

                    <div class="space-y-4">
                        {{-- Poin 1 --}}
                        <div class="flex gap-4 items-start">
                            <div class="w-12 h-12 rounded-full bg-[#e9d9c9]/10 flex items-center justify-center text-[#e9d9c9] shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-xl mb-1">Menu Makanan & Kopi Nikmat</h4>
                                <p class="text-gray-400 text-sm">Indomie kekinian, camilan gurih, hingga kopi susu gula aren yang creamy.</p>
                            </div>
                        </div>

                        {{-- Poin 2 --}}
                        <div class="flex gap-4 items-start">
                            <div class="w-12 h-12 rounded-full bg-[#e9d9c9]/10 flex items-center justify-center text-[#e9d9c9] shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" /></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-xl mb-1">Turnamen & Komunitas</h4>
                                <p class="text-gray-400 text-sm">Rutin mengadakan turnamen biliar dan tenis meja untuk pemula hingga pro.</p>
                            </div>
                        </div>

                        {{-- Poin 3 --}}
                        <div class="flex gap-4 items-start">
                            <div class="w-12 h-12 rounded-full bg-[#e9d9c9]/10 flex items-center justify-center text-[#e9d9c9] shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-xl mb-1">Tempat Nongkrong Luas</h4>
                                <p class="text-gray-400 text-sm">Parkiran luas, WiFi kencang, dan suasana yang nyaman buat kumpul rame-rame.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- CTA SECTION --}}
    <section class="py-24 bg-[#0e0f0b] text-center px-6 relative overflow-hidden">
        {{-- Elemen Dekorasi --}}
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-[#e9d9c9]/5 rounded-full blur-3xl -z-10 pointer-events-none"></div>

        <h2 class="text-5xl md:text-7xl font-bebas text-white mb-6">TUNGGU APA LAGI?</h2>
        <p class="text-gray-400 text-lg mb-10 max-w-2xl mx-auto">
            Slot meja cepat penuh di jam sibuk. Amankan mejamu sekarang sebelum keduluan yang lain!
        </p>
        <a href="/reservation" 
           class="inline-block px-10 py-4 bg-[#C1121F] hover:bg-[#A00F1B] text-white font-bold text-xl rounded-xl shadow-lg shadow-red-900/30 transition transform hover:-translate-y-1">
            Booking Meja Sekarang
        </a>
    </section>

</x-Layout>