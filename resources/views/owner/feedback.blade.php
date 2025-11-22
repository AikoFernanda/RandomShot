<x-layout-owner>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="bg-black min-h-screen text-[#F4EFE7]">
        <div class="mt-10 grid grid-cols-2 min-w-full text-xl font-bold text-[#F4EFE7] mb-5">
            <button type="meja" class="hover:bg-[#697565] rounded-t p-4 cursor-pointer">Kritik dan Saran</button>

            <button type="menu" class="hover:bg-[#697565] rounded-t p-4 cursor-pointer">Rating</button>
            <hr class="col-span-2 border-t border-[#f3ebdf] w-full">
        </div>

        <div class="bg-[#3C3D37] rounded-2xl p-6 text-[#F4EFE7]">
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






            <!-- INI KRITIK DAN SARAN
            <div class="relative ml-auto w-50">
                <input type="text" name="search" placeholder="Cari tanggal..." value="{{ request('search') }}"
                    {{-- Menampilkan query search saat ini --}}
                    class="w-full bg-[#757572] rounded-lg py-3 pl-12 pr-4 text-[#F4EFE7] placeholder-gray-100 focus:outline-none focus:ring-1 focus:ring-blue-500">
                {{-- Ikon search di dalam input --}}
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[#F4EFE7]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </span>
                {{-- Tombol submit tersembunyi, form akan submit saat menekan Enter --}}
            </div>


            Kritik 1
            <div class="p-6 border-b border-[#FFF3E1]/50">
                <div class="flex items-start gap-10 relative z-10">
                    <div
                        class="w-14 h-14 shrink-0 rounded-full bg-[#F4EFE7] flex items-center justify-center 
                        text-black text-xl font-bold">
                        AJ
                   </div>
                    <div class="w-full">
                        <div class="flex items-center justify-between">
                            <p class="font-bold text-lg pt-3">Aoka Jerome</p>
                            <p class="text-sm opacity-70">
                                21 November 2025
                            </p>
                        </div>
                        <p class="pt-5">Untuk menu minumannya, bisa ga next menyediakan jus buah. Karena aku
                            sedang
                            menjaga pola hidup sehat, jadi lebih enak kalo olahraga tenis dibarengi minum jus yang
                            sehat. Lalu untuk meja tenis, tambahin dong mejanya, soalnya tadi aku harus menunggu 5
                            jam
                            untuk dapat meja tenis</p>
                    </div>
                </div>
            </div>

            Kritik 2
            <div class="p-6 border-b border-[#FFF3E1]/50">
                <div class="flex items-start gap-10 relative z-10">
                    <div
                        class="w-14 h-14 shrink-0 rounded-full bg-[#F4EFE7] flex items-center justify-center 
                        text-black text-xl font-bold">
                        AJ
                    </div>
                    <div class="w-full">
                        <div class="flex items-center justify-between">
                            <p class="font-bold text-lg pt-3">Aoka Jerome</p>
                            <p class="text-sm opacity-70">
                                21 November 2025
                            </p>
                        </div>
                        <p class="pt-5">Untuk menu minumannya, bisa ga next menyediakan jus buah. Karena aku
                            sedang
                            menjaga pola hidup sehat, jadi lebih enak kalo olahraga tenis dibarengi minum jus yang
                            sehat. Lalu untuk meja tenis, tambahin dong mejanya, soalnya tadi aku harus menunggu 5
                            jam
                            untuk dapat meja tenis</p>
                    </div>
                </div>
            </div> -->

        </div>
    </div>
</x-layout-owner>
