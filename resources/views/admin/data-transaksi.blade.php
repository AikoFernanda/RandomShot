<x-layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>
    {{-- Kartu Konten Utama --}}
    <div class="bg-[#181C14]">
        <div class="bg-[#3C3D37] rounded-2xl p-6 text-[#F4EFE7]">
            <div class="relative">
                <input type="text" name="search" placeholder="Cari berdasarkan nama..." value="{{ request('search') }}"
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

            <div class="flex mt-4">
                <p class="inline-block border px-2 py-2 ml-auto">10/page v</p>
            </div>

            <!-- DATA TRANSAKSI -->
            <div class="overflow-x-auto">
                <table class="w-full min-w-[800px] text-sm text-left mt-6">
                    {{-- Header Tabel --}}
                    <thead class="text-[#ECDFCC]/75 uppercase font-medium">
                        <tr>
                            <th scope="col" class="w-[140px] py-4 px-4">No Invoice</th>
                            <th scope="col" class="w-[150px] py-4 px-4">Nama Pengguna</th>
                            <th scope="col" class="w-[130px] py-4 px-4">No Hp</th>
                            <th scope="col" class="w-[130px] py-4 px-4">Total Harga</th>
                            <th scope="col" class="w-[130px] py-4 px-4">Tanggal Transaksi</th>
                            <th scope="col" class="w-[100px] py-4 px-4">Status</th>
                        </tr>
                    </thead>

                    <!-- TRANSAKSI 1 -->
                    <tbody class="text-[#F4EFE7]">
                        <tr class="border-b border-[#FFF3E1]/50 gap-3">
                            <td class="py-3 px-4">INV-2025-11-042</td>
                            <td class="py-3 px-4">afra</td>
                            <td class="py-3 px-4">0848930388</td>
                            <td class="py-3 px-4">50.000</td>
                            <td class="py-3 px-4">2025-11-01</td>
                            <td class="ml-3 py-1 px-4 inline-block border bg-[#64B449]">lunas</td>
                            <!-- menunggu-check in, check-in, selesai, dibatalkan -->
                        </tr>
                    </tbody>

                    <!-- TRANSAKSI 2 -->
                    <tbody class="text-[#F4EFE7]">
                        <tr class="border-b border-[#FFF3E1]/50 gap-3">
                            <td class="py-3 px-4">INV-2025-11-041</td>
                            <td class="py-3 px-4">jk</td>
                            <td class="py-3 px-4">0810930311</td>
                            <td class="py-3 px-4">37.000</td>
                            <td class="py-3 px-4">2025-11-01</td>
                            <td class="ml-3 py-1 px-4 inline-block border bg-[#64B449]">lunas</td>
                            <!-- menunggu-check in, check-in, selesai, dibatalkan -->
                        </tr>
                    </tbody>
            </div>
        </div>
</x-layout-admin>
