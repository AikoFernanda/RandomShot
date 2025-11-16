<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

<section class="min-h-screen bg-black text-white flex">

    {{-- SIDEBAR --}}
    <aside class="w-72 bg-[#2e2e2c] py-24 px-8 flex flex-col">
        <h2 class="text-3xl">HALO,</h2>
        <h1 class="text-5xl mb-10 uppercase">PENGGUNA!</h1>

        <a href="{{ route('customer.profile') }}" 
           class="w-full py-3 rounded-xl bg-transparent mb-3 text-center">
           Informasi Akun
        </a>

        <a href="{{ route('customer.profile.activity') }}" 
           class="w-full py-3 bg-black/40 border border-white rounded-xl text-white text-center">
           Aktivitas Saya
        </a>
    </aside>


    {{-- MAIN CONTENT --}}
    <main class="flex-1 py-24">

        {{-- HEADER BUTTONS --}}
        <div class="flex justify-end gap-3 mb-6 mr-8">
            <a href="{{ route('customer.profile.activity') }}"
               class="px-4 py-2 bg-transparent rounded-md border border-white text-white text-sm">
               Reservasi Meja
            </a>

            <a href="{{ route('customer.profile.activity.cafe') }}"
               class="px-4 py-2 bg-white/30 rounded-md border border-white text-white text-sm">
               Menu Cafe
            </a>
        </div>

        {{-- TAB TITLE --}}
        <h2 class="text-4xl ml-6 mb-6">Aktivitas Pesanan Cafe</h2>
        <div class="space-y-5">

            {{-- CARD 1 --}}
            <div class="ml-6 mr-6 flex bg-[#141414] rounded-xl border border-white 
                        overflow-hidden relative">

                <img src="{{ asset('img/menu/indomie.png') }}" 
                     class="w-40 h-28 object-cover">

                <div class="p-4 flex-1">
                    <h3 class="text-2xl">Indomie Goreng</h3>
                    <p class="text-gray-400 text-sm">09/10/2025 <br> Tanpa bumbu sambal</p>
                </div>

                <div class="absolute right-0 top-0 bottom-0 border-r-3 border-green-400"></div>
                <p class="text-green-400 text-sm absolute right-4 bottom-3">
                    Pesanan Berhasil!
                </p>
            </div>


            {{-- CARD 2 --}}
            <div class="ml-6 mr-6 flex bg-[#141414] rounded-xl border border-white 
                        overflow-hidden relative">

                <img src="{{ asset('img/menu/indomie.png') }}" 
                     class="w-40 h-28 object-cover">

                <div class="p-4 flex-1">
                    <h3 class="text-2xl">Indomie Goreng</h3>
                    <p class="text-gray-400 text-sm">09/10/2025 <br> Tanpa bumbu sambal</p>
                </div>

                <div class="absolute right-0 top-0 bottom-0 border-r-3 border-red-400"></div>
                <p class="text-red-400 text-sm absolute right-4 bottom-3">
                    Pesanan gagal!
                </p>
            </div>


            {{-- CARD 3 --}}
            <div class="ml-6 mr-6 flex bg-[#141414] rounded-xl border border-white 
                        overflow-hidden relative">

                <img src="{{ asset('img/menu/indomie.png') }}" 
                     class="w-40 h-28 object-cover">

                <div class="p-4 flex-1">
                    <h3 class="text-2xl">Indomie Goreng</h3>
                    <p class="text-gray-400 text-sm">09/10/2025 <br> Tanpa bumbu sambal
                    </p>
                </div>

                <div class="absolute right-0 top-0 bottom-0 border-r-3 border-yellow-400"></div>
                <p class="text-yellow-400 text-sm absolute right-4 bottom-3">
                    Menunggu Konfirmasi...
                </p>
            </div>

            {{-- CARD 2 --}}
            <div class="ml-6 mr-6 flex bg-[#141414] rounded-xl border border-white 
                        overflow-hidden relative">

                <img src="{{ asset('img/menu/indomie.png') }}" 
                     class="w-40 h-28 object-cover">

                <div class="p-4 flex-1">
                    <h3 class="text-2xl">Indomie Goreng</h3>
                    <p class="text-gray-400 text-sm">09/10/2025 <br> Tanpa bumbu sambal</p>
                </div>

                <div class="absolute right-0 top-0 bottom-0 border-r-3 border-red-400"></div>
                <p class="text-red-400 text-sm absolute right-4 bottom-3">
                    Pesanan gagal!
                </p>
            </div>

        </div>

    </main>

</section>
</x-Layout>
