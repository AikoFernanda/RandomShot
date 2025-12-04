<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="min-h-screen bg-[#0e0f0b] text-white px-4 py-20 flex justify-center items-center">

        {{-- STRUK KERTAS DIGITAL --}}
        <div class="bg-white text-black w-full max-w-md rounded-xl shadow-2xl overflow-hidden relative">

            {{-- Hiasan Gerigi Kertas (Atas) --}}
            <div class="absolute top-0 left-0 w-full h-4 bg-[#0e0f0b]"
                style="clip-path: polygon(0 0, 5% 100%, 10% 0, 15% 100%, 20% 0, 25% 100%, 30% 0, 35% 100%, 40% 0, 45% 100%, 50% 0, 55% 100%, 60% 0, 65% 100%, 70% 0, 75% 100%, 80% 0, 85% 100%, 90% 0, 95% 100%, 100% 0);">
            </div>

            <div class="p-8 pt-12 text-center">

                {{-- LOGO / BRAND --}}
                <h2 class="font-bebas text-3xl tracking-wider mb-1">RANDOM SHOT</h2>
                <p class="text-xs text-gray-500 uppercase tracking-widest mb-6">Pool & Cafe</p>

                {{-- STATUS BADGE --}}
                <div
                    class="inline-block bg-yellow-100 border border-yellow-300 text-yellow-800 px-4 py-2 rounded-full mb-8">
                    <div class="flex items-center gap-2">
                        {{-- Icon Jam Pasir (SVG) --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 animate-pulse" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-xs font-bold uppercase tracking-wide">Menunggu Konfirmasi Admin</span>
                    </div>
                </div>

                {{-- INFO UTAMA --}}
                <div class="space-y-4 mb-8">
                    <div>
                        <p class="text-gray-400 text-xs uppercase">No. Invoice</p>
                        <p class="font-mono text-xl font-bold">#{{ $transaction->no_invoice }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs uppercase">Total Pembayaran</p>
                        <p class="font-bebas text-4xl">Rp{{ number_format($transaction->total_transaksi, 0, ',', '.') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs uppercase">Tanggal</p>
                        <p class="text-sm font-medium">
                            {{ optional($transaction->created_at)->timezone('Asia/Jakarta')->format('d M Y, H:i') ?? now()->format('d M Y, H:i') }}
                            WIB
                        </p>
                    </div>
                </div>

                {{-- GARIS PUTUS-PUTUS --}}
                <div class="border-t-2 border-dashed border-gray-300 my-6"></div>

                {{-- PESAN --}}
                <p class="text-sm text-gray-600 leading-relaxed mb-8">
                    Terima kasih! Bukti pembayaran Anda telah kami terima. 
                    Silakan cek status transaksi secara berkala pada riwayat transaksi Anda. Hubungi kami jika status tidak segera berubah.
                </p>

                {{-- TOMBOL AKSI --}}
                <div class="space-y-3">
                    <a href="{{route('home')}}"
                        class="block w-full py-3 bg-black text-white font-bold rounded-lg hover:bg-gray-800 transition">
                        Kembali ke Beranda
                    </a>

                    <a href="#"
                        class="block w-full py-3 border border-gray-300 text-gray-600 font-bold rounded-lg hover:bg-gray-50 transition">
                        Beri Rating
                    </a>
                </div>

            </div>

            {{-- Hiasan Gerigi Kertas (Bawah) --}}
            <div class="absolute bottom-0 left-0 w-full h-4 bg-[#0e0f0b]"
                style="clip-path: polygon(0 100%, 5% 0, 10% 100%, 15% 0, 20% 100%, 25% 0, 30% 100%, 35% 0, 40% 100%, 45% 0, 50% 100%, 55% 0, 60% 100%, 65% 0, 70% 100%, 75% 0, 80% 100%, 85% 0, 90% 100%, 95% 0, 100% 100%);">
            </div>

        </div>

    </section>
</x-Layout>
