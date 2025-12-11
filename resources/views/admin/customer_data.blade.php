<x-layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- WRAPPER --}}
    <div class="min-h-screen bg-[#181C14] text-[#F4EFE7] font-poppins p-4 md:p-8">

        {{-- HEADER --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bebas tracking-wide text-white">DATA PELANGGAN</h1>
                <p class="text-sm text-gray-400">Kelola informasi dan status akun customer.</p>
            </div>
        </div>

        {{-- KARTU KONTEN UTAMA --}}
        <div class="bg-[#3C3D37] rounded-2xl p-6 text-[#F4EFE7] shadow-lg border border-white/5">

            {{-- 1. FORM PENCARIAN (Sama seperti Transaksi) --}}
            <form action="{{ route('admin.customer') }}" method="GET" class="relative mb-6">
                <input type="text" name="search" placeholder="Cari Nama, Email, atau No HP..."
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
                    <a href="{{ route('admin.customer') }}" title="Hapus Pencarian"
                        class="absolute right-3 top-1/2 -translate-y-1/2 p-1.5 rounded-full text-gray-300 hover:text-white hover:bg-white/20 transition duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                @endif
            </form>

            {{-- 2. TABEL DATA --}}
            <div class="overflow-x-auto">
                <table class="w-full min-w-[900px] text-sm text-left">
                    {{-- Header Tabel --}}
                    <thead class="text-[#ECDFCC]/75 uppercase font-medium border-b border-[#FFF3E1]/20">
                        <tr>
                            <th scope="col" class="py-4 px-4">Nama Pengguna</th>
                            <th scope="col" class="py-4 px-4">No. Handphone</th>
                            <th scope="col" class="py-4 px-4">Email</th>
                            <th scope="col" class="py-4 px-4">Alamat</th>
                            <th scope="col" class="py-4 px-4 text-center">Status Akun</th>
                        </tr>
                    </thead>

                    <tbody class="text-[#F4EFE7]">
                        @forelse ($customers as $customer)
                            <tr class="border-b border-[#FFF3E1]/10 hover:bg-white/5 transition duration-200">
                                {{-- Nama & Avatar --}}
                                <td class="py-4 px-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-full bg-[#e9d9c9] text-black flex items-center justify-center font-bold text-xs">
                                            {{ substr($customer->nama, 0, 1) }}
                                        </div>
                                        <span class="font-bold">{{ $customer->nama }}</span>
                                    </div>
                                </td>

                                <td class="py-4 px-4 text-gray-300 font-mono">{{ $customer->no_telepon ?? '-' }}</td>
                                <td class="py-4 px-4 text-gray-300">{{ $customer->email }}</td>
                                <td class="py-4 px-4 text-gray-300 max-w-xs truncate" title="{{ $customer->alamat }}">
                                    {{ $customer->alamat ?? '-' }}
                                </td>

                                {{-- STATUS & UPDATE (X-DATA) --}}
                                <td class="py-4 px-4 text-center">
                                    <div x-data="{
                                        currentStatus: '{{ $customer->status }}',
                                        customerId: {{ $customer->user_id }},
                                    
                                        confirmChange(event) {
                                            const nextStatus = event.target.value;
                                            event.target.value = this.currentStatus;
                                    
                                            // SweetAlert Konfirmasi (Style sudah konsisten Dark & Gold)
                                            Swal.fire({
                                                title: 'Ubah Status Akun?',
                                                text: `Anda akan mengubah status ${this.currentStatus} menjadi ${nextStatus}.`,
                                                icon: 'warning',
                                                showCancelButton: true,
                                                background: '#1a1a19',
                                                color: '#F4EFE7',
                                                confirmButtonColor: '#e9d9c9',
                                                cancelButtonColor: '#3C3D37',
                                                confirmButtonText: '<span style=\'color:black; font-weight:bold;\'>Ya, Ubah</span>',
                                                cancelButtonText: 'Batal',
                                                reverseButtons: true
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    this.updateStatus(nextStatus);
                                                }
                                            });
                                        },
                                    
                                        updateStatus(newStatus) {
                                            fetch(`/admin/customer/${this.customerId}/status`, {
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
                                    
                                                        // Panggil Toast Global dari layout-admin agar konsisten (ada loading bar & warna sama)
                                                        Toast.fire({
                                                            icon: 'success',
                                                            title: 'Status berhasil diperbarui!',
                                                            iconColor: '#4ade80' // Samakan warna hijau dengan notifikasi layout
                                                        });
                                    
                                                    } else {
                                                        Swal.fire('Gagal!', 'Terjadi kesalahan sistem.', 'error');
                                                    }
                                                })
                                                .catch(() => {
                                                    Swal.fire('Error!', 'Gagal menghubungi server.', 'error');
                                                });
                                        }
                                    }" class="relative inline-block">

                                        <select :value="currentStatus" @change="confirmChange($event)"
                                            :class="{
                                                'bg-green-500/20 text-green-400 border-green-500/50': currentStatus ==
                                                    'Aktif',
                                                'bg-red-500/20 text-red-400 border-red-500/50': currentStatus ==
                                                    'Nonaktif'
                                            }"
                                            class="appearance-none border text-xs font-bold pl-4 pr-10 py-2 rounded-full cursor-pointer focus:outline-none focus:ring-2 focus:ring-[#e9d9c9] transition">
                                            <option value="Aktif">Aktif</option>
                                            <option value="Nonaktif">Nonaktif</option>
                                        </select>

                                        {{-- Panah Dropdown --}}
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2"
                                            :class="currentStatus == 'Aktif' ? 'text-green-400' : 'text-red-400'">
                                            <svg class="h-3 w-3 fill-current" viewBox="0 0 20 20">
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
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-2 opacity-50"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        <p>Data pelanggan tidak ditemukan.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- 3. PAGINATION --}}
            <div class="mt-6 border-t border-white/10 pt-4">
                {{ $customers->withQueryString()->links('pagination::tailwind') }}
            </div>

        </div>
    </div>
</x-layout-admin>
