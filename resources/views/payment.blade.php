<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="min-h-screen bg-[#0e0f0b] text-white px-8 pt-20 pb-16 flex flex-col items-center">

        {{-- CONTAINER UTAMA --}}
        <div class="w-full max-w-5xl space-y-8">

            {{-- 1. HEADER & TIMER GROUP --}}
            <div class="flex flex-col gap-6">
                {{-- Back & Title --}}
                <div class="flex items-center gap-4">
                    <h1 class="text-5xl font-bebas tracking-wide">
                        PEMBAYARAN
                    </h1>
                </div>

                {{-- TIMER --}}
                @php
                    $deadline = $transaction->created_at
                        ? $transaction->created_at->addMinutes(2)
                        : now()->addMinutes(2);
                    $sisaDetik = now()->diffInSeconds($deadline, false);
                @endphp

                @if ($transaction->status_transaksi == 'Unpaid' && $sisaDetik > 0)
                    <div x-data="{
                        timeLeft: {{ $sisaDetik }},
                    
                        formatTime(seconds) {
                            // 1. Bulatkan total detik ke bawah (hilangkan koma)
                            seconds = Math.floor(seconds);
                    
                            // 2. Hitung menit
                            const m = Math.floor(seconds / 60).toString().padStart(2, '0');
                    
                            // 3. Hitung sisa detik
                            const s = (seconds % 60).toString().padStart(2, '0');
                    
                            return `${m}:${s}`;
                        },
                        // ------------------------------
                    
                        init() {
                            const timer = setInterval(() => {
                                if (this.timeLeft > 0) {
                                    this.timeLeft--;
                                } else {
                                    clearInterval(timer);
                                    window.location.href = '{{ route('home') }}';
                                }
                            }, 1000);
                        }
                    }"
                        class="w-full bg-red-500/10 border border-red-500/20 text-red-200 px-4 py-3 rounded-lg flex items-center gap-3 backdrop-blur-sm">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400 animate-pulse" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                        <span class="text-sm font-medium">
                            Selesaikan pembayaran dalam <span x-text="formatTime(timeLeft)"
                                class="font-mono font-bold text-red-400"></span> menit.
                        </span>
                    </div>
                @endif
            </div>

            {{-- 2. GRID CONTENT UTAMA --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">

                {{-- ================= KIRI: INFO & UPLOAD ================= --}}
                <div class="flex flex-col gap-8">
                    {{-- Form Utama (Remote Control) --}}
                    <form id="payment-form" action="{{ route('customer.payment.validation') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="transaction_id" value="{{ $transaction->transaction_id }}">
                    </form>

                    {{-- INFO TAGIHAN --}}
                    <div class="bg-white/5 border border-white/10 rounded-xl p-8 space-y-6">
                        <div>
                            <p class="text-gray-400 text-sm mb-1">No. Invoice</p>
                            <p class="text-3xl font-bebas tracking-wider text-[#e9d9c9]">
                                #{{ $transaction->no_invoice }}
                            </p>
                        </div>
                        <div class="w-full h-px bg-white/10"></div>
                        <div>
                            <p class="text-gray-400 text-sm mb-1">Total Pembayaran</p>
                            <p class="text-4xl font-bold font-bebas tracking-wide">
                                Rp{{ number_format($transaction->total_transaksi, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    {{-- UPLOAD BUKTI --}}
                    <div class="bg-white/5 border border-white/10 rounded-xl p-8">
                        <label for="proof" class="block text-lg font-semibold mb-4">
                            Upload Bukti Pembayaran
                        </label>
                        <div class="relative">
                            <input type="file" id="proof" name="proof" required form="payment-form"
                                accept="image/jpeg, image/png, image/jpg"
                                class="block w-full text-sm text-gray-400
                                file:mr-4 file:py-3 file:px-6
                                file:rounded-full file:border-0
                                file:text-sm file:font-bold
                                file:bg-[#e9d9c9] file:text-black
                                file:cursor-pointer hover:file:bg-white
                                border border-white/20 rounded-lg cursor-pointer
                                bg-black/20 focus:outline-none focus:border-[#e9d9c9]
                                p-2" />
                        </div>
                        @error('proof')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- ================= KANAN: QRIS & ACTIONS ================= --}}
                <div class="flex flex-col gap-6">

                    {{-- KARTU QRIS --}}
                    <div class="bg-[#e9d9c9] text-black border border-white/10 rounded-xl p-10 text-center shadow-2xl">
                        {{-- ... (Isi QRIS Sama seperti sebelumnya) ... --}}
                        <div class="flex justify-between items-start mb-4">
                            <img src="{{ asset('img/qris.png') }}" class="h-8 opacity-80" alt="Logo QRIS">
                            <span class="bg-black/10 px-2 py-1 rounded text-xs font-bold">SCAN ME</span>
                        </div>
                        <p class="font-semibold text-lg leading-relaxed mb-6">
                            Pindai kode QR dibawah
                        </p>
                        <div class="flex justify-center mb-4">
                            <div class="bg-white p-2 rounded-lg shadow-inner">
                                <img src="{{ asset('img/qr.png') }}" class="w-64 h-64 object-contain">
                            </div>
                        </div>
                        <p class="text-sm font-medium opacity-70">RANDOM SHOT POOL & CAFE</p>
                    </div>

                    {{-- GROUP TOMBOL (Menyatu Vertikal) --}}
                    <div class="flex flex-col gap-3">
                        {{-- 1. Tombol Konfirmasi (Primary) --}}
                        <button type="submit" form="payment-form"
                            class="w-full py-4 bg-white hover:bg-gray-200 text-black 
                                   font-bebas text-xl tracking-widest rounded-full shadow-lg 
                                   transition transform hover:scale-[1.01] active:scale-95">
                            KONFIRMASI PEMBAYARAN
                        </button>

                        {{-- 2. Tombol Batalkan (Secondary/Text Link) --}}
                        <form action="{{ route('customer.payment.cancel') }}" method="POST" class="w-full"
                            onsubmit="return confirm('Yakin ingin membatalkan pesanan?');">
                            @csrf
                            <input type="hidden" name="transaction_id" value="{{ $transaction->transaction_id }}">

                            {{-- Desain Tombol Cancel yang lebih 'sopan' dan tidak mencolok --}}
                            <button type="submit"
                                class="w-full py-2 text-sm text-red-400 hover:text-red-300 
                                           transition underline decoration-red-500/30 hover:decoration-red-300">
                                Batalkan Pesanan
                            </button>
                        </form>
                    </div>

                </div>

            </div> {{-- End Grid --}}

        </div> {{-- End Container --}}
    </section>
</x-Layout>
