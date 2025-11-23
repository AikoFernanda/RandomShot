<x-layout-owner>
    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="min-h-screen text-[#F4EFE7]">

        {{-- HEADER & FILTER --}}
        <h1 class="text-5xl mb-6">Laporan Penjualan</h1>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 mb-8">

            {{-- PERIODE --}}
            <div class="p-4 rounded-xl">
                <p class="text-sm text-white mb-2">Periode</p>
                <select class="w-full bg-[#697565]/30 border border-gray-300/20 text-[#F4EFE7] text-sm px-3 py-2 rounded-md">
                    <option class="text-black">1 minggu terakhir</option>
                    <option class="text-black">1 bulan terakhir</option>
                    <option class="text-black">3 bulan terakhir</option>
                </select>
            </div>

            {{-- TANGGAL --}}
            <div class="p-4 rounded-xl">
                <p class="text-sm text-white mb-2">Masukkan tanggal</p>
                <input type="date" class="w-full bg-[#697565]/30 border border-gray-300/20 text-[#F4EFE7] text-sm px-3 py-2 rounded-md">
            </div>

            {{-- STATUS PEMBAYARAN --}}
            <div class="p-4 rounded-xl">
                <p class="text-sm text-white mb-2">Status Pembayaran</p>
                <select class="w-full bg-[#697565]/30 border border-gray-300/20 text-[#F4EFE7] text-sm px-3 py-2 rounded-md">
                    <option class="text-black">Semua</option>
                    <option class="text-black">Lunas</option>
                    <option class="text-black">Pending</option>
                    <option class="text-black">Gagal</option>
                </select>
            </div>

            {{-- TIPE PENJUALAN --}}
            <div class="p-4 rounded-xl">
                <p class="text-sm text-white mb-2">Tipe Penjualan</p>
                <select class="w-full bg-[#697565]/30 border border-gray-300/20 text-[#F4EFE7] text-sm px-3 py-2 rounded-md">
                    <option class="text-black">Semua</option>
                    <option class="text-black">Pesanan Cafe</option>
                    <option class="text-black">Reservasi Meja</option>
                </select>
            </div>

        </div>

    {{-- CARDS SUMMARY --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-[#3C3D37]/90 border border-[#F4EFE7]/20 rounded-xl p-4">
            <p class="text-sm text-gray-300">Pendapatan 7 Hari Terakhir</p>
            <p class="text-2xl font-bold mt-2">Rp 250,5k</p>
        </div>

        <div class="bg-[#3C3D37]/90 border border-[#F4EFE7]/20 rounded-xl p-4">
            <p class="text-sm text-gray-300">Total Transaksi 7 Hari Terakhir</p>
            <p class="text-2xl font-bold mt-2">25 Transaksi</p>
        </div>

        <div class="bg-[#3C3D37]/90 border border-[#F4EFE7]/20 rounded-xl p-4">
            <p class="text-sm text-gray-300">Rata-Rata Pendapatan 7 Hari Terakhir</p>
            <p class="text-2xl font-bold mt-2">15 Reservasi</p>
        </div>

        <div class="bg-[#3C3D37]/90 border border-[#F4EFE7]/20 rounded-xl p-4">
            <p class="text-sm text-gray-300">Total Item Terjual 7 Hari Terakhir</p>
            <p class="text-2xl font-bold mt-2">10 Item</p>
        </div>
    </div>



        {{-- GRAFIK --}}
        <h2 class="text-3xl mt-8 mb-4">Grafik Penjualan</h2>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            {{-- LINE CHART --}}
            <div class="lg:col-span-2 bg-[#3C3D37] border border-white/20 rounded-xl p-6">
                <img src="{{ asset('img/chart-line.png') }}" class="w-full rounded-lg">
            </div>

            {{-- PIE CHART --}}
            <div class="bg-[#3C3D37] border border-white/20 rounded-xl p-6">
                <img src="{{ asset('img/chart-pie.png') }}" class="w-full">
                <div class="mt-4 text-sm space-y-1">
                    <p><span class="inline-block w-3 h-3 bg-yellow-300 rounded mr-2"></span>Pesanan Cafe</p>
                    <p><span class="inline-block w-3 h-3 bg-gray-300 rounded mr-2"></span>Reservasi Meja</p>
                </div>
            </div>

        </div>



        {{-- TABEL TRANSAKSI --}}
        <h2 class="text-3xl mt-12 mb-4">Tabel Rincian Transaksi Penjualan</h2>

        <div class="bg-[#3C3D37] border border-black rounded-xl overflow-hidden">

            <table class="w-full text-sm text-[#F4EFE7]">
                <thead class="bg-white/20">
                    <tr>
                        <th class="py-3 text-center w-10">No</th>
                        <th class="py-3 text-left px-3">Tanggal</th>
                        <th class="py-3 text-left px-3">Nomor Invoice</th>
                        <th class="py-3 text-left px-3">Pelanggan</th>
                        <th class="py-3 text-center px-3">Status Pembayaran</th>
                        <th class="py-3 text-center px-3">Metode Pembayaran</th>
                        <th class="py-3 text-center px-3">Total (Rp)</th>
                        <th class="py-3 text-center">Lihat Detail</th>
                    </tr>
                </thead>

                <tbody>

                    {{-- Row 1 --}}
                    <tr class="bg-[#F4EFE7] text-black border-b border-black">
                        <td class="py-3 text-center">1</td>
                        <td class="py-3 px-3">22/10/2025</td>
                        <td class="py-3 px-3">Invoice123</td>
                        <td class="py-3 px-3">Aoka Yeremi</td>
                        <td class="py-3 text-center">Pending</td>
                        <td class="py-3 text-center">QRIS</td>
                        <td class="py-3 text-center">Rp10.000</td>
                        <td class="py-3 text-center">
                            <button class="px-4 py-1 bg-black text-[#F4EFE7] rounded-lg">Detail</button>
                        </td>
                    </tr>

                    {{-- Row 2 --}}
                    <tr class="bg-[#F4EFE7] text-black border-b border-black">
                        <td class="py-3 text-center">2</td>
                        <td class="py-3 px-3">21/10/2025</td>
                        <td class="py-3 px-3">Invoice456</td>
                        <td class="py-3 px-3">Afra Sui</td>
                        <td class="py-3 text-center">Lunas</td>
                        <td class="py-3 text-center">QRIS</td>
                        <td class="py-3 text-center">Rp50.000</td>
                        <td class="py-3 text-center">
                            <button class="px-4 py-1 bg-black text-[#F4EFE7] rounded-lg">Detail</button>
                        </td>
                    </tr>

                    {{-- Row 3 --}}
                    <tr class="bg-[#F4EFE7] text-black border-b border-black">
                        <td class="py-3 text-center">3</td>
                        <td class="py-3 px-3">20/10/2025</td>
                        <td class="py-3 px-3">Invoice789</td>
                        <td class="py-3 px-3">Anggi Seagull</td>
                        <td class="py-3 text-center">Lunas</td>
                        <td class="py-3 text-center">Cash</td>
                        <td class="py-3 text-center">Rp43.000</td>
                        <td class="py-3 text-center">
                            <button class="px-4 py-1 bg-black text-[#F4EFE7] rounded-lg">Detail</button>
                        </td>
                    </tr>

                    {{-- Row 4 --}}
                    <tr class="bg-[#F4EFE7] text-black border-b border-black">
                        <td class="py-3 text-center">4</td>
                        <td class="py-3 px-3">19/10/2025</td>
                        <td class="py-3 px-3">Invoice990</td>
                        <td class="py-3 px-3">Arul Zaqwan</td>
                        <td class="py-3 text-center">Pending</td>
                        <td class="py-3 text-center">QRIS</td>
                        <td class="py-3 text-center">Rp35.000</td>
                        <td class="py-3 text-center">
                            <button class="px-4 py-1 bg-black text-[#F4EFE7] rounded-lg">Detail</button>
                        </td>
                    </tr>

                </tbody>
            </table>

        </div>

    </section>

</x-layout-owner>
