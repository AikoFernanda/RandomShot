<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    @php
        $isReservationFlow = session()->has('cart.reservation');
        // Cek apakah user sudah login
        $isLoggedIn = session()->has('user_id'); 
    @endphp

    {{-- SECTION HEADER --}}
    <div class="relative w-full h-[300px] pt-24">
        <img src="{{ asset('img/headercafe.png') }}" class="absolute inset-0 w-full h-full object-cover opacity-50">

        <div class="relative z-10 text-[#F4EFE7] ml-10 pt-10">
            @if ($isReservationFlow)
                <h1 class="text-6xl mb-3 font-bold">Langkah 2: Tambah Menu</h1>
                <p class="mb-10 text-lg sm:text-base md:text-lg lg:text-xl leading-relaxed pr-12 max-w-4xl">
                    Meja Anda sudah disimpan. Pilih menu menu yang ingin ditambahkan untuk dinikmati
                    bersama saat bermain meja Anda.
                </p>
            @else
                <h1 class="text-7xl mb-1">Menu Cafe</h1>
                <p class="mb-10 text-sm sm:text-base md:text-lg lg:text-xl leading-relaxed pr-12 max-w-6xl">
                    Santai sejenak dan nikmati hidangan lezat dari Menu Cafe Random Shot!
                    Cocok buat kamu yang cuma ingin nongkrong, ngopi, atau mengisi energi!
                </p>
            @endif
        </div>
    </div>

    {{-- KATEGORI MENU --}}
    <div class="grid grid-cols-2 gap-3 w-full max-w-md ml-17 mb-10 pr-10 mt-10">
        <a href="{{ route('cafe', ['kategori' => 'Makanan']) }}"
            class="border p-2 sm:p-3 md:p-4 text-center font-semibold text-sm sm:text-base md:text-lg rounded-xl transition duration-300
                {{ request('kategori') == 'Makanan' ? 'bg-[#F4EFE7] text-[#181C14]' : 'text-[#F4EFE7] hover:bg-[#FFF2E0]/20' }}">
            Makanan
        </a>

        <a href="{{ route('cafe', ['kategori' => 'Minuman']) }}"
            class="border p-2 sm:p-3 md:p-4 text-center font-semibold text-sm sm:text-base md:text-lg rounded-xl transition duration-300
                {{ request('kategori') == 'Minuman' ? 'bg-[#F4EFE7] text-[#181C14]' : 'text-[#F4EFE7] hover:bg-[#FFF2E0]/20' }}">
            Minuman
        </a>
    </div>

    {{-- GRID MENU --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 w-[90%] mx-auto pb-28">

        @forelse($menus as $menu)
            @php
                $cart = session('cart.items', []);
                $currentQty = isset($cart[$menu->menu_id]) ? $cart[$menu->menu_id]['qty'] : 0;
            @endphp

            <div x-data="{
                qty: {{ $currentQty }},
                menuId: {{ $menu->menu_id }},
                isLoggedIn: {{ $isLoggedIn ? 'true' : 'false' }}, // Kirim status login ke JS
            
                updateCart(newQty) {
                    // Double check di JS, walau di HTML sudah dicegah
                    if (!this.isLoggedIn) {
                        window.location.href = '{{ route('login') }}'; // Redirect ke login
                        return;
                    }

                    this.qty = newQty;
            
                    fetch('{{ route('customer.cart.update') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                id: this.menuId,
                                qty: this.qty
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            window.dispatchEvent(new CustomEvent('cart-updated', {
                                detail: {
                                    totalQty: data.totalQty,
                                    totalPrice: data.totalPrice
                                }
                            }));
                        });
                }
            }"
                class="rounded-xl border-2 border-[#F4EFE7] p-4 h-full flex flex-col justify-between duration-300
                     {{ $menu->stok == 0 ? 'opacity-60 grayscale cursor-not-allowed' : 'hover:scale-105 transition' }}">

                {{-- INFORMASI MENU --}}
                <div>
                    <div class="relative border-2 bg-[#3C3D37] border-[#F4EFE7] rounded-xl w-full aspect-square flex items-center justify-center overflow-hidden">
                        @if ($menu->stok == 0)
                            <div class="absolute inset-0 bg-black/60 flex items-center justify-center z-10">
                                <span class="border-2 border-red-500 text-red-500 font-bold text-2xl px-4 py-1 -rotate-12 tracking-widest uppercase">
                                    HABIS
                                </span>
                            </div>
                        @endif
                        <img src="{{ asset('img/menu/' . $menu->nama_gambar) }}" alt="{{ $menu->nama }}" class="w-3/4 h-3/4 object-contain">
                    </div>

                    <h3 class="text-[#F4EFE7] text-2xl mt-4 leading-tight">{{ $menu->nama }}</h3>
                    <p class="text-[#F4EFE7] font-medium text-lg mt-1 opacity-90">
                        Rp{{ number_format($menu->harga, 0, ',', '.') }}
                    </p>
                    <p class="text-xs mt-1 {{ $menu->stok == 0 ? 'text-red-400 font-bold' : 'text-gray-400' }}">
                        Stok: {{ $menu->stok }}
                    </p>
                </div>

                {{-- TOMBOL AKSI --}}
                <div class="mt-4 flex justify-center">

                    @if ($menu->stok > 0)
                        
                        {{-- KONDISI 1: User Belum Login --}}
                        @if (!$isLoggedIn)
                            {{-- Tampilkan tombol Link biasa yang mengarah ke Login --}}
                            <a href="{{ route('login') }}" 
                               onclick="return confirm('Silakan login terlebih dahulu untuk memesan menu.');"
                               class="block w-full border border-[#F4EFE7] p-2 rounded-xl bg-[#F4EFE7] text-[#181C14] font-bold hover:bg-[#FFF2E0]/80 py-3 transition text-center no-underline">
                                Tambahkan
                            </a>
                        
                        {{-- KONDISI 2: User Sudah Login --}}
                        @else
                            {{-- Tampilkan Tombol Interaktif Alpine.js --}}
                            
                            {{-- Tombol Awal "Tambahkan" --}}
                            <button x-show="qty === 0" @click="updateCart(1)"
                                class="border border-[#F4EFE7] p-2 rounded-xl bg-[#F4EFE7] text-[#181C14] font-bold hover:bg-[#FFF2E0]/80 w-full py-3 transition">
                                Tambahkan
                            </button>

                            {{-- Counter (+ 1 -) --}}
                            <div x-show="qty > 0"
                                class="flex items-center justify-between gap-4 bg-[#F4EFE7]/20 border border-[#F4EFE7] px-4 py-2 rounded-full w-full transition"
                                style="display: none;">

                                <button @click="updateCart(qty-1)"
                                    class="w-8 h-8 flex items-center justify-center border border-white rounded-full text-white text-xl hover:bg-white hover:text-[#4A4640] transition">−</button>
                                <span class="text-white text-xl font-semibold" x-text="qty"></span>

                                <button @click="updateCart(qty+1)" :disabled="qty >= {{ $menu->stok }}"
                                    :class="qty >= {{ $menu->stok }} ? 'opacity-50 cursor-not-allowed' : 'hover:bg-white hover:text-[#4A4640]'"
                                    class="w-8 h-8 flex items-center justify-center border border-white rounded-full text-white text-xl transition">
                                    +
                                </button>
                            </div>
                        @endif

                    @else
                        {{-- Stok Habis --}}
                        <button disabled
                            class="border border-gray-600 p-2 rounded-xl bg-gray-700 text-gray-400 font-bold w-full py-3 cursor-not-allowed">
                            Stok Habis
                        </button>
                    @endif

                </div>
            </div>
        @empty
            <div class="col-span-full text-center text-[#F4EFE7] py-10">
                <p class="text-2xl font-bold">Yah, menu kategori ini sedang kosong :(</p>
                <p>Coba kategori lain yuk!</p>
            </div>
        @endforelse

    </div>

    {{-- FOOTER TOTAL (Hanya muncul jika login dan ada item) --}}
    @if($isLoggedIn)
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
            totalPrice: '{{ number_format($grandTotal, 0, ',', '.') }}'
        }"
            @cart-updated.window="totalQty = $event.detail.totalQty; totalPrice = $event.detail.totalPrice"
            x-show="totalQty > 0 || {{ session()->has('cart.reservation') ? 'true' : 'false' }}"
            x-transition.duration.500ms class="fixed bottom-0 left-0 right-0 z-50" style="display: none;">
            
            <footer class="bg-[#181C14] border-t-4 border-[#3C3D37] flex justify-between items-center px-6 py-4 shadow-2xl">
                <p class="text-[#F4EFE7] font-semibold text-lg">
                    @if (session()->has('cart.reservation'))
                        Total Reservasi
                    @else
                        Total Pesanan Menu
                    @endif
                </p>

                <a href="{{ route('customer.cart') }}"
                    class="flex items-center gap-3 bg-[#C1121F] text-[#F4EFE7] px-6 py-3 rounded-xl cursor-pointer hover:bg-[#A00F1B] transition shadow-lg hover:scale-105">
                    <div class="relative mr-2">
                        <span class="text-2xl">🛒</span>
                        <span class="absolute -top-2 -right-2 bg-black text-[#F4EFE7] text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center border border-[#C1121F]"
                            x-text="totalQty">
                        </span>
                    </div>
                    <span class="font-bold text-lg">Rp <span x-text="totalPrice"></span></span>
                </a>
            </footer>
        </div>
    @endif

</x-Layout>