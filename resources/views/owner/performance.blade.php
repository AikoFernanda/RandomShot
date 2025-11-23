<x-layout-owner>
    <x-slot:title>{{ $title }}</x-slot:title>

<section class="min-h-screen text-[#F4EFE7]">

    {{-- HEADER & FILTER ATAS --}}
    <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between mb-10 gap-4">
        <h1 class="text-5xl text-[#F4EFE7]">Highlight Bisnis Harian</h1>

        <form class="flex items-center space-x-3">
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

            <div class="bg-white/10 border border-white/20 px-4 py-2 rounded-lg">
                <input type="date" class="bg-transparent text-[#F4EFE7] text-sm focus:outline-none">
            </div>

            <button class="px-5 py-2 bg-[#F4EFE7] hover:bg-[#F4EFE7]/80 text-black font-semibold text-sm rounded-lg">
                Cari
            </button>
        </form>
    </div>


    {{-- CARDS SUMMARY --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-[#3C3D37]/90 border border-[#F4EFE7]/20 rounded-xl p-4">
            <p class="text-sm text-gray-300">Pendapatan Hari ini</p>
            <p class="text-3xl font-bold mt-2">Rp 250,5k</p>
        </div>

        <div class="bg-[#3C3D37]/90 border border-[#F4EFE7]/20 rounded-xl p-4">
            <p class="text-sm text-gray-300">Total Transaksi Hari ini</p>
            <p class="text-3xl font-bold mt-2">25 Transaksi</p>
        </div>

        <div class="bg-[#3C3D37]/90 border border-[#F4EFE7]/20 rounded-xl p-4">
            <p class="text-sm text-gray-300">Reservasi Meja Hari ini</p>
            <p class="text-3xl font-bold mt-2">15 Reservasi</p>
        </div>

        <div class="bg-[#3C3D37]/90 border border-[#F4EFE7]/20 rounded-xl p-4">
            <p class="text-sm text-gray-300">Pesanan Cafe Hari ini</p>
            <p class="text-3xl font-bold mt-2">10 Pesanan</p>
        </div>
    </div>


    {{-- GRAFIK --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-10">
        <div class="lg:col-span-2 bg-[#3C3D37]/90 border border-[#F4EFE7]/20 rounded-xl p-6">
            <h2 class="text-2xl mb-4">Grafik Tren Pendapatan Harian</h2>
            <img src="{{ asset('img/grafik.png') }}" class="w-full rounded-lg">
        </div>

        <div class="bg-[#3C3D37]/90 border border-[#F4EFE7]/20 rounded-xl p-6">
            <h2 class="text-2xl mb-4">Persentase Transaksi</h2>
            <img src="{{ asset('img/chart-pie.png') }}" class="w-full">
            <div class="mt-4 text-sm space-y-1">
                <p><span class="inline-block w-3 h-3 bg-yellow-300 rounded mr-2"></span> Pesanan Cafe</p>
                <p><span class="inline-block w-3 h-3 bg-gray-400 rounded mr-2"></span> Reservasi Meja</p>
            </div>
        </div>
    </div>

        {{-- MENU CAFE TERLARIS --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-10">

            {{-- MENU TERLARIS --}}
            <div class="bg-[#3C3D37]/90 border border-black rounded-xl p-6">
                <h2 class="text-3xl mb-4">Menu Cafe Terlaris</h2>

                <table class="w-full text-sm">
                    <thead class="bg-white/20 text-[#F4EFE7]">
                        <tr>
                            <th class="py-2 px-3 text-center w-10">No.</th>
                            <th class="py-2 px-3 text-left">Menu</th>
                            <th class="py-2 px-3 text-center">Total Pesanan</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr class="bg-[#F4EFE7] text-black border-b border-black rounded-lg">
                            <td class="py-2 text-center">1.</td>
                            <td class="py-2 px-3">Kopi Good Day</td>
                            <td class="py-2 text-center">10</td>
                        </tr>

                        <tr class="bg-[#F4EFE7] text-black border-b border-black">
                            <td class="py-2 text-center">2.</td>
                            <td class="py-2 px-3">Indomie Goreng</td>
                            <td class="py-2 text-center">8</td>
                        </tr>

                        <tr class="bg-[#F4EFE7] text-black border-b border-black">
                            <td class="py-2 text-center">3.</td>
                            <td class="py-2 px-3">Indomie Rebus</td>
                            <td class="py-2 text-center">6</td>
                        </tr>

                        <tr class="bg-[#F4EFE7] text-black border-b border-black">
                            <td class="py-2 text-center">4.</td>
                            <td class="py-2 px-3">Es Milo</td>
                            <td class="py-2 text-center">5</td>
                        </tr>

                        <tr class="bg-[#F4EFE7] text-black">
                            <td class="py-2 text-center">5.</td>
                            <td class="py-2 px-3">Chocolatos</td>
                            <td class="py-2 text-center">4</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- MEJA TERLARIS --}}
            <div class="bg-[#3C3D37]/90 border border-black rounded-xl p-6">
                <h2 class="text-3xl mb-4">Meja Terlaris</h2>

                <table class="w-full text-sm">
                    <thead class="bg-white/20 text-[#F4EFE7]">
                        <tr>
                            <th class="py-2 text-center w-10">No.</th>
                            <th class="py-2 text-left">Meja</th>
                            <th class="py-2 text-center">Total Reservasi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr class="bg-[#F4EFE7] text-black border-b border-black">
                            <td class="py-2 text-center">1.</td>
                            <td class="py-2 px-3">Biliar</td>
                            <td class="py-2 text-center">10 kali dipesan</td>
                        </tr>
                        <tr class="bg-[#F4EFE7] text-black border-b border-black">
                            <td class="py-2 text-center">2.</td>
                            <td class="py-2 px-3">Tenis</td>
                            <td class="py-2 text-center">8 kali dipesan</td>
                        </tr>
                        <tr class="bg-[#F4EFE7] text-black">
                            <td class="py-2 text-center">3.</td>
                            <td class="py-2 px-3">Playstation</td>
                            <td class="py-2 text-center">6 kali dipesan</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>


        {{-- PELANGGAN TERBAIK --}}
        <div class="bg-[#3C3D37]/90 border border-black rounded-xl p-6 mt-12">
            <h2 class="text-3xl mb-4">Pelanggan Terbaik</h2>

            <table class="w-full text-sm">
                <thead class="bg-white/20 text-[#F4EFE7]">
                    <tr>
                        <th class="py-2 text-center w-10">No.</th>
                        <th class="py-2 text-left">Pelanggan</th>
                        <th class="py-2 text-left">Email</th>
                        <th class="py-2 text-center">No. Handphone</th>
                        <th class="py-2 text-center">Total Transaksi</th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="bg-[#F4EFE7] text-black border-b border-black">
                        <td class="py-2 text-center">1.</td>
                        <td class="py-2 px-3">Anggita Jeon</td>
                        <td class="py-2 px-3">anggitoy@gmail.com</td>
                        <td class="py-2 text-center">081234567890</td>
                        <td class="py-2 text-center">10</td>
                    </tr>

                    <tr class="bg-[#F4EFE7] text-black border-b border-black">
                        <td class="py-2 text-center">2.</td>
                        <td class="py-2 px-3">Aoka Yeremi</td>
                        <td class="py-2 px-3">aik0gacor@gmail.com</td>
                        <td class="py-2 text-center">081234567890</td>
                        <td class="py-2 text-center">8</td>
                    </tr>

                    <tr class="bg-[#F4EFE7] text-black border-b border-black">
                        <td class="py-2 text-center">3.</td>
                        <td class="py-2 px-3">Arultzy Bogor</td>
                        <td class="py-2 px-3">kingarul@gmail.com</td>
                        <td class="py-2 text-center">081234567890</td>
                        <td class="py-2 text-center">6</td>
                    </tr>

                    <tr class="bg-[#F4EFE7] text-black border-b border-black">
                        <td class="py-2 text-center">4.</td>
                        <td class="py-2 px-3">Afra Sui</td>
                        <td class="py-2 px-3">aprasuiy456@gmail.com</td>
                        <td class="py-2 text-center">081234567890</td>
                        <td class="py-2 text-center">5</td>
                    </tr>

                    <tr class="bg-[#F4EFE7] text-black">
                        <td class="py-2 text-center">5.</td>
                        <td class="py-2 px-3">Ramanda Kookie</td>
                        <td class="py-2 px-3">ramkookie3@gmail.com</td>
                        <td class="py-2 text-center">081234567890</td>
                        <td class="py-2 text-center">4</td>
                    </tr>
                </tbody>
            </table>
        </div>


        {{-- FEEDBACK TERBARU --}}
        <div class="bg-[#3C3D37]/90 border border-black rounded-xl p-6 mt-12 mb-10">
            <h2 class="text-3xl mb-4">Feedback Terbaru</h2>

            <table class="w-full text-sm">
                <thead class="bg-white/20 text-[#F4EFE7]">
                    <tr>
                        <th class="py-2 text-center w-10">No.</th>
                        <th class="py-2 text-left">Pelanggan</th>
                        <th class="py-2 text-left">Deskripsi</th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="bg-[#F4EFE7] text-black border-b border-black">
                        <td class="py-2 text-center">1.</td>
                        <td class="py-2 px-3">Anggita Jeon</td>
                        <td class="py-2 px-3">Murahin Kopinya</td>
                    </tr>

                    <tr class="bg-[#F4EFE7] text-black border-b border-black">
                        <td class="py-2 text-center">2.</td>
                        <td class="py-2 px-3">Aoka Yeremi</td>
                        <td class="py-2 px-3">Tambahin tempat duduk, soalnya temen saya ada yang ngelesot</td>
                    </tr>

                    <tr class="bg-[#F4EFE7] text-black border-b border-black">
                        <td class="py-2 text-center">3.</td>
                        <td class="py-2 px-3">Arultzy Bogor</td>
                        <td class="py-2 px-3">Lebih dijaga kebersihannya yaa</td>
                    </tr>

                    <tr class="bg-[#F4EFE7] text-black border-b border-black">
                        <td class="py-2 text-center">4.</td>
                        <td class="py-2 px-3">Afra Sekre</td>
                        <td class="py-2 px-3">AC kurang dingin</td>
                    </tr>

                    <tr class="bg-[#F4EFE7] text-black">
                        <td class="py-2 text-center">5.</td>
                        <td class="py-2 px-3">Ramanda Kookie</td>
                        <td class="py-2 px-3">Toiletnya kurang bersih</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </section>

</x-layout-owner>
