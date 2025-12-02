<x-Layout>
<x-slot:title>{{ $title }}</x-slot:title>

{{-- WRAPPER UTAMA: Flexbox untuk membagi Sidebar (Kiri) dan Konten (Kanan) --}}
<div class="min-h-screen bg-[#0e0f0b] text-[#F4EFE7] flex font-poppins mt-5">

    {{-- ================= SIDEBAR ================= --}}
    {{-- sticky top-0 h-screen: Agar sidebar tetap diam saat konten di-scroll --}}
    <aside
        class="w-72 bg-[#1a1a19] border-r border-white/10 py-12 px-8 flex flex-col sticky top-0 h-screen overflow-y-auto hidden md:flex shrink-0">

        <h2 class="text-xl text-gray-400 font-light mb-1">HALO,</h2>
        {{-- Menampilkan nama user (optional, jika ada di session) --}}
        <h1 class="text-3xl font-bebas tracking-wide mb-12 uppercase text-[#e9d9c9] truncate">
            {{ session('nama') ?? 'PENGGUNA' }}!
        </h1>

        <nav class="space-y-4 flex-1">

            {{-- Menu 1: Profil --}}
            <a href="{{ route('customer.profile') }}"
                class="group flex items-center gap-3 w-full py-3 px-4 rounded-xl text-left transition duration-300
                    {{ Route::is('customer.profile') ? 'bg-[#e9d9c9] text-black font-bold shadow-[0_0_15px_rgba(233,217,201,0.3)]' : 'hover:bg-white/5 text-gray-400 hover:text-white' }}">

                {{-- Ikon User --}}
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 {{ Route::is('customer.profile') ? 'text-black' : 'text-gray-500 group-hover:text-white' }}"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Informasi Akun
            </a>

            {{-- Menu 2: Riwayat (Aktif) --}}
            <a href="{{ route('customer.transaction.history') }}"
                class="group flex items-center gap-3 w-full py-3 px-4 rounded-xl text-left transition duration-300
                   {{ Route::is('customer.transaction.history') ? 'bg-[#e9d9c9] text-black font-bold shadow-[0_0_15px_rgba(233,217,201,0.3)]' : 'hover:bg-white/5 text-gray-400 hover:text-white' }}">

                {{-- Ikon Riwayat --}}
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 {{ Route::is('customer.transaction.history') ? 'text-black' : 'text-gray-500 group-hover:text-white' }}"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                Riwayat Transaksi
            </a>

        </nav>

        {{-- Tombol Logout (Optional di bawah sidebar) --}}
        {{-- <form action="/logout" method="POST"> @csrf <button class="...">Logout</button> </form> --}}
    </aside>

    {{-- ================= KONTEN UTAMA ================= --}}
    {{-- flex-1: Mengambil sisa lebar layar --}}
    <main class="flex-1 p-8 md:p-16 lg:px-24 w-full">

        <div class="max-w-4xl mx-auto space-y-8">

            {{-- HEADER HALAMAN --}}
            <div class="mb-10 border-b border-white/10 pb-6">
                <h1 class="text-5xl font-bebas tracking-wide mb-2">RIWAYAT TRANSAKSI</h1>
                <p class="text-gray-400">Pantau status pesanan dan riwayat kuliner Anda di sini.</p>
            </div>

            {{-- LOOPING DATA TRANSAKSI --}}
            @forelse($transactionHistory as $transaction)
                {{-- KARTU TRANSAKSI (Desain sama seperti sebelumnya) --}}
                <div
                    class="bg-[#1a1a19] border border-white/5 rounded-xl overflow-hidden hover:border-[#e9d9c9]/30 transition duration-300 shadow-lg">

                    {{-- Header Kartu --}}
                    <div
                        class="p-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-white/5 bg-white/[0.02]">
                        <div class="flex items-center gap-4">
                            @php
                                $iconColor = match ($transaction->status_transaksi) {
                                    'Paid' => 'bg-green-500/20 text-green-400 border border-green-500/30',
                                    'Unpaid' => 'bg-red-500/20 text-red-400 border border-red-500/30 animate-pulse',
                                    'Pending' => 'bg-yellow-500/20 text-yellow-400 border border-yellow-500/30',
                                    default => 'bg-gray-500/20 text-gray-400',
                                };
                            @endphp
                            <div class="w-12 h-12 rounded-full flex items-center justify-center {{ $iconColor }}">
                                @if ($transaction->status_transaksi == 'Paid')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                @endif
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-widest font-bold">No. Invoice</p>
                                <p class="font-mono font-bold text-lg text-[#e9d9c9]">#{{ $transaction->no_invoice }}
                                </p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-500 uppercase tracking-widest font-bold">Tanggal</p>
                            <p class="text-sm text-gray-300">
                                {{ $transaction->created_at ? $transaction->created_at->timezone('Asia/Jakarta')->format('d M Y, H:i') : '-' }}
                                WIB
                            </p>
                        </div>
                    </div>

                    {{-- Body Kartu --}}
                    <div class="p-6 flex justify-between items-center">
                        <div class="flex flex-col">
                            <span class="text-xs text-gray-500 uppercase font-bold">Total Tagihan</span>
                            <span class="text-2xl font-bebas tracking-wide text-white">
                                Rp{{ number_format($transaction->total_transaksi, 0, ',', '.') }}
                            </span>
                        </div>

                        {{-- Badge Status --}}
                        @php
                            $statusBadge = match ($transaction->status_transaksi) {
                                'Paid' => 'text-green-400 bg-green-400/10 border-green-400/20',
                                'Unpaid' => 'text-red-400 bg-red-400/10 border-red-400/20',
                                'Pending' => 'text-yellow-400 bg-yellow-400/10 border-yellow-400/20',
                                default => 'text-gray-400 bg-gray-400/10',
                            };
                        @endphp
                        <div
                            class="px-3 py-1 rounded border text-xs font-bold uppercase tracking-widest {{ $statusBadge }}">
                            {{ $transaction->status_transaksi }}
                        </div>
                    </div>

                    {{-- Footer Kartu --}}
                    <div class="px-6 py-4 bg-black/20 flex justify-end gap-3 border-t border-white/5">

                        {{-- Form Lihat Detail (GET) --}}
                        <form action="{{ route('customer.transaction.detail') }}" method="POST">
                            @csrf
                            <input type="hidden" name="transaction_id" value="{{ $transaction->transaction_id }}">
                            <button type="submit"
                                class="px-5 py-2 border border-white/20 hover:bg-white hover:text-black rounded-lg text-sm font-bold transition duration-300">
                                Lihat Detail
                            </button>
                        </form>

                        {{-- Tombol Bayar --}}
                        @if ($transaction->status_transaksi == 'Unpaid')
                            <a href="{{ route('customer.payment', $transaction->transaction_id) }}"
                                class="px-6 py-2 bg-[#e9d9c9] hover:bg-white text-black rounded-lg text-sm font-bold shadow-lg transition duration-300 flex items-center gap-2">
                                Bayar Sekarang <span>&rarr;</span>
                            </a>
                        @endif
                    </div>

                </div>

            @empty
                {{-- EMPTY STATE --}}
                <div class="text-center py-24 opacity-60">
                    <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <p class="text-2xl font-bebas tracking-wide mb-2">Belum Ada Transaksi</p>
                    <p class="text-sm text-gray-400">Riwayat pesanan Anda akan muncul di sini.</p>
                    <a href="/reservation"
                        class="mt-6 inline-block px-8 py-3 bg-[#e9d9c9] text-black rounded-lg font-bold hover:bg-white transition shadow-lg">
                        Mulai Pesan
                    </a>
                </div>
            @endforelse

        </div>
    </main>

</div>
</x-Layout>
