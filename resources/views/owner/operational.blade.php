<x-layout-owner>
    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="min-h-screen text-[#F4EFE7]">

    {{-- HEADER & FILTER ATAS --}}
    <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between mb-10 gap-4">

        <h1 class="text-5xl text-[#F4EFE7]">Data Operasional</h1>

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


        {{-- TABEL DATA OPERASIONAL --}}
        <div class="relative bg-[#0F100E] p-6 border border-[#F4EFE7]/20 rounded-xl">

            {{-- Tabel --}}
            <table class="w-full text-sm mb-14">
                <thead class="bg-white/20 text-[#F4EFE7]">
                    <tr>
                        <th class="py-3 text-center w-10">No</th>
                        <th class="py-3 text-center px-3">Tanggal</th>
                        <th class="py-3 text-center px-3">Kategori Operasional</th>
                        <th class="py-3 text-center px-3">Nominal</th>
                        <th class="py-3 text-center px-3">Catatan</th>
                        <th class="py-3 text-center w-20">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    {{-- ROW 1 --}}
                    <tr class="bg-[#F4EFE7] text-black border-b border-black">
                        <td class="py-3 text-center">1.</td>
                        <td class="py-3 px-3">31/10/2025</td>
                        <td class="py-3 px-3">Gaji Karyawan</td>
                        <td class="py-3 px-3">Rp1.500.000</td>
                        <td class="py-3 px-3">untuk 2 pegawai</td>

                        <td class="py-3 px-4 text-center flex items-center justify-center gap-1">

                            {{-- Tombol Edit --}}
                            <button class="px-3 py-1 bg-[#D7D3C3] text-black rounded hover:bg-[#c0bcad] text-xs">
                                Edit
                            </button>

                            {{-- Icon Delete --}}
                            <button class="px-3 py-0.5 text-white bg-red-900 rounded hover:bg-red-950 text-medium">
                                🗑
                            </button>
                        </td>
                    </tr>

                </tbody>
            </table>

            {{-- Tombol tambah --}}
            <button
                class="absolute bottom-6 right-6 w-10 h-10 flex items-center justify-center bg-[#F4EFE7] text-black rounded-full text-2xl hover:bg-[#F4EFE7]/80">
                +
            </button>

        </div>

    </section>

</x-layout-owner>
