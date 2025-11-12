<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <!-- Background -->
    <div class="relative w-full min-h-screen bg-[#181C14] pt-20">
        <div class="text-[#FFF4E4] ml-10 mt-8">
            <h1 class="text-6xl mb-3">menu cafe</h1>
            <p class="mb-10 text-sm sm:text-base md:text-lg lg:text-xl leading-relaxed pr-12">Santai sejenak dan nikmati
                hidangan lezat dari Menu Cafe Random Shot! Cocok buat kamu yang
                ingin nongkrong, ngopi, atau mengisi energi setelah seru bermain biliar, tennis,
                dan playstation!</p>
        </div>

        <!-- Button makanan/minuman -->
        <div class="grid grid-cols-2 gap-3 w-1/4 ml-10 mb-10">
            <button type="makanan"
                class="border p-2 sm:p-3 md:p-4 text-center font-semibold text-sm sm:text-base md:text-lg text-[#FFF4E4] rounded-2xl hover:bg-[#FFF2E0]/40 transition">Makanan
            </button>

            <button type="minuman"
                class="border p-2 sm:p-3 md:p-4 text-center font-semibold text-sm sm:text-base md:text-lg text-[#FFF4E4] rounded-2xl hover:bg-[#FFF2E0]/40 transition">Minuman
            </button>
        </div>

        <!-- Isi -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 w-[90%] mx-auto">
            <div class="rounded-xl border-2 border-[#FFF4E4] p-4 w-80 h-115 mt-3">
                <div class="border-2 bg-[#3C3D37] border-[#FFF4E4] rounded-xl w-70 aspect-square mx-auto">
                    <img src="{{ asset('img/menu/indomie.png') }}" class="w-50 h-50 mx-auto mt-7">
                </div>
                <p class="text-[#FFF4E4] font-bold text-xl mt-4">Indomie Goreng</p>
                <p class="text-[#FFF4E4] font-bold text-xl mt-2">Rp7.000</p>
                <button type="tambahkan"
                    class="border p-2 rounded-xl bg-[#FFF4E4] hover:bg-[#FFF2E0]/40 w-35 h-12 mt-4 ml-35 transition">Tambahkan</button>
            </div>
            <!-- Jika pesan -->
            <div class="rounded-xl border-2 border-[#FFF4E4] p-4 w-80 h-115 mt-3">
                <div class="border-2 bg-[#3C3D37] border-[#FFF4E4] rounded-xl w-70 aspect-square mx-auto">
                    <img src="{{ asset('img/menu/indomie.png') }}" class="w-50 h-50 mx-auto mt-7">
                </div>
                <p class="text-[#FFF4E4] font-bold text-xl mt-4">Indomie Goreng</p>
                <p class="text-[#FFF4E4] font-bold text-xl mt-2">Rp7.000</p>
                <div class="flex items-center gap-4 bg-[#FFF4E4]/30 px-4 py-2 ml-35 mt-4 rounded-full w-fit">
                    <button
                        class="w-8 h-8 flex items-center justify-center border border-white rounded-full text-white text-xl hover:bg-white hover:text-[#4A4640] transition">−</button>
                    <span class="text-white text-xl font-semibold">2</span>
                    <button
                        class="w-8 h-8 flex items-center justify-center border border-white rounded-full text-white text-xl hover:bg-white hover:text-[#4A4640] transition">+</button>
                </div>
            </div>
        </div>

        <!-- Kalo pesen, maka muncul (dari gpt)-->
        <footer class="bg-[#181C14] border-t-4 border-[#3C3D37] flex justify-between items-center px-6 py-4">
            <p class="text-[#FFF4E4] font-semibold text-lg">Menu 2 Pesanan</p>
            <div
                class="flex items-center gap-3 bg-[#C1121F] text-[#FFF4E4] px-4 py-2 rounded-lg cursor-pointer hover:bg-[#A00F1B] transition">
                <!-- Icon keranjang pakai emoji dari gpt -->
                <div class="relative">
                    🛒
                    <span class="absolute -top-2 -right-2 bg-black text-[#FFF4E4] text-xs rounded-full px-1">1</span>
                </div>
                <span class="font-semibold">Total Rp14.000</span>
            </div>
        </footer>

    </div>
</x-Layout>
