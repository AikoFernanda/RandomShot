<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="min-h-screen bg-[#0e0f0b] text-white px-8 pt-20 pb-16">
{{-- {{ dd(session('cart.reservation'), session('cart.items'), session('cart'), $items) }}  --}}
        {{-- BACK + TITLE --}}
        <div class="flex items-center gap-4 mb-12">
            <a href="{{ route('customer.cart') }}"
                class="w-10 h-10 bg-black/40 rounded-full flex items-center justify-center 
                  text-white text-2xl backdrop-blur hover:bg-white/20">←
            </a>

            <h1 class="text-5xl tracking-wide">
                PEMBAYARAN
            </h1>
        </div>

        {{-- GRID 2 KOLOM --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

            {{-- ================= LEFT: DETAIL PESANAN ================= --}}
            <div class="bg-white/10 border border-white/20 rounded-xl p-6">

                <h2 class="text-3xl mb-4">Detail Pesanan</h2>

                <p class="text-gray-300 text-sm mb-2">Item</p>

                @if ($reservationData)
                    <div class="text-sm">
                        <p>Meja</p>
                    </div>
                    <div class="flex justify-between text-xs mb-2">
                        <div>
                            <p class="text-gray-400 italic">{{ $reservationData['nama'] }}
                                ({{ count($reservationData['slots']) }} jam)</p>
                        </div>
                        <p>Rp{{ number_format($reservationData['total_price'], 0, '.', '.') }}</p>
                    </div>
                @endif

                @if ($itemsData)
                    <div class="text-sm {{ $reservationData ? 'mt-4' : '' }}"> {{-- Beri jarak jika Meja ada --}}
                        <p>Cafe</p>
                    </div>
                    @foreach ($itemsData as $item)
                        <div class="flex justify-between text-xs mt-0">
                            <div>
                                <p class="text-gray-400 italic">{{ $item['nama'] }} ({{ $item['qty'] }})</p>
                            </div>
                            <p>Rp {{ number_format($item['harga'] * $item['qty'], 0, ',', '.') }}</p>
                        </div>
                    @endforeach
                @endif

                {{-- ALAMAT MEJA --}}
                @if (session('cart.selected_table'))
                <div class="mt-6">
                    <label class="text-sm">Alamat meja</label>
                    <div
                        class="flex justify-between items-center border border-white/30 rounded-full px-4 py-2 mt-2">
                        <p class="text-sm text-gray-300">{{ $selectedTable['nama'] }}</p>
                    </div>
                </div>
                @endif

                {{-- PAYMENT --}}
                <div class="mt-4">
                    <label class="text-sm">Metode Pembayaran</label>
                    <div
                        class="flex justify-between items-center border border-white/30 rounded-full px-4 py-2 mt-2">
                        <p class="text-sm text-gray-300">QRIS</p>
                    </div>
                </div>

                {{-- SUBTOTAL --}}
                <div class="flex justify-between items-center mt-6 text-lg font-bold">
                    <p>Sub Total :</p>
                    <p>{{ $totalPrice }}</p>
                </div>

            </div>


            {{-- QR PAYMENT --}}
            <div class="bg-[#e9d9c9] text-black border border-white/10 rounded-xl p-10 text-center">

                <p class="font-semibold text-lg leading-relaxed">
                    Pindai kode QR dibawah dengan<br>
                    dompet digitalmu!
                </p>

                <div class="mt-6 flex justify-center">
                    <img src="{{ asset('img/qr.png') }}"
                        class="w-64 h-64 bg-white border-4 border-white rounded-lg object-contain">
                </div>

                <p class="text-center mt-2 text-sm">05.10</p>

                <p class="text-center text-sm mt-1">
                    Didukung oleh
                    <img src="{{ asset('img/qris.png') }}" class="w-10 inline-block">
                </p>

                <button
                    class="mt-6 w-full py-3 bg-black hover:bg-black/80 border border-white 
                           text-white font-bold rounded-full">
                    Konfirmasi Pembayaran
                </button>

            </div>

        </div>

    </section>

</x-Layout>
