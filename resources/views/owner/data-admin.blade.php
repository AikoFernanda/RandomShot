<x-layout-owner>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="min-h-screen text-[#F4EFE7] font-poppins" x-data="adminCrud({{ $errors->any() ? 'true' : 'false' }})">

        {{-- HEADER HALAMAN --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
            <div>
                <h1 class="text-4xl font-bebas tracking-wide text-white">MANAJEMEN PENGGUNA</h1>
                <p class="text-sm text-gray-400">Kelola akses Owner dan Karyawan.</p>
            </div>

            <button @click="openModal('add')"
                class="px-6 py-2.5 bg-[#e9d9c9] hover:bg-white text-black font-bold rounded-lg shadow-lg transition transform hover:scale-105 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                Tambah Pengguna
            </button>
        </div>

        {{-- BAGIAN 1: OWNER (CARD VIP) --}}
        <div class="mb-12">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-1 h-8 bg-[#e9d9c9] rounded-full"></div>
                <h2 class="text-xl font-bold uppercase tracking-widest text-[#e9d9c9]">Executive Board (Owner)</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($owners as $owner)
                    <div
                        class="bg-gradient-to-br from-[#3C3D37] to-[#2A2B25] p-6 rounded-2xl border border-[#e9d9c9]/30 shadow-lg group hover:border-[#e9d9c9] transition relative overflow-hidden">
                        {{-- Background Accent --}}
                        <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-[#e9d9c9]" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>

                        <div class="flex items-start gap-4 relative z-10">
                            {{-- Foto Profil (Inisial) --}}
                            <div class="w-16 h-16 rounded-full border-2 border-[#e9d9c9] p-1 bg-[#181C14] shrink-0">
                                <div
                                    class="w-full h-full rounded-full bg-[#3C3D37] flex items-center justify-center text-[#e9d9c9] font-bold text-xl uppercase">
                                    {{ substr($owner->nama, 0, 1) }}
                                </div>
                            </div>

                            {{-- Info --}}
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-white group-hover:text-[#e9d9c9] transition">
                                    {{ $owner->nama }}</h3>
                                <p class="text-xs text-gray-400 mb-1">{{ $owner->email }}</p>
                                <span
                                    class="px-2 py-0.5 rounded text-[10px] font-bold bg-[#e9d9c9] text-black uppercase tracking-wider">Owner
                                    Access</span>
                            </div>

                            {{-- Tombol Edit --}}
                            <div class="flex flex-col gap-2">
                                <button @click="openModal('edit', {{ $owner }})"
                                    class="text-gray-500 hover:text-[#e9d9c9] transition" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                @if (session('user_id') != $owner->user_id)
                                    <form action="{{ route('owner.data.admin.destroy', $owner->user_id) }}"
                                        method="POST">
                                        @csrf @method('DELETE')
                                        <button type="button" @click="confirmDelete($event)"
                                            class="text-gray-500 hover:text-red-500 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


        {{-- BAGIAN 2: EMPLOYEE (TABEL) --}}
        <div>
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                <div class="flex items-center gap-3">
                    <div class="w-1 h-8 bg-gray-500 rounded-full"></div>
                    <h2 class="text-xl font-bold uppercase tracking-widest text-gray-400">Staff & Employee</h2>
                </div>

                {{-- FORM PENCARIAN DENGAN TOMBOL X --}}
                <form action="{{ route('owner.data.admin') }}" method="GET" class="relative w-full md:w-auto">
                    <div class="relative">
                        <input type="text" name="search" placeholder="Cari karyawan..."
                            value="{{ request('search') }}"
                            class="bg-[#3C3D37] border border-white/10 text-white text-sm rounded-lg pl-4 pr-10 py-2 focus:border-[#e9d9c9] focus:outline-none w-full md:w-64 transition placeholder-gray-500">

                        {{-- Tombol X (Muncul jika ada search) --}}
                        @if (request('search'))
                            <a href="{{ route('owner.data.admin') }}"
                                class="absolute right-10 top-1/2 -translate-y-1/2 text-gray-500 hover:text-red-400 transition"
                                title="Hapus Pencarian">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        @endif

                        {{-- Tombol Search --}}
                        <button type="submit"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-[#3C3D37] rounded-xl border border-white/5 shadow-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-gray-400 uppercase bg-[#2A2B25] border-b border-white/5">
                            <tr>
                                <th class="px-6 py-4">Karyawan</th>
                                <th class="px-6 py-4">Kontak</th>
                                <th class="px-6 py-4">Alamat</th>
                                <th class="px-6 py-4 text-center">Status Akun</th> {{-- Kolom Status --}}
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5 text-gray-300">
                            @forelse($employees as $emp)
                                <tr class="hover:bg-white/5 transition">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 rounded-full bg-[#181C14] flex items-center justify-center font-bold text-white uppercase overflow-hidden border border-white/10">
                                                {{ substr($emp->nama, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="font-bold text-white">{{ $emp->nama }}</div>
                                                <div class="text-xs text-gray-500">ID: {{ $emp->user_id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-xs">{{ $emp->email }}</div>
                                        <div class="text-xs text-gray-500">{{ $emp->no_telepon ?? '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-xs text-gray-400 max-w-[150px] truncate"
                                            title="{{ $emp->alamat }}">{{ $emp->alamat ?? '-' }}</p>
                                    </td>

                                    {{-- Kolom Status Akun --}}
                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="px-2 py-1 rounded text-[10px] font-bold border 
                                            {{ $emp->status == 'Aktif' ? 'bg-green-500/10 text-green-400 border-green-500/20' : 'bg-red-500/10 text-red-400 border-red-500/20' }}">
                                            {{ $emp->status }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <button @click="openModal('edit', {{ $emp }})"
                                                class="p-1.5 bg-blue-500/10 text-blue-400 rounded hover:bg-blue-500 hover:text-white transition">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </button>
                                            <form action="{{ route('owner.data.admin.destroy', $emp->user_id) }}"
                                                method="POST">
                                                @csrf @method('DELETE')
                                                <button type="button" @click="confirmDelete($event)"
                                                    class="p-1.5 bg-red-500/10 text-red-400 rounded hover:bg-red-500 hover:text-white transition">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                                    <td colspan="5" class="px-6 py-10 text-center text-gray-500">Belum ada data
                                        karyawan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-4 border-t border-white/5">
                    {{ $employees->links('pagination::tailwind') }}
                </div>
            </div>
        </div>


        {{-- === MODAL FORM (ALPINE) === --}}
        <div x-show="showModal" x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm"
            x-transition.opacity>

            <div class="bg-[#3C3D37] w-full max-w-lg rounded-2xl shadow-2xl border border-white/10 p-6 relative overflow-y-auto max-h-[90vh]"
                @click.away="showModal = false">

                <h2 class="text-2xl font-bebas tracking-wide text-[#e9d9c9] mb-6"
                    x-text="isEdit ? 'EDIT PENGGUNA' : 'TAMBAH PENGGUNA BARU'"></h2>

                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-500/20 border border-red-500/50 rounded-lg">
                        <ul class="list-disc list-inside text-xs text-red-300 ml-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form :action="formAction" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="_method" :value="isEdit ? 'PUT' : 'POST'">

                    {{-- Nama --}}
                    <div>
                        <label class="block text-xs uppercase text-gray-400 font-bold mb-1">Nama Lengkap</label>
                        <input type="text" name="nama" x-model="formData.nama" required
                            class="w-full bg-[#181C14] border border-white/20 rounded-lg p-2.5 text-white focus:border-[#e9d9c9] focus:outline-none">
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-xs uppercase text-gray-400 font-bold mb-1">Email</label>
                        <input type="email" name="email" x-model="formData.email" required
                            class="w-full bg-[#181C14] border border-white/20 rounded-lg p-2.5 text-white focus:border-[#e9d9c9] focus:outline-none">
                    </div>

                    {{-- No Telepon & Jenis Kelamin (Grid 2 Kolom) --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs uppercase text-gray-400 font-bold mb-1">No. Telepon</label>
                            <input type="text" name="no_telepon" x-model="formData.no_telepon"
                                class="w-full bg-[#181C14] border border-white/20 rounded-lg p-2.5 text-white focus:border-[#e9d9c9] focus:outline-none">
                        </div>

                        {{-- INPUT JENIS KELAMIN --}}
                        <div>
                            <label class="block text-xs uppercase text-gray-400 font-bold mb-1">Jenis Kelamin</label>
                            <select name="jenis_kelamin" x-model="formData.jenis_kelamin" required
                                class="w-full bg-[#181C14] border border-white/20 rounded-lg p-2.5 text-white focus:border-[#e9d9c9] focus:outline-none">
                                <option value="" disabled>Pilih JK</option>
                                <option value="Pria">Pria</option>
                                <option value="Wanita">Wanita</option>
                                <option value="Unknown">Unknown</option>
                            </select>
                        </div>
                    </div>

                    {{-- Alamat --}}
                    <div>
                        <label class="block text-xs uppercase text-gray-400 font-bold mb-1">Alamat</label>
                        <textarea name="alamat" x-model="formData.alamat" rows="2"
                            class="w-full bg-[#181C14] border border-white/20 rounded-lg p-2.5 text-white focus:border-[#e9d9c9] focus:outline-none"></textarea>
                    </div>

                    {{-- Peran & Status (Grid 2 Kolom) --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs uppercase text-gray-400 font-bold mb-1">Peran / Jabatan</label>
                            <select name="peran" x-model="formData.peran" required
                                class="w-full bg-[#181C14] border border-white/20 rounded-lg p-2.5 text-white focus:border-[#e9d9c9] focus:outline-none">
                                <option value="Employee">Employee (Staff)</option>
                                <option value="Owner">Owner (Executive)</option>
                            </select>
                        </div>

                        {{-- Opsi Status (Hanya muncul saat edit) --}}
                        <div>
                            <label class="block text-xs uppercase text-gray-400 font-bold mb-1">Status Akun</label>
                            <select name="status" x-model="formData.status" required
                                class="w-full bg-[#181C14] border border-white/20 rounded-lg p-2.5 text-white focus:border-[#e9d9c9] focus:outline-none"
                                :disabled="!isEdit" :class="!isEdit ? 'opacity-50 cursor-not-allowed' : ''">
                                <option value="Aktif">Aktif</option>
                                <option value="Nonaktif">Nonaktif</option>
                            </select>
                        </div>
                    </div>

                    {{-- Password --}}
                    <div>
                        <label class="block text-xs uppercase text-gray-400 font-bold mb-1"
                            x-text="isEdit ? 'Password Baru (Opsional)' : 'Password'"></label>
                        <input type="password" name="password"
                            class="w-full bg-[#181C14] border border-white/20 rounded-lg p-2.5 text-white focus:border-[#e9d9c9] focus:outline-none"
                            :required="!isEdit" placeholder="Minimal 6 karakter">
                        <p x-show="isEdit" class="text-[10px] text-gray-500 mt-1">*Kosongkan jika tidak ingin
                            mengganti password.</p>
                    </div>

                    {{-- Tombol --}}
                    <div class="flex justify-end gap-3 pt-4 border-t border-white/10">
                        <button type="button" @click="showModal = false"
                            class="px-5 py-2.5 rounded-lg border border-white/10 hover:bg-white/10 text-gray-300 font-bold transition">Batal</button>
                        <button type="submit"
                            class="px-5 py-2.5 rounded-lg bg-[#e9d9c9] hover:bg-white text-black font-bold shadow-lg transition">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script>
        function adminCrud(startOpen = false) {
            return {
                showModal: startOpen,
                isEdit: {{ old('_method') === 'PUT' ? 'true' : 'false' }},
                formAction: '{{ route('owner.data.admin.store') }}',

                formData: {
                    nama: '',
                    email: '',
                    no_telepon: '',
                    jenis_kelamin: '',
                    alamat: '',
                    peran: 'Employee',
                    status: 'Aktif' // Default Status
                },

                openModal(mode, data = null) {
                    this.isEdit = (mode === 'edit');
                    this.showModal = true;

                    if (this.isEdit && data) {
                        this.formAction = `/owner/data-admin/${data.user_id}`;
                        this.formData = {
                            nama: data.nama,
                            email: data.email,
                            no_telepon: data.no_telepon,
                            jenis_kelamin: data.jenis_kelamin,
                            alamat: data.alamat,
                            peran: data.peran,
                            status: data.status // Load Status dari DB
                        };
                    } else {
                        this.formAction = '{{ route('owner.data.admin.store') }}';
                        if (!startOpen) {
                            this.formData = {
                                nama: '',
                                email: '',
                                no_telepon: '',
                                jenis_kelamin: 'Unknown',
                                alamat: '',
                                peran: 'Employee',
                                status: 'Aktif'
                            };
                        }
                    }
                },

                confirmDelete(event) {
                    const form = event.target.closest('form');
                    Swal.fire({
                        title: 'Hapus Pengguna?',
                        text: "Akses akun ini akan dicabut permanen!",
                        icon: 'warning',
                        showCancelButton: true,
                        reverseButtons: true,
                        background: '#1a1a19',
                        color: '#F4EFE7',
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#3C3D37',
                        confirmButtonText: 'Ya, Hapus',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) form.submit();
                    });
                }
            }
        }
    </script>
</x-layout-owner>
