<x-layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>
    {{-- PESAN ERROR DI DALAM MODAL --}}
                    @if ($errors->any())
                        <div class="mb-4 p-3 bg-red-500/20 border border-red-500/50 rounded-lg">
                            <ul class="list-disc list-inside text-xs text-red-300 ml-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
    {{-- WRAPPER UTAMA --}}
    <div class="min-h-screen bg-[#181C14] text-[#F4EFE7] font-poppins p-4 md:p-8"
         x-data="tableCrud()">

        {{-- HEADER HALAMAN --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bebas tracking-wide text-white">KELOLA DATA MEJA</h1>
                <p class="text-sm text-gray-400">Atur meja biliar, tarif per jam, dan status ketersediaan.</p>
            </div>
            
            {{-- Tombol Tambah --}}
            <button @click="openModal('add')" 
                class="px-6 py-2.5 bg-[#e9d9c9] hover:bg-white text-black font-bold rounded-lg shadow-lg transition transform hover:scale-105 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah Meja
            </button>
        </div>

        {{-- KARTU KONTEN --}}
        <div class="bg-[#3C3D37] rounded-2xl p-6 text-[#F4EFE7] shadow-lg border border-white/5">

            {{-- FORM PENCARIAN --}}
            <form action="{{ route('admin.table') }}" method="GET" class="relative mb-6">
                <input type="text" name="search" placeholder="Cari Nama Meja atau Kategori..."
                    value="{{ request('search') }}"
                    class="w-full bg-[#757572] rounded-lg py-3 pl-12 pr-12 text-[#F4EFE7] placeholder-gray-300 focus:outline-none focus:ring-1 focus:ring-[#F4EFE7] transition">
                
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[#F4EFE7]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>
                </span>

                @if(request('search'))
                    <a href="{{ route('admin.table') }}" title="Hapus Pencarian"
                       class="absolute right-3 top-1/2 -translate-y-1/2 p-1.5 rounded-full text-gray-300 hover:text-white hover:bg-white/20 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                    </a>
                @endif
            </form>

            {{-- TABEL DATA --}}
            <div class="overflow-x-auto">
                <table class="w-full min-w-[1000px] text-sm text-left">
                    <thead class="text-[#ECDFCC]/75 uppercase font-medium border-b border-[#FFF3E1]/20">
                        <tr>
                            <th class="py-4 px-4">Meja & Kategori</th>
                            <th class="py-4 px-4">Tarif (Per Jam)</th>
                            <th class="py-4 px-4">Deskripsi</th>
                            <th class="py-4 px-4 text-center">Status</th>
                            <th class="py-4 px-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-[#F4EFE7]">
                        @forelse ($tables as $table)
                            <tr class="border-b border-[#FFF3E1]/10 hover:bg-white/5 transition duration-200">
                                
                                {{-- 1. Gambar & Nama --}}
                                <td class="py-4 px-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-16 h-16 rounded-lg bg-[#181C14] overflow-hidden shrink-0 border border-white/10 relative group">
                                            @if($table->nama_gambar)
                                                <img src="{{ asset('img/' . $table->nama_gambar) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-xs text-gray-500">No Img</div>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="font-bold text-lg text-white">{{ $table->nama }}</div>
                                            <div class="text-xs font-mono text-[#e9d9c9] border border-[#e9d9c9]/30 px-2 py-0.5 rounded w-fit mt-1">
                                                {{ $table->kategori }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Tarif --}}
                                <td class="py-4 px-4">
                                    <div class="space-y-1 text-gray-300 text-xs">
                                        <div class="flex justify-between w-32">
                                            <span>Siang:</span> 
                                            <span class="font-mono text-[#e9d9c9]">Rp{{ number_format($table->tarif_per_jam_siang, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="flex justify-between w-32">
                                            <span>Sore:</span> 
                                            <span class="font-mono text-[#e9d9c9]">Rp{{ number_format($table->tarif_per_jam_sore, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="flex justify-between w-32">
                                            <span>Malam:</span> 
                                            <span class="font-mono text-[#e9d9c9]">Rp{{ number_format($table->tarif_per_jam_malam, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </td>

                                {{-- Deskripsi --}}
                                <td class="py-4 px-4">
                                    <p class="text-gray-400 text-xs line-clamp-2 max-w-[200px]" title="{{ $table->deskripsi }}">
                                        {{ $table->deskripsi ?? '-' }}
                                    </p>
                                </td>

                                {{-- Status --}}
                                <td class="py-4 px-4 text-center">
                                    @php
                                        $statusClass = match($table->status) {
                                            'Tersedia' => 'bg-green-500/20 text-green-400 border-green-500/50',
                                            'Dalam Perbaikan' => 'bg-red-500/20 text-red-400 border-red-500/50',
                                            default => 'bg-gray-500/20 text-gray-400',
                                        };
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $statusClass }}">
                                        {{ $table->status }}
                                    </span>
                                </td>

                                {{-- Aksi --}}
                                <td class="py-4 px-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        {{-- Edit Button --}}
                                        <button @click="openModal('edit', {{ $table }})" 
                                            class="p-2 bg-blue-500/10 text-blue-400 rounded hover:bg-blue-500 hover:text-white transition border border-blue-500/20" 
                                            title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                        </button>

                                        {{-- Delete Button --}}
                                        <form action="{{ route('admin.table.destroy', $table->table_id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" @click="confirmDelete($event)"
                                                class="p-2 bg-red-500/10 text-red-400 rounded hover:bg-red-500 hover:text-white transition border border-red-500/20" 
                                                title="Hapus">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-10 text-center text-gray-400">Belum ada data meja.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6 border-t border-white/10 pt-4">
                {{ $tables->links('pagination::tailwind') }}
            </div>
        </div>

        {{-- === MODAL FORM (ALPINE.JS) === --}}
        <div x-show="showModal" x-cloak 
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" 
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" 
            x-transition:leave-end="opacity-0">

            <div class="bg-[#3C3D37] w-full max-w-2xl rounded-2xl shadow-2xl border border-white/10 p-6 relative overflow-y-auto max-h-[90vh]"
                 @click.away="showModal = false">
                
                {{-- Judul Modal --}}
                <h2 class="text-2xl font-bebas tracking-wide text-[#e9d9c9] mb-6" x-text="isEdit ? 'EDIT DATA MEJA' : 'TAMBAH MEJA BARU'"></h2>

                {{-- FORM --}}
                <form :action="formAction" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    {{-- Method Spoofing untuk Edit (PUT) --}}
                    <input type="hidden" name="_method" :value="isEdit ? 'PUT' : 'POST'">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Nama Meja --}}
                        <div>
                            <label class="block text-xs uppercase text-gray-400 font-bold mb-1">Nama Meja</label>
                            <input type="text" name="nama" x-model="formData.nama" required
                                class="w-full bg-[#181C14] border border-white/20 rounded-lg p-2.5 text-white focus:border-[#e9d9c9] focus:outline-none">
                        </div>
                        {{-- Kategori --}}
                        <div>
                            <label class="block text-xs uppercase text-gray-400 font-bold mb-1">Kategori</label>
                            <select name="kategori" x-model="formData.kategori" required
                                class="w-full bg-[#181C14] border border-white/20 rounded-lg p-2.5 text-white focus:border-[#e9d9c9] focus:outline-none">
                                <option value="Biliar">Biliar</option>
                                <option value="Tenis">Tenis</option>
                                <option value="Playstation">Playstation</option>
                            </select>
                        </div>
                    </div>

                    {{-- Tarif Grid --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs uppercase text-gray-400 font-bold mb-1">Tarif Siang</label>
                            <input type="number" name="tarif_per_jam_siang" x-model="formData.tarif_per_jam_siang" required
                                class="w-full bg-[#181C14] border border-white/20 rounded-lg p-2.5 text-white focus:border-[#e9d9c9] focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs uppercase text-gray-400 font-bold mb-1">Tarif Sore</label>
                            <input type="number" name="tarif_per_jam_sore" x-model="formData.tarif_per_jam_sore" required
                                class="w-full bg-[#181C14] border border-white/20 rounded-lg p-2.5 text-white focus:border-[#e9d9c9] focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs uppercase text-gray-400 font-bold mb-1">Tarif Malam</label>
                            <input type="number" name="tarif_per_jam_malam" x-model="formData.tarif_per_jam_malam" required
                                class="w-full bg-[#181C14] border border-white/20 rounded-lg p-2.5 text-white focus:border-[#e9d9c9] focus:outline-none">
                        </div>
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="block text-xs uppercase text-gray-400 font-bold mb-1">Status Meja</label>
                        <select name="status" x-model="formData.status" required
                            class="w-full bg-[#181C14] border border-white/20 rounded-lg p-2.5 text-white focus:border-[#e9d9c9] focus:outline-none">
                            <option value="Tersedia">Tersedia (Bisa Dipesan)</option>
                            <option value="Dalam Perbaikan">Dalam Perbaikan (Rusak/Perbaikan)</option>
                        </select>
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <label class="block text-xs uppercase text-gray-400 font-bold mb-1">Deskripsi (Opsional)</label>
                        <textarea name="deskripsi" x-model="formData.deskripsi" rows="2"
                            class="w-full bg-[#181C14] border border-white/20 rounded-lg p-2.5 text-white focus:border-[#e9d9c9] focus:outline-none"></textarea>
                    </div>

                    {{-- Gambar --}}
                    <div>
                        <label class="block text-xs uppercase text-gray-400 font-bold mb-1">Gambar Meja</label>
                        <input type="file" name="gambar" accept="image/*"
                            class="w-full bg-[#181C14] border border-white/20 rounded-lg p-2 text-sm text-gray-400 file:bg-[#e9d9c9] file:text-black file:border-0 file:rounded file:px-4 file:py-1 file:mr-4 file:font-bold hover:file:bg-white cursor-pointer">
                        <p class="text-[10px] text-gray-500 mt-1">*Upload baru untuk mengganti gambar lama. Max 2MB.</p>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="flex justify-end gap-3 pt-4 border-t border-white/10">
                        <button type="button" @click="showModal = false"
                            class="px-5 py-2.5 rounded-lg border border-white/10 hover:bg-white/10 text-gray-300 font-bold transition">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-5 py-2.5 rounded-lg bg-[#e9d9c9] hover:bg-white text-black font-bold shadow-lg transition">
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    {{-- SCRIPT LOGIKA HALAMAN INI --}}
    <script>
        function tableCrud() {
            return {
                showModal: false,
                isEdit: false,
                formAction: '',
                
                // Model Data Form
                formData: {
                    nama: '',
                    kategori: '',
                    tarif_per_jam_siang: '',
                    tarif_per_jam_sore: '',
                    tarif_per_jam_malam: '',
                    status: '',
                    deskripsi: ''
                },

                // Buka Modal (Mode Tambah / Edit)
                openModal(mode, data = null) {
                    this.isEdit = (mode === 'edit');
                    this.showModal = true;

                    if (this.isEdit && data) {
                        // Isi form dengan data yang mau diedit
                        this.formAction = `{{ route('admin.table.store') }}/${data.table_id}`.replace('/meja', '/meja'); 
                        // URL Update: /admin/meja/{id}
                        this.formAction = `/admin/meja/${data.table_id}`;

                        this.formData = {
                            nama: data.nama,
                            kategori: data.kategori,
                            tarif_per_jam_siang: data.tarif_per_jam_siang,
                            tarif_per_jam_sore: data.tarif_per_jam_sore,
                            tarif_per_jam_malam: data.tarif_per_jam_malam,
                            status: data.status,
                            deskripsi: data.deskripsi
                        };
                    } else {
                        // Reset form untuk mode Tambah
                        this.formAction = "{{ route('admin.table.store') }}";
                        this.formData = {
                            nama: '',
                            kategori: 'Regular',
                            tarif_per_jam_siang: '',
                            tarif_per_jam_sore: '',
                            tarif_per_jam_malam: '',
                            status: 'Tersedia',
                            deskripsi: ''
                        };
                    }
                },

                // Konfirmasi Hapus dengan SweetAlert
                confirmDelete(event) {
                    const form = event.target.closest('form');
                    Swal.fire({
                        title: 'Hapus Meja?',
                        text: "Data yang dihapus tidak bisa dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        background: '#1a1a19',
                        color: '#F4EFE7',
                        confirmButtonColor: '#ef4444', // Merah
                        cancelButtonColor: '#3C3D37',
                        confirmButtonText: 'Ya, Hapus',
                        cancelButtonText: 'Batal',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                }
            }
        }
    </script>
</x-layout-admin>