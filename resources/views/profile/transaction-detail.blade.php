<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="min-h-screen bg-[#0e0f0b] text-white px-4 py-20 flex flex-col items-center">

        {{-- CONTAINER UTAMA --}}
        <div class="w-full max-w-4xl space-y-8">

            {{-- HEADER: BACK + TITLE --}}
            <div class="flex items-center gap-4">
                <a href="{{ route('customer.transaction.history') }}"
                    class="w-10 h-10 bg-black/40 rounded-full flex items-center justify-center 
                    text-white text-2xl backdrop-blur hover:bg-white/20 transition">←
                </a>
                <h1 class="text-4xl md:text-5xl font-bebas tracking-wide">
                    DETAIL TRANSAKSI
                </h1>
            </div>

            {{-- STATUS BANNER --}}
            @php
                $statusColors = match ($transaction->status_transaksi) {
                    'Paid' => 'bg-green-900/50 border-green-500/50 text-green-100',
                    'Unpaid' => 'bg-red-900/50 border-red-500/50 text-red-100',
                    'Pending' => 'bg-yellow-900/50 border-yellow-500/50 text-yellow-100',
                    'Expired' => 'bg-gray-800 border-gray-600 text-gray-400',
                    default => 'bg-gray-800 border-gray-600 text-gray-400',
                };
            @endphp

            <div
                class="w-full border px-6 py-4 rounded-xl flex flex-col md:flex-row justify-between items-center gap-4 backdrop-blur-sm {{ $statusColors }}">
                <div class="flex items-center gap-3">
                    {{-- Ikon Status --}}
                    @if ($transaction->status_transaksi == 'Paid')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    @elseif($transaction->status_transaksi == 'Unpaid')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 animate-pulse" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    @endif

                    <div>
                        <p class="text-xs uppercase opacity-70 tracking-widest">Status Pesanan</p>
                        <p class="font-bold text-lg uppercase tracking-wide">{{ $transaction->status_transaksi }}</p>
                    </div>
                </div>

                {{-- Jika Unpaid, Tampilkan Tombol Bayar --}}
                @if ($transaction->status_transaksi == 'Unpaid')
                    <a href="{{ route('customer.payment', $transaction->transaction_id) }}"
                        class="px-6 py-2 bg-white text-red-900 font-bold rounded-lg shadow-lg hover:bg-gray-100 transition flex items-center gap-2 text-sm">
                        Bayar Sekarang <span>&rarr;</span>
                    </a>
                @endif
            </div>

            {{-- GRID DETAIL --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- KIRI: RINCIAN ORDER (Lebar 2 Kolom) --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- KARTU ITEM --}}
                    <div class="bg-white/5 border border-white/10 rounded-xl p-6 md:p-8">
                        <h3 class="text-xl font-bebas tracking-wide mb-6 border-b border-white/10 pb-4 text-[#e9d9c9]">
                            Rincian Item
                        </h3>

                        <div class="space-y-6">
                            {{-- 1. RESERVASI MEJA (Jika Ada) --}}
                            {{-- Perbaikan: Kita loop karena reservationData bisa jadi collection --}}
                            @if ($reservationData && $reservationData->isNotEmpty())
                                @foreach ($reservationData as $res)
                                    <div class="flex justify-between items-start">
                                        <div class="flex gap-4">
                                            {{-- 
                                                GAMBAR MEJA
                                            --}}
                                            @if (optional($res->table)->nama_gambar)
                                                <div
                                                    class="w-16 h-16 rounded-lg overflow-hidden border border-[#e9d9c9]/20 shadow-md shrink-0">
                                                    <img src="{{ asset('img/' . $res->table->nama_gambar) }}"
                                                        class="w-full h-full object-cover"
                                                        alt="{{ $res->table->nama ?? 'Meja' }}">
                                                </div>
                                            @else
                                                <div
                                                    class="w-12 h-12 bg-[#e9d9c9]/10 rounded-lg flex items-center justify-center border border-[#e9d9c9]/20 shrink-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-6 w-6 text-[#e9d9c9]" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.5"
                                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                                    </svg>
                                                </div>
                                            @endif

                                            <div>
                                                {{-- Nama Meja --}}
                                                <p class="font-bold text-lg">
                                                    {{ $res->table->nama ?? 'Meja Terhapus' }}</p>
                                                <div class="text-sm text-gray-400 mt-1 space-y-1">
                                                    <p>Tanggal:
                                                        {{ \Carbon\Carbon::parse($res->tanggal_reservasi)->format('d M Y') }}
                                                    </p>
                                                    <p>Jam:
                                                        {{ \Carbon\Carbon::parse($res->waktu_mulai)->format('H:i') }}
                                                        -
                                                        {{ \Carbon\Carbon::parse($res->waktu_selesai)->format('H:i') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Harga Meja --}}
                                        <p class="font-mono font-medium">
                                            Rp{{ number_format($res->harga, 0, ',', '.') }}
                                        </p>
                                    </div>
                                    <div class="w-full h-px bg-white/5 my-4"></div>
                                @endforeach
                            @endif

                            {{-- 2. LIST MENU --}}
                            {{-- 2. LIST MENU CAFE --}}
                            @foreach ($itemsData as $item)
                                <div
                                    class="flex justify-between items-start border-b border-white/5 pb-4 last:border-0 last:pb-0 mb-4 last:mb-0">
                                    <div class="flex gap-4">

                                        {{-- GAMBAR MENU --}}
                                        @if (optional($item->menu)->nama_gambar)
                                            <div
                                                class="w-16 h-16 rounded-lg overflow-hidden border border-white/10 shadow-md shrink-0 bg-[#252525]">
                                                <img src="{{ asset('img/menu/' . $item->menu->nama_gambar) }}"
                                                    class="w-full h-full object-contain p-1"
                                                    alt="{{ $item->menu->nama ?? 'Menu' }}">
                                            </div>
                                        @else
                                            <div
                                                class="w-16 h-16 bg-white/5 rounded-lg flex items-center justify-center border border-white/10 shrink-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1.5"
                                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                </svg>
                                            </div>
                                        @endif

                                        <div class="flex flex-col">
                                            {{-- Nama Menu --}}
                                            <p class="font-bold text-base md:text-lg">
                                                {{ $item->menu->nama ?? 'Menu Terhapus' }}</p>

                                            {{-- Harga Satuan x Qty --}}
                                            <p class="text-xs text-gray-400 mt-0.5">
                                                {{ $item->quantity }} x
                                                Rp{{ number_format($item->harga / $item->quantity, 0, ',', '.') }}
                                            </p>

                                            {{-- BAGIAN NOTE (CATATAN) --}}
                                            {{-- BAGIAN NOTE (CATATAN) --}}
                                            @if (!empty($item->deskripsi))
                                                <div
                                                    class="mt-2 bg-white/5 px-3 py-2 rounded-lg border border-white/10 w-full max-w-[250px] md:max-w-[300px]">
                                                    <p class="text-[10px] text-[#e9d9c9] font-bold uppercase tracking-wider mb-1"> Catatan:</p>
                                                    <p class="text-[11px] text-gray-400 italic leading-relaxed break-words whitespace-pre-wrap">{{ $item->deskripsi }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Harga Total Item --}}
                                    <p class="font-mono font-medium text-white/90">
                                        Rp{{ number_format($item->harga, 0, ',', '.') }}
                                    </p>
                                </div>
                            @endforeach
                        </div>

                        {{-- TOTAL --}}
                        <div class="mt-8 pt-6 border-t border-white/20 flex justify-between items-center">
                            <p class="text-lg font-bold">Total Transaksi</p>
                            <p class="text-3xl font-bebas text-[#e9d9c9] tracking-wide">
                                Rp{{ number_format($transaction->total_transaksi, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                </div>

                {{-- KANAN: INFO LAINNYA (Lebar 1 Kolom) --}}
                <div class="space-y-6">

                    {{-- INFO TRANSAKSI --}}
                    <div class="bg-white/5 border border-white/10 rounded-xl p-6">
                        <h3 class="text-sm uppercase text-gray-500 font-bold tracking-widest mb-4">Info Pesanan</h3>

                        <div class="space-y-4 text-sm">
                            <div>
                                <p class="text-gray-400 mb-1">No. Invoice</p>
                                <p class="font-mono text-white select-all">#{{ $transaction->no_invoice }}</p>
                            </div>

                            <div>
                                <p class="text-gray-400 mb-1">Waktu Pesanan</p>
                                <p class="text-white">
                                    {{ $transaction->created_at ? $transaction->created_at->timezone('Asia/Jakarta')->format('d M Y') : '-' }}
                                    <span class="text-gray-500 mx-1">|</span>
                                    {{ $transaction->created_at ? $transaction->created_at->timezone('Asia/Jakarta')->format('H:i') : '-' }}
                                    WIB
                                </p>
                            </div>

                            <div>
                                <p class="text-gray-400 mb-1">Metode Pembayaran</p>
                                <p class="text-white">{{ $transaction->metode_pembayaran ?? 'Cashless' }}</p>
                            </div>

                            @if ($selectedTable)
                                <div>
                                    <p class="text-gray-400 mb-1">Lokasi Meja</p>
                                    <p class="text-white px-2 py-1 bg-white/10 rounded inline-block text-xs">
                                        {{ $selectedTable }}
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- BANTUAN --}}
                    <div class="bg-[#e9d9c9]/10 border border-[#e9d9c9]/20 rounded-xl p-6 text-center">
                        <p class="text-sm text-[#e9d9c9] mb-4">Butuh bantuan dengan pesanan ini?</p>
                        <a href="https://wa.me/6281234567890" target="_blank"
                            class="inline-block w-full py-2 bg-[#e9d9c9] hover:bg-white text-black font-bold text-sm rounded-lg transition">
                            Hubungi Admin (WhatsApp)
                        </a>
                    </div>

                </div>

            </div>

        </div>
    </section>
</x-Layout>
