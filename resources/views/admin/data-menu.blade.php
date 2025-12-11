<x-layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- WRAPPER UTAMA --}}
    <div class="min-h-screen bg-[#181C14] text-[#F4EFE7] font-poppins p-4 md:p-8" x-data="menuCrud({{ $errors->any() ? 'true' : 'false' }})">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bebas tracking-wide text-white">KELOLA MENU CAFE</h1>
                <p class="text-sm text-gray-400">Atur daftar makanan, minuman, harga, dan stok.</p>
            </div>

            <button @click="openModal('add')"
                class="px-6 py-2.5 bg-[#e9d9c9] hover:bg-white text-black font-bold rounded-lg shadow-lg transition transform hover:scale-105 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                Tambah Menu
            </button>
        </div>

        {{-- KARTU KONTEN --}}
        <div class="bg-[#3C3D37] rounded-2xl p-6 text-[#F4EFE7] shadow-lg border border-white/5">

            {{-- SEARCH BAR --}}
            <form action="{{ route('admin.menu') }}" method="GET" class="relative mb-6">
                {{-- Pesan Error Validasi --}}
                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-500/20 border border-red-500/50 rounded-lg">
                        <div class="flex items-center gap-2 text-red-400 font-bold mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="text-sm">Gagal Menyimpan Data</span>
                        </div>
                        <ul class="list-disc list-inside text-xs text-red-300 ml-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <input type="text" name="search" placeholder="Cari Nama Menu atau Kategori..."
                    value="{{ request('search') }}"
                    class="w-full bg-[#757572] rounded-lg py-3 pl-12 pr-12 text-[#F4EFE7] placeholder-gray-300 focus:outline-none focus:ring-1 focus:ring-[#F4EFE7] transition">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[#F4EFE7]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </span>
                @if (request('search'))
                    <a href="{{ route('admin.menu') }}"
                        class="absolute right-3 top-1/2 -translate-y-1/2 p-1.5 rounded-full text-gray-300 hover:text-white hover:bg-white/20 transition"><svg
                            xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg></a>
                @endif
            </form>

            {{-- TABEL DATA --}}
            <div class="overflow-x-auto">
                <table class="w-full min-w-[1000px] text-sm text-left">
                    <thead class="text-[#ECDFCC]/75 uppercase font-medium border-b border-[#FFF3E1]/20">
                        <tr>
                            <th class="py-4 px-4">Info Menu</th>
                            <th class="py-4 px-4">Kategori</th>
                            <th class="py-4 px-4">Harga & Stok</th>
                            <th class="py-4 px-4">Deskripsi</th>
                            <th class="py-4 px-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-[#F4EFE7]">
                        @forelse ($menus as $menu)
                            <tr class="border-b border-[#FFF3E1]/10 hover:bg-white/5 transition duration-200">

                                {{-- 1. Gambar & Nama --}}
                                <td class="py-4 px-4">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-14 h-14 rounded-lg bg-[#181C14] overflow-hidden shrink-0 border border-white/10 relative group">
                                            @if ($menu->nama_gambar)
                                                <img src="{{ asset('img/menu/' . $menu->nama_gambar) }}"
                                                    class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                            @else
                                                <div
                                                    class="w-full h-full flex items-center justify-center text-xs text-gray-500">
                                                    No Img</div>
                                            @endif
                                        </div>
                                        <div class="font-bold text-lg text-white">{{ $menu->nama }}</div>
                                    </div>
                                </td>

                                {{-- 2. Kategori --}}
                                <td class="py-4 px-4">
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-bold border 
                                        {{ $menu->kategori == 'Makanan'
                                            ? 'bg-orange-500/20 text-orange-400 border-orange-500/50'
                                            : ($menu->kategori == 'Minuman'
                                                ? 'bg-blue-500/20 text-blue-400 border-blue-500/50'
                                                : 'bg-purple-500/20 text-purple-400 border-purple-500/50') }}">
                                        {{ $menu->kategori }}
                                    </span>
                                </td>

                                {{-- 3. Harga & Stok --}}
                                <td class="py-4 px-4">
                                    <div class="flex flex-col gap-1">
                                        <div class="font-mono text-[#e9d9c9] text-base">
                                            Rp{{ number_format($menu->harga, 0, ',', '.') }}
                                        </div>
                                        <div
                                            class="text-xs {{ $menu->stok > 0 ? 'text-gray-400' : 'text-red-500 font-bold' }}">
                                            Stok: {{ $menu->stok }} porsi
                                        </div>
                                    </div>
                                </td>

                                {{-- 4. Deskripsi --}}
                                <td class="py-4 px-4">
                                    <p class="text-gray-400 text-xs line-clamp-2 max-w-[200px]"
                                        title="{{ $menu->deskripsi }}">
                                        {{ $menu->deskripsi ?? '-' }}
                                    </p>
                                </td>

                                {{-- 5. Aksi --}}
                                <td class="py-4 px-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        {{-- Edit --}}
                                        <button @click="openModal('edit', {{ $menu }})"
                                            class="p-2 bg-blue-500/10 text-blue-400 rounded hover:bg-blue-500 hover:text-white transition border border-blue-500/20">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                        {{-- Delete --}}
                                        <form action="{{ route('admin.menu.destroy', $menu->menu_id) }}"
                                            method="POST">
                                            @csrf @method('DELETE')
                                            <button type="button" @click="confirmDelete($event)"
                                                class="p-2 bg-red-500/10 text-red-400 rounded hover:bg-red-500 hover:text-white transition border border-red-500/20">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-10 text-center text-gray-400">Belum ada data menu.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6 border-t border-white/10 pt-4">
                {{ $menus->links('pagination::tailwind') }}
            </div>
        </div>

        {{-- === MODAL FORM === --}}
        <div x-show="showModal" x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm"
            x-transition.opacity>

            <div class="bg-[#3C3D37] w-full max-w-2xl rounded-2xl shadow-2xl border border-white/10 p-6 relative overflow-y-auto max-h-[90vh]"
                @click.away="showModal = false">

                <h2 class="text-2xl font-bebas tracking-wide text-[#e9d9c9] mb-6"
                    x-text="isEdit ? 'EDIT MENU' : 'TAMBAH MENU BARU'"></h2>

                <form :action="formAction" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    @if ($errors->any())
                        <div class="mb-4 p-3 bg-red-500/20 border border-red-500/50 rounded-lg">
                            <div class="flex items-center gap-2 text-red-400 font-bold mb-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm">Gagal: Data Salah / Duplikat</span>
                            </div>
                            <ul class="list-disc list-inside text-xs text-red-300 ml-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <input type="hidden" name="_method" :value="isEdit ? 'PUT' : 'POST'">

                    {{-- Nama & Kategori --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs uppercase text-gray-400 font-bold mb-1">Nama Menu</label>
                            <input type="text" name="nama" x-model="formData.nama" required
                                class="w-full bg-[#181C14] border border-white/20 rounded-lg p-2.5 text-white focus:border-[#e9d9c9] focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs uppercase text-gray-400 font-bold mb-1">Kategori</label>
                            <select name="kategori" x-model="formData.kategori" required
                                class="w-full bg-[#181C14] border border-white/20 rounded-lg p-2.5 text-white focus:border-[#e9d9c9] focus:outline-none">
                                <option value="Makanan">Makanan</option>
                                <option value="Minuman">Minuman</option>
                                <option value="Snack">Snack</option>
                            </select>
                        </div>
                    </div>

                    {{-- Harga & Stok --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs uppercase text-gray-400 font-bold mb-1">Harga (Rp)</label>
                            <input type="number" name="harga" x-model="formData.harga" required
                                class="w-full bg-[#181C14] border border-white/20 rounded-lg p-2.5 text-white focus:border-[#e9d9c9] focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs uppercase text-gray-400 font-bold mb-1">Stok Awal</label>
                            <input type="number" name="stok" x-model="formData.stok" required
                                class="w-full bg-[#181C14] border border-white/20 rounded-lg p-2.5 text-white focus:border-[#e9d9c9] focus:outline-none">
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <label class="block text-xs uppercase text-gray-400 font-bold mb-1">Deskripsi</label>
                        <textarea name="deskripsi" x-model="formData.deskripsi" rows="2"
                            class="w-full bg-[#181C14] border border-white/20 rounded-lg p-2.5 text-white focus:border-[#e9d9c9] focus:outline-none"></textarea>
                    </div>

                    {{-- Gambar --}}
                    <div>
                        <label class="block text-xs uppercase text-gray-400 font-bold mb-1">Foto Menu</label>
                        <input type="file" name="gambar" accept="image/*"
                            class="w-full bg-[#181C14] border border-white/20 rounded-lg p-2 text-sm text-gray-400 file:bg-[#e9d9c9] file:text-black file:border-0 file:rounded file:px-4 file:py-1 file:mr-4 file:font-bold hover:file:bg-white cursor-pointer">
                    </div>

                    {{-- Tombol --}}
                    <div class="flex justify-end gap-3 pt-4 border-t border-white/10">
                        <button type="button" @click="showModal = false"
                            class="px-5 py-2.5 rounded-lg border border-white/10 hover:bg-white/10 text-gray-300 font-bold transition">Batal</button>
                        <button type="submit"
                            class="px-5 py-2.5 rounded-lg bg-[#e9d9c9] hover:bg-white text-black font-bold shadow-lg transition">Simpan
                            Data</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script>
        function menuCrud(startOpen = false) {
            return {
                showModal: startOpen,
                isEdit: false, // Default false,

                // Form Action Default
                formAction: '{{ route('admin.menu.store') }}',

                // Data Kosong (Reset)
                formData: {
                    nama: '',
                    kategori: 'Makanan',
                    harga: '',
                    stok: '',
                    deskripsi: ''
                },

                openModal(mode, data = null) {
                    this.isEdit = (mode === 'edit');
                    this.showModal = true;

                    if (this.isEdit && data) {
                        this.formAction = `/admin/menu/${data.menu_id}`;
                        this.formData = {
                            nama: data.nama,
                            kategori: data.kategori,
                            harga: data.harga,
                            stok: data.stok,
                            deskripsi: data.deskripsi
                        };
                    } else {
                        // Reset jika tambah baru
                        this.formAction = "{{ route('admin.menu.store') }}";
                        // Jika terbuka karena error, jangan reset (user harus input ulang)
                        if (!startOpen) {
                            this.formData = {
                                nama: '',
                                kategori: 'Makanan',
                                harga: '',
                                stok: '',
                                deskripsi: ''
                            };
                        }
                    }
                },

                confirmDelete(event) {
                    const form = event.target.closest('form');
                    Swal.fire({
                        title: 'Hapus Menu?',
                        text: "Data tidak bisa dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        background: '#1a1a19',
                        color: '#F4EFE7',
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#3C3D37',
                        confirmButtonText: 'Ya, Hapus',
                        cancelButtonText: 'Batal',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) form.submit();
                    });
                }
            }
        }
    </script>
</x-layout-admin>
