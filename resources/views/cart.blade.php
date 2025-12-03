<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- {{ dd(session('user_id'), session('cart.reservation'), session('cart.items'), session('cart.selected_table'), session('cart'))}} --}}

    <section x-data="{
        pilihMeja: false,
        // Ambil data session reservation dan selected_table dari PHP ke JS
        hasReservation: {{ session()->has('cart.reservation') ? 'true' : 'false' }},
        selectedTable: {{ session('cart.selected_table') ? json_encode(session('cart.selected_table')) : 'null' }},
        isLoading: false,
    
        // Computed property untuk validasi checkout
        get isCheckoutValid() {
            // Valid jika: Ada Reservasi (Off-site) ATAU Sudah Pilih Meja (On-site)
            return this.hasReservation || this.selectedTable !== null;
        },

        async selectTable(tableId, tableName) {
            this.isLoading = true;
    
            try {
                const response = await fetch('{{ route('customer.cart.selectTable') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        table_id: tableId,
                        table_name: tableName
                    })
                });
    
                const data = await response.json();
    
                if (data.success) {
                    this.selectedTable = {
                        table_id: tableId,
                        nama: tableName
                    };
                    this.pilihMeja = false;
                    console.log('Meja berhasil dipilih!');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Gagal memilih meja. Silakan coba lagi.');
            } finally {
                this.isLoading = false;
            }
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

                @if (!session()->has('cart.reservation') && empty(session('cart.items')))
                    {{-- Kode UI Keranjang Kosong --}}
                    <div
                        class="flex flex-col items-center justify-center min-h-[50vh] bg-white/5 border border-white/10 rounded-2xl p-8 shadow-inner shadow-black/50">

                        <svg class="w-20 h-20 text-red-500/70 mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>

                        <h2 class="text-3xl font-bold text-white mb-2">Keranjangmu Kosong!</h2>

                        <p class="text-gray-400 text-lg text-center mb-6">
                            Ayo tambahkan menu spesial kami atau reservasi meja favoritmu.
                        </p>

                        <a href="{{ route('cafe') }}"
                            class="px-8 py-3  bg-red-600 hover:bg-red-700 rounded-full border  border-white text-white font-bold transition duration-200">
                            Mulai Pesan Menu
                        </a>

                        <a href="{{ route('reservation') }}"
                            class="mt-3 text-sm text-white/50 hover:text-white transition duration-200">
                            Atau Reservasi Meja
                        </a>
                    </div>
                @endif

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
                        </div>
                        <div class="text-right font-bold text-lg whitespace-nowrap">
                            Rp{{ number_format($reservationData['total_price'], 0, '.', '.') }}
                            <div>
                                <form action="{{ route('customer.cart.remove') }}" method="POST" class="mt-10">
                                    @csrf
                                    @method('DELETE')
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
                @if (session()->has('cart.items'))
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
                                        <p class="font-bold text-xl whitespace-nowrap">
                                            Rp{{ number_format($item['harga'] * $item['qty'], 0, '.', '.') }}
                                        </p>
                                    </div>
                                </div>

                                <button class="text-sm text-gray-300/70 flex items-center gap-1 mt-1">
                                    ✎ Tambahkan Catatan
                                </button>

                                <div>
                                    <form action="{{ route('customer.cart.remove') }}" method="POST"
                                        class="flex justify-end mt-1">
                                        @csrf
                                        @method('DELETE')
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
                @endif

            </div>


            {{-- RIGHT SIDEBAR (SUMMARY) --}}
            <div class="bg-white/10 border border-white/20 rounded-xl p-6 sticky top-28">

                <h2 class="text-3xl mb-4">Detail Pesanan</h2>

                {{-- Rincian Item (Sama seperti sebelumnya) --}}
                @if ($reservationData)
                    <div class="text-sm">
                        <p>Meja</p>
                    </div>
                    <div class="flex justify-between text-xs mb-2">
                        <div>
                            <p class="text-gray-400 italic">{{ $reservationData['nama'] }}
                                ({{ count($reservationData['slots']) }} jam)</p>
                        </div>
                        <p>Rp{{ number_format($reservationData['total_price'], 0, '.', '.') }}</p>
                    </div>
                @endif

                @if ($itemsData)
                    <div class="text-sm {{ $reservationData ? 'mt-4' : '' }}">
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

                <hr class="border-white/10 my-4"> 


                {{-- Lokasi MEJA (Kondisional) --}}
                @if ($reservationData && $itemsData)
                    {{-- Kasus 1: Reservasi + Menu -> Meja otomatis dari reservasi --}}
                    <div class="mt-6">
                        <label class="text-sm">Lokasi Meja</label>
                        <div class="border border-green-500/30 bg-green-500/20 rounded-2xl px-4 py-3 mt-2 text-center">
                            <p class="text-xs text-green-300">Pesanan menu akan disajikan saat check-in</p>
                        </div>
                    </div>
                @elseif ($reservationData)
                    {{-- Kasus 2: Reservasi Saja --}}
                    <div class="mt-6"></div>
                @else
                    {{-- Kasus 3: Menu Saja (Cafe) -> WAJIB PILIH MEJA --}}
                    <div class="mt-6">
                        <label class="text-sm">Lokasi Meja <span class="text-red-500">*</span></label>

                        {{-- Jika sudah pilih meja --}}
                        <template x-if="selectedTable">
                            <div class="flex justify-between items-center border border-green-500/30 bg-green-500/10 rounded-full px-4 py-2 mt-2">
                                <p class="text-sm text-white" x-text="selectedTable.nama"></p>
                                <button type="button" @click="pilihMeja = true"
                                    class="text-xs text-green-400 hover:text-green-300">
                                    Ganti
                                </button>
                            </div>
                        </template>

                        {{-- Jika belum pilih meja --}}
                        <template x-if="!selectedTable">
                            <div class="space-y-1">
                                <button type="button" @click="pilihMeja = true"
                                    class="w-full flex justify-between items-center border border-red-500/50 bg-red-500/10 rounded-full px-4 py-2 mt-2 cursor-pointer hover:bg-red-500/20 animate-pulse">
                                    <p class="text-sm text-red-300">Pilih Meja Dahulu</p>
                                    <span class="text-red-300">›</span>
                                </button>
                                <p class="text-xs text-red-400 italic">Wajib memilih meja untuk pesanan cafe</p>
                            </div>
                        </template>
                    </div>

                    {{-- MODAL PILIH MEJA --}}
                    <template x-teleport="body">
                        <div x-show="pilihMeja" x-cloak @keydown.escape.window="pilihMeja = false"
                            class="fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-4">
                            
                            <div x-show="pilihMeja" @click="pilihMeja = false" class="absolute inset-0 bg-black/70 backdrop-blur-sm"></div>

                            <div x-show="pilihMeja" class="relative bg-[#1a1a1a] w-full max-w-md border border-white/10 shadow-2xl rounded-2xl overflow-hidden z-10">
                                <div class="bg-gradient-to-r from-red-600/20 to-orange-600/20 border-b border-white/10 px-6 py-4 flex justify-between items-center">
                                    <h2 class="text-2xl font-bold text-white">Pilih Meja</h2>
                                    <button @click="pilihMeja = false" class="text-white hover:text-red-400">✕</button>
                                </div>
                                <div class="p-6 space-y-3 max-h-[50vh] overflow-y-auto">
                                    @foreach ($tables as $table)
                                        <button type="button"
                                            @click="selectTable({{ $table->table_id }}, '{{ addslashes($table->nama) }}')"
                                            :disabled="isLoading"
                                            class="w-full text-left p-4 bg-white/5 border border-white/10 rounded-xl hover:bg-white/10 hover:border-red-500/50 transition flex justify-between items-center group">
                                            <span class="text-white group-hover:text-red-400">{{ $table->nama }}</span>
                                            <span class="text-gray-500 group-hover:text-red-400">›</span>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </template>
                @endif


                {{-- Metode Pembayaran --}}
                <div class="mt-4">
                    <label class="text-sm">Metode Pembayaran</label>
                    <div class="flex justify-between items-center border border-white/30 rounded-full px-4 py-2 mt-2 cursor-pointer">
                        <p class="text-sm text-gray-300">QRIS</p>
                    </div>
                </div>


                {{-- Total --}}
                <div class="flex justify-between items-center mt-6 text-lg font-bold">
                    <p>Total :</p>
                    <p>Rp{{ number_format($totalPrice, 0, '.', '.') }}</p>
                </div>

                @if (session('error'))
                    <div class="bg-red-500/20 text-red-300 p-4 rounded-lg mb-4 border border-red-500/50 mt-3">
                        {{ session('error') }}
                    </div>
                @endif


                {{-- CHECKOUT BUTTON --}}
                <form method="POST" action="{{ route('customer.checkout') }}" class="mt-6">
                    @csrf
                    
                    {{-- 
                        TOMBOL DINAMIS: 
                        Hanya bisa diklik (enabled) jika isCheckoutValid == true 
                    --}}
                    <button type="submit"
                        :disabled="!isCheckoutValid"
                        :class="{
                            'bg-red-600 hover:bg-red-700 text-white cursor-pointer': isCheckoutValid,
                            'bg-gray-600 text-gray-400 cursor-not-allowed opacity-50': !isCheckoutValid
                        }"
                        class="w-full py-3 rounded-full border border-transparent font-bold text-lg text-center block transition-all duration-300">
                        Bayar Sekarang
                    </button>

                    {{-- Pesan Helper jika tombol disabled --}}
                    <template x-if="!isCheckoutValid">
                        <p class="text-center text-xs text-red-400 mt-2">
                            *Silakan pilih meja terlebih dahulu untuk melanjutkan.
                        </p>
                    </template>
                </form>

            </div>
        </div> {{-- End Grid --}}

    </section>

</x-Layout>