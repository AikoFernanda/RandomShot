<x-LayoutAdmin>
    <x-slot:title>{{ $title }}</x-slot:title>
    {{-- Kartu Konten Utama --}}
    <div class="bg-[#181C14]">
        <div class="mt-10 grid grid-cols-2 min-w-full text-xl font-bold text-[#FFF3E1] mb-5">
            <button type="meja" class="hover:bg-[#697565] rounded-t p-4 cursor-pointer">Data Reservasi Meja</button>

            <button type="menu" class="hover:bg-[#697565] rounded-t p-4 cursor-pointer">Data Pesanan Menu</button>
            <hr class="col-span-2 border-t border-[#f3ebdf] w-full">
        </div>
        <div class="bg-[#3C3D37] rounded-2xl p-6 text-white">
            <div class="relative">
                <input type="text" name="search" placeholder="Cari berdasarkan nama..."
                    value="{{ request('search') }}" {{-- Menampilkan query search saat ini --}}
                    class="w-full bg-[#757572] rounded-lg py-3 pl-12 pr-4 text-[#] placeholder-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500">
                {{-- Ikon search di dalam input --}}
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </span>
                {{-- Tombol submit tersembunyi, form akan submit saat menekan Enter --}}
            </div>

            <!-- RESERVASI MEJA
            <div
                class="grid grid-cols-[1.5fr_2fr_1.5fr_1fr_1.5fr_1.5fr_1.5fr] min-w-full mt-5 text-center text-xl tracking-wide text-[#ECDFCC]">
                <h1 class="py-5">Tanggal</h1>
                <h1 class="py-5">Nama Pengguna</h1>
                <h1 class="py-5">Meja</h1>
                <h1 class="py-5">Durasi</h1>
                <h1 class="py-5">Waktu Mulai</h1>
                <h1 class="py-5">Waktu Selesai</h1>
                <h1 class="py-5">Status</h1>
            </div>
            <div
                class="grid grid-cols-[1.5fr_2fr_1.5fr_1fr_1.5fr_1.5fr_1.5fr] min-w-full text-center text-[#ECDFCC] border-b">
                <div class="py-5">23/10/2025</div>
                <div class="py-5">afra</div>
                <div class="py-5">Biliar 1</div>
                <div class="py-5">1</div>
                <div class="py-5">20.00</div>
                <div class="py-5">21.00</div>
                <div class="py-5">Status</div>
            </div> -->

            <!-- Pesanan menu -->
            <div
                class="grid grid-cols-[2fr_1.5fr_1.5fr_0.5fr_1fr_2fr_1fr] min-w-full mt-5 text-center text-xl tracking-wide text-[#ECDFCC]">
                <h1 class="py-5">Tanggal dan Waktu</h1>
                <h1 class="py-5">Nama Pengguna</h1>
                <h1 class="py-5">Menu Pesanan</h1>
                <h1 class="py-5">Jumlah</h1>
                <h1 class="py-5">Tempat</h1>
                <h1 class="py-5">Catatan</h1>
                <h1 class="py-5">Status</h1>
            </div>

            <div
                class="grid grid-cols-[2fr_1.5fr_1.5fr_0.5fr_1fr_2fr_1fr] min-w-full text-center text-[#ECDFCC] border-b">
                <div class="py-5">23/10/2025 <br> 20.30</div>
                <div class="py-5">afra</div>
                <div class="py-5">Indomie Goreng</div>
                <div class="py-5">1</div>
                <div class="py-5">B1</div>
                <div class="py-5">Gapake sambel</div>
                <div class="py-5">Status</div>
            </div>
        </div>
    </div>
</x-LayoutAdmin>
