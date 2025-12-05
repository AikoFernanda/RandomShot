
    <x-Layout>
        <x-slot:title>{{ $title }}</x-slot:title>

        @php
            $isReservationFlow = session()->has('cart.reservation');
            $isLoggedIn = session()->has('user_id');
        @endphp

        <section class="min-h-screen bg-[#0e0f0b] text-[#F4EFE7] font-poppins pb-32">

            {{-- 1. HEADER (Parallax Effect) --}}
            <div class="relative w-full h-[300px] overflow-hidden group">
                <div class="absolute inset-0 bg-cover bg-center"
                    style="background-image: url('{{ asset('img/headercafe.png') }}');">
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-[#0e0f0b] via-[#0e0f0b]/60 to-transparent"></div>

                <div class="absolute bottom-0 left-0 w-full p-6 md:p-10 z-10 flex flex-col items-center text-center">
                    @if ($isReservationFlow)
                        <div
                            class="inline-block px-3 py-1 rounded-full bg-[#e9d9c9] text-black text-xs font-bold uppercase tracking-wider mb-3">
                            Langkah 2</div>
                        <h1 class="text-4xl md:text-6xl font-bebas tracking-wide text-[#e9d9c9] drop-shadow-lg mb-2">
                            TAMBAH MENU</h1>
                        <p class="text-sm md:text-base text-gray-300 max-w-2xl">
                            Meja aman! Sekarang pilih camilan atau minuman segar buat nemenin main biliar kalian.
                        </p>
                    @else
                        <h1 class="text-5xl md:text-7xl font-bebas tracking-wide text-[#e9d9c9] drop-shadow-lg mb-2">
                            CAFE MENU</h1>
                        <p class="text-sm md:text-base text-gray-300 max-w-2xl">
                            Santai sejenak dan nikmati hidangan lezat dari Random Shot! Cocok buat nongkrong atau isi
                            energi.
                        </p>
                    @endif
                </div>
            </div>

            {{-- 2. KATEGORI (Capsule Style) --}}
            <div
                class="top-20 z-30 bg-[#0e0f0b]/90 backdrop-blur-md border-b border-white/5 py-4 mb-8 shadow-lg">
                <div class="flex justify-center gap-4">
                    <a href="{{ route('cafe', ['kategori' => 'Makanan']) }}"
                        class="px-6 py-2 rounded-full text-sm font-bold transition-all duration-300 border 
                    {{ request('kategori') == 'Makanan'
                        ? 'bg-[#e9d9c9] text-black border-[#e9d9c9] shadow-[0_0_15px_rgba(233,217,201,0.4)]'
                        : 'bg-white/5 text-gray-400 border-white/10 hover:bg-white/10 hover:text-white' }}">
                         Makanan
                    </a>

                    <a href="{{ route('cafe', ['kategori' => 'Minuman']) }}"
                        class="px-6 py-2 rounded-full text-sm font-bold transition-all duration-300 border
                    {{ request('kategori') == 'Minuman'
                        ? 'bg-[#e9d9c9] text-black border-[#e9d9c9] shadow-[0_0_15px_rgba(233,217,201,0.4)]'
                        : 'bg-white/5 text-gray-400 border-white/10 hover:bg-white/10 hover:text-white' }}">
                         Minuman
                    </a>
                </div>
            </div>

            {{-- 3. GRID MENU --}}
            <div class="container mx-auto px-6 md:px-10">
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">

                    @forelse($menus as $menu)
                        @php
                            $cart = session('cart.items', []);
                            $currentQty = isset($cart[$menu->menu_id]) ? $cart[$menu->menu_id]['qty'] : 0;
                        @endphp

                        <div x-data="{
                            qty: {{ $currentQty }},
                            menuId: {{ $menu->menu_id }},
                            isLoggedIn: {{ $isLoggedIn ? 'true' : 'false' }},
                        
                            updateCart(newQty) {
                                if (!this.isLoggedIn) {
                                    window.location.href = '{{ route('login') }}';
                                    return;
                                }
                                this.qty = newQty;
                                fetch('{{ route('customer.cart.update') }}', {
                                        method: 'POST',
                                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                                        body: JSON.stringify({ id: this.menuId, qty: this.qty })
                                    })
                                    .then(res => res.json())
                                    .then(data => {
                                        window.dispatchEvent(new CustomEvent('cart-updated', {
                                            detail: { totalQty: data.totalQty, totalPrice: data.totalPrice }
                                        }));
                                    });
                            }
                        }"
                            class="group relative bg-[#1a1a19] border border-white/5 rounded-2xl overflow-hidden hover:border-[#e9d9c9]/50 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl
                         {{ $menu->stok == 0 ? 'opacity-60 grayscale' : '' }}">

                            {{-- Image Container --}}
                            <div
                                class="aspect-square w-full bg-[#252525] p-4 flex items-center justify-center relative overflow-hidden">
                                @if ($menu->stok == 0)
                                    <div
                                        class="absolute inset-0 bg-black/70 flex items-center justify-center z-10 backdrop-blur-[2px]">
                                        <span
                                            class="border border-red-500 text-red-500 bg-red-500/10 font-bold text-xs px-3 py-1 -rotate-12 tracking-widest uppercase rounded-md">
                                            HABIS
                                        </span>
                                    </div>
                                @endif
                                <img src="{{ asset('img/menu/' . $menu->nama_gambar) }}" alt="{{ $menu->nama }}"
                                    class="w-full h-full object-contain drop-shadow-lg group-hover:scale-110 transition duration-500">
                            </div>

                            {{-- Info Menu --}}
                            <div class="p-4">
                                <h3
                                    class="text-white text-sm font-bold leading-tight line-clamp-2 min-h-[2.5em] mb-1 group-hover:text-[#e9d9c9] transition">
                                    {{ $menu->nama }}
                                </h3>
                                <div class="flex items-center justify-between mb-3">
                                    <p class="text-[#e9d9c9] font-bold text-sm">
                                        Rp{{ number_format($menu->harga, 0, ',', '.') }}
                                    </p>
                                    <p
                                        class="text-[10px] {{ $menu->stok < 5 && $menu->stok > 0 ? 'text-red-400 font-bold animate-pulse' : 'text-gray-500' }}">
                                        @if ($menu->stok > 0)
                                            Stok: {{ $menu->stok }}
                                        @endif
                                    </p>
                                </div>

                                {{-- Tombol Aksi --}}
                                @if ($menu->stok > 0)
                                    @if (!$isLoggedIn)
                                        <a href="{{ route('login.required') }}"
                                            class="block w-full py-2 rounded-lg bg-white/10 hover:bg-[#e9d9c9] hover:text-black text-xs font-bold text-center transition">
                                            + Tambah
                                        </a>
                                    @else
                                        {{-- Tombol Add Awal --}}
                                        <button x-show="qty === 0" @click="updateCart(1)"
                                            class="w-full py-2 rounded-lg bg-white/10 text-white text-xs font-bold hover:bg-[#e9d9c9] hover:text-black transition flex items-center justify-center gap-1 group/btn">
                                            <span>Tambah</span>
                                            <svg class="w-3 h-3 transition-transform group-hover/btn:translate-x-0.5"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4v16m8-8H4" />
                                            </svg>
                                        </button>

                                        {{-- Counter --}}
                                        <div x-show="qty > 0"
                                            class="flex items-center justify-between bg-[#e9d9c9] rounded-lg p-1"
                                            style="display: none;">
                                            <button @click="updateCart(qty-1)"
                                                class="w-6 h-6 flex items-center justify-center bg-black/10 hover:bg-black/20 rounded text-black font-bold transition">−</button>
                                            <span class="text-black text-xs font-bold w-6 text-center"
                                                x-text="qty"></span>
                                            <button @click="updateCart(qty+1)" :disabled="qty >= {{ $menu->stok }}"
                                                :class="qty >= {{ $menu->stok }} ? 'opacity-30 cursor-not-allowed' :
                                                    'hover:bg-black/20'"
                                                class="w-6 h-6 flex items-center justify-center bg-black/10 rounded text-black font-bold transition">+</button>
                                        </div>
                                    @endif
                                @else
                                    <button disabled
                                        class="w-full py-2 rounded-lg bg-white/5 text-gray-500 text-xs font-bold cursor-not-allowed border border-white/5">
                                        Sold Out
                                    </button>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div
                            class="col-span-full py-20 text-center flex flex-col items-center justify-center text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-4 opacity-30" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <p class="text-lg font-medium">Menu kategori ini lagi kosong nih :(</p>
                            <p class="text-sm opacity-60">Coba cek kategori sebelah yuk!</p>
                        </div>
                    @endforelse

                </div>
            </div>

        </section>

        {{-- FOOTER TOTAL --}}
        @if ($isLoggedIn)
            @php
                $itemsQty = 0;
                $itemsPrice = 0;
                if (session('cart.items')) {
                    foreach (session('cart.items') as $item) {
                        $itemsQty += $item['qty'];
                        $itemsPrice += $item['harga'] * $item['qty'];
                    }
                }
                $reservation = session('cart.reservation');
                $reservationPrice = $reservation['total_price'] ?? 0;
                if ($reservation) {
                    $itemsQty += 1;
                }
                $grandTotal = $itemsPrice + $reservationPrice;
            @endphp

            <div x-data="{
                totalQty: {{ $itemsQty }},
                totalPrice: {{ $grandTotal }}
            }"
                @cart-updated.window="totalQty = $event.detail.totalQty; totalPrice = $event.detail.totalPriceInt || $event.detail.totalPrice.replace(/\./g, '')"
                x-show="totalQty > 0 || {{ session()->has('cart.reservation') ? 'true' : 'false' }}"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-full"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-full"
                class="fixed bottom-4 left-0 right-0 z-50 px-4 md:px-0 flex justify-center pointer-events-none"
                style="display: none;">

                <div
                    class="pointer-events-auto bg-[#1a1a19]/95 backdrop-blur-md border border-white/10 shadow-[0_4px_20px_rgb(0,0,0,0.5)] rounded-xl p-2.5 w-full max-w-lg flex items-center justify-between gap-3">

                    {{-- Kiri: Info Total --}}
                    <div class="flex flex-col pl-2">
                        <span
                            class="text-[10px] text-gray-400 font-medium uppercase tracking-wider leading-none mb-0.5">
                            @if (session()->has('cart.reservation'))
                                Total Estimasi
                            @else
                                Total Pesanan
                            @endif
                        </span>
                        <div class="flex items-baseline gap-1">
                            <span class="text-[#e9d9c9] font-bold text-sm">Rp</span>
                            <span class="text-white font-bebas text-xl md:text-2xl tracking-wide"
                                x-text="new Intl.NumberFormat('id-ID').format(totalPrice)"></span>
                        </div>
                    </div>

                    {{-- Kanan: Tombol Checkout --}}
                    <a href="{{ route('customer.cart') }}"
                        class="group bg-[#e9d9c9] hover:bg-white text-black px-5 py-2 rounded-lg transition duration-300 flex items-center gap-2 shadow-md hover:shadow-[#e9d9c9]/20 transform active:scale-95">

                        <div class="relative">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 text-black transition-transform group-hover:-rotate-12" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            {{-- Badge --}}
                            <span
                                class="absolute -top-1.5 -right-1.5 bg-black text-white text-[9px] font-bold h-3.5 w-3.5 rounded-full flex items-center justify-center border border-[#e9d9c9]"
                                x-text="totalQty"></span>
                        </div>

                        <span class="font-bold text-xs md:text-sm uppercase tracking-wider">Lanjut</span>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-3.5 w-3.5 transform transition-transform group-hover:translate-x-1"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>
        @endif

    </x-Layout>
