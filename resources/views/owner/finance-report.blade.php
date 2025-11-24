<x-Layout-owner>
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- ========== HEADER & FILTER ATAS ========== --}}
    <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between mb-10 gap-4">

        <h1 class="text-5xl text-[#F4EFE7]">Laporan Keuangan</h1>

        <form class="flex items-center space-x-3">

            {{-- Dropdown Periode --}}
            <div class="bg-white/10 border border-white/20 px-4 py-2 rounded-lg">
                <select class="bg-transparent text-[#F4EFE7] text-sm focus:outline-none">
                    <option value="" class="text-black">Pilih Periode</option>
                    <option class="text-black">Bulan ini</option>
                    <option class="text-black">1 Bulan Terakhir</option>
                    <option class="text-black">3 Bulan Terakhir</option>
                    <option class="text-black">6 Bulan Terakhir</option>
                    <option class="text-black">1 Tahun Terakhir</option>
                </select>
            </div>

            {{-- Input tanggal --}}
            <div class="bg-white/10 border border-white/20 px-4 py-2 rounded-lg">
                <input type="date" class="bg-transparent text-[#F4EFE7] text-sm focus:outline-none">
            </div>

            {{-- Tombol Cari --}}
            <button
                class="px-5 py-2 bg-[#F4EFE7] hover:bg-[#F4EFE7]/80 text-black font-semibold text-sm rounded-lg">
                Cari
            </button>

        </form>
    </div>


    {{-- ========== HIGHLIGHT BOXES ========== --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-12">

        <div class="bg-[#3C3D37]/90 border border-[#F4EFE7]/20 rounded-xl p-6">
            <p class="text-sm text-gray-300">Total Pendapatan</p>
            <p class="text-3xl text-[#F4EFE7] font-bold mt-2">Rp 150.000<span class="text-lg">,-</span></p>
        </div>

        <div class="bg-[#3C3D37]/90 border border-[#F4EFE7]/20 rounded-xl p-6">
            <p class="text-sm text-gray-300">Total Biaya Operasional</p>
            <p class="text-3xl text-[#F4EFE7] font-bold mt-2">Rp 2.600.000<span class="text-lg">,-</span></p>
        </div>

        <div class="bg-[#3C3D37]/90 border border-[#F4EFE7]/20 rounded-xl p-6">
            <p class="text-sm text-gray-300">Laba Bersih</p>
            <p class="text-3xl text-[#F4EFE7] font-bold mt-2">Rp 65.217<span class="text-lg">,-</span></p>
        </div>

    </div>

    {{-- TABEL PENDAPATAN --}}
    <div class="mb-12">
        <h2 class="text-3xl text-[#F4EFE7] mb-3">Tabel Pendapatan</h2>

        <div class="bg-[#3C3D37]/90 border border-black rounded-xl overflow-hidden">

            <table class="w-full text-sm text-[#F4EFE7]">
                <thead class="bg-white/20">
                    <tr>
                        <th class="py-3 px-4 text-left">Jenis Pendapatan</th>
                        <th class="py-3 px-4 text-left">Nominal</th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="border-b border-black bg-[#F4EFE7] text-black ">
                        <td class="py-3 px-4">Reservasi Meja</td>
                        <td class="py-3 px-4">Rp 150.000</td>
                    </tr>

                    <tr class="border-b border-black  bg-[#F4EFE7] text-black">
                        <td class="py-3 px-4">Pesanan Menu Kafe</td>
                        <td class="py-3 px-4">Rp 150.000</td>
                    </tr>

                    <tr class="font-semibold bg-[#F4EFE7]/90 text-black">
                        <td class="py-3 px-4">Total</td>
                        <td class="py-3 px-4">Rp 300.000</td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>



    {{-- TABEL BIAYA OPERASIONAL --}}
    <div class="mb-14">
        <h2 class="text-3xl text-[#F4EFE7] mb-3">Tabel Biaya Operasional</h2>

        <div class="bg-[#3C3D37]/90 border border-black rounded-xl overflow-hidden">

            <table class="w-full text-sm text-[#F4EFE7]">
                <thead class="bg-white/20">
                    <tr>
                        <th class="py-3 px-4 text-left">Jenis Operasional</th>
                        <th class="py-3 px-4 text-left">Nominal</th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="border-b border-black bg-[#F4EFE7] text-black">
                        <td class="py-3 px-4">Gaji Karyawan</td>
                        <td class="py-3 px-4">Rp 1.500.000</td>
                    </tr>

                    <tr class="border-b border-black bg-[#F4EFE7] text-black">
                        <td class="py-3 px-4">Sewa Tempat</td>
                        <td class="py-3 px-4">Rp 800.000</td>
                    </tr>

                    <tr class="border-b border-black bg-[#F4EFE7] text-black">
                        <td class="py-3 px-4">Stok Barang</td>
                        <td class="py-3 px-4">Rp 300.000</td>
                    </tr>

                    <tr class="border-b border-black bg-[#F4EFE7]/90 text-black font-semibold">
                        <td class="py-3 px-4">Total</td>
                        <td class="py-3 px-4">Rp 2.600.000</td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>

</x-Layout-owner>
