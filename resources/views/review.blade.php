<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class=" min-h-screen text-[#F4EFE7]">

        <div class="rounded-2xl p-6 text-[#F4EFE7] py-10 mt-20">
            <div class="grid grid-cols-4 gap-2 w-3xl ml-10 text-[#FFF4E4] p-4 mb-5 ">
                <button type="semua" class="hover:bg-[#FFF2E0]/38 border rounded-xl px-4 py-3">Semua</button>
                <button type="hari" class="hover:bg-[#FFF2E0]/38 border rounded-xl px-4 py-3">1 Hari
                    Terakhir</button>
                <button type="minggu" class="hover:bg-[#FFF2E0]/38 border rounded-xl px-4 py-3">1 Minggu
                    Terakhir</button>
                <button type="bulan" class="hover:bg-[#FFF2E0]/38 border rounded-xl px-4 py-3">1 Bulan
                    Terakhir</button>
            </div>

            <!-- INI RATING 1 -->
            <div class="p-6 border-b border-[#FFF3E1]/50">
                <div class="flex items-start gap-10 relative z-10">
                    <div
                        class="w-14 h-14 shrink-0 rounded-full bg-[#F4EFE7] flex items-center justify-center 
                        text-black text-xl font-bold">
                        AT
                    </div>
                    <div class="w-full">
                        <div class="flex items-center justify-between">
                            <p class="font-bold text-lg pt-3">Arul Tia</p>
                            <p class="text-sm opacity-70">
                                21 November 2025
                            </p>
                        </div>
                        <p class="text-yellow-400 text-sm">★★★★☆</p>
                        <p class="pt-5">Menunya bervariasii</p>
                    </div>
                </div>
            </div>

            <!-- INI RATING 2 -->
            <div class="p-6 border-b border-[#FFF3E1]/50">
                <div class="flex items-start gap-10 relative z-10">
                    <div
                        class="w-14 h-14 shrink-0 rounded-full bg-[#F4EFE7] flex items-center justify-center 
                        text-black text-xl font-bold">
                        AS
                    </div>
                    <div class="w-full">
                        <div class="flex items-center justify-between">
                            <p class="font-bold text-lg pt-3">Afra Sui</p>
                            <p class="text-sm opacity-70">
                                19 November 2025
                            </p>
                        </div>
                        <p class="text-yellow-400 text-sm">★★★★★</p>
                        <p class="pt-5">Pelayanannya sangat cepat dan pelayanannya ramah</p>
                    </div>
                </div>
            </div>
        </div>

</x-Layout>
