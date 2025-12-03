<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- 
        HERO SECTION
        Perbaikan: Menghapus 'p-' yang typo dan memastikan background cover sempurna 
    --}}
    <section id="home" 
        style="background-image: url('{{ asset('img/bghome.png') }}');"
        class="min-h-screen bg-cover bg-center bg-no-repeat relative">
        
        {{-- Overlay Gradient (Opsional: Agar teks lebih terbaca) --}}
        <div class="absolute inset-0 bg-black/40 z-0"></div>

        <div class="container pt-32 mx-auto relative z-10 h-full flex items-center">
            <div class="w-full py-20 px-6 md:px-12 text-center md:text-left">
                <div class="max-w-4xl mx-auto"> {{-- Center content --}}
                    <h1 class="text-[#F4EFE7] text-5xl md:text-6xl font-medium leading-tight mb-2 font-bebas tracking-wide">
                        Waktu Luangmu, Tempat Serumu 
                    </h1>
                    <h2 class="text-[#F4EFE7] text-7xl md:text-9xl font-bold leading-none mb-6 font-bebas tracking-wider">
                        RANDOM SHOT <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#F4EFE7] to-gray-400">POOL AND CAFE</span>
                    </h2>
                    <p class="text-[#F4EFE7] text-lg md:text-2xl font-light leading-relaxed mb-10 max-w-2xl mx-auto">
                        Waktu luang gak harus membosankan. Yuk ke Random Shot Pool and Cafe! 
                        Main biliar, nikmatin kopi, dan temukan tempat nongkrong paling asik di Bogor.
                    </p>
                        
                    <div class="flex justify-center gap-4">
                        <a href="/reservation" 
                           class="bg-[#F4EFE7] text-black px-8 py-4 rounded-full text-lg font-bold hover:bg-white transition transform hover:scale-105 shadow-lg flex items-center gap-2">
                           Reservasi Sekarang
                           <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                               <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                           </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- PROMO TERBARU --}}
    <section id="promo" class="bg-[#0e0f0b] text-[#F4EFE7] py-24 px-4 border-t border-white/5">
        <div class="max-w-7xl mx-auto text-center">
            <h2 class="text-6xl font-bebas mb-16 tracking-wide">Promo Terbaru</h2>
            <div class="grid md:grid-cols-3 gap-8">
                {{-- Promo Card 1 --}}
                <div class="bg-white/5 border border-white/10 rounded-2xl p-6 hover:bg-white/10 transition duration-300 group">
                    <div class="overflow-hidden rounded-xl mb-6 h-64">
                        <img src="{{ asset('img/Promo1.png') }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                    </div>
                    <h3 class="text-2xl font-bold mb-3 font-bebas tracking-wide">Diskon 25% Member Baru</h3>
                    <p class="text-gray-400 text-sm">Dapatkan diskon spesial untuk 10 kali reservasi pertama Anda!</p>
                </div>

                {{-- Promo Card 2 --}}
                <div class="bg-white/5 border border-white/10 rounded-2xl p-6 hover:bg-white/10 transition duration-300 group">
                    <div class="overflow-hidden rounded-xl mb-6 h-64">
                        <img src="{{ asset('img/Promo2.png') }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                    </div>
                    <h3 class="text-2xl font-bold mb-3 font-bebas tracking-wide">Turnamen 2nd Anniversary</h3>
                    <p class="text-gray-400 text-sm">Ikuti keseruannya dan menangkan total hadiah jutaan rupiah!</p>
                </div>
            
                {{-- Promo Card 3 --}}
                <div class="bg-white/5 border border-white/10 rounded-2xl p-6 hover:bg-white/10 transition duration-300 group">
                    <div class="overflow-hidden rounded-xl mb-6 h-64">
                        <img src="{{ asset('img/Promo3.png') }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                    </div>
                    <h3 class="text-2xl font-bold mb-3 font-bebas tracking-wide">Paket Hemat Kenyang</h3>
                    <p class="text-gray-400 text-sm">Indomie Telur + Es Teh + Basreng cuma Rp 15.000!</p>
                </div>
            </div>
        </div>
    </section>

    {{-- MENU & MEJA FAVORIT --}}
    <section id="menu" class="bg-[#F4EFE7] text-black py-24 px-4">
        <div class="max-w-7xl mx-auto text-center">
            <h2 class="text-6xl font-bebas mb-16 tracking-wide">Menu & Meja Favorit</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
                {{-- Item 1 --}}
                <div class="bg-white rounded-2xl shadow-xl p-4 hover:-translate-y-2 transition duration-300">
                    <img src="{{ asset('img/mejabiliar1.png') }}" class="rounded-xl mb-4 aspect-square object-cover w-full">
                    <h3 class="text-xl font-bold font-bebas">Meja VIP 1</h3>
                </div>
                {{-- Item 2 --}}
                <div class="bg-white rounded-2xl shadow-xl p-4 hover:-translate-y-2 transition duration-300">
                    <img src="{{ asset('img/extrajoss.png') }}" class="rounded-xl mb-4 aspect-square object-cover w-full">
                    <h3 class="text-xl font-bold font-bebas">Extrajoss Susu</h3>
                </div>
                {{-- Item 3 --}}
                <div class="bg-white rounded-2xl shadow-xl p-4 hover:-translate-y-2 transition duration-300">
                    <img src="{{ asset('img/mejatenis.png') }}" class="rounded-xl mb-4 aspect-square object-cover w-full">
                    <h3 class="text-xl font-bold font-bebas">Meja Tenis</h3>
                </div>
                {{-- Item 4 --}}
                <div class="bg-white rounded-2xl shadow-xl p-4 hover:-translate-y-2 transition duration-300">
                    <img src="{{ asset('img/indomiegtelur.png') }}" class="rounded-xl mb-4 aspect-square object-cover w-full">
                    <h3 class="text-xl font-bold font-bebas">Indomie Goreng</h3>
                </div>
            </div>
        </div>
    </section>

    {{-- SOSIAL MEDIA --}}
    <section class="bg-[#1a1a19] py-20 text-center px-4">
        <h2 class="text-5xl font-bebas text-[#F4EFE7] mb-6 tracking-wide">IKUTI KAMI DI INSTAGRAM</h2>
        <p class="text-gray-400 mb-10 max-w-2xl mx-auto">Dapatkan update promo, event, dan konten seru seputar Random Shot Pool & Cafe di @rs.poolcafebgr</p>
        <a href="https://www.instagram.com/rs.poolcafebgr" target="_blank" class="inline-block bg-gradient-to-r from-purple-500 to-pink-500 text-white font-bold px-10 py-4 rounded-full hover:shadow-lg hover:shadow-pink-500/30 transition transform hover:scale-105">
            Kunjungi Profil Instagram &rarr;
        </a>
    </section>


    {{-- AJAKAN RESERVASI --}}
    <section id="reservasi" class="bg-[#273520] text-[#F4EFE7] text-center py-24 px-4 relative overflow-hidden">
        {{-- Pattern Background (Opsional) --}}
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')]"></div>
        
        <div class="relative z-10">
            <h2 class="text-6xl font-bebas mb-6 tracking-wide">Yuk, Booking Sekarang!</h2>
            <p class="text-xl mb-10 font-light text-gray-300">Pilih meja favoritmu dan nikmati waktu santai bareng teman.</p>
            <a href="/reservation" class="bg-[#F4EFE7] text-[#273520] font-bold px-12 py-4 rounded-full hover:bg-white transition shadow-xl transform hover:scale-105 inline-block">
                Reservasi Sekarang
            </a>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-black text-[#F4EFE7] py-16 border-t border-white/10">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center md:items-start gap-8">
            <div class="text-center md:text-left">
                <img id="img-logo-random-shot" src="{{ asset('img/logo-rs.png') }}" alt="logo_random_shot"
                    class="w-48 h-auto mb-6 mx-auto md:mx-0">
                <p class="text-gray-400 text-sm leading-relaxed">
                    Perumahan Indogreen Blok D1 No.1<br>
                    Gunung Sari, Citeureup, Bogor, Indonesia
                </p>
            </div>
            
            <div class="text-center md:text-right self-end">
                <div class="flex gap-4 justify-center md:justify-end mb-4">
                    {{-- Social Icons could go here --}}
                </div>
                <p class="text-gray-600 text-xs">
                    © 2025 Random Shot Pool and Cafe. All rights reserved.
                </p>
            </div>
        </div>
    </footer>


    {{-- 🔥🔥🔥 NOTIFIKASI TAGIHAN MELAYANG (Hanya muncul jika ada $pendingTransaction) 🔥🔥🔥 --}}
    {{-- Ini yang akan "menghantui" user jika mereka kabur dari halaman payment --}}
    @if(isset($pendingTransaction) && $pendingTransaction)
        @php
            // Hitung sisa waktu mundur (30 menit dari created_at)
            $deadline = $pendingTransaction->created_at ? $pendingTransaction->created_at->addMinutes(30) : now()->addMinutes(30);
            $sisaDetik = now()->diffInSeconds($deadline, false);
        @endphp

        {{-- Hanya tampilkan jika waktu masih ada --}}
        @if($sisaDetik > 0)
            <div x-data="{ 
                    timeLeft: {{ $sisaDetik }},
                    formatTime(seconds) {
                        seconds = Math.floor(seconds);
                        const m = Math.floor(seconds / 60).toString().padStart(2, '0');
                        const s = (seconds % 60).toString().padStart(2, '0');
                        return `${m}:${s}`;
                    },
                    init() {
                        const timer = setInterval(() => {
                            if (this.timeLeft > 0) {
                                this.timeLeft--;
                            } else {
                                clearInterval(timer);
                                window.location.reload(); // Reload saat waktu habis
                            }
                        }, 1000);
                    }
                 }" 
                 class="fixed bottom-0 left-0 w-full bg-red-900/95 border-t border-red-500/50 text-white p-4 shadow-[0_-10px_40px_rgba(220,38,38,0.3)] z-50 backdrop-blur-md animate-slide-up">
                
                <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4">
                    
                    {{-- KIRI: Info & Timer --}}
                    <div class="flex items-center gap-4">
                        <div class="bg-red-500/20 p-3 rounded-full animate-pulse">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="text-center md:text-left">
                            <p class="font-bold text-lg leading-none text-red-100">Menunggu Pembayaran</p>
                            <p class="text-sm text-red-300 mt-1">
                                Pesanan Anda akan hangus dalam: <span x-text="formatTime(timeLeft)" class="font-mono font-bold text-white text-base ml-1"></span>
                            </p>
                        </div>
                    </div>

                    {{-- KANAN: Tombol Aksi --}}
                    <div class="flex items-center gap-3 w-full md:w-auto justify-center md:justify-end">
                        
                        {{-- Tombol Batal --}}
                        <form action="{{ route('customer.transaction.cancel') }}" 
                              method="POST" 
                              onsubmit="return confirm('Yakin batalkan pesanan?');">
                            @csrf
                            {{-- Input Hidden ID Transaksi --}}
                            <input type="hidden" name="transaction_id" value="{{ $pendingTransaction->transaction_id }}">
                            
                            <button type="submit" 
                                    class="px-4 py-2 rounded-lg border border-red-400/30 text-red-300 text-sm hover:bg-red-800 hover:text-white transition">
                                Batalkan
                            </button>
                        </form>

                        {{-- Tombol Bayar Sekarang (Balik ke Payment) --}}
                        <a href="{{ route('customer.payment', $pendingTransaction->transaction_id) }}" 
                           class="px-6 py-2 bg-white text-red-900 font-bold rounded-lg shadow-lg hover:bg-gray-100 transition flex items-center gap-2">
                            Bayar Sekarang <span>&rarr;</span>
                        </a>
                    </div>

                </div>
            </div>
        @endif
    @endif

</x-Layout>

{{-- x'-data="{}": Ini adalah perintah untuk "menyalakan" Alpine.js di elemen <body> dan semua elemen di dalamnya. --}} {{-- x'-init="...kode...": Ini adalah perintah yang kamu cari. "Saat <body> selesai dimuat, jalankan kode JavaScript ini." --}}
{{-- Jadi, "dimasukin ke div semua" itu artinya kamu menentukan batas area mana yang akan dikontrol oleh Alpine.js di halaman itu. --}}