<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

<section class="min-h-screen bg-[#121412] text-white pt-28 pb-24 px-10">

 {{-- TAB TITLE --}}
        <h2 class="text-5xl ml-6 mb-6">RIWAYAT PESANAN SAYA</h2>
        <div class="space-y-5">

    {{-- HEADER BUTTONS --}}
        <div class="flex justify-end gap-3 mb-6 mr-8">
            <a href="/riwayat-meja"
               class="px-4 py-2 bg-transparent rounded-md border border-white text-white text-sm">
               Reservasi Meja
            </a>

            <a href="/riwayat-cafe"
               class="px-4 py-2 bg-white/30 rounded-md border border-white text-white text-sm">
               Menu Cafe
            </a>
        </div>

        {{-- CARD 1 --}}
        <div class="flex mr-6 ml-6 bg-black/40 rounded-xl border border-white overflow-hidden relative">

            <img src="{{ asset('img/menu/indomie.png') }}" class="w-44 h-32 object-cover">

            <div class="p-4 flex-1">
                <h3 class="text-3xl">Indomie Goreng</h3>
                <p class="text-gray-400 text-sm">
                    09/10/2025 <br> Tanpa bumbu sambal
                </p>
            </div>

            <div class="absolute right-4 top-4 text-xl font-semibold">
                Rp10.000
            </div>

            <div class="absolute right-4 bottom-6">
                <a href="#"
                   class="px-6 py-2 bg-white text-black text-sm font-semibold rounded-lg">
                    Lihat Detail
                </a>
            </div>
        </div>

        {{-- CARD 2 --}}
        <div class="flex mr-6 ml-6 bg-black/40 rounded-xl border border-white overflow-hidden relative">

            <img src="{{ asset('img/menu/indomie.png') }}" class="w-44 h-32 object-cover">

            <div class="p-4 flex-1">
                <h3 class="text-3xl">Indomie Goreng</h3>
                <p class="text-gray-400 text-sm">
                    09/10/2025 <br> Tanpa bumbu sambal
                </p>
            </div>

            <div class="absolute right-4 top-4 text-xl font-semibold">
                Rp10.000
            </div>

            <div class="absolute right-4 bottom-6">
                <a href="#"
                   class="px-6 py-2 bg-white text-black text-sm font-semibold rounded-lg">
                    Lihat Detail
                </a>
            </div>
        </div>

        {{-- CARD 3 --}}
        <div class="flex mr-6 ml-6 bg-black/40 rounded-xl border border-white overflow-hidden relative">

            <img src="{{ asset('img/menu/indomie.png') }}" class="w-44 h-32 object-cover">

            <div class="p-4 flex-1">
                <h3 class="text-3xl">Indomie Goreng</h3>
                <p class="text-gray-400 text-sm">
                    09/10/2025 <br> Tanpa bumbu sambal
                </p>
            </div>

            <div class="absolute right-4 top-4 text-xl font-semibold">
                Rp10.000
            </div>

            <div class="absolute right-4 bottom-6">
                <a href="#"
                   class="px-6 py-2 bg-white text-black text-sm font-semibold rounded-lg">
                    Lihat Detail
                </a>
            </div>
        </div>
        

    </div>

</section>

</x-Layout>
