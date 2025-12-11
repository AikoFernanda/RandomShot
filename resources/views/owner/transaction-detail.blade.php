<x-layout-owner>
    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="min-h-screen text-[#F4EFE7] flex flex-col">
        
        {{-- HEADER & TOMBOL KEMBALI --}}
        <div class="mb-8 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('owner.laporan.penjualan') }}" class="w-10 h-10 rounded-full bg-[#3C3D37] flex items-center justify-center text-gray-400 hover:bg-[#e9d9c9] hover:text-black transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bebas tracking-wide text-[#F4EFE7]">Rincian Transaksi</h1>
                    <p class="text-gray-400 text-sm">Invoice <span class="font-mono text-[#e9d9c9]">#{{ $trx->no_invoice }}</span></p>
                </div>
            </div>

            {{-- Tombol Print (Opsional) --}}
            <button onclick="window.print()" class="flex items-center gap-2 px-4 py-2 bg-[#3C3D37] border border-white/10 rounded-lg hover:bg-white/10 transition text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                Cetak Invoice
            </button>
        </div>

        {{-- GRID LAYOUT --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- KOLOM KIRI: ITEM YG DIBELI (Struk Belanja) --}}
            <div class="lg:col-span-2 space-y-6">
                
                {{-- 1. LIST MENU CAFE --}}
                <div class="bg-[#3C3D37] border border-white/5 rounded-xl overflow-hidden shadow-lg">
                    <div class="p-4 border-b border-white/5 bg-[#2A2B25] flex justify-between items-center">
                        <h3 class="font-bold text-[#e9d9c9] flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                            Rincian Pesanan Menu
                        </h3>
                    </div>
                    
                    <div class="p-4">
                        @if($trx->transactionDetails->count() > 0)
                            <table class="w-full text-sm">
                                <thead class="text-xs text-gray-500 uppercase border-b border-white/5">
                                    <tr>
                                        <th class="text-left py-2">Menu</th>
                                        <th class="text-center py-2">Qty</th>
                                        <th class="text-right py-2">Harga Satuan</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-white/5">
                                    @foreach($trx->transactionDetails as $detail)
                                        @if($detail->menu)
                                        <tr>
                                            <td class="py-3">
                                                <p class="font-bold text-white">{{ $detail->menu->nama }}</p>
                                                <p class="text-[10px] text-gray-400">{{ $detail->menu->kategori }}</p>
                                            </td>
                                            <td class="text-center py-3 text-gray-300">x{{ $detail->quantity }}</td>
                                            <td class="text-right py-3 text-gray-400">Rp {{ number_format(($detail->harga/$detail->quantity), 0, ',', '.') }}</td>                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-center text-gray-500 italic py-4">Tidak ada pesanan menu cafe.</p>
                        @endif
                    </div>
                </div>

                {{-- 2. LIST RESERVASI MEJA --}}
                <div class="bg-[#3C3D37] border border-white/5 rounded-xl overflow-hidden shadow-lg">
                    <div class="p-4 border-b border-white/5 bg-[#2A2B25] flex justify-between items-center">
                        <h3 class="font-bold text-[#e9d9c9] flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                            Rincian Sewa Meja
                        </h3>
                    </div>
                    
                    <div class="p-4">
                        @if($trx->reservations->count() > 0)
                            <div class="space-y-3">
                                @foreach($trx->reservations as $res)
                                    <div class="flex justify-between items-center bg-black/20 p-3 rounded-lg border border-white/5">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 rounded bg-[#181C14] overflow-hidden">
                                                @if($res->table->nama_gambar)
                                                    <img src="{{ asset('img/' . $res->table->nama_gambar) }}" class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center text-xs">Img</div>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="font-bold text-white">{{ $res->table->nama }}</p>
                                                <p class="text-xs text-gray-400">
                                                    {{ \Carbon\Carbon::parse($res->tanggal_reservasi)->format('d M Y') }} • 
                                                    {{ \Carbon\Carbon::parse($res->waktu_mulai)->format('H:i') }} - 
                                                    {{ \Carbon\Carbon::parse($res->waktu_selesai)->format('H:i') }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-bold text-[#e9d9c9]">Rp {{ number_format($res->harga, 0, ',', '.') }}</p>
                                            <p class="text-[10px] text-gray-500">Durasi: {{ \Carbon\Carbon::parse($res->waktu_selesai)->diffInHours(\Carbon\Carbon::parse($res->waktu_mulai)) }} Jam</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-center text-gray-500 italic py-4">Tidak ada reservasi meja.</p>
                        @endif
                    </div>
                </div>

            </div>


            {{-- KOLOM KANAN: INFO PELANGGAN & TOTAL (Summary) --}}
            <div class="space-y-6">
                
                {{-- INFO PELANGGAN --}}
                <div class="bg-[#3C3D37] border border-white/5 rounded-xl p-6 shadow-lg">
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-4">Informasi Pelanggan</h3>
                    
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-[#e9d9c9] to-[#8d7b68] p-[2px]">
                            <div class="w-full h-full rounded-full bg-[#3C3D37] flex items-center justify-center font-bold text-[#e9d9c9] text-xl">
                                {{ substr($trx->customer->nama ?? 'G', 0, 1) }}
                            </div>
                        </div>
                        <div>
                            <p class="text-lg font-bold text-white">{{ $trx->customer->nama ?? 'Guest' }}</p>
                            <p class="text-xs text-gray-400">{{ $trx->customer->email ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between border-b border-white/5 pb-2">
                            <span class="text-gray-400">No. Telepon</span>
                            <span>{{ $trx->customer->no_telepon ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between border-b border-white/5 pb-2">
                            <span class="text-gray-400">Tanggal Transaksi</span>
                            <span>{{ $trx->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between border-b border-white/5 pb-2">
                            <span class="text-gray-400">Waktu</span>
                            <span>{{ $trx->created_at->format('H:i') }} WIB</span>
                        </div>
                    </div>
                </div>

                {{-- PEMBAYARAN --}}
                <div class="bg-[#3C3D37] border-l-4 {{ $trx->status_transaksi == 'Paid' ? 'border-green-500' : 'border-yellow-500' }} rounded-r-xl p-6 shadow-lg">
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-4">Status Pembayaran</h3>
                    
                    <div class="flex justify-between items-center mb-6">
                        <span class="px-3 py-1 rounded-full text-xs font-bold border 
                            {{ $trx->status_transaksi == 'Paid' ? 'bg-green-500/20 text-green-400 border-green-500/30' : 'bg-yellow-500/20 text-yellow-400 border-yellow-500/30' }}">
                            {{ $trx->status_transaksi == 'Paid' ? 'LUNAS (PAID)' : 'BELUM LUNAS (UNPAID)' }}
                        </span>
                        <span class="text-sm font-mono text-gray-300">{{ $trx->metode_pembayaran ?? '-' }}</span>
                    </div>

                    <div class="space-y-2 pt-4 border-t border-white/10">
                        <div class="flex justify-between items-center pt-4 mt-2 border-dashed border-white/20">
                            <span class="text-lg font-bold text-[#e9d9c9]">TOTAL</span>
                            <span class="text-2xl font-bold font-mono text-[#e9d9c9]">Rp {{ number_format($trx->total_transaksi, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </section>
</x-layout-owner>