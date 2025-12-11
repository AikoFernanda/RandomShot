<x-layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="min-h-screen bg-[#181C14] text-[#F4EFE7] font-poppins p-4 md:p-8">

        {{-- HEADER --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bebas tracking-wide text-white">KELOLA OPERASIONAL</h1>
                <p class="text-sm text-gray-400">Pantau jadwal check-in dan pesanan menu cafe.</p>
            </div>
        </div>

        {{-- KARTU UTAMA --}}
        <div class="bg-[#3C3D37] rounded-2xl p-6 text-[#F4EFE7] shadow-lg border border-white/5">

            {{-- === TAB NAVIGATION === --}}
            <div class="flex space-x-1 bg-[#181C14]/50 p-1 rounded-xl mb-6 w-fit border border-white/10">
                {{-- Tab 1: Reservasi Meja --}}
                <a href="{{ route('admin.reservation') }}"
                    class="px-6 py-2 rounded-lg text-sm font-bold transition duration-200 
                   {{ Route::is('admin.reservation') ? 'bg-[#e9d9c9] text-black shadow-lg' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    Reservasi Meja
                </a>

                {{-- Tab 2: Pesanan Menu --}}
                <a href="{{ route('admin.order') }}"
                    class="px-6 py-2 rounded-lg text-sm font-bold transition duration-200 
                   {{ Route::is('admin.order') ? 'bg-[#e9d9c9] text-black shadow-lg' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    Pesanan Menu
                </a>
            </div>

            {{-- FORM PENCARIAN --}}
            <form action="{{ route('admin.order') }}" method="GET" class="relative mb-6">
                <input type="text" name="search" placeholder="Cari Menu, Invoice, atau Pelanggan..."
                    value="{{ request('search') }}"
                    class="w-full bg-[#757572] rounded-lg py-3 pl-12 pr-12 text-[#F4EFE7] placeholder-gray-300 focus:outline-none focus:ring-1 focus:ring-[#F4EFE7] transition">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[#F4EFE7]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </span>
                @if (request('search'))
                    <a href="{{ route('admin.order') }}"
                        class="absolute right-3 top-1/2 -translate-y-1/2 p-1.5 rounded-full text-gray-300 hover:text-white hover:bg-white/20 transition"><svg
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg></a>
                @endif
            </form>

            {{-- TABEL DATA PESANAN --}}

            {{-- TABEL DATA PESANAN --}}
            <div class="overflow-x-auto">
                <table class="w-full min-w-[1100px] text-sm text-left">
                    <thead class="text-[#ECDFCC]/75 uppercase font-medium border-b border-[#FFF3E1]/20">
                        <tr>
                            <th class="py-4 px-4">Info Reservasi</th>
                            <th class="py-4 px-4">Pelanggan</th>
                            <th class="py-4 px-4">Menu & Deskripsi</th>
                            <th class="py-4 px-4 text-center">Qty</th>
                            <th class="py-4 px-4">Meja Tujuan</th>
                            <th class="py-4 px-4 text-center">Status Pesanan</th>
                        </tr>
                    </thead>
                    <tbody class="text-[#F4EFE7]">
                        @forelse ($orders as $order)
                            <tr class="border-b border-[#FFF3E1]/10 hover:bg-white/5 transition duration-200">
                                
                                {{-- 1. INFO RESERVASI (Invoice & Waktu Pesan) --}}
                                <td class="py-4 px-4">
                                    <span class="block font-mono font-bold text-[#e9d9c9] mb-1">
                                        #{{ $order->transaction->no_invoice }}
                                    </span>
                                    <span class="text-xs text-gray-400">
                                        {{ $order->created_at->format('d M Y, H:i') }}
                                    </span>
                                </td>

                                {{-- 2. PELANGGAN (Nama & No HP) --}}
                                <td class="py-4 px-4">
                                    <div class="font-bold">{{ $order->transaction->customer->nama ?? 'Guest' }}</div>
                                    <div class="text-xs text-gray-400 font-mono mt-1">
                                        {{ $order->transaction->customer->no_telepon ?? '-' }}
                                    </div>
                                </td>

                                {{-- 3. MENU & DESKRIPSI --}}
                                <td class="py-4 px-4">
                                    <div class="flex items-start gap-3">
                                        {{-- Foto Menu --}}
                                        <div class="w-12 h-12 rounded bg-[#181C14] overflow-hidden shrink-0 border border-white/10 mt-1">
                                            @if($order->menu && $order->menu->nama_gambar)
                                                <img src="{{ asset('img/menu/' . $order->menu->nama_gambar) }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-xs text-gray-500">Img</div>
                                            @endif
                                        </div>
                                        {{-- Nama & Catatan --}}
                                        <div class="max-w-[200px]">
                                            <div class="font-bold text-base text-white">{{ $order->menu->nama ?? 'Menu Dihapus' }}</div>
                                            @if($order->deskripsi)
                                                <div class="text-xs text-yellow-400 italic mt-1 border-l-2 border-yellow-500/50 pl-2">
                                                    "{{ $order->deskripsi }}"
                                                </div>
                                            @else
                                                <span class="text-xs text-gray-600 italic">- Tidak ada catatan -</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                {{-- 4. QTY --}}
                                <td class="py-4 px-4 text-center">
                                    <div class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-[#e9d9c9]/10 text-[#e9d9c9] font-bebas text-xl border border-[#e9d9c9]/20">
                                        {{ $order->quantity }}
                                    </div>
                                </td>

                                {{-- 5. MEJA TUJUAN --}}
                                <td class="py-4 px-4">
                                    @php
                                        $namaMeja = $order->meja_tujuan; 
                                        if (!$namaMeja && $order->transaction->reservations->isNotEmpty()) {
                                            $namaMeja = $order->transaction->reservations->first()->table->nama ?? null;
                                        }
                                    @endphp
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded bg-[#2A2B25] flex items-center justify-center text-[#e9d9c9] border border-white/5">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </div>
                                        <span class="font-bold text-[#e9d9c9]">{{ $namaMeja ?? 'Take Away' }}</span>
                                    </div>
                                </td>

                                {{-- 6. STATUS (MERAH JIKA MENUNGGU) --}}
                                <td class="py-4 px-4 text-center">
                                    <div x-data="{
                                        currentStatus: '{{ $order->status_pesanan }}',
                                        orderId: {{ $order->transaction_detail_id }},
                                    
                                        confirmChange(event) {
                                            const nextStatus = event.target.value;
                                            event.target.value = this.currentStatus;
                                    
                                            Swal.fire({
                                                title: 'Pesanan Selesai?',
                                                text: 'Pastikan menu sudah diantar ke meja pelanggan.',
                                                icon: 'question',
                                                showCancelButton: true,
                                                background: '#1a1a19',
                                                color: '#F4EFE7',
                                                confirmButtonColor: '#e9d9c9',
                                                cancelButtonColor: '#3C3D37',
                                                confirmButtonText: '<span style=\'color:black; font-weight:bold;\'>Ya, Selesai</span>',
                                                cancelButtonText: 'Batal',
                                                reverseButtons: true
                                            }).then((result) => {
                                                if (result.isConfirmed) this.updateStatus(nextStatus);
                                            });
                                        },
                                    
                                        updateStatus(newStatus) {
                                            fetch(`/admin/pesanan/${this.orderId}/status`, {
                                                method: 'POST',
                                                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                                                body: JSON.stringify({ status: newStatus })
                                            }).then(res => res.json()).then(data => {
                                                if (data.success) {
                                                    this.currentStatus = newStatus;
                                                    Toast.fire({ icon: 'success', title: 'Pesanan Selesai!', iconColor: '#4ade80' });
                                                } else {
                                                    Swal.fire('Gagal!', data.message, 'error');
                                                }
                                            });
                                        }
                                    }" class="relative w-44 inline-block">

                                        <select :value="currentStatus" @change="confirmChange($event)"
                                            :disabled="currentStatus == 'Selesai'"
                                            :class="{
                                                // MERAH BERDENYUT JIKA MENUNGGU
                                                'bg-red-500/20 text-red-400 border-red-500/50 animate-pulse': currentStatus == 'Menunggu Dibuat',
                                                
                                                // HIJAU JIKA SELESAI
                                                'bg-green-500/20 text-green-400 border-green-500/50': currentStatus == 'Selesai',
                                                
                                                // MATI JIKA SELESAI
                                                'opacity-60 cursor-not-allowed': currentStatus == 'Selesai'
                                            }"
                                            class="w-full appearance-none border text-xs font-bold pl-4 pr-8 py-2 rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-[#e9d9c9] transition text-center disabled:cursor-not-allowed">
                                            
                                            <option value="Menunggu Dibuat">Menunggu dibuat</option>
                                            <option value="Selesai">Selesai</option>
                                        </select>

                                        {{-- Panah Dropdown --}}
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-white/50">
                                            <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-gray-400">
                                    <div class="flex flex-col items-center justify-center opacity-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                                        <p class="text-lg font-bold">Dapur Bersih</p>
                                        <p class="text-sm">Tidak ada pesanan yang perlu dibuat saat ini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6 border-t border-white/10 pt-4">
                {{ $orders->links('pagination::tailwind') }}
            </div>

        </div>
    </div>
</x-layout-admin>
