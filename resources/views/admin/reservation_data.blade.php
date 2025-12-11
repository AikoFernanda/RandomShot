<x-layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- WRAPPER UTAMA --}}
    <div class="min-h-screen bg-[#181C14] text-[#F4EFE7] font-poppins p-4 md:p-8">

        {{-- HEADER HALAMAN --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bebas tracking-wide text-white">KELOLA OPERASIONAL</h1>
                <p class="text-sm text-gray-400">Pantau jadwal check-in dan pesanan menu cafe.</p>
            </div>
        </div>

        {{-- KARTU KONTEN UTAMA --}}
        <div class="bg-[#3C3D37] rounded-2xl p-6 text-[#F4EFE7] shadow-lg border border-white/5">

            {{-- === TAB NAVIGATION (DITAMBAHKAN) === --}}
            <div class="flex space-x-1 bg-[#181C14]/50 p-1 rounded-xl mb-6 w-fit border border-white/10">
                {{-- Tab 1: Reservasi Meja (Logika Route::is memastikannya Aktif) --}}
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
            <form action="{{ route('admin.reservation') }}" method="GET" class="relative mb-6">
                <input type="text" name="search" placeholder="Cari No. Invoice atau Nama Pelanggan..."
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
                    <a href="{{ route('admin.reservation') }}" title="Hapus Pencarian"
                        class="absolute right-3 top-1/2 -translate-y-1/2 p-1.5 rounded-full text-gray-300 hover:text-white hover:bg-white/20 transition duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                @endif
            </form>

            {{-- TABEL DATA --}}
            <div class="overflow-x-auto">
                <table class="w-full min-w-[1000px] text-sm text-left">
                    <thead class="text-[#ECDFCC]/75 uppercase font-medium border-b border-[#FFF3E1]/20">
                        <tr>
                            <th scope="col" class="py-4 px-4">Info Reservasi</th>
                            <th scope="col" class="py-4 px-4">Pelanggan</th>
                            <th scope="col" class="py-4 px-4">Meja</th>
                            <th scope="col" class="py-4 px-4">Jadwal Main</th>
                            <th scope="col" class="py-4 px-4 text-center">Status Meja</th>
                        </tr>
                    </thead>

                    <tbody class="text-[#F4EFE7]">
                        @forelse ($reservations as $res)
                            <tr class="border-b border-[#FFF3E1]/10 hover:bg-white/5 transition duration-200">

                                {{-- Info Invoice --}}
                                <td class="py-4 px-4">
                                    <span class="block font-mono font-bold text-[#e9d9c9] mb-1">
                                        #{{ $res->transaction->no_invoice }}
                                    </span>
                                    <span class="text-xs text-gray-400">
                                        Dipesan: {{ $res->created_at->format('d M Y') }}
                                    </span>
                                </td>

                                {{-- Pelanggan --}}
                                <td class="py-4 px-4">
                                    <div class="font-bold">{{ $res->transaction->customer->nama ?? 'Guest' }}</div>
                                    <div class="text-xs text-gray-400 font-mono mt-1">
                                        {{ $res->transaction->customer->no_telepon ?? '-' }}
                                    </div>
                                </td>

                                {{-- Meja --}}
                                <td class="py-4 px-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded bg-[#181C14] overflow-hidden shrink-0 border border-white/10">
                                            @if ($res->table && $res->table->nama_gambar)
                                                <img src="{{ asset('img/' . $res->table->nama_gambar) }}"
                                                    class="w-full h-full object-cover">
                                            @else
                                                <div
                                                    class="w-full h-full flex items-center justify-center text-xs text-gray-500">
                                                    Img</div>
                                            @endif
                                        </div>
                                        <span>{{ $res->table->nama ?? 'Meja ?' }}</span>
                                    </div>
                                </td>

                                {{-- Jadwal --}}
                                <td class="py-4 px-4">
                                    <div class="text-[#e9d9c9] font-bold">
                                        {{ \Carbon\Carbon::parse($res->tanggal_reservasi)->format('d M Y') }}
                                    </div>
                                    <div class="text-xs mt-1 bg-white/10 px-2 py-1 rounded inline-block">
                                        {{ \Carbon\Carbon::parse($res->waktu_mulai)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($res->waktu_selesai)->format('H:i') }}
                                    </div>
                                </td>

                                {{-- STATUS & UPDATE (X-DATA) --}}
                                <td class="py-4 px-4 text-center">
                                    <div x-data="{
                                        currentStatus: '{{ $res->status_reservasi }}',
                                        resId: {{ $res->reservation_id }},
                                    
                                        confirmChange(event) {
                                            const nextStatus = event.target.value;
                                            event.target.value = this.currentStatus;
                                    
                                            Swal.fire({
                                                title: 'Update Status Meja?',
                                                text: `Ubah status meja menjadi '${nextStatus}'?`,
                                                icon: 'question',
                                                showCancelButton: true,
                                                background: '#1a1a19',
                                                color: '#F4EFE7',
                                                confirmButtonColor: '#e9d9c9',
                                                cancelButtonColor: '#3C3D37',
                                                confirmButtonText: '<span style=\'color:black; font-weight:bold;\'>Ya, Update</span>',
                                                cancelButtonText: 'Batal',
                                                reverseButtons: true
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    this.updateStatus(nextStatus);
                                                }
                                            });
                                        },
                                    
                                        updateStatus(newStatus) {
                                            fetch(`/admin/reservation/${this.resId}/status`, {
                                                    method: 'POST',
                                                    headers: {
                                                        'Content-Type': 'application/json',
                                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                    },
                                                    body: JSON.stringify({ status: newStatus })
                                                })
                                                .then(res => res.json())
                                                .then(data => {
                                                    if (data.success) {
                                                        this.currentStatus = newStatus;
                                                        Toast.fire({
                                                            icon: 'success',
                                                            title: 'Status Meja Diperbarui!',
                                                            iconColor: '#4ade80'
                                                        });
                                                    } else {
                                                        Swal.fire('Gagal!', 'Terjadi kesalahan sistem.', 'error');
                                                    }
                                                })
                                                .catch(() => {
                                                    Swal.fire('Error!', 'Gagal menghubungi server.', 'error');
                                                });
                                        }
                                    }" class="relative inline-block w-40">

                                        {{-- Dropdown Status --}}
                                        <select :value="currentStatus" @change="confirmChange($event)"
                                            :disabled="currentStatus == 'Selesai'"
                                            :class="{
                                                'bg-yellow-500/20 text-yellow-400 border-yellow-500/50': currentStatus ==
                                                    'Menunggu Check-in',
                                                'bg-green-500/20 text-green-400 border-green-500/50': currentStatus ==
                                                    'Checked-in',
                                                'bg-gray-500/20 text-gray-400 border-gray-500/50 opacity-50 cursor-not-allowed': currentStatus ==
                                                    'Selesai'
                                            }"
                                            class="w-full appearance-none border text-xs font-bold pl-4 pr-8 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#e9d9c9] transition text-center disabled:cursor-not-allowed">

                                            {{-- MODIFIKASI DISINI: --}}
                                            {{-- Opsi Menunggu akan disabled (abu-abu/gabisa diklik) jika status sekarang Checked-in atau Selesai --}}
                                            <option value="Menunggu Check-in"
                                                :disabled="currentStatus == 'Checked-in' || currentStatus == 'Selesai'">
                                                Menunggu
                                            </option>

                                            <option value="Checked-in">Checked-in</option>
                                            <option value="Selesai">Selesai</option>
                                            </select>

                                            {{-- Panah Dropdown --}}
                                            <div
                                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-white/50">
                                                <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                                </svg>
                                            </div>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-10 text-center text-gray-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-3 opacity-50"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <p>Tidak ada jadwal reservasi aktif.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            <div class="mt-6 border-t border-white/10 pt-4">
                {{ $reservations->links('pagination::tailwind') }}
            </div>

        </div>
    </div>
</x-layout-admin>
