{{-- Beranda/Home --}}
<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <section id="home" class="relative min-h-screen flex items-center justify-center overflow-hidden" x-data>
        
        {{-- Background Image Fixed (Parallax Effect Sederhana) --}}
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('img/bghome.png') }}" class="w-full h-full object-cover opacity-60" alt="Background Home">
            {{-- Gradient Overlay agar teks lebih pop-up --}}
            <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/40 to-[#0e0f0b]"></div>
        </div>

        {{-- Content Hero --}}
        <div class="container mx-auto px-6 relative z-10 text-center pt-20">
            
            <h1 class="text-[#F4EFE7] text-sm md:text-base font-light tracking-[0.3em] mb-3 uppercase animate-fade-in-up">
                Waktu Luangmu, Tempat Serumu
            </h1>
            
            <h2 class="text-[#F4EFE7] text-4xl md:text-6xl lg:text-7xl font-bebas leading-none mb-6 drop-shadow-2xl animate-fade-in-up delay-100">
                RANDOM SHOT<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#F4EFE7] to-gray-400">POOL & CAFE</span>
            </h2>

            <p class="text-gray-300 text-base md:text-lg max-w-2xl mx-auto mb-8 font-light leading-relaxed animate-fade-in-up delay-200">
                Main biliar di meja standar turnamen, nikmati kopi premium, dan temukan tempat nongkrong paling asik di Bogor.
            </p>

            <div class="flex flex-col md:flex-row gap-4 justify-center items-center animate-fade-in-up delay-300">
                <a href="{{ route('reservation') }}" 
                   class="px-6 py-3 bg-[#F4EFE7] text-black font-bold text-base rounded-full hover:bg-white hover:scale-105 transition duration-300 shadow-[0_0_20px_rgba(244,239,231,0.3)] flex items-center gap-2">
                   Booking Meja Sekarang
                   <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                       <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                   </svg>
                </a>
                
                {{-- Smooth Scroll Button --}}
                <button @click="document.getElementById('layanan').scrollIntoView({ behavior: 'smooth' })" 
                   class="px-6 py-3 border border-white/30 text-white font-bold text-base rounded-full hover:bg-white/10 transition duration-300 backdrop-blur-sm cursor-pointer">
                   Lihat Menu & Fasilitas
                </button>
            </div>

        </div>

        {{-- Scroll Indicator --}}
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-10 animate-bounce" x-data>
            <button @click="document.getElementById('layanan').scrollIntoView({ behavior: 'smooth' })" 
                    class="text-white/50 hover:text-white transition cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
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
        SECTION INFO / FEATURE (Zig-Zag Layout)
    --}}
    <section class="py-20 bg-[#1a1a19] text-[#F4EFE7] border-t border-white/5">
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
                        <h2 class="text-4xl md:text-5xl font-bebas mb-4 leading-none">
                            LEBIH DARI SEKADAR<br>
                            <span class="text-[#e9d9c9]">TEMPAT MAIN.</span>
                        </h2>
                        <p class="text-gray-400 text-base">
                            Kami menggabungkan keseruan olahraga biliar dengan kenyamanan cafe modern. Tempat yang pas buat nongkrong, kerja remote, atau sekadar melepas penat.
                        </p>
                    </div>

                    <div class="space-y-6">
                        {{-- Poin 1 --}}
                        <div class="flex gap-4 items-start">
                            <div class="w-12 h-12 rounded-full bg-[#e9d9c9]/10 flex items-center justify-center text-[#e9d9c9] shrink-0 mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg mb-1">Cafe & Resto</h4>
                                <p class="text-gray-400 text-sm leading-relaxed">Indomie kekinian, camilan gurih, hingga kopi susu gula aren yang creamy siap menemani permainanmu.</p>
                            </div>
                        </div>

                        {{-- Poin 2 --}}
                        <div class="flex gap-4 items-start">
                            <div class="w-12 h-12 rounded-full bg-[#e9d9c9]/10 flex items-center justify-center text-[#e9d9c9] shrink-0 mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" /></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg mb-1">Turnamen Rutin</h4>
                                <p class="text-gray-400 text-sm leading-relaxed">Uji skill kamu di turnamen biliar dan tenis meja yang kami adakan secara berkala untuk berbagai level.</p>
                            </div>
                        </div>

                        {{-- Poin 3 --}}
                        <div class="flex gap-4 items-start">
                            <div class="w-12 h-12 rounded-full bg-[#e9d9c9]/10 flex items-center justify-center text-[#e9d9c9] shrink-0 mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg mb-1">Fasilitas Lengkap</h4>
                                <p class="text-gray-400 text-sm leading-relaxed">Parkiran luas, WiFi kencang, Mushola, dan Toilet bersih untuk kenyamanan maksimal.</p>
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
                {{-- Testimoni 1 --}}
                <div class="bg-[#1a1a19] p-8 rounded-2xl border border-white/5 relative">
                    <div class="text-4xl text-[#e9d9c9] absolute top-4 left-6 font-serif opacity-30">"</div>
                    <p class="text-gray-300 italic mb-6 relative z-10">
                        Tempatnya asik banget buat nongkrong! Mejanya mulus, stik-nya oke punya. Kopinya juga enak, gak kalah sama coffee shop mahal.
                    </p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-purple-500 to-blue-500 flex items-center justify-center font-bold text-white">
                            AJ
                        </div>
                        <div>
                            <p class="font-bold text-sm">Anggita Jeon</p>
                            <div class="flex text-yellow-500 text-xs">★★★★★</div>
                        </div>
                    </div>
                </div>

                {{-- Testimoni 2 --}}
                <div class="bg-[#1a1a19] p-8 rounded-2xl border border-white/5 relative transform md:-translate-y-4">
                    <div class="text-4xl text-[#e9d9c9] absolute top-4 left-6 font-serif opacity-30">"</div>
                    <p class="text-gray-300 italic mb-6 relative z-10">
                        Sering banget main PS4 di sini bareng temen-temen kampus. Harganya bersahabat banget di kantong mahasiswa. Recommended!
                    </p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-red-500 to-orange-500 flex items-center justify-center font-bold text-white">
                            RD
                        </div>
                        <div>
                            <p class="font-bold text-sm">Rudi Hartono</p>
                            <div class="flex text-yellow-500 text-xs">★★★★★</div>
                        </div>
                    </div>
                </div>

                {{-- Testimoni 3 --}}
                <div class="bg-[#1a1a19] p-8 rounded-2xl border border-white/5 relative">
                    <div class="text-4xl text-[#e9d9c9] absolute top-4 left-6 font-serif opacity-30">"</div>
                    <p class="text-gray-300 italic mb-6 relative z-10">
                        Pelayanannya ramah banget. Parkiran luas jadi gak pusing kalau bawa mobil. Bakal jadi basecamp baru nih.
                    </p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-green-500 to-teal-500 flex items-center justify-center font-bold text-white">
                            AN
                        </div>
                        <div>
                            <p class="font-bold text-sm">Afra Naila</p>
                            <div class="flex text-yellow-500 text-xs">★★★★☆</div>
                        </div>
                    </div>
                </div>
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
                    <img src="{{ asset('img/biliar.jpeg') }}" alt="Gallery 1" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                        <p class="text-white font-bold">Meja Biliar</p>
                    </div>
                </div>
                <div class="group relative overflow-hidden rounded-xl aspect-square">
                    <img src="{{ asset('img/main.jpeg') }}" alt="Gallery 2" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                        <p class="text-white font-bold">Area Cafe</p>
                    </div>
                </div>
                <div class="group relative overflow-hidden rounded-xl aspect-square">
                    <img src="{{ asset('img/ps4.jpeg') }}" alt="Gallery 3" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                        <p class="text-white font-bold">PS4 Corner</p>
                    </div>
                </div>
                <div class="group relative overflow-hidden rounded-xl aspect-square">
                    <img src="{{ asset('img/tenis.jpeg') }}" alt="Gallery 4" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                        <p class="text-white font-bold">Tenis Meja</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 
        SECTION MENU MAKANAN & MINUMAN
    --}}
    <section class="py-20 bg-[#0e0f0b] text-[#F4EFE7]">
        <div class="container mx-auto px-6 max-w-7xl">
            <div class="text-center mb-16">
                <h3 class="text-[#e9d9c9] font-bold tracking-widest uppercase mb-2 text-xs">Menu Favorit</h3>
                <h2 class="text-4xl md:text-5xl font-bebas">NIKMATI SAMBIL MAIN</h2>
                <div class="w-20 h-1 bg-[#e9d9c9] mx-auto mt-4 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                {{-- Makanan --}}
                <div>
                    <h3 class="text-2xl font-bebas mb-6 text-[#e9d9c9] flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                        Makanan
                    </h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center border-b border-white/10 pb-3">
                            <div>
                                <h4 class="font-bold text-base">Indomie Goreng Special</h4>
                                <p class="text-gray-500 text-sm">Telur, kornet, keju meleleh</p>
                            </div>
                            <span class="text-[#e9d9c9] font-bold">15K</span>
                        </div>
                        <div class="flex justify-between items-center border-b border-white/10 pb-3">
                            <div>
                                <h4 class="font-bold text-base">Nasi Goreng Random Shot</h4>
                                <p class="text-gray-500 text-sm">Signature fried rice</p>
                            </div>
                            <span class="text-[#e9d9c9] font-bold">18K</span>
                        </div>
                        <div class="flex justify-between items-center border-b border-white/10 pb-3">
                            <div>
                                <h4 class="font-bold text-base">French Fries</h4>
                                <p class="text-gray-500 text-sm">Crispy potato</p>
                            </div>
                            <span class="text-[#e9d9c9] font-bold">12K</span>
                        </div>
                        <div class="flex justify-between items-center border-b border-white/10 pb-3">
                            <div>
                                <h4 class="font-bold text-base">Chicken Wings</h4>
                                <p class="text-gray-500 text-sm">5 pcs saus pilihan</p>
                            </div>
                            <span class="text-[#e9d9c9] font-bold">20K</span>
                        </div>
                    </div>
                </div>

                {{-- Minuman --}}
                <div>
                    <h3 class="text-2xl font-bebas mb-6 text-[#e9d9c9] flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                        Minuman
                    </h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center border-b border-white/10 pb-3">
                            <div>
                                <h4 class="font-bold text-base">Kopi Susu Gula Aren</h4>
                                <p class="text-gray-500 text-sm">Premium arabica blend</p>
                            </div>
                            <span class="text-[#e9d9c9] font-bold">15K</span>
                        </div>
                        <div class="flex justify-between items-center border-b border-white/10 pb-3">
                            <div>
                                <h4 class="font-bold text-base">Es Teh Manis</h4>
                                <p class="text-gray-500 text-sm">Refreshing iced tea</p>
                            </div>
                            <span class="text-[#e9d9c9] font-bold">5K</span>
                        </div>
                        <div class="flex justify-between items-center border-b border-white/10 pb-3">
                            <div>
                                <h4 class="font-bold text-base">Matcha Latte</h4>
                                <p class="text-gray-500 text-sm">Japanese green tea</p>
                            </div>
                            <span class="text-[#e9d9c9] font-bold">18K</span>
                        </div>
                        <div class="flex justify-between items-center border-b border-white/10 pb-3">
                            <div>
                                <h4 class="font-bold text-base">Mojito (Non-Alcohol)</h4>
                                <p class="text-gray-500 text-sm">Fresh mint & lime</p>
                            </div>
                            <span class="text-[#e9d9c9] font-bold">12K</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('cafe') }}" class="inline-block px-8 py-3 border border-[#e9d9c9] text-[#e9d9c9] font-bold rounded-full hover:bg-[#e9d9c9] hover:text-black transition duration-300">
                    Lihat Menu Lengkap
                </a>
            </div>
        </div>
    </section>

    {{-- 
        SECTION PRICING/PAKET
    --}}
    <section class="py-20 bg-[#1a1a19] text-[#F4EFE7] border-t border-white/5">
        <div class="container mx-auto px-6 max-w-7xl">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bebas mb-4">PAKET HEMAT</h2>
                <p class="text-gray-400">Pilih paket yang cocok buat kamu dan temen-temen</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Paket 1 --}}
                <div class="bg-[#0e0f0b] border border-white/5 rounded-2xl p-8 hover:border-[#e9d9c9]/50 transition duration-300">
                    <div class="text-center mb-6">
                        <h3 class="text-2xl font-bebas text-[#e9d9c9] mb-2">PAKET SOLO</h3>
                        <p class="text-gray-500 text-sm">Perfect untuk main sendirian</p>
                    </div>
                    <div class="text-center mb-6">
                        <span class="text-4xl font-bold">50K</span>
                        <p class="text-gray-500 text-sm mt-1">/ 3 jam</p>
                    </div>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-green-500 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <span class="text-sm">1 Meja Biliar (3 jam)</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-green-500 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <span class="text-sm">1 Minuman Pilihan</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-green-500 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <span class="text-sm">Free WiFi</span>
                        </li>
                    </ul>
                    <button class="w-full py-3 bg-[#e9d9c9]/10 text-[#e9d9c9] font-bold rounded-lg hover:bg-[#e9d9c9] hover:text-black transition duration-300">
                        Pilih Paket
                    </button>
                </div>

                {{-- Paket 2 - POPULAR --}}
                <div class="bg-gradient-to-b from-[#e9d9c9]/10 to-[#0e0f0b] border-2 border-[#e9d9c9] rounded-2xl p-8 relative transform md:-translate-y-4">
                    <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-[#C1121F] text-white px-6 py-1 rounded-full text-sm font-bold">
                        PALING LARIS
                    </div>
                    <div class="text-center mb-6">
                        <h3 class="text-2xl font-bebas text-[#e9d9c9] mb-2">PAKET SQUAD</h3>
                        <p class="text-gray-500 text-sm">Best for group hangout</p>
                    </div>
                    <div class="text-center mb-6">
                        <span class="text-4xl font-bold">150K</span>
                        <p class="text-gray-500 text-sm mt-1">/ 5 jam</p>
                    </div>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-green-500 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <span class="text-sm">2 Meja Biliar (5 jam)</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-green-500 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <span class="text-sm">4 Minuman Pilihan</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-green-500 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <span class="text-sm">2 Snack Pilihan</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-green-500 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <span class="text-sm">Free WiFi & Power Socket</span>
                        </li>
                    </ul>
                    <button class="w-full py-3 bg-[#e9d9c9] text-black font-bold rounded-lg hover:bg-white transition duration-300">
                        Pilih Paket
                    </button>
                </div>

                {{-- Paket 3 --}}
                <div class="bg-[#0e0f0b] border border-white/5 rounded-2xl p-8 hover:border-[#e9d9c9]/50 transition duration-300">
                    <div class="text-center mb-6">
                        <h3 class="text-2xl font-bebas text-[#e9d9c9] mb-2">PAKET PARTY</h3>
                        <p class="text-gray-500 text-sm">For big celebration</p>
                    </div>
                    <div class="text-center mb-6">
                        <span class="text-4xl font-bold">350K</span>
                        <p class="text-gray-500 text-sm mt-1">/ full day</p>
                    </div>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-green-500 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <span class="text-sm">Semua Meja (8 jam)</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-green-500 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <span class="text-sm">Unlimited Minuman</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-green-500 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <span class="text-sm">Catering Makanan</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-green-500 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <span class="text-sm">Dekorasi Custom</span>
                        </li>
                    </ul>
                    <button class="w-full py-3 bg-[#e9d9c9]/10 text-[#e9d9c9] font-bold rounded-lg hover:bg-[#e9d9c9] hover:text-black transition duration-300">
                        Hubungi Kami
                    </button>
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
                    <button @click="open = open === 1 ? null : 1" class="w-full p-6 text-left flex justify-between items-center hover:bg-white/5 transition">
                        <span class="font-bold text-base">Berapa harga sewa meja biliar per jam?</span>
                        <svg class="w-6 h-6 transition-transform" :class="open === 1 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open === 1" x-collapse class="px-6 pb-6">
                        <p class="text-gray-400 text-sm">Harga sewa meja biliar mulai dari Rp 20.000 per jam. Kami juga punya paket hemat untuk sewa lebih lama.</p>
                    </div>
                </div>

                {{-- FAQ 2 --}}
                <div class="bg-[#1a1a19] border border-white/5 rounded-xl overflow-hidden">
                    <button @click="open = open === 2 ? null : 2" class="w-full p-6 text-left flex justify-between items-center hover:bg-white/5 transition">
                        <span class="font-bold text-base">Apakah bisa booking meja di hari yang sama?</span>
                        <svg class="w-6 h-6 transition-transform" :class="open === 2 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open === 2" x-collapse class="px-6 pb-6">
                        <p class="text-gray-400 text-sm">Bisa! Tapi kami sangat menyarankan untuk booking H-1 karena slot cepat penuh, terutama saat weekend dan malam hari.</p>
                    </div>
                </div>

                {{-- FAQ 3 --}}
                <div class="bg-[#1a1a19] border border-white/5 rounded-xl overflow-hidden">
                    <button @click="open = open === 3 ? null : 3" class="w-full p-6 text-left flex justify-between items-center hover:bg-white/5 transition">
                        <span class="font-bold text-base">Jam buka Random Shot?</span>
                        <svg class="w-6 h-6 transition-transform" :class="open === 3 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open === 3" x-collapse class="px-6 pb-6">
                        <p class="text-gray-400 text-sm">Kami buka setiap hari pukul 14.00 - 24.00 WIB (Senin-Jumat) dan 10.00 - 01.00 WIB (Sabtu-Minggu).</p>
                    </div>
                </div>

                {{-- FAQ 4 --}}
                <div class="bg-[#1a1a19] border border-white/5 rounded-xl overflow-hidden">
                    <button @click="open = open === 4 ? null : 4" class="w-full p-6 text-left flex justify-between items-center hover:bg-white/5 transition">
                        <span class="font-bold text-base">Apakah ada tempat parkir?</span>
                        <svg class="w-6 h-6 transition-transform" :class="open === 4 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open === 4" x-collapse class="px-6 pb-6">
                        <p class="text-gray-400 text-sm">Ada! Kami punya parkiran luas yang bisa menampung mobil dan motor. Gratis untuk semua pengunjung.</p>
                    </div>
                </div>

                {{-- FAQ 5 --}}
                <div class="bg-[#1a1a19] border border-white/5 rounded-xl overflow-hidden">
                    <button @click="open = open === 5 ? null : 5" class="w-full p-6 text-left flex justify-between items-center hover:bg-white/5 transition">
                        <span class="font-bold text-base">Boleh bawa makanan dari luar?</span>
                        <svg class="w-6 h-6 transition-transform" :class="open === 5 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open === 5" x-collapse class="px-6 pb-6">
                        <p class="text-gray-400 text-sm">Untuk menjaga kebersihan dan kenyamanan bersama, kami tidak mengizinkan makanan dari luar. Tapi tenang, menu kami enak dan harganya terjangkau kok!</p>
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
                            <div class="w-12 h-12 rounded-full bg-[#e9d9c9]/10 flex items-center justify-center text-[#e9d9c9] shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg mb-1">Alamat</h4>
                                <p class="text-gray-400 text-sm">Jl. Raya Bogor No. 123<br>Kota Bogor, Jawa Barat 16128</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-[#0e0f0b] p-6 rounded-xl border border-white/5">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-full bg-[#e9d9c9]/10 flex items-center justify-center text-[#e9d9c9] shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg mb-1">Jam Operasional</h4>
                                <p class="text-gray-400 text-sm">Senin - Jumat: 14.00 - 24.00<br>Sabtu - Minggu: 10.00 - 01.00</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-[#0e0f0b] p-6 rounded-xl border border-white/5">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-full bg-[#e9d9c9]/10 flex items-center justify-center text-[#e9d9c9] shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg mb-1">Kontak</h4>
                                <p class="text-gray-400 text-sm">WhatsApp: +62 812-3456-7890<br>Instagram: @randomshot.poolcafe</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Google Maps Embed --}}
                <div class="rounded-xl overflow-hidden border border-white/5 h-[400px]">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.4567890123456!2d106.8123456789012!3d-6.5987654321098!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMzUnNTUuNiJTIDEwNsKwNDgnNDQuNCJF!5e0!3m2!1sid!2sid!4v1234567890123!5m2!1sid!2sid" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade"
                        class="grayscale hover:grayscale-0 transition duration-500">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA SECTION --}}
    <section class="py-20 bg-[#0e0f0b] text-center px-6 relative overflow-hidden border-t border-white/5">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-[#e9d9c9]/5 rounded-full blur-3xl -z-10 pointer-events-none"></div>

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