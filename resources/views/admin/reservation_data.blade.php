<x-LayoutAdmin>
    <x-slot:title>{{ $title }}</x-slot:title>
    {{-- Kartu Konten Utama --}}
    <div class="bg-[#181C14]">
        <div class="mt-10 grid grid-cols-2 min-w-full text-xl font-bold text-[#F4EFE7] mb-5">
            <button type="meja" class="hover:bg-[#697565] rounded-t p-4 cursor-pointer">Data Reservasi Meja</button>

            <button type="menu" class="hover:bg-[#697565] rounded-t p-4 cursor-pointer">Data Pesanan Menu</button>
            <hr class="col-span-2 border-t border-[#f3ebdf] w-full">
        </div>
        <div class="bg-[#3C3D37] rounded-2xl p-6 text-[#F4EFE7]">
            <div class="relative">
                <input type="text" name="search" placeholder="Cari berdasarkan nama..."
                    value="{{ request('search') }}" {{-- Menampilkan query search saat ini --}}
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

            <!-- RESERVASI MEJA -->
            <div class="overflow-x-auto">
                <table class="w-full min-w-[800px] text-sm text-left">
                    {{-- Header Tabel --}}
                    <thead class="text-[#ECDFCC]/75 uppercase font-medium">
                        <tr>
                            <th scope="col" class="w-[150px] py-4 px-4">Tanggal</th>
                            <th scope="col" class="w-[180px] py-4 px-4">Nama Pengguna</th>
                            <th scope="col" class="w-[100px] py-4 px-4">Meja</th>
                            <th scope="col" class="w-[100px] py-4 px-4">Durasi</th>
                            <th scope="col" class="w-[150px] py-4 px-4">Waktu Mulai</th>
                            <th scope="col" class="w-[150px] py-4 px-4">Waktu Selesai</th>
                            <th scope="col" class="w-[100px] py-4 px-4">Status</th>
                        </tr>
                    </thead>

                    <tbody class="text-[#FFF3E1]">
                        <tr class="border-b border-[#FFF3E1]/50 gap-3">
                            <td class="py-3 px-4">2025-11-01</td>
                            <td class="py-3 px-4">afra</td>
                            <td class="py-3 px-4">Biliar 1</td>
                            <td class="py-3 px-4">1</td>
                            <td class="py-3 px-4">20.00</td>
                            <td class="py-3 px-4">21.00</td>
                            <td class="py-1 px-2"></td> <!-- menunggu-check in, check-in, selesai, dibatalkan -->
                        </tr>
                    </tbody>
            </div>

            <!-- PESAN MENU -->
            <div class="overflow-x-auto">
                <table class="w-full min-w-[800px] text-sm text-left">
                    {{-- Header Tabel --}}
                    <thead class="text-[#ECDFCC]/70 uppercase font-medium">
                        <tr>
                            <th scope="col" class="w-[220px] py-4 px-4">Tanggal dan Waktu</th>
                            <th scope="col" class="w-[180px] py-4 px-4">Nama Pengguna</th>
                            <th scope="col" class="w-[150px] py-4 px-4">Menu Pesanan</th>
                            <th scope="col" class="w-[100px] py-4 px-4">Jumlah</th>
                            <th scope="col" class="w-[100px] py-4 px-4">Tempat</th>
                            <th scope="col" class="w-[200px] py-4 px-4">Catatan</th>
                            <th scope="col" class="w-[100px] py-4 px-4">Status</th>
                        </tr>
                    </thead>

                    <tbody class="text-[#FFF3E1]">
                        <tr class="border-b border-[#FFF3E1]/50 gap-3">
                            <td class="py-3 px-4">2025-11-01 20.30</td>
                            <td class="py-3 px-4">afra</td>
                            <td class="py-3 px-4">Indomie Goreng</td>
                            <td class="py-3 px-4">1</td>
                            <td class="py-3 px-4">B1</td>
                            <td class="py-3 px-4">Gapake sambal</td>
                            <td class="py-1 px-2"></td> <!-- menunggu dibuat, selesai, dibatalkan -->
                        </tr>
                    </tbody>
            </div>
        </div>
</x-LayoutAdmin>
