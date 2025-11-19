<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

<section x-data="{ pilihMeja:false }" 
         class="min-h-screen bg-[#0e0f0b] text-[#F4EFE7] px-8 pt-20 pb-10">

    {{-- BACK BUTTON + TITLE --}}
    <div class="flex items-center gap-4 mb-10">
        <a href="/drink-reservation" 
           class="w-10 h-10 bg-black/40 rounded-full flex items-center justify-center 
                  text-[#F4EFE7] text-2xl backdrop-blur hover:bg-white/20">←
        </a>

        <h1 class="text-5xl tracking-wide">
            Keranjang Saya
        </h1>
    </div>


    {{-- GRID WRAPPER --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 items-start">

        {{-- LEFT CONTENT --}}
        <div class="lg:col-span-2 space-y-3">

            {{-- ITEM MEJA --}}
            <div class="border border-white/20 rounded-xl p-4 flex gap-4">

                <img src="{{ asset('img/meja1.png') }}" 
                     class="w-36 h-32 object-cover rounded-md">

                <div class="flex-1">
                    <p class="font-bold text-lg">Meja Biliar 1</p>

                    <p class="text-gray-300 text-sm italic mt-1 leading-tight">
                        Tanggal 09 Oktober 2025
                    </p>
                    <p class="text-gray-300 text-sm italic mt-1 leading-tight">
                        Pukul 13.00 – 14.00 WIB
                    </p>

                    <p class="mt-9 text-green-400 text-sm">Tersedia</p>
                </div>

                <div class="text-right font-bold text-lg whitespace-nowrap">
                    Rp 20.000
                </div>
            </div>



            {{-- ITEM MAKANAN --}}
            <div class="border border-white/20 rounded-xl p-4 flex gap-4">

                {{-- FOTO MAKANAN --}}
                <img src="{{ asset('img/menu/indomie.png') }}" 
                     class="w-36 h-28 object-cover rounded-md">

                {{-- KONTEN --}}
                <div class="flex-1">

                    <div class="flex justify-between items-start">

                        <p class="font-bold text-xl">Indomie Goreng</p>

                        <div class="flex items-center gap-4">

                            {{-- QTY --}}
                            <div class="flex items-center gap-2 bg-white/10 px-3 py-1 rounded-full">
                                <button class="text-xl">−</button>
                                <span class="font-semibold text-lg">2</span>
                                <button class="text-xl">+</button>
                            </div>

                            {{-- HARGA --}}
                            <p class="font-bold text-xl whitespace-nowrap">
                                Rp 14.000
                            </p>
                        </div>
                    </div>

                    <button class="text-sm text-gray-300/70 flex items-center gap-1 mt-1">
                        ✎ Tambahkan Catatan
                    </button>

                    <p class="mt-8 text-green-400 text-sm">Tersedia</p>

                    <div class="flex justify-end mt-1">
                        <button class="text-red-400 text-sm flex items-center gap-2">
                            🗑 Hapus dari Keranjang
                        </button>
                    </div>

                </div>
            </div>

        </div>




        {{-- RIGHT SIDEBAR --}}
        <div class="bg-white/10 border border-white/20 rounded-xl p-6 sticky top-28">

            <h2 class="text-3xl mb-4">Detail Pesanan</h2>

            <p class="text-gray-300 text-sm mb-2">Item</p>

            <div class="flex justify-between text-sm">
                <div>
                    <p>Meja Biliar</p>
                    <p class="text-gray-400 italic text-xs">Meja Biliar 1 (1)</p>
                </div>
                <p>Rp 20.000</p>
            </div>

            <div class="flex justify-between text-sm mt-3">
                <div>
                    <p>Cafe</p>
                    <p class="text-gray-400 italic text-xs">Indomie Goreng (2)</p>
                </div>
                <p>Rp 14.000</p>
            </div>


            {{-- ALAMAT MEJA --}}
            <div class="mt-6">
                <label class="text-sm">Alamat meja</label>

                {{-- KETIKA DIKLIK → POPUP MUNCUL --}}
                <div @click="pilihMeja = true"
                     class="flex justify-between items-center border border-white/30 rounded-full px-4 py-2 mt-2 cursor-pointer">
                    <p class="text-sm text-gray-300">Pilih</p>
                    <span>›</span>
                </div>
            </div>


            {{-- PAYMENT --}}
            <div class="mt-4">
                <label class="text-sm">Metode Pembayaran</label>
                <div class="flex justify-between items-center border border-white/30 rounded-full px-4 py-2 mt-2 cursor-pointer">
                    <p class="text-sm text-gray-300">QRIS</p>
                    <span>›</span>
                </div>
            </div>


            {{-- SUBTOTAL --}}
            <div class="flex justify-between items-center mt-6 text-lg font-bold">
                <p>Sub Total :</p>
                <p>Rp 34.000</p>
            </div>


            {{-- CHECKOUT --}}
            <a href="/payment"
            class="mt-6 w-full py-3 bg-red-600 hover:bg-red-700 rounded-full border
             border-white text-[#F4EFE7] font-bold text-lg text-center block">
                Check Out</a>

        </div>

    </div> {{-- END GRID --}}



    {{-- POPUP PILIH MEJA --}}
    <div x-show="pilihMeja"
         x-transition.opacity
         @click.self="pilihMeja = false"
         class="fixed inset-0 bg-black/60 backdrop-blur z-50 flex items-center justify-center">

        <div x-show="pilihMeja"
             x-transition.duration.300ms
             class="bg-[#151515] w-full max-w-xl p-6 rounded-t-2xl">

            <h2 class="text-2xl mb-4">Pilih Meja</h2>

            <div class="space-y-3">

                <div @click="pilihMeja = false"
                     class="p-3 border border-white/20 rounded-xl hover:bg-white/10 cursor-pointer">
                    Meja 1
                </div>

                <div @click="pilihMeja = false"
                     class="p-3 border border-white/20 rounded-xl hover:bg-white/10 cursor-pointer">
                    Meja 2
                </div>

            </div>

            <button @click="pilihMeja = false"
                    class="mt-5 w-full py-3 bg-red-600 font-bold rounded-xl">
                Konfirmasi
            </button>

        </div>

    </div>

</section>

</x-Layout>
