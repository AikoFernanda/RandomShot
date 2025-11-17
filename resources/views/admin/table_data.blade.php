<x-LayoutAdmin>
    <x-slot:title>{{ $title }}</x-slot:title>
    {{-- Kartu Konten Utama --}}
    <div class="bg-[#181C14]">
        <div class="grid grid-cols-3 gap-2 w-3xl ml-10 text-[#FFF4E4] font-bold p-4 mb-5">
            <button type="biliar" class="hover:bg-[#FFF2E0]/38 border rounded-xl px-4 py-3">Meja Biliar</button>
            <button type="tenis" class="hover:bg-[#FFF2E0]/38 border rounded-xl px-4 py-3">Meja Tenis</button>
            <button type="ps" class="hover:bg-[#FFF2E0]/38 border rounded-xl px-4 py-3">PlayStation</button>

            <!-- <div class="grid grid-cols-2 gap-3 w-full max-w-md ml-10 mb-10 pr-10">
            <div class="grid grid-cols-2 gap-3 w-1/4 ml-10"> <button type="makanan"
                class="border p-4 text-center text-bold-1/2 text-[#FFF4E4] rounded-2xl hover:bg-[#FFF2E0]/38 ">Makanan </button>-->

            {{-- Nanti Anda akan letakkan tabel reservasi di sini --}}
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 w-[90%] mx-auto">
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
                    <a href="#" class="px-6 py-2 bg-white text-black text-sm font-semibold rounded-lg">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>


    </div>
</x-LayoutAdmin>
