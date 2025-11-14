<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="relative w-full min-h-screen bg-[#181C14] pt-20 pb-24"> {{-- pb-24 agar footer tidak menutupi konten --}}

        <div class="text-[#FFF4E4] ml-10 mt-8">
            <h1 class="text-6xl mb-3 font-bold">Menu Cafe</h1>
            <p class="mb-10 text-sm sm:text-base md:text-lg lg:text-xl leading-relaxed pr-12 max-w-4xl">
                Santai sejenak dan nikmati hidangan lezat dari Menu Cafe Random Shot!
                Cocok buat kamu yang ingin nongkrong, ngopi, atau mengisi energi!
            </p>
        </div>

        <div class="grid grid-cols-2 gap-3 w-full max-w-md ml-10 mb-10 pr-10">
            {{-- 
                Logika: Jika URL sedang ?kategori=Makanan, beri background terang. 
                Jika tidak, beri border biasa.
            --}}
            <a href="{{ route('cafe', ['kategori' => 'Makanan']) }}"
                class="border p-2 sm:p-3 md:p-4 text-center font-semibold text-sm sm:text-base md:text-lg rounded-2xl transition duration-300
                {{ request('kategori') == 'Makanan' ? 'bg-[#FFF4E4] text-[#181C14]' : 'text-[#FFF4E4] hover:bg-[#FFF2E0]/20' }}">
                Makanan
            </a>

            <a href="{{ route('cafe', ['kategori' => 'Minuman']) }}"
                class="border p-2 sm:p-3 md:p-4 text-center font-semibold text-sm sm:text-base md:text-lg rounded-2xl transition duration-300
                {{ request('kategori') == 'Minuman' ? 'bg-[#FFF4E4] text-[#181C14]' : 'text-[#FFF4E4] hover:bg-[#FFF2E0]/20' }}">
                Minuman
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 w-[90%] mx-auto">

            @forelse($menus as $menu)
                {{-- 
                pakai Alpine.js (x-data) untuk simulasi tombol Tambah menjadi Counter 
                   qty: 0 artinya belum dipesan.
                --}}

                @php
                    $cart = session('cart', []);
                    $currentQty = isset($cart[$menu->menu_id]) ? $cart[$menu->menu_id]['qty'] : 0;
                @endphp

                <div x-data="{
                    qty: {{ $currentQty }},
                    menuId: {{ $menu->menu_id }},
                
                    updateCart(newQty) {
                        this.qty = newQty;
                
                        fetch('{{ route('cart.update') }}', {
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
                    class="rounded-xl border-2 border-[#FFF4E4] p-4 h-full flex flex-col justify-between duration-300
                     {{ $menu->stok == 0 ? 'opacity-60 grayscale cursor-not-allowed' : 'hover:scale-105 transition' }}">

                    <div>
                        <div
                            class="relative border-2 bg-[#3C3D37] border-[#FFF4E4] rounded-xl w-full aspect-square flex items-center justify-center overflow-hidden">

                            {{-- TAMPILKAN STEMPEL 'HABIS' JIKA STOK 0 --}}
                            @if ($menu->stok == 0)
                                <div class="absolute inset-0 bg-black/60 flex items-center justify-center z-10">
                                    <span
                                        class="border-2 border-red-500 text-red-500 font-bold text-2xl px-4 py-1 -rotate-12 tracking-widest uppercase">
                                        HABIS
                                    </span>
                                </div>
                            @endif

                            <img src="{{ asset('img/menu/indomie.png') }}" alt="{{ $menu->nama }}"
                                class="w-3/4 h-3/4 object-contain">
                        </div>

                        <h3 class="text-[#FFF4E4] font-bold text-xl mt-4 leading-tight">{{ $menu->nama }}</h3>

                        <p class="text-[#FFF4E4] font-medium text-lg mt-2 opacity-90">
                            Rp{{ number_format($menu->harga, 0, ',', '.') }}
                        </p>

                        {{-- Ubah warna teks stok jadi Merah jika habis --}}
                        <p class="text-xs mt-1 {{ $menu->stok == 0 ? 'text-red-400 font-bold' : 'text-gray-400' }}">
                            Stok: {{ $menu->stok }}
                        </p>
                    </div>

                    <div class="mt-4 flex justify-center">

                        {{-- LOGIKA TOMBOL: Cek Stok di Level PHP (Blade) --}}
                        @if ($menu->stok > 0)
                            <button x-show="qty === 0" @click="updateCart(1)"
                                class="border border-[#FFF4E4] p-2 rounded-xl bg-[#FFF4E4] text-[#181C14] font-bold hover:bg-[#FFF2E0]/80 w-full py-3 transition">
                                Tambahkan
                            </button>

                            <div x-show="qty > 0"
                                class="flex items-center justify-between gap-4 bg-[#FFF4E4]/20 border border-[#FFF4E4] px-4 py-2 rounded-full w-full transition"
                                style="display: none;">

                                <button @click="updateCart(qty-1)"
                                    class="w-8 h-8 flex items-center justify-center border border-white rounded-full text-white text-xl hover:bg-white hover:text-[#4A4640] transition">−</button>
                                <span class="text-white text-xl font-semibold" x-text="qty"></span>

                                <button @click="updateCart(qty+1)" :disabled="qty >= {{ $menu->stok }}"
                                    {{-- Cek di Alpine: Jangan biarkan qty melebihi stok --}}
                                    :class="qty >= {{ $menu->stok }} ? 'opacity-50 cursor-not-allowed' :
                                        'hover:bg-white hover:text-[#4A4640]'"
                                    class="w-8 h-8 flex items-center justify-center border border-white rounded-full text-white text-xl transition">
                                    +
                                </button>
                            </div>
                        @else
                            <button disabled
                                class="border border-gray-600 p-2 rounded-xl bg-gray-700 text-gray-400 font-bold w-full py-3 cursor-not-allowed">
                                Stok Habis
                            </button>
                        @endif

                    </div>
                </div>
            @empty
                {{-- Tampilan jika menu kosong --}}
                <div class="col-span-full text-center text-[#FFF4E4] py-10">
                    <p class="text-2xl font-bold">Yah, menu kategori ini sedang kosong :(</p>
                    <p>Coba kategori lain yuk!</p>
                </div>
            @endforelse

        </div>

        @php
            $totalQty = 0;
            $totalPrice = 0;

            if (session('cart')) {
                foreach (session('cart') as $item) {
                    $totalQty += $item['qty'];
                    $totalPrice += $item['harga'] * $item['qty'];
                }
            }
        @endphp

        <div x-data="{
            totalQty: {{ $totalQty }},
            totalPrice: '{{ number_format($totalPrice, 0, ',', '.') }}'
        }"
            @cart-updated.window="totalQty = $event.detail.totalQty; totalPrice = $event.detail.totalPrice"
            x-show="totalQty > 0" x-transition.duration.500ms class="fixed bottom-0 left-0 right-0 z-50"
            style="{{ $totalQty == 0 ? 'display: none;' : '' }}">

            <footer
                class="bg-[#181C14] border-t-4 border-[#3C3D37] flex justify-between items-center px-6 py-4 shadow-2xl">
                <p class="text-[#FFF4E4] font-semibold text-lg">
                    Total Pesanan
                </p>

                <a href="#" {{-- Rute harus diaktifkan nanti {{ route('cart.view') }} --}}
                    class="flex items-center gap-3 bg-[#C1121F] text-[#FFF4E4] px-6 py-3 rounded-xl cursor-pointer hover:bg-[#A00F1B] transition shadow-lg hover:scale-105">
                    <div class="relative mr-2">
                        <span class="text-2xl">🛒</span>
                        <span
                            class="absolute -top-2 -right-2 bg-black text-[#FFF4E4] text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center border border-[#C1121F]"
                            x-text="totalQty">
                            {{-- Angka qty dinamis dari x-text --}}
                        </span>
                    </div>

                    <span class="font-bold text-lg">Rp <span x-text="totalPrice"></span></span>

                </a>
            </footer>
        </div>

    </div>
</x-Layout>
