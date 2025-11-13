<x-LayoutAdmin>
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- Kartu Konten Utama (yang gelap) --}}
    <div class="bg-gray-800 rounded-2xl p-6 text-white">
        {{-- search bar --}}
        <form action="{{ route('admin.customer') }}" method="GET" class="mb-4">
            <div class="relative">
                <input type="text" name="search" placeholder="Cari berdasarkan nama..." value="{{ request('search') }}"
                    {{-- Menampilkan query search saat ini --}}
                    class="w-full bg-gray-700 border border-gray-600 rounded-lg py-3 pl-12 pr-4 text-white placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500">
                {{-- Ikon search di dalam input --}}
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </span>
                {{-- Tombol submit tersembunyi, form akan submit saat menekan Enter --}}
            </div>
        </form>

        {{-- Wrapper Tabel agar bisa scroll horizontal di HP --}}
        <div class="overflow-x-auto">
            <table class="w-full min-w-[800px] text-sm text-left">
                {{-- Header Tabel --}}
                <thead class="text-gray-400 uppercase font-medium">
                    <tr>
                        <th scope="col" class="py-3 px-4">Nama Pengguna</th>
                        <th scope="col" class="py-3 px-4">No. Handphone</th>
                        <th scope="col" class="py-3 px-4">Email</th>
                        <th scope="col" class="py-3 px-4">Alamat</th>
                        <th scope="col" class="py-3 px-4">Status</th>
                    </tr>
                </thead>

                {{-- Isi Tabel --}}
                <tbody>
                    @foreach ($customers as $customer)
                        <tr class="border-b border-gray-700">
                            <td class="py-4 px-4 whitespace-nowrap">
                                <div class="flex items-center space-x-3">
                                    <span>{{ $customer->nama }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-4 whitespace-nowrap">{{ $customer->no_telepon }}</td>
                            <td class="py-4 px-4 whitespace-nowrap">{{ $customer->email }}</td>
                            <td class="py-4 px-4 whitespace-normal max-w-xs">{{ $customer->alamat }}</td>
                            <td class="py-4 px-4 whitespace-nowrap">
                                {{-- Status akun --}}
                                {{-- 1. x-data: Kita 'simpan' statusnya. (Ganti 'Aktif' dengan data asli dari server, misal: '{{ $customer->status }}') 2. relative: Diperlukan agar ikon panah bisa diposisikan --}}
                                {{-- 1. Tambahkan customerId dan fungsi updateStatus() ke x-data(Pastikan $customer->status dan $customer->id ada dari controller) --}}
                                <div x-data="{
                                    status: '{{ $customer->status }}',
                                    customerId: {{ $customer->user_id }},
                                    updateStatus() {
                                        fetch(`/customer/${this.customerId}/status`, {
                                                method: 'POST',
                                                headers: {
                                                    'Content-Type': 'application/json',
                                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                },
                                                body: JSON.stringify({
                                                    status: this.status
                                                })
                                            })
                                            .then(response => response.json())
                                            .then(data => {
                                                if (data.success) {
                                                    console.log('Status berhasil diupdate!');
                                
                                                } else {
                                                    console.error('Gagal update status.');
                                                }
                                            });
                                    }
                                }" class="relative w-fit">

                                    <select x-model="status" @change="updateStatus()" {{-- 2. @change trigger disini --}}
                                        :class="{
                                            'bg-green-200 text-green-800': status == 'Aktif',
                                            'bg-red-200 text-red-800': status == 'Nonaktif'
                                        }"
                                        class="text-xs font-semibold px-3 py-1.5 rounded-lg appearance-none pr-8 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">
                                        <option value="Aktif">Aktif</option>
                                        <option value="Nonaktif">Nonaktif</option>
                                    </select>

                                    {{-- Ini adalah Ikon Panah 1. absolute ...: Menempatkannya di atas <select> di sisi kanan. 2. pointer-events-none: Agar bisa di-klik 'tembus' ke <select> di bawahnya. 3. :class: Mengubah warna panah agar cocok dengan status. --}}
                                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none"
                                        :class="{
                                            'text-green-800': status === 'Aktif',
                                            'text-red-800': status === 'Nonaktif'
                                        }">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </div>

                                </div>
                            </td>
                        </tr>
                    @endforeach

                    {{-- Pagination (Footer Tabel) --}}
                    <nav class="pt-6 flex justify-between items-center text-sm">

                        {{-- Kiri: Link pagination--}}
                        {{ $customers->withQueryString()->links() }}

                        {{-- Kanan: Dropdown "per page" --}}
                        <div class="text-gray-400">
                            <form action="{{ route('admin.customer') }}" method="GET">

                                {{-- Input tersembunyi(hidden) ini PENTING --}}
                                {{-- Ini untuk menyimpan query 'search' Anda saat mengganti 'per_page' --}}
                                <input type="hidden" name="search" value="{{ request('search') }}">

                                <select name="per_page" onchange="this.form.submit()" {{-- Otomatis submit saat diganti --}}
                                    class="bg-gray-700 border border-gray-600 rounded-lg py-2 px-3 focus:outline-none focus:ring-1 focus:ring-blue-500">

                                    {{-- 
                                      @selected() adalah helper Blade untuk mengecek 
                                      request 'per_page' saat ini dan memilih option yang sesuai.
                                    --}}
                                    <option value="10" @selected(request('per_page', 10) == 10)>10/page</option>
                                    <option value="20" @selected(request('per_page') == 20)>20/page</option>
                                    <option value="50" @selected(request('per_page') == 50)>50/page</option>
                                </select>
                            </form>
                        </div>
                    </nav>
                </tbody>

        </div>

</x-LayoutAdmin>
