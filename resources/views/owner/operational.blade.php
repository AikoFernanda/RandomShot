<x-layout-owner>
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- WRAPPER UTAMA DENGAN ALPINE DATA --}}
    <div class="min-h-screen text-[#F4EFE7]" x-data="costCrud({{ $errors->any() ? 'true' : 'false' }})">

        {{-- HEADER & SUMMARY --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
            <div>
                <h1 class="text-4xl font-bebas tracking-wide text-[#F4EFE7]">BIAYA OPERASIONAL</h1>
                <p class="text-gray-400 text-sm mt-1">Catat pengeluaran untuk perhitungan laba bersih yang akurat.</p>
            </div>
            
            {{-- Kartu Total Pengeluaran (Sesuai Filter) --}}
            <div class="bg-[#3C3D37] border-l-4 border-red-500 px-6 py-3 rounded-r-xl shadow-lg">
                <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest">Total Pengeluaran</p>
                <p class="text-2xl font-bold text-white mt-1">Rp {{ number_format($totalCost, 0, ',', '.') }}</p>
            </div>
        </div>

        {{-- TOOLS: FILTER & ADD BUTTON --}}
        <div class="bg-[#3C3D37] p-4 rounded-xl border border-white/5 shadow-lg mb-6 flex flex-col md:flex-row justify-between items-center gap-4">
            
            {{-- Form Filter --}}
            <form action="{{ route('owner.data.operasional') }}" method="GET" class="flex flex-wrap items-center gap-3 w-full md:w-auto">
                
                {{-- Filter Periode --}}
                <div class="relative group">
                    <select name="period" class="appearance-none bg-[#181C14] text-[#F4EFE7] text-sm py-2 pl-4 pr-10 rounded border border-white/10 focus:outline-none focus:border-[#e9d9c9] transition cursor-pointer" onchange="this.form.submit()">
                        <option value="">Semua Waktu</option>
                        <option value="this_month" {{ request('period') == 'this_month' ? 'selected' : '' }}>Bulan Ini</option>
                        <option value="last_month" {{ request('period') == 'last_month' ? 'selected' : '' }}>Bulan Lalu</option>
                        <option value="this_year" {{ request('period') == 'this_year' ? 'selected' : '' }}>Tahun Ini</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                        <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>

                {{-- Filter Kategori --}}
                <div class="relative group">
                    <select name="kategori" class="appearance-none bg-[#181C14] text-[#F4EFE7] text-sm py-2 pl-4 pr-10 rounded border border-white/10 focus:outline-none focus:border-[#e9d9c9] transition cursor-pointer" onchange="this.form.submit()">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ request('kategori') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                        <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>

                @if(request('period') || request('kategori'))
                    <a href="{{ route('owner.data.operasional') }}" class="text-xs text-red-400 hover:text-red-300 underline">Reset</a>
                @endif
            </form>

            {{-- Tombol Tambah --}}
            <button @click="openModal('add')" 
                class="w-full md:w-auto px-5 py-2 bg-[#e9d9c9] hover:bg-white text-black font-bold text-sm rounded-lg shadow-lg transition transform hover:scale-105 flex items-center justify-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Catat Biaya Baru
            </button>
        </div>

        {{-- TABEL DATA --}}
        <div class="bg-[#3C3D37] rounded-xl border border-white/5 shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-400 uppercase bg-[#2A2B25] border-b border-white/5">
                        <tr>
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4">Kategori</th>
                            <th class="px-6 py-4">Deskripsi</th>
                            <th class="px-6 py-4 text-right">Nominal</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5 text-gray-300">
                        @forelse($costs as $cost)
                            <tr class="hover:bg-white/5 transition duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($cost->tanggal_biaya)->translatedFormat('d F Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded text-[10px] font-bold uppercase bg-white/10 text-[#e9d9c9] border border-white/10">
                                        {{ $cost->kategori }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="truncate max-w-xs" title="{{ $cost->deskripsi }}">
                                        {{ $cost->deskripsi ?? '-' }}
                                    </p>
                                </td>
                                <td class="px-6 py-4 text-right font-bold text-red-400">
                                    Rp {{ number_format($cost->total_biaya, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        {{-- Edit --}}
                                        <button @click="openModal('edit', {{ $cost }})" class="p-1.5 text-blue-400 hover:text-white hover:bg-blue-500/20 rounded transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                        </button>
                                        {{-- Delete --}}
                                        <form action="{{ route('owner.data.operasional.destroy', $cost->operational_cost_id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="button" @click="confirmDelete($event)" class="p-1.5 text-red-400 hover:text-white hover:bg-red-500/20 rounded transition">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-gray-500 italic">
                                    Belum ada data biaya operasional.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Pagination --}}
            <div class="p-4 border-t border-white/5">
                {{ $costs->links('pagination::tailwind') }}
            </div>
        </div>


        {{-- === MODAL FORM (ALPINE) === --}}
        <div x-show="showModal" x-cloak 
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm"
            x-transition.opacity>

            <div class="bg-[#3C3D37] w-full max-w-lg rounded-2xl shadow-2xl border border-white/10 p-6 relative" @click.away="showModal = false">
                
                <h2 class="text-2xl font-bebas tracking-wide text-[#e9d9c9] mb-6" 
                    x-text="isEdit ? 'EDIT DATA BIAYA' : 'CATAT BIAYA BARU'"></h2>

                {{-- Alert Error --}}
                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-500/20 border border-red-500/50 rounded-lg">
                        <ul class="list-disc list-inside text-xs text-red-300 ml-1">
                            @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                        </ul>
                    </div>
                @endif

                <form :action="formAction" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="_method" :value="isEdit ? 'PUT' : 'POST'">

                    {{-- Tanggal --}}
                    <div>
                        <label class="block text-xs uppercase text-gray-400 font-bold mb-1">Tanggal</label>
                        <input type="date" name="tanggal_biaya" x-model="formData.tanggal_biaya" required
                            class="w-full bg-[#181C14] border border-white/20 rounded-lg p-2.5 text-white focus:border-[#e9d9c9] focus:outline-none [color-scheme:dark]">
                    </div>

                    {{-- Kategori --}}
                    <div>
                        <label class="block text-xs uppercase text-gray-400 font-bold mb-1">Kategori Biaya</label>
                        <select name="kategori" x-model="formData.kategori" required
                            class="w-full bg-[#181C14] border border-white/20 rounded-lg p-2.5 text-white focus:border-[#e9d9c9] focus:outline-none">
                            <option value="" disabled>Pilih Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}">{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Total Biaya --}}
                    <div>
                        <label class="block text-xs uppercase text-gray-400 font-bold mb-1">Total Biaya (Rp)</label>
                        <input type="number" name="total_biaya" x-model="formData.total_biaya" required min="0" placeholder="Contoh: 500000"
                            class="w-full bg-[#181C14] border border-white/20 rounded-lg p-2.5 text-white focus:border-[#e9d9c9] focus:outline-none">
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <label class="block text-xs uppercase text-gray-400 font-bold mb-1">Deskripsi / Catatan</label>
                        <textarea name="deskripsi" x-model="formData.deskripsi" rows="3" placeholder="Contoh: Bayar tagihan listrik bulan Desember"
                            class="w-full bg-[#181C14] border border-white/20 rounded-lg p-2.5 text-white focus:border-[#e9d9c9] focus:outline-none"></textarea>
                    </div>

                    {{-- Tombol --}}
                    <div class="flex justify-end gap-3 pt-4 border-t border-white/10">
                        <button type="button" @click="showModal = false" class="px-5 py-2.5 rounded-lg border border-white/10 hover:bg-white/10 text-gray-300 font-bold transition">Batal</button>
                        <button type="submit" class="px-5 py-2.5 rounded-lg bg-[#e9d9c9] hover:bg-white text-black font-bold shadow-lg transition">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    {{-- SCRIPT ALPINE --}}
    <script>
        function costCrud(startOpen = false) {
            return {
                showModal: startOpen,
                isEdit: {{ old('_method') === 'PUT' ? 'true' : 'false' }},
                formAction: '{{ route('owner.data.operasional.store') }}',
                
                // Form Data Model
                formData: {
                    tanggal_biaya: '{{ date('Y-m-d') }}', // Default hari ini
                    kategori: '',
                    total_biaya: '',
                    deskripsi: ''
                },

                openModal(mode, data = null) {
                    this.isEdit = (mode === 'edit');
                    this.showModal = true;

                    if (this.isEdit && data) {
                        // Mode Edit
                        this.formAction = `/owner/biaya-operasional/${data.operational_cost_id}`;
                        this.formData = {
                            tanggal_biaya: data.tanggal_biaya,
                            kategori: data.kategori,
                            total_biaya: data.total_biaya,
                            deskripsi: data.deskripsi
                        };
                    } else {
                        // Mode Tambah
                        this.formAction = '{{ route('owner.data.operasional.store') }}';
                        // Reset form jika bukan karena error validation reload
                        if (!startOpen) {
                            this.formData = {
                                tanggal_biaya: new Date().toISOString().split('T')[0], // Hari ini YYYY-MM-DD
                                kategori: '',
                                total_biaya: '',
                                deskripsi: ''
                            };
                        }
                    }
                },

                confirmDelete(event) {
                    const form = event.target.closest('form');
                    Swal.fire({
                        title: 'Hapus Data Biaya?',
                        text: "Data yang dihapus akan mempengaruhi laporan keuangan!",
                        icon: 'warning',
                        showCancelButton: true,
                        background: '#1a1a19',
                        color: '#F4EFE7',
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#3C3D37',
                        confirmButtonText: 'Ya, Hapus',
                        cancelButtonText: 'Batal',
                        reverseButtons: true
                    }).then((result) => { if (result.isConfirmed) form.submit(); });
                }
            }
        }
    </script>
</x-layout-owner>