<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <section x-data="{
        pilihMeja: false,
        hasReservation: {{ session()->has('cart.reservation') ? 'true' : 'false' }},
        selectedTable: {{ session('cart.selected_table') ? json_encode(session('cart.selected_table')) : 'null' }},
        isLoading: false,
        openNoteId: null, // Untuk melacak ID menu mana yang sedang dibuka catatannya
    
        get isCheckoutValid() {
            return this.hasReservation || this.selectedTable !== null;
        },
    
        async selectTable(tableId, tableName) {
            this.isLoading = true;
            try {
                const response = await fetch('{{ route('customer.cart.selectTable') }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({ table_id: tableId, table_name: tableName })
                });
                const data = await response.json();
                if (data.success) {
                    this.selectedTable = { table_id: tableId, nama: tableName };
                    this.pilihMeja = false;
                }
            } catch (error) {
                alert('Gagal memilih meja. Silakan coba lagi.');
            } finally {
                this.isLoading = false;
            }
        },
    
        toggleNote(id) {
            this.openNoteId = this.openNoteId === id ? null : id;
        }
    }"
        class="min-h-screen bg-[#0e0f0b] text-[#F4EFE7] font-poppins pt-24 pb-20 px-6 md:px-12">

        {{-- HEADER --}}
        <div class="flex items-center gap-6 mb-12 border-b border-white/10 pb-6">
            <a href="{{ route('cafe') }}"
                class="w-12 h-12 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-[#e9d9c9] hover:text-black hover:border-[#e9d9c9] transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h1 class="text-4xl md:text-5xl font-bebas tracking-wide text-white">KERANJANG SAYA</h1>
                <p class="text-gray-400 text-sm mt-1">Periksa kembali pesanan Anda sebelum checkout.</p>
            </div>
        </div>

        {{-- MAIN GRID --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            {{-- LEFT CONTENT (LIST ITEMS) --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- STATE KOSONG --}}
                @if (!session()->has('cart.reservation') && empty(session('cart.items')))
                    <div
                        class="flex flex-col items-center justify-center min-h-[400px] bg-[#1a1a19] border border-white/10 rounded-3xl p-10 text-center">
                        <div class="w-24 h-24 bg-white/5 rounded-full flex items-center justify-center mb-6">
                            <svg class="w-12 h-12 text-gray-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-white mb-2">Keranjangmu Masih Kosong</h2>
                        <p class="text-gray-400 mb-8 max-w-md">Belum ada item yang ditambahkan. Yuk cari meja biliar
                            favoritmu atau pesan makanan enak!</p>
                        <div class="flex gap-4">
                            <a href="{{ route('cafe') }}"
                                class="px-6 py-3 bg-[#e9d9c9] text-black font-bold rounded-xl hover:bg-white transition">Pesan
                                Menu</a>
                            <a href="{{ route('reservation') }}"
                                class="px-6 py-3 border border-white/20 hover:bg-white/10 rounded-xl transition">Reservasi
                                Meja</a>
                        </div>
                    </div>
                @endif

                {{-- ITEM RESERVASI MEJA --}}
                @if (session()->has('cart.reservation'))
                    <div
                        class="bg-[#1a1a19] border border-white/10 rounded-2xl p-5 flex flex-col sm:flex-row gap-5 relative group hover:border-[#e9d9c9]/30 transition">
                        <div class="w-full sm:w-40 aspect-video rounded-xl overflow-hidden bg-black/50">
                            <img src="{{ asset('img/' . $reservationData['nama_gambar']) }}"
                                class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1 flex flex-col justify-between">
                            <div>
                                <div class="flex justify-between items-start">
                                    <h3 class="text-xl font-bebas text-[#e9d9c9] tracking-wide">
                                        {{ $reservationData['nama'] }}</h3>
                                    <span
                                        class="text-white font-bold">Rp{{ number_format($reservationData['total_price'], 0, '.', '.') }}</span>
                                </div>
                                <div class="mt-2 space-y-1 text-sm text-gray-400">
                                    <p class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ \Carbon\Carbon::parse($reservationData['tanggal_pemesanan'])->translatedFormat('d F Y') }}
                                    </p>
                                    <div class="flex flex-wrap gap-2 mt-1">
                                        @foreach ($reservationData['slots'] as $slot)
                                            <span
                                                class="bg-white/5 border border-white/10 px-2 py-0.5 rounded text-xs text-gray-300">{{ $slot['time'] }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <form action="{{ route('customer.cart.remove') }}" method="POST"
                                class="mt-4 flex justify-end">
                                @csrf @method('DELETE')
                                <input type="hidden" name="table_id" value="{{ $reservationData['table_id'] }}">
                                <button type="submit"
                                    class="text-xs text-red-400 hover:text-red-300 flex items-center gap-1 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @endif

                {{-- ITEM MENU CAFE --}}
                @if (session()->has('cart.items'))
                    @foreach ($itemsData as $item)
                        <div class="bg-[#1a1a19] border border-white/10 rounded-2xl p-5 flex flex-col sm:flex-row gap-5 hover:border-[#e9d9c9]/30 transition relative"
                            x-data="{ noteOpen: false }">

                            {{-- Gambar --}}
                            <div
                                class="w-24 h-24 sm:w-28 sm:h-28 rounded-xl overflow-hidden bg-black/50 shrink-0 border border-white/5">
                                <img src="{{ asset('img/menu/' . $item['nama_gambar']) }}"
                                    class="w-full h-full object-contain p-2">
                            </div>

                            {{-- Konten --}}
                            <div class="flex-1 flex flex-col justify-between">
                                <div>
                                    <div class="flex justify-between items-start mb-1">
                                        <h3 class="font-bold text-white text-lg leading-tight">{{ $item['nama'] }}</h3>
                                        <span
                                            class="font-bold text-[#e9d9c9]">Rp{{ number_format($item['harga'] * $item['qty'], 0, '.', '.') }}</span>
                                    </div>
                                    <p class="text-sm text-gray-500">{{ $item['qty'] }} x
                                        Rp{{ number_format($item['harga'], 0, '.', '.') }}</p>

                                    {{-- Tombol Toggle Catatan --}}
                                    <button @click="toggleNote({{ $item['menu_id'] }})"
                                        class="text-xs text-[#e9d9c9] hover:underline mt-2 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        {{ isset($item['note']) && $item['note'] ? 'Edit Catatan' : 'Tambah Catatan' }}
                                    </button>
                                </div>

                                {{-- Input Catatan (Hidden by Default) --}}
                                <div x-show="openNoteId === {{ $item['menu_id'] }}" x-transition.origin.top
                                    class="mt-3 bg-black/30 p-3 rounded-lg border border-white/10"
                                    {{-- Inisialisasi panjang karakter awal --}} x-data="{ currentLength: {{ strlen($item['note'] ?? '') }} }">

                                    <form action="{{ route('customer.cart.updateNote') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="menu_id" value="{{ $item['menu_id'] }}">

                                        <div class="relative">
                                            <textarea name="note" rows="2" maxlength="100" placeholder="Contoh: Jangan pedas, es sedikit..."
                                                @input="currentLength = $el.value.length"
                                                class="w-full bg-transparent text-sm text-white placeholder-gray-600 focus:outline-none resize-none pr-12">{{ $item['note'] ?? '' }}</textarea>

                                            {{-- Penghitung Karakter --}}
                                            <span
                                                class="absolute bottom-0 right-0 text-[10px] text-gray-500 pointer-events-none"
                                                :class="currentLength >= 100 ? 'text-red-500' : 'text-gray-500'">
                                                <span x-text="currentLength"></span>/100
                                            </span>
                                        </div>

                                        <div class="flex justify-end mt-2 gap-2">
                                            <button type="button" @click="openNoteId = null"
                                                class="text-xs text-gray-400 hover:text-white px-2 py-1">Batal</button>
                                            <button type="submit"
                                                class="text-xs bg-[#e9d9c9] text-black px-3 py-1 rounded hover:bg-white font-bold transition">Simpan</button>
                                        </div>
                                    </form>
                                </div>

                                {{-- Tombol Hapus --}}
                                <form action="{{ route('customer.cart.remove') }}" method="POST"
                                    class="mt-4 flex justify-end">
                                    @csrf @method('DELETE')
                                    <input type="hidden" name="menu_id" value="{{ $item['menu_id'] }}">
                                    <button type="submit"
                                        class="text-xs text-red-400 hover:text-red-300 flex items-center gap-1 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            {{-- RIGHT SIDEBAR (SUMMARY) --}}
            <div class="lg:col-span-1">
                <div class="bg-[#1a1a19] border border-white/10 rounded-2xl p-6 sticky top-28 shadow-xl">
                    <h2 class="text-xl font-bold font-bebas text-white mb-6 border-b border-white/10 pb-4">RINGKASAN
                        PESANAN</h2>

                    {{-- List Items Summary --}}
                    <div class="space-y-3 mb-6 max-h-[300px] overflow-y-auto pr-2 custom-scrollbar">
                        {{-- Item Reservasi --}}
                        @if ($reservationData)
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-400">{{ $reservationData['nama'] }}</span>
                                <span
                                    class="text-white">Rp{{ number_format($reservationData['total_price'], 0, '.', '.') }}</span>
                            </div>
                        @endif

                        {{-- Item Menu Cafe --}}
                        @if ($itemsData)
                            @foreach ($itemsData as $item)
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-400">{{ $item['nama'] }} <span
                                            class="text-xs text-gray-600">x{{ $item['qty'] }}</span></span>
                                    <span
                                        class="text-white">Rp{{ number_format($item['harga'] * $item['qty'], 0, '.', '.') }}</span>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    {{-- Lokasi Meja (Logic Selection) --}}
                    @if ($reservationData && $itemsData)
                        <div
                            class="bg-green-900/20 border border-green-500/20 rounded-xl p-3 mb-4 flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-full bg-green-500/20 flex items-center justify-center text-green-400">
                                ✓</div>
                            <div>
                                <p class="text-xs text-green-400 font-bold uppercase">Lokasi Meja</p>
                                <p class="text-sm text-white">Sesuai Reservasi</p>
                            </div>
                        </div>
                    @elseif (!$reservationData && $itemsData)
                        <div class="mb-4">
                            <div class="flex justify-between items-center mb-2">
                                <label class="text-xs font-bold uppercase text-gray-400 tracking-wider">Pilih Lokasi
                                    Meja</label>
                                <span class="text-red-500 text-xs">*Wajib</span>
                            </div>

                            <template x-if="selectedTable">
                                <div
                                    class="bg-[#e9d9c9]/10 border border-[#e9d9c9]/30 rounded-xl p-3 flex justify-between items-center">
                                    <div class="flex items-center gap-2">
                                        <span class="text-xl">📍</span>
                                        <p class="text-sm font-bold text-[#e9d9c9]" x-text="selectedTable.nama"></p>
                                    </div>
                                    <button @click="pilihMeja = true"
                                        class="text-xs text-white hover:text-[#e9d9c9] underline">Ubah</button>
                                </div>
                            </template>
                            <template x-if="!selectedTable">
                                <button @click="pilihMeja = true"
                                    class="w-full py-3 border border-dashed border-red-500/50 rounded-xl text-red-400 text-sm hover:bg-red-500/5 hover:border-red-500 transition flex items-center justify-center gap-2">
                                    <span>Pilih Meja</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                            </template>
                        </div>
                    @endif

                    {{-- INFO PENYAJIAN (TAMBAHAN DISINI) --}}
                    @if ($itemsData && $reservationData)
                        <div
                            class="bg-blue-900/20 border border-blue-500/20 rounded-xl p-3 mb-6 flex items-start gap-3">
                            <div
                                class="w-5 h-5 mt-0.5 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-400 shrink-0 text-xs font-bold">
                                i</div>
                            <div>
                                <p class="text-xs text-blue-300 leading-tight">
                                    Pesanan menu akan disajikan setelah Anda melakukan Check-in meja reservasi.
                                    Jika ingin pesanan langsung disajikan, silakan melakukan pesanan tanpa reservasi
                                    meja
                                </p>
                            </div>
                        </div>
                    @endif

                    {{-- Metode Pembayaran --}}
                    <div class="mb-6">
                        <label class="text-xs font-bold uppercase text-gray-400 tracking-wider mb-2 block">Metode
                            Pembayaran</label>
                        <div class="bg-white/5 border border-white/10 rounded-xl p-3 flex items-center gap-3">
                            <div class="w-8 h-5 bg-white rounded flex items-center justify-center overflow-hidden">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a2/Logo_QRIS.svg/1200px-Logo_QRIS.svg.png"
                                    class="h-full object-contain">
                            </div>
                            <span class="text-sm text-white">QRIS (Scan Barcode)</span>
                        </div>
                    </div>

                    <div class="border-t border-white/10 pt-4 mb-6">
                        <div class="flex justify-between items-end">
                            <span class="text-gray-400 text-sm">Total Bayar</span>
                            <span
                                class="text-2xl font-bebas text-[#e9d9c9] tracking-wide">Rp{{ number_format($totalPrice, 0, '.', '.') }}</span>
                        </div>
                    </div>

                    {{-- Form Checkout --}}
                    <form method="POST" action="{{ route('customer.checkout') }}">
                        @csrf
                        <button type="submit" :disabled="!isCheckoutValid"
                            :class="isCheckoutValid ? 'bg-[#e9d9c9] hover:bg-white text-black' :
                                'bg-white/10 text-gray-500 cursor-not-allowed'"
                            class="w-full py-4 rounded-xl font-bold uppercase tracking-widest transition-all duration-300 shadow-lg">
                            Bayar Sekarang
                        </button>
                    </form>
                </div>
            </div>

        </div>

        {{-- MODAL PILIH MEJA (Teleport) --}}
        <template x-teleport="body">
            <div x-show="pilihMeja" style="display: none;" x-transition.opacity
                class="fixed inset-0 z-[9999] flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm">

                <div @click.outside="pilihMeja = false" x-show="pilihMeja"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                    class="bg-[#1a1a19] w-full max-w-md border border-white/10 rounded-2xl shadow-2xl overflow-hidden">

                    <div class="px-6 py-4 border-b border-white/10 flex justify-between items-center bg-white/5">
                        <h3 class="font-bebas text-xl text-white tracking-wide">PILIH MEJA ANDA</h3>
                        <button @click="pilihMeja = false" class="text-gray-400 hover:text-white">✕</button>
                    </div>

                    <div class="p-2 max-h-[60vh] overflow-y-auto custom-scrollbar">
                        @foreach ($tables as $table)
                            <button @click="selectTable({{ $table->table_id }}, '{{ addslashes($table->nama) }}')"
                                class="w-full text-left p-4 rounded-xl hover:bg-[#e9d9c9] hover:text-black transition group flex items-center justify-between border border-transparent hover:border-[#e9d9c9]">
                                <span
                                    class="font-bold text-gray-300 group-hover:text-black">{{ $table->nama }}</span>
                                <span
                                    class="text-xs bg-white/10 px-2 py-1 rounded text-gray-400 group-hover:text-black group-hover:bg-black/10">Pilih</span>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </template>

    </section>

    {{-- Tambahan CSS untuk scrollbar custom --}}
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.4);
        }
    </style>

</x-Layout>
