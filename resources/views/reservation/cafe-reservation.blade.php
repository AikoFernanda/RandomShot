<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

<section class="min-h-screen bg-black text-white">

    @php
        $meja = request('meja'); 
    @endphp


    {{-- HEADER GAMBAR --}}
    <div class="relative w-full h-[250px]">
        <img src="{{ asset('img/headercafe.png') }}" class="w-full h-full opacity-50 object-cover">

        {{-- Back Button --}}
        <a href="/detail-meja{{ $meja }}" 
           class="absolute top-16 left-3 w-10 h-10 bg-black/40 rounded-full flex items-center 
                  justify-center text-white text-2xl backdrop-blur hover:bg-black">←
        </a>

        {{-- Nama Meja (CENTER) --}}
        <h1 class="absolute bottom-14 left-1/2 -translate-x-1/2 text-6xl tracking-wide">
            MENU CAFE
        </h1>
    </div>


    {{-- DESKRIPSI --}}
    <div class="px-8 mt-6">
        <h2 class="text-3xl mb-2">Deskripsi</h2>
        <p class="text-gray-300 leading-relaxed max-w-7xl">
            Nikmati sajian terbaik dari kafe kami untuk menemani waktu bermain Anda!<br>
            Jika Anda memesan menu kafe bersamaan dengan reservasi meja, pesanan akan diantar saat reservasi dimulai.
            Untuk pemesanan langsung di tempat, silakan akses layanan pemesanan kafe yang tersedia.
        </p>
    </div>

    {{-- KATEGORI --}}
    <div class="px-8 mt-6 flex gap-4">
        <button class="px-4 py-2 bg-white text-black rounded-lg font-semibold">
            Makanan
        </button>
        <button class="px-4 py-2 bg-white/10 border border-white rounded-lg">
            Minuman
        </button>
    </div>

    {{-- LIST MENU --}}
    <div class="px-8 mt-10 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">

        {{-- CARD 1 --}}
        <div class="bg-white/5 border border-white/20 rounded-xl p-4">
            <img src="{{ asset('img/menu/indomie-goreng.png') }}" 
                 class="w-full h-36 object-cover rounded-lg">
            
            <p class="mt-3 font-bold">Indomie Goreng</p>
            <p class="text-gray-300 text-sm">Rp 7.000</p>

            <button class="mt-3 w-full py-2 bg-white text-black rounded-lg font-semibold">
                Tambahkan
            </button>
        </div>

        {{-- CARD 2 --}}
        <div class="bg-white/5 border border-white/20 rounded-xl p-4">
            <img src="{{ asset('img/menu/indomie-rebus.png') }}" 
                 class="w-full h-36 object-cover rounded-lg">

            <p class="mt-3 font-bold">Indomie Rebus</p>
            <p class="text-gray-300 text-sm">Rp 7.000</p>

            <button class="mt-3 w-full py-2 bg-white text-black rounded-lg font-semibold">
                Tambahkan
            </button>
        </div>

        {{-- CARD 3 --}}
        <div class="bg-white/5 border border-white/20 rounded-xl p-4">
            <img src="{{ asset('img/menu/indomie-telur.png') }}" 
                 class="w-full h-36 object-cover rounded-lg">

            <p class="mt-3 font-bold">Indomie Goreng + Telur</p>
            <p class="text-gray-300 text-sm">Rp 10.000</p>

            <button class="mt-3 w-full py-2 bg-white text-black rounded-lg font-semibold">
                Tambahkan
            </button>
        </div>

        {{-- CARD 4 --}}
        <div class="bg-white/5 border border-white/20 rounded-xl p-4">
            <img src="{{ asset('img/menu/indomie-rebus-telur.png') }}" 
                 class="w-full h-36 object-cover rounded-lg">

            <p class="mt-3 font-bold">Indomie Rebus + Telur</p>
            <p class="text-gray-300 text-sm">Rp 10.000</p>

            <button class="mt-3 w-full py-2 bg-white text-black rounded-lg font-semibold">
                Tambahkan
            </button>
        </div>

        {{-- Tambah item-item selanjutnya... --}}
    </div>


    {{-- BOTTOM CART FLOATING --}}
    <div class="fixed bottom-0 left-0 w-full py-4 bg-black/80 backdrop-blur-lg px-8 
                flex items-center justify-between z-50">

        <p class="text-white text-lg">Menu 1 Pesanan</p>

        <a href="/checkout-kafe"
           class="flex items-center gap-3 bg-red-700 hover:bg-red-800 text-white 
                  px-10 py-3 rounded-xl text-lg font-semibold">

            <div class="relative">
                <img src="{{ asset('img/keranjang.png') }}" class="w-7 h-7">
                <span class="absolute -top-2 -right-2 bg-white text-black text-xs 
                               font-bold px-2 py-0.5 rounded-full">2</span>
            </div>

            Total Rp34.000
        </a>
    </div>

</section>

</x-Layout>
