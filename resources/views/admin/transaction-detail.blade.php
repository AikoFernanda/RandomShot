<x-layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- WRAPPER --}}
    <div class="min-h-screen bg-[#181C14] text-[#F4EFE7] font-poppins p-4 md:p-8">

        {{-- HEADER: Tombol Kembali & Judul --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.transaction') }}"
                    class="p-2 rounded-full bg-white/5 hover:bg-[#e9d9c9] hover:text-black transition duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bebas tracking-wide text-white">
                        DETAIL TRANSAKSI <span class="text-[#e9d9c9]">#{{ $transaction->no_invoice }}</span>
                    </h1>
                    <p class="text-sm text-gray-400">
                        Dibuat pada {{ $transaction->created_at->translatedFormat('d F Y, H:i') }} WIB
                    </p>
                </div>
            </div>

            {{-- Status Badge Besar --}}
            <div>
                @php
                    $statusColor = match ($transaction->status_transaksi) {
                        'Paid' => 'bg-green-500/20 text-green-400 border-green-500/50',
                        'Unpaid' => 'bg-red-500/20 text-red-400 border-red-500/50',
                        'Pending' => 'bg-yellow-500/20 text-yellow-400 border-yellow-500/50',
                        'Cancelled' => 'bg-gray-500/20 text-gray-400 border-gray-500/50',
                        default => 'bg-white/10 text-white',
                    };
                @endphp
                <span
                    class="px-6 py-2 rounded-full text-sm font-bold border uppercase tracking-widest {{ $statusColor }}">
                    {{ $transaction->status_transaksi }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- KOLOM KIRI (2/3): Rincian Item --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- 1. INFO CUSTOMER --}}
                <div class="bg-[#1a1a19] border border-white/10 rounded-2xl p-6">
                    <h3 class="text-xl font-bebas text-[#e9d9c9] mb-4 border-b border-white/10 pb-2">Informasi Pelanggan
                    </h3>
                    <div class="flex items-center gap-4">
                        <div
                            class="w-12 h-12 rounded-full bg-gradient-to-br from-[#e9d9c9] to-[#c5b4a0] flex items-center justify-center text-black font-bold text-lg">
                            {{ substr($transaction->customer->nama ?? 'G', 0, 1) }}
                        </div>
                        <div>
                            <p class="font-bold text-lg text-white">
                                {{ $transaction->customer->nama ?? 'Guest / Terhapus' }}</p>
                            <div class="flex items-center gap-4 text-sm text-gray-400 mt-1">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    {{ $transaction->customer->no_telepon ?? '-' }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    {{ $transaction->customer->email ?? '-' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 2. RINCIAN RESERVASI MEJA --}}
                @if ($transaction->reservations->count() > 0)
                    <div class="bg-[#1a1a19] border border-white/10 rounded-2xl p-6">
                        <h3 class="text-xl font-bebas text-[#e9d9c9] mb-4 border-b border-white/10 pb-2">Reservasi Meja
                        </h3>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-300">
                                <thead class="text-xs uppercase bg-white/5 text-gray-400">
                                    <tr>
                                        <th class="px-4 py-3 rounded-l-lg">Meja</th>
                                        <th class="px-4 py-3">Tanggal</th>
                                        <th class="px-4 py-3">Jam</th>
                                        <th class="px-4 py-3 text-right rounded-r-lg">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaction->reservations as $res)
                                        <tr class="border-b border-white/5 last:border-0">
                                            <td class="px-4 py-4 font-medium text-white flex items-center gap-3">
                                                <div class="w-10 h-10 rounded bg-white/10 overflow-hidden">
                                                    <img src="{{ asset('img/' . ($res->table->nama_gambar ?? 'default.jpg')) }}"
                                                        class="w-full h-full object-cover">
                                                </div>
                                                {{ $res->table->nama ?? 'Meja Dihapus' }}
                                            </td>
                                            <td class="px-4 py-4">
                                                {{ \Carbon\Carbon::parse($res->tanggal_pemesanan)->format('d M Y') }}
                                            </td>
                                            <td class="px-4 py-4">
                                                <span class="bg-[#e9d9c9]/10 text-[#e9d9c9] px-2 py-1 rounded text-xs">
                                                    {{ \Carbon\Carbon::parse($res->waktu_mulai)->format('H:i') }} -
                                                    {{ \Carbon\Carbon::parse($res->waktu_selesai)->format('H:i') }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-4 text-right font-mono text-[#e9d9c9]">
                                                Rp {{ number_format($res->harga, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                {{-- 3. RINCIAN MENU --}}
                @if ($transaction->transactionDetails->count() > 0)
                    <div class="bg-[#1a1a19] border border-white/10 rounded-2xl p-6">
                        <h3 class="text-xl font-bebas text-[#e9d9c9] mb-4 border-b border-white/10 pb-2">Pesanan Menu
                        </h3>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-300">
                                <thead class="text-xs uppercase bg-white/5 text-gray-400">
                                    <tr>
                                        <th class="px-4 py-3 rounded-l-lg">Menu</th>
                                        <th class="px-4 py-3 text-center">Qty</th>
                                        <th class="px-4 py-3 text-right">Harga Satuan</th>
                                        <th class="px-4 py-3 text-right rounded-r-lg">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaction->transactionDetails as $detail)
                                        <tr class="border-b border-white/5 last:border-0 hover:bg-white/5 transition">
                                            <td class="px-4 py-4 font-medium text-white flex items-center gap-3">
                                                <div
                                                    class="w-10 h-10 rounded-full bg-white/10 overflow-hidden flex-shrink-0">
                                                    @if ($detail->menu && $detail->menu->nama_gambar)
                                                        <img src="{{ asset('img/menu/' . $detail->menu->nama_gambar) }}"
                                                            class="w-full h-full object-cover">
                                                    @else
                                                        <div
                                                            class="flex items-center justify-center h-full text-xs text-gray-500">
                                                            Img</div>
                                                    @endif
                                                </div>
                                                {{ $detail->menu->nama ?? 'Menu Dihapus' }}
                                            </td>
                                            <td class="px-4 py-4 text-center">x{{ $detail->quantity }}</td>
                                            <td class="px-4 py-4 text-right">Rp
                                                {{ number_format($detail->harga / $detail->quantity, 0, ',', '.') }}
                                            </td>
                                            <td class="px-4 py-4 text-right font-mono text-[#e9d9c9]">
                                                Rp {{ number_format($detail->harga, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

            </div>

            {{-- KOLOM KANAN (1/3): Pembayaran & Aksi --}}
            <div class="lg:col-span-1 space-y-6">

                {{-- 1. UPDATE STATUS --}}
                <div class="bg-[#1a1a19] border border-white/10 rounded-2xl p-6">
                    <h3 class="text-xl font-bebas text-white mb-4">STATUS TRANSAKSI</h3>

                    @if ($transaction->status_transaksi == 'Cancelled')
                        <div class="p-4 bg-red-900/20 border border-red-500/30 rounded-xl text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-500 mx-auto mb-2"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-red-400 font-bold">Transaksi Dibatalkan</p>
                            <p class="text-xs text-red-300 mt-1">Status tidak dapat diubah lagi.</p>
                        </div>
                    @else
                        @if ($errors->any())
                            <div class="bg-red-500 text-white p-4 mb-4 rounded">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form id="formUpdateStatus"
                            action="{{ route('admin.transaction.update', $transaction->transaction_id) }}"
                            method="POST" class="space-y-4">
                            @csrf
                            @method('PUT')

                            <div>
                                <label class="block text-xs text-gray-400 mb-1 uppercase tracking-wider">Pilih
                                    Status</label>

                                <select name="status_transaksi" id="statusSelect"
                                    class="w-full bg-[#0e0f0b] border border-white/20 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#e9d9c9] transition">

                                    @if ($transaction->status_transaksi == 'Unpaid')
                                        <option value="Unpaid" selected>
                                            Unpaid (Belum Bayar)
                                        </option>
                                    @endif

                                    <option value="Pending"
                                        {{ $transaction->status_transaksi == 'Pending' ? 'selected' : '' }}>
                                        Pending (Cek Bukti)
                                    </option>

                                    <option value="Paid"
                                        {{ $transaction->status_transaksi == 'Paid' ? 'selected' : '' }}>
                                        Paid (Lunas)
                                    </option>

                                    <option value="Cancelled" class="text-red-400 font-bold">
                                        Cancelled (Batalkan)
                                    </option>
                                </select>
                            </div>

                            <button type="button" onclick="confirmSubmit()"
                                class="w-full py-3 bg-[#e9d9c9] hover:bg-white text-black font-bold rounded-lg transition transform active:scale-95 shadow-lg">
                                SIMPAN PERUBAHAN
                            </button>
                        </form>

                        <div class="mt-4 text-xs text-gray-500 text-center">
                            *Mengubah status menjadi <b>Cancelled</b> bersifat permanen. Stok menu akan otomatis
                            dipulihkan.
                        </div>
                    @endif
                </div>

                {{-- BUKTI PEMBAYARAN --}}
                <div class="bg-[#1a1a19] border border-white/10 rounded-2xl p-6">
                    <h3 class="text-xl font-bebas text-white mb-4">BUKTI PEMBAYARAN</h3>

                    @if ($transaction->bukti_pembayaran)
                        <div class="relative group rounded-xl overflow-hidden border border-white/10">
                            <img src="{{ asset($transaction->bukti_pembayaran) }}" alt="Bukti Bayar"
                                class="w-full h-auto object-cover">

                            {{-- Overlay View --}}
                            <a href="{{ asset("$transaction->bukti_pembayaran") }}" target="_blank"
                                class="absolute inset-0 bg-black/60 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#e9d9c9] mb-2"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <span class="text-white text-sm font-bold">Lihat Ukuran Penuh</span>
                            </a>
                        </div>
                    @else
                        <div
                            class="py-8 bg-[#0e0f0b] border border-dashed border-white/20 rounded-xl flex flex-col items-center justify-center text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-2 opacity-50" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="text-sm">Belum ada bukti pembayaran</p>
                        </div>
                    @endif
                </div>

                {{-- TOTAL SUMMARY (REVISI UKURAN) --}}
                <div class="bg-[#e9d9c9] rounded-2xl p-6 text-black shadow-[0_0_20px_rgba(233,217,201,0.2)]">
                    <h3 class="text-sm font-bold border-b border-black/10 pb-3 mb-4 tracking-widest text-black/70">
                        RINGKASAN HARGA
                    </h3>

                    <div class="space-y-3 mb-6 text-sm">
                        <div class="flex justify-between items-center">
                            <span class="font-medium text-black/60">Metode Bayar</span>
                            <span class="font-bold bg-black/5 px-2 py-1 rounded text-xs uppercase tracking-wide">
                                {{ $transaction->metode_pembayaran }}
                            </span>
                        </div>
                        {{-- Contoh baris lain (kalau ada) --}}
                        {{-- <div class="flex justify-between"><span class="text-black/60">Pajak</span><span>Rp 0</span></div> --}}
                    </div>

                    {{-- BAGIAN TOTAL YANG DIPERBAIKI --}}
                    <div class="flex justify-between items-end pt-4 border-t border-black/10">
                        {{-- Label Total (Kecil & Rapi) --}}
                        <span class="font-bold text-xs uppercase tracking-widest text-black/60 mb-1">
                            Total Tagihan
                        </span>

                        {{-- Nominal (Angka Besar, Rp Kecil) --}}
                        <div class="flex items-baseline gap-1 text-black">
                            <span class="text-lg font-bold">Rp</span>
                            <span class="text-3xl font-bebas tracking-wide leading-none">
                                {{ number_format($transaction->total_transaksi, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <script>
        function confirmSubmit() {
            // Ambil value dari dropdown
            const selectedStatus = document.getElementById('statusSelect').value;
            let titleText = 'Simpan Perubahan?';
            let bodyText = 'Status transaksi akan diperbarui.';
            let iconType = 'question'; // Ikon default (tanda tanya)

            // Cek jika statusnya 'Cancelled'
            if (selectedStatus === 'Cancelled') {
                titleText = 'Batalkan Transaksi?';
                bodyText =
                    "PERINGATAN: Stok menu akan otomatis dikembalikan dan detail pesanan dihapus. Tindakan ini tidak dapat dibatalkan!";
                iconType = 'warning'; // Ikon peringatan (segitiga seru)
            }

            // Tampilkan SweetAlert dengan teks dinamis
            Swal.fire({
                title: titleText,
                text: bodyText,
                icon: iconType,
                showCancelButton: true,

                // Styling Tema
                background: '#1a1a19',
                color: '#F4EFE7',
                confirmButtonColor: '#e9d9c9',
                cancelButtonColor: '#3C3D37',
                confirmButtonText: '<span style="color:black; font-weight:bold;">Ya, Simpan</span>',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                focusConfirm: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('formUpdateStatus').submit();
                }
            });
        }
    </script>
</x-layout-admin>
