<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    {{ dd($activities) }}
    <section class="min-h-screen bg-black text-[#F4EFE7] flex">

        {{-- SIDEBAR --}}
        <aside class="w-72 bg-[#2e2e2c] py-24 px-8 flex flex-col">
            <h2 class="text-3xl">HALO,</h2>
            <h1 class="text-5xl mb-10 uppercase">PENGGUNA!</h1>

            <a href="{{ route('customer.profile') }}" 
               class="w-full py-3 rounded-xl bg-transparent mb-3 text-center hover:bg-white/10 transition-colors">
               Informasi Akun
            </a>

            <a href="{{ route('customer.profile.activity') }}" 
               class="w-full py-3 bg-black/40 border border-[#F4EFE7] rounded-xl text-[#F4EFE7] text-center">
               Aktivitas Saya
            </a>
        </aside>


        {{-- MAIN CONTENT --}}
        <main class="flex-1 py-24">
            
            @php
                // Di halaman ini, kita diasumsikan menampilkan aktivitas Reservasi Meja (default index)
                $isReservasiView = true; 
            @endphp

            {{-- HEADER BUTTONS (Navigasi Antar Tipe Aktivitas) --}}
            <div class="flex justify-end gap-3 mb-6 mr-8">
                {{-- Tombol Reservasi Meja (Active) --}}
                <a href="{{ route('customer.profile.activity') }}"
                   class="px-4 py-2 bg-[#F4EFE7]/30 rounded-md border border-[#F4EFE7] text-[#F4EFE7] text-sm">
                   Reservasi Meja
                </a>

                {{-- Tombol Menu Cafe (Inactive) --}}
                <a href="{{ route('customer.profile.activity.cafe') }}"
                   class="px-4 py-2 bg-transparent rounded-md border border-[#F4EFE7]/50 text-[#F4EFE7]/80 text-sm hover:bg-white/10 transition-colors">
                   Menu Cafe
                </a>
            </div>

            {{-- TAB TITLE --}}
            <h2 class="text-4xl ml-6 mb-6">Aktivitas Reservasi Meja</h2>
            <div class="space-y-5">

                @forelse ($activities as $activity)
                    @php
                        // 1. Tentukan status visual (warna) berdasarkan status_pesanan
                        $status = $activity['status_pesanan'];
                        $borderColor = 'border-yellow-400';
                        $textColor = 'text-yellow-400';
                        $statusText = $status;

                        if (in_array($status, ['Berhasil Reservasi', 'Selesai', 'PAID', 'Menunggu Check-in'])) {
                            $borderColor = 'border-green-400';
                            $textColor = 'text-green-400';
                        } elseif (in_array($status, ['Gagal', 'Dibatalkan', 'Reservasi Gagal'])) {
                            $borderColor = 'border-red-400';
                            $textColor = 'text-red-400';
                        }
                        
                        // Ambil grup slot pertama
                        $firstGroup = $activity['slot_groups']->first();
                        
                        // Gambar (Asumsi menggunakan placeholder karena tidak ada kolom gambar di Model Table)
                        $gambarSrc = asset('img/biliar.jpeg');
                    @endphp
                    
                    {{-- CARD DINAMIS --}}
                    <div class="ml-6 mr-6 flex bg-[#141414] rounded-xl border border-[#F4EFE7] 
                                overflow-hidden relative">

                        <img src="{{ $gambarSrc }}" 
                             class="w-40 h-28 object-cover">

                        <div class="p-4 flex-1">
                            {{-- Nama Item/Meja --}}
                            <h3 class="text-2xl">{{ $activity['nama_item'] }}</h3>
                            
                            @if ($firstGroup)
                                {{-- Loop untuk setiap kelompok slot (jika ada lebih dari satu tanggal) --}}
                                @foreach ($activity['slot_groups'] as $group)
                                    <p class="text-gray-400 text-sm mt-1">
                                        {{ $group['tanggal'] }} | 
                                        {{ $group['waktu_mulai'] }} – {{ $group['waktu_selesai'] }} WIB
                                    </p>
                                    @if ($group['jumlah_slot'] > 1)
                                        <p class="text-gray-500 text-xs">({{ $group['jumlah_slot'] }} jam)</p>
                                    @endif
                                @endforeach
                            @endif

                            <p class="text-gray-400 text-xs mt-3">Invoice: {{ $activity['no_invoice'] }}</p>
                        </div>

                        {{-- GARIS STATUS --}}
                        <div class="absolute right-0 top-0 bottom-0 border-r-4 {{ $borderColor }}"></div>
                        <p class="text-sm absolute right-4 bottom-3 {{ $textColor }}">
                            {{ $statusText }}
                        </p>
                    </div>

                @empty
                    {{-- Tampilan Jika Tidak Ada Aktivitas --}}
                    <div class="ml-6 mr-6 text-center py-10 bg-white/5 border border-white/10 rounded-xl">
                        <p class="text-xl text-gray-400">Anda belum memiliki riwayat reservasi meja.</p>
                        <a href="{{ route('reservation') }}" class="mt-4 inline-block text-red-400 hover:text-red-300 transition-colors">
                            Mulai Reservasi Sekarang
                        </a>
                    </div>
                @endforelse

            </div>
        </main>
    </section>
</x-Layout>