<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

<section class="min-h-screen bg-black text-white">

    {{-- HEADER GAMBAR --}}
    <div class="relative w-full h-[250px]">
        <img src="{{ asset('img/meja1.png') }}" class="w-full h-full opacity-50 object-cover">

        {{-- Back Button --}}
        <a href="/biliar-reservation" 
           class="absolute top-16 left-3 w-10 h-10 bg-black/40 rounded-full flex items-center 
                  justify-center text-white text-2xl backdrop-blur hover:bg-black">←
        </a>

        {{-- Nama Meja (CENTER) --}}
        <h1 class="absolute bottom-14 left-1/2 -translate-x-1/2 text-6xl tracking-wide">
            MEJA BILLIAR 1
        </h1>
    </div>


    {{-- DESKRIPSI --}}
    <div class="px-8 mt-6">
        <h2 class="text-3xl mb-2">Deskripsi</h2>
        <p class="text-gray-300 leading-relaxed max-w-5xl">
            Nikmati permainan seru di Meja Billiard 1!<br>
            Dilengkapi dengan pencahayaan ideal dan kain meja berkualitas tinggi untuk hasil 
            tembakan yang presisi. Cocok buat kamu yang ingin bermain santai tapi tetap kompetitif.
        </p>
    </div>


    {{-- FASILITAS --}}
    <div class="px-8 mt-6">
        <h2 class="text-3xl mb-3">Fasilitas</h2>

        <div class="flex flex-col gap-6 text-gray-300 text-lg">

            <div class="flex items-center gap-3">
                <img src="{{ asset('img/wifi.png') }}" class="w-6 h-6"> WiFi
            </div>

            <div class="flex items-center gap-3">
                <img src="{{ asset('img/cafe.png') }}" class="w-6 h-6"> Cafe
            </div>

            <div class="flex items-center gap-3">
                <img src="{{ asset('img/toilet.png') }}" class="w-6 h-6"> Toilet
            </div>

            <div class="flex items-center gap-3">
                <img src="{{ asset('img/parking.png') }}" class="w-6 h-6"> Parkiran
            </div>

        </div>
    </div>


    {{-- SLIDER TANGGAL --}}
    <div x-data="{ scroll: 0 }" class="relative w-full mt-10">

        {{-- Tombol Kiri --}}
        <button 
            @click="scroll -= 300; $refs.daySlider.scrollLeft = scroll"
            class="absolute left-3 top-1/2 -translate-y-1/2 z-20">
            <img src="{{ asset('img/tombol-kiri.png') }}" 
                 class="w-10 h-10 opacity-80 hover:opacity-100 transition">
        </button>

        {{-- Wrapper Scroll --}}
        <div 
            x-ref="daySlider"
            class="flex gap-6 overflow-x-auto no-scrollbar px-14 scroll-smooth">

            {{-- Data Tanggal --}}
            @php
                $days = [
                    ['tgl' => '12 Oktober 2025', 'hari' => 'SELASA'],
                    ['tgl' => '13 Oktober 2025', 'hari' => 'RABU'],
                    ['tgl' => '14 Oktober 2025', 'hari' => 'KAMIS'],
                    ['tgl' => '15 Oktober 2025', 'hari' => 'JUMAT'],
                    ['tgl' => '16 Oktober 2025', 'hari' => 'SABTU'],
                    ['tgl' => '12 Oktober 2025', 'hari' => 'SELASA'],
                    ['tgl' => '13 Oktober 2025', 'hari' => 'RABU'],
                    ['tgl' => '14 Oktober 2025', 'hari' => 'KAMIS'],
                    ['tgl' => '15 Oktober 2025', 'hari' => 'JUMAT'],
                    ['tgl' => '16 Oktober 2025', 'hari' => 'SABTU'],
                ];
            @endphp

            @foreach ($days as $d)
                <div class="min-w-[220px] bg-[#2d2d2d] rounded-xl p-6 text-white 
                            flex flex-col items-center justify-center text-center border border-white/10">
                    <p class="text-gray-300">{{ $d['tgl'] }}</p>
                    <p class="text-2xl font-bold">{{ $d['hari'] }}</p>
                </div>
            @endforeach

        </div>

        {{-- Tombol Kanan --}}
        <button 
            @click="scroll += 300; $refs.daySlider.scrollLeft = scroll"
            class="absolute right-3 top-1/2 -translate-y-1/2 z-20">
            <img src="{{ asset('img/tombol-kanan.png') }}" 
                 class="w-10 h-10 opacity-80 hover:opacity-100 transition">
        </button>

    </div>

    {{-- HIDE SCROLLBAR --}}
    <style>.no-scrollbar::-webkit-scrollbar { display: none; }</style>


    {{-- JUMLAH JADWAL --}}
    <div class="px-8 mt-8">
        <button class="px-4 py-2 border border-white rounded-lg text-white text-sm bg-white/10">
            8 Jadwal Tersedia
        </button>
    </div>


    {{-- DATA SLOT WAKTU --}}
    @php
        $jadwal = [
            ['jam' => '13.00 – 14.00', 'harga' => 'Rp 20.000'],
            ['jam' => '14.00 – 15.00', 'harga' => 'Rp 20.000'],
            ['jam' => '15.00 – 16.00', 'harga' => 'Rp 20.000'],
            ['jam' => '16.00 – 17.00', 'harga' => 'Rp 20.000'],
            ['jam' => '17.00 – 18.00', 'harga' => 'Rp 20.000'],
            ['jam' => '18.00 – 19.00', 'harga' => 'Rp 20.000'],
            ['jam' => '19.00 – 20.00', 'harga' => 'Rp 20.000'],
            ['jam' => '20.00 – 21.00', 'harga' => 'Rp 20.000'],
        ];
    @endphp


    {{-- SLIDER SLOT WAKTU --}}
    <div x-data="{ scroll: 0 }" class="relative w-full px-6 mt-6">

        {{-- Tombol Kiri --}}
        <button 
            @click="scroll -= 300; $refs.timeSlider.scrollLeft = scroll"
            class="absolute left-2 top-1/2 -translate-y-1/2 z-20">
            <img src="{{ asset('img/tombol-kiri.png') }}" 
                 class="w-10 h-10 opacity-80 hover:opacity-100 transition">
        </button>

        {{-- Wrapper Jadwal --}}
        <div 
            x-ref="timeSlider"
            class="flex gap-4 overflow-x-auto no-scrollbar scroll-smooth px-14 mb-10">

            @foreach ($jadwal as $slot)
            <div class="min-w-[150px] bg-[#2d2d2d] rounded-xl border border-white/20 
                        flex flex-col items-center justify-center text-center p-4">
                
                <p class="text-sm text-gray-300">60 Menit</p>
                <p class="font-bold">{{ $slot['jam'] }}</p>
                <p class="text-sm text-gray-300">{{ $slot['harga'] }}</p>

            </div>
            @endforeach

        </div>

        {{-- Tombol Kanan --}}
        <button 
            @click="scroll += 300; $refs.timeSlider.scrollLeft = scroll"
            class="absolute right-2 top-1/2 -translate-y-1/2 z-20">
            <img src="{{ asset('img/tombol-kanan.png') }}" 
                 class="w-10 h-10 opacity-80 hover:opacity-100 transition">
        </button>

    </div>


    {{-- EXTRA SPACE supaya tidak ketutup bottom bar --}}
    <div class="pb-24"></div>


    {{-- BOTTOM FLOATING BUTTON --}}
    <div class="fixed bottom-0 left-0 w-full bg-black/80 backdrop-blur-lg px-8 
            flex items-center justify-between py-4 z-50 border-t-2 border-white/20">

    <p class="text-white text-xl font-bold leading-none">
        Total Rp20.000</p>

    <a href="/cafe-reservation?meja=1"
    class="flex items-center gap-3 bg-red-700 hover:bg-red-800 text-white 
          px-10 py-3 rounded-xl text-lg font-semibold">
    <div class="relative">
        <img src="{{ asset('img/keranjang.png') }}" class="w-7 h-7 object-contain">
        <span class="absolute -top-1 -right-1 bg-white text-black text-xs font-bold 
                       px-2 py-1 rounded-full leading-none">1</span>
    </div>
    Lanjut
</a>

</div>


</section>

</x-Layout>
