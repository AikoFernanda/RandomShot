<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- {{ dd(session('cart.reservation'), session('cart.items'), session('cart')) }} // debug --}}

    <section x-data="{
        pilihMeja: false,
        selectedTable: '',
    
        selectTable(meja) {
            // 1. Set datanya
            this.selectedTable = meja;
    
            // 2. Beri browser ruang 50 milidetik untuk update teks, sebelum perintahkan modal untuk tutup
            setTimeout(() => {
                this.pilihMeja = false;
            }, 100);
        }
    }" class="min-h-screen bg-[#0e0f0b] text-white px-8 pt-20 pb-10">

        {{-- BACK BUTTON + TITLE --}}
        <div class="flex items-center gap-4 mb-10">
            <a href="{{ route('cafe') }}"
                class="w-10 h-10 bg-black/40 rounded-full flex items-center justify-center 
                  text-white text-2xl backdrop-blur hover:bg-white/20">←
            </a>

            <h1 class="text-5xl tracking-wide">
                Keranjang Saya
            </h1>
        </div>


        {{-- GRID WRAPPER --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 items-start">

            {{-- LEFT CONTENT --}}
            <div class="lg:col-span-2 space-y-3">

                {{-- ITEM MEJA --}}
                @if (session()->has('cart.reservation'))
                    <div class="border border-white/20 rounded-xl p-4 flex gap-4">

                        <img src="{{ asset('img/' . $reservationData['nama_gambar']) }}"
                            class="w-36 h-32 object-cover rounded-md">

                        <div class="flex-1">
                            <p class="font-bold text-lg">{{ $reservationData['nama'] }}</p>

                            <p class="text-gray-300 text-sm italic mt-1 leading-tight">
                                {{ $reservationData['tanggal_pemesanan'] }}:
                            </p>
                            @foreach ($reservationData['slots'] as $slot)
                                <p class="text-gray-300 text-sm italic mt-1 leading-tight">
                                    {{ $slot['time'] }}
                                </p>
                            @endforeach

                            {{-- <p class="mt-9 text-green-400 text-sm">Tersedia</p> --}}
                        </div>
                        <div class="text-right font-bold text-lg whitespace-nowrap">
                            Rp{{ number_format($reservationData['total_price'], 0, '.', '.') }}
                            <div>
                                <form action="{{ route('customer.cart.remove') }}" method="POST" class="mt-10">
                                    @csrf
                                    @method('DELETE') {{-- Method spoofing untuk Hapus --}}
                                    <input type="hidden" name="table_id" value="{{ $reservationData['table_id'] }}">
                                    <button type="submit"
                                        class="text-red-400 text-sm flex items-center gap-2 cursor-pointer">
                                        🗑 Hapus dari Keranjang
                                    </button>
                                </form>
                            </div>
                        </div>


                    </div>
                @endif



                {{-- ITEM MAKANAN --}}
                @foreach ($itemsData as $item)
                    <div class="border border-white/20 rounded-xl p-4 flex gap-4">

                        {{-- FOTO MAKANAN --}}
                        <img src="{{ asset('img/menu/' . $item['nama_gambar']) }}"
                            class="w-36 h-28 object-cover rounded-md">

                        {{-- KONTEN --}}
                        <div class="flex-1">

                            <div class="flex justify-between items-start">

                                <p class="font-bold text-xl">{{ $item['nama'] }}</p>

                                <div class="flex items-center gap-4">

                                    {{-- QTY
                                <div class="flex items-center gap-2 bg-white/10 px-3 py-1 rounded-full">
                                    <button class="text-xl">−</button>
                                    <span class="font-semibold text-lg">2</span>
                                    <button class="text-xl">+</button>
                                </div> --}}

                                    {{-- HARGA --}}
                                    <p class="font-bold text-xl whitespace-nowrap">
                                        Rp{{ number_format($item['harga'] * $item['qty'], 0, '.', '.') }}
                                    </p>
                                </div>
                            </div>

                            <button class="text-sm text-gray-300/70 flex items-center gap-1 mt-1">
                                ✎ Tambahkan Catatan
                            </button>

                            {{-- <p class="mt-8 text-green-400 text-sm">Tersedia</p> --}}

                            <div>
                                <form action="{{ route('customer.cart.remove') }}" method="POST"
                                    class="flex justify-end mt-1">
                                    @csrf
                                    @method('DELETE') {{-- Method spoofing untuk Hapus --}}
                                    <input type="hidden" name="menu_id" value="{{ $item['menu_id'] }}">
                                    <button type="submit"
                                        class="text-red-400 text-sm flex items-center gap-2 cursor-pointer">
                                        🗑 Hapus dari Keranjang
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>




            {{-- RIGHT SIDEBAR --}}
            <div class="bg-white/10 border border-white/20 rounded-xl p-6 sticky top-28">

                <h2 class="text-3xl mb-4">Detail Pesanan</h2>

                {{-- Tampilkan bagian Meja HANYA JIKA ada di session --}}
                @if ($reservationData)
                    <div class="text-sm">
                        <p>Meja</p>
                    </div>
                    <div class="flex justify-between text-xs mb-2">
                        <div>
                            <p class="text-gray-400 italic">{{ $reservationData['nama'] }}
                                ({{ count($reservationData['slots']) }} jam)</p>
                        </div>
                        <p>Rp {{ number_format($reservationData['total_price'], 0, ',', '.') }}</p>
                    </div>
                @endif

                {{-- Tampilkan bagian Cafe HANYA JIKA ada di session --}}
                @if ($itemsData)
                    <div class="text-sm {{ $reservationData ? 'mt-4' : '' }}"> {{-- Beri jarak jika Meja ada --}}
                        <p>Cafe</p>
                    </div>
                    @foreach ($itemsData as $item)
                        <div class="flex justify-between text-xs mt-0">
                            <div>
                                <p class="text-gray-400 italic">{{ $item['nama'] }} ({{ $item['qty'] }})</p>
                            </div>
                            <p>Rp {{ number_format($item['harga'] * $item['qty'], 0, ',', '.') }}</p>
                        </div>
                    @endforeach
                @endif

                <hr class="border-white/10 my-4"> {{-- Garis pemisah --}}


                {{-- alamat meja kondisional --}}

                @if ($reservationData && $itemsData)
                    {{-- Alur Reservasi (Customer Off-site) --}}
                    <div class="mt-6">
                        <label class="text-sm">Alamat Meja</label>
                        <div class="border border-green-500/30 bg-green-500/20 rounded-2xl px-4 py-3 mt-2 text-center">
                            <p class="text-xs text-green-300">Pesanan menu akan disajikan saat check-in
                            </p>
                        </div>
                    </div>
                @elseif ($reservationData)
                    {{-- Alur Reservasi tanpa menu(Customer Off-site) --}}
                    <div class="mt-6">
                    </div>
                @else
                    {{-- Alur Cafe Only (Customer On-site) --}}

                    <div class="mt-6">
                        <label class="text-sm">Alamat Meja</label>
                        <button type="button" @click="pilihMeja = true"
                            class="w-full flex justify-between items-center border border-white/30 rounded-full px-4 py-2 mt-2 cursor-pointer hover:bg-white/10">
                            <p class="text-sm" :class="selectedTable ? 'text-white' : 'text-gray-300'">
                                <span x-text="selectedTable ? selectedTable : 'Pilih Meja'"></span>
                            </p>
                            <span>›</span>
                        </button>
                    </div>

                    {{-- MODAL OVERLAY --}}
                    <template x-teleport="body">
                        <div x-show="pilihMeja" x-cloak @keydown.escape.window="pilihMeja = false"
                            class="fixed inset-0 z-9999 flex items-end sm:items-center justify-center p-4">

                            {{-- Backdrop --}}
                            <div x-show="pilihMeja" x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                @click="pilihMeja = false" class="absolute inset-0 bg-black/70 backdrop-blur-sm"></div>

                            {{-- Modal Content --}}
                            <div x-show="pilihMeja" x-trap.noscroll.inert="pilihMeja"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                class="relative bg-linear-to-b from-[#1a1a1a] to-[#0e0e0e] w-full max-w-md border border-white/10 shadow-2xl rounded-2xl overflow-hidden">

                                {{-- Header dengan gradient --}}
                                <div
                                    class="bg-linear-to-r from-red-600/20 to-orange-600/20 border-b border-white/10 px-6 py-4">
                                    <div class="flex justify-between items-center">
                                        <h2 class="text-2xl font-bold text-white">Pilih Meja</h2>
                                        <button type="button" @click="pilihMeja = false"
                                            class="w-9 h-9 flex items-center justify-center rounded-full bg-white/5 hover:bg-white/10 border border-white/10 text-white text-xl transition-all duration-200 hover:rotate-90">
                                            ×
                                        </button>
                                    </div>
                                    <p class="text-gray-400 text-sm mt-1">Silahkan pilih meja yang tersedia</p>
                                </div>

                                {{-- List Meja dengan scrollbar custom --}}
                                <div
                                    class="p-6 space-y-3 max-h-[50vh] overflow-y-auto scrollbar-thin scrollbar-thumb-white/20 scrollbar-track-transparent">
                                    <button type="button" @click="selectedTable = 'Meja 1'; pilihMeja = false"
                                        class="group w-full text-left p-4 bg-white/5 border border-white/10 rounded-xl hover:bg-white/10 hover:border-red-500/50 transition-all duration-200 hover:scale-[1.02] hover:shadow-lg hover:shadow-red-500/10">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-3">
                                                <span
                                                    class="text-base font-medium text-white group-hover:text-red-400 transition-colors">Meja
                                                    1</span>
                                            </div>
                                            <svg class="w-5 h-5 text-gray-500 group-hover:text-red-400 transition-colors"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </div>
                                    </button>

                                    <button type="button" @click="selectedTable = 'Meja 2'; pilihMeja = false"
                                        class="group w-full text-left p-4 bg-white/5 border border-white/10 rounded-xl hover:bg-white/10 hover:border-red-500/50 transition-all duration-200 hover:scale-[1.02] hover:shadow-lg hover:shadow-red-500/10">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-3">
                                                <span
                                                    class="text-base font-medium text-white group-hover:text-red-400 transition-colors">Meja
                                                    2</span>
                                            </div>
                                            <svg class="w-5 h-5 text-gray-500 group-hover:text-red-400 transition-colors"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </div>
                                    </button>
                                </div>

                            </div>
                        </div>
                    </template>
                @endif


                {{-- Metode Pembayaran --}}
                <div class="mt-4">
                    <label class="text-sm">Metode Pembayaran</label>
                    <div
                        class="flex justify-between items-center border border-white/30 rounded-full px-4 py-2 mt-2 cursor-pointer">
                        <p class="text-sm text-gray-300">QRIS</p>
                        {{-- <span>›</span> --}}
                    </div>
                </div>


                {{-- Total --}}
                <div class="flex justify-between items-center mt-6 text-lg font-bold">
                    <p>Total :</p>
                    <p>Rp{{ number_format($totalPrice, 0, '.', '.') }}</p>
                </div>


                {{-- CHECKOUT --}}
                <a href="{{ route('customer.payment') }}"
                    class="mt-6 w-full py-3 bg-red-600 hover:bg-red-700 rounded-full border
                           border-white text-white font-bold text-lg text-center block">
                    Check Out</a>

            </div>

    </section>

</x-Layout>