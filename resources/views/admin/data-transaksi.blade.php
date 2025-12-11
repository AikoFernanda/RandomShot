<x-layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- WRAPPER UTAMA--}}
    <div class="min-h-screen bg-[#181C14] text-[#F4EFE7] font-poppins p-4 md:p-8">

        {{-- HEADER HALAMAN) --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bebas tracking-wide text-white">DATA TRANSAKSI</h1>
                <p class="text-sm text-gray-400">Pantau transaksi terbaru dan kelola status pembayaran.</p>
            </div>
        </div>

        {{-- KARTU KONTEN UTAMA --}}
        <div class="bg-[#3C3D37] rounded-2xl p-6 text-[#F4EFE7] shadow-lg border border-white/5">

            {{-- 1. FORM PENCARIAN --}}
            <form action="{{ route('admin.transaction') }}" method="GET" class="relative mb-6">
                
                {{-- Input --}}
                <input type="text" name="search" placeholder="Cari Invoice atau Nama Customer..."
                    value="{{ request('search') }}"
                    class="w-full bg-[#757572] rounded-lg py-3 pl-12 pr-12 text-[#F4EFE7] placeholder-gray-300 focus:outline-none focus:ring-1 focus:ring-[#F4EFE7] transition">

                {{-- Ikon Search --}}
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[#F4EFE7]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </span>

                {{-- Tombol X / Reset --}}
                @if (request('search'))
                    <a href="{{ route('admin.transaction') }}" title="Hapus Pencarian"
                        class="absolute right-3 top-1/2 -translate-y-1/2 p-1.5 rounded-full text-gray-300 hover:text-white hover:bg-white/20 transition duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                @endif

            </form>

            {{-- 2. TABEL DATA TRANSAKSI --}}
            <div class="overflow-x-auto">
                <table class="w-full min-w-[900px] text-sm text-left">
                    {{-- Header Tabel --}}
                    <thead class="text-[#ECDFCC]/75 uppercase font-medium border-b border-[#FFF3E1]/20">
                        <tr>
                            <th scope="col" class="py-4 px-4">No Invoice</th>
                            <th scope="col" class="py-4 px-4">Nama Pengguna</th>
                            <th scope="col" class="py-4 px-4">No Hp</th>
                            <th scope="col" class="py-4 px-4">Total Harga</th>
                            <th scope="col" class="py-4 px-4">Tanggal</th>
                            <th scope="col" class="py-4 px-4">Status</th>
                            <th scope="col" class="py-4 px-4 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="text-[#F4EFE7]">
                        @forelse($transactions as $transaction)
                            <tr class="border-b border-[#FFF3E1]/10 hover:bg-white/5 transition duration-200">
                                {{-- Invoice --}}
                                <td class="py-4 px-4 font-mono font-bold text-[#e9d9c9]">
                                    {{ $transaction->no_invoice }}
                                </td>

                                {{-- Nama Customer --}}
                                <td class="py-4 px-4 font-bold">
                                    {{ $transaction->customer->nama ?? 'Guest/Terhapus' }}
                                </td>

                                {{-- No HP --}}
                                <td class="py-4 px-4 text-gray-300">
                                    {{ $transaction->customer->no_telepon ?? '-' }}
                                </td>

                                {{-- Total Harga --}}
                                <td class="py-4 px-4 font-mono">
                                    Rp {{ number_format($transaction->total_transaksi, 0, ',', '.') }}
                                </td>

                                {{-- Tanggal --}}
                                <td class="py-4 px-4 text-xs text-gray-400">
                                    {{ $transaction->created_at->format('d M Y') }} <br>
                                    <span class="text-gray-500">{{ $transaction->created_at->format('H:i') }} WIB</span>
                                </td>

                                {{-- Status Badge --}}
                                <td class="py-4 px-4">
                                    @php
                                        $statusClass = match($transaction->status_transaksi) {
                                            'Paid' => 'bg-green-500/20 text-green-400 border-green-500/50',
                                            'Unpaid' => 'bg-red-500/20 text-red-400 border-red-500/50',
                                            'Pending' => 'bg-yellow-500/20 text-yellow-400 border-yellow-500/50',
                                            'Cancelled' => 'bg-gray-500/20 text-gray-400 border-gray-500/50',
                                            default => 'bg-gray-500/20 text-gray-400 border-gray-500/50',
                                        };
                                    @endphp
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold border {{ $statusClass }}">
                                        {{ $transaction->status_transaksi }}
                                    </span>
                                </td>

                                {{-- Tombol Detail --}}
                                <td class="py-4 px-4 text-center">
                                    <a href="{{ route('admin.transaction.show', $transaction->transaction_id) }}" 
                                       class="inline-block px-4 py-2 border border-[#F4EFE7]/30 rounded-lg hover:bg-[#F4EFE7] hover:text-[#181C14] transition font-bold text-xs">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            {{-- State Kosong --}}
                            <tr>
                                <td colspan="7" class="py-10 text-center text-gray-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-2 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                        <p>Belum ada data transaksi.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- 3. PAGINATION --}}
            <div class="mt-6 border-t border-white/10 pt-4">
                {{ $transactions->links('pagination::tailwind') }}
            </div>

        </div>
    </div>
</x-layout-admin>