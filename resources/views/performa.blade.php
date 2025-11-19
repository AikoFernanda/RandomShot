<x-layout-owner>
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- ================= HEADER ================= --}}
    <h1 class="text-3xl font-bold mb-6">Highlight Bisnis Harian</h1>

    {{-- ================= CARDS SUMMARY ================= --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

        <div class="bg-white/10 border border-white/10 rounded-xl p-4">
            <p class="text-sm text-gray-300">Pendapatan Hari ini</p>
            <p class="text-3xl font-bold mt-2">Rp 250,5k</p>
        </div>

        <div class="bg-white/10 border border-white/10 rounded-xl p-4">
            <p class="text-sm text-gray-300">Total Transaksi Hari ini</p>
            <p class="text-3xl font-bold mt-2">25 Transaksi</p>
        </div>

        <div class="bg-white/10 border border-white/10 rounded-xl p-4">
            <p class="text-sm text-gray-300">Reservasi Meja Hari ini</p>
            <p class="text-3xl font-bold mt-2">15 Reservasi</p>
        </div>

        <div class="bg-white/10 border border-white/10 rounded-xl p-4">
            <p class="text-sm text-gray-300">Pesanan Cafe Hari ini</p>
            <p class="text-3xl font-bold mt-2">10 Pesanan</p>
        </div>
    </div>



    {{-- ================= GRAFIK & PIE CHART ================= --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-10">

        {{-- GRAFIK TREND --}}
        <div class="lg:col-span-2 bg-white/10 border border-white/10 rounded-xl p-6">
            <h2 class="text-xl font-bold mb-4">Grafik Tren Pendapatan Harian</h2>

            {{-- Gambar dummy grafik --}}
            <img src="{{ asset('img/grafik.png') }}" class="w-full rounded-lg">
        </div>

        {{-- PIE CHART --}}
        <div class="bg-white/10 border border-white/10 rounded-xl p-6">
            <h2 class="text-xl font-bold mb-4">Persentase Transaksi</h2>

            <img src="{{ asset('img/chart-pie.png') }}" class="w-full">

            <div class="mt-4 text-sm space-y-1">
                <p><span class="inline-block w-3 h-3 bg-yellow-300 rounded mr-2"></span> Pesanan Cafe</p>
                <p><span class="inline-block w-3 h-3 bg-gray-400 rounded mr-2"></span> Reservasi Meja</p>
            </div>
        </div>

    </div>




    {{-- ================= MENU TERLARIS & MEJA TERLARIS ================= --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-12">

        {{-- MENU CAFE TERLARIS --}}
        <div class="bg-white/10 border border-white/10 rounded-xl p-6">
            <h2 class="text-xl font-bold mb-4">Menu Cafe Terlaris</h2>

            <table class="w-full text-sm">
                <thead>
                    <tr class="text-gray-400 border-b border-white/10">
                        <th class="py-2 text-left w-10">No.</th>
                        <th class="py-2 text-left">Menu</th>
                        <th class="py-2 text-left">Total Pesanan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td class="py-2">1.</td><td>Kopi Good Day</td><td>10</td></tr>
                    <tr><td class="py-2">2.</td><td>Indomie Goreng</td><td>8</td></tr>
                    <tr><td class="py-2">3.</td><td>Indomie Rebus</td><td>6</td></tr>
                    <tr><td class="py-2">4.</td><td>Es Milo</td><td>5</td></tr>
                    <tr><td class="py-2">5.</td><td>Chocolatos</td><td>4</td></tr>
                </tbody>
            </table>
        </div>

        {{-- MEJA TERLARIS --}}
        <div class="bg-white/10 border border-white/10 rounded-xl p-6">
            <h2 class="text-xl font-bold mb-4">Meja Terlaris</h2>

            <table class="w-full text-sm">
                <thead>
                    <tr class="text-gray-400 border-b border-white/10">
                        <th class="py-2 w-10">No.</th>
                        <th class="py-2">Meja</th>
                        <th class="py-2">Total Reservasi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td class="py-2">1.</td><td>Biliar</td><td>10 kali dipesan</td></tr>
                    <tr><td class="py-2">2.</td><td>Tenis</td><td>8 kali dipesan</td></tr>
                    <tr><td class="py-2">3.</td><td>Playstation</td><td>6 kali dipesan</td></tr>
                </tbody>
            </table>
        </div>

    </div>


    {{-- ================= PELANGGAN TERBAIK ================= --}}
    <div class="bg-white/10 border border-white/10 rounded-xl p-6 mt-12">
        <h2 class="text-xl font-bold mb-4">Pelanggan Terbaik</h2>

        <table class="w-full text-sm">
            <thead>
                <tr class="text-gray-400 border-b border-white/10">
                    <th class="py-2 w-10">No.</th>
                    <th class="py-2">Pelanggan</th>
                    <th class="py-2">Email</th>
                    <th class="py-2">No. Handphone</th>
                    <th class="py-2">Total Transaksi</th>
                </tr>
            </thead>

            <tbody>
                <tr><td class="py-2">1.</td><td>Anggita Jeon</td><td>anggitoy@gmail.com</td><td>081234567890</td><td>10</td></tr>
                <tr><td class="py-2">2.</td><td>Aoka Yeremi</td><td>aik0gacor@gmail.com</td><td>081234567890</td><td>8</td></tr>
                <tr><td class="py-2">3.</td><td>Arultzy Bogor</td><td>kingarul@gmail.com</td><td>081234567890</td><td>6</td></tr>
                <tr><td class="py-2">4.</td><td>Afra Sui</td><td>aprasuiy456@gmail.com</td><td>081234567890</td><td>5</td></tr>
                <tr><td class="py-2">5.</td><td>Ramanda Kookie</td><td>ramkookie3@gmail.com</td><td>081234567890</td><td>4</td></tr>
            </tbody>
        </table>
    </div>




    {{-- ================= FEEDBACK TERBARU ================= --}}
    <div class="bg-white/10 border border-white/10 rounded-xl p-6 mt-12">
        <h2 class="text-xl font-bold mb-4">Feedback Terbaru</h2>

        <table class="w-full text-sm">
            <thead>
                <tr class="text-gray-400 border-b border-white/10">
                    <th class="py-2 w-10">No.</th>
                    <th class="py-2">Pelanggan</th>
                    <th class="py-2">Deskripsi</th>
                </tr>
            </thead>

            <tbody>
                <tr><td class="py-2">1.</td><td>Anggita Jeon</td><td>Murahin Kopinya</td></tr>
                <tr><td class="py-2">2.</td><td>Aoka Yeremi</td><td>Tambah tempat duduk</td></tr>
                <tr><td class="py-2">3.</td><td>Arultzy Bogor</td><td>Lebih dijaga kebersihannya</td></tr>
                <tr><td class="py-2">4.</td><td>Afra Sekre</td><td>AC kurang dingin</td></tr>
                <tr><td class="py-2">5.</td><td>Ramanda Kookie</td><td>Toiletnya kurang bersih</td></tr>
            </tbody>
        </table>

    </div>

</x-layout-owner>
