<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

{{-- Banner --}}
<section class="relative w-full h-[500px] bg-black">
    <img src="{{ asset('img/bgreservasi.png') }}" 
         class="w-full h-full object-cover opacity-60">

    <div class="absolute inset-2 flex flex-col justify-center px-12">
        <h1 class="text-7xl text-[#F4EFE7]">RANDOM SHOT<br>POOL AND CAFE</h1>
        <p class="text-[#F4EFE7] mt-2 max-w-2xl text-xl">
            Tempat ini hadir untuk memberikan pengalaman hiburan yang menyenangkan 
            dan nyaman bagi para pelanggan
        </p>
    </div>
</section>

{{-- Category Buttons --}}
<section class="bg-black text-[#F4EFE7] px-12 py-10">
    <div class="flex gap-3">
        <a href="/table-reservation"
            class="px-6 py-2 border border-white rounded-xl font-medium shadow">
            Meja Biliar
        </a>
        <a href="/tenis-reservation"
            class="px-6 py-2 border border-white rounded-xl font-medium">
            Meja Tenis
        </a>
        <a href="/ps4-reservation"
            class="px-6 py-2 border border-white bg-white/30 text-[#F4EFE7] rounded-xl font-medium">
            PlayStation 4
        </a>
    </div>
</section>

{{-- Grid Meja --}}
<section class="bg-black text-[#F4EFE7] px-12 pb-24">
    <h2 class="text-5xl mb-6">Playstation 4</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        {{-- Item 1 --}}
        <div class="bg-white/10 border border-white/20 rounded-xl p-4 shadow-lg">
            <img src="{{ asset('img/ps4.jpeg') }}" class="w-full h-65 object-cover rounded-lg">

            <h3 class="text-4xl mt-4">Playstation 4</h3>
            <p class="text-gray-300">Rp 8.000/jam</p>

            <a href="/detail-meja1"
               class="mt-4 inline-block px-5 py-2 bg-white hover:bg-white/50 text-black hover:text-[#F4EFE7] rounded-lg font-semibold">
               Lihat Detail
            </a>
        </div>

    </div>
</section>

{{-- Ulasan --}}
<section class="bg-black text-[#F4EFE7] px-12 pb-20">

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-5xl tracking-wide">ULASAN</h2>

    <a href="/ulasan"
        class="px-5 py-2 bg-white/30 text-[#F4EFE7] rounded-lg font-semibold hover:bg-gray-200 hover:text-black transition">
        Lihat Ulasan Lainnya
    </a>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        {{-- Rating Summary --}}
        <div class="bg-black/40 p-6 rounded-xl border border-white">
            <p class="text-5xl font-bold">4.9 <span class="text-2xl">/ 5</span></p>
            <p class="text-gray-300 mb-4">2518 Penilaian</p>

            {{-- Bar Graph --}}
            <div class="space-y-2">
                @for ($i=5; $i>=1; $i--)
                    <div class="flex items-center gap-4">
                        <span class="w-8">{{ $i }}</span>
                        <div class="flex-1 h-2 bg-white/20 rounded-full">
                            <div class="h-2 bg-yellow-400 rounded-full w-[{{ rand(40,100) }}%]"></div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>

        {{-- Individual Reviews --}}
        <div class="space-y-6">

    {{-- Review Card 1 --}}
    <div class="bg-black/40 p-6 rounded-xl border border-white">

        <div class="flex items-center gap-4">
            
            {{-- Avatar + Initials Style (mirip profil halaman akun) --}}
            <div class="w-14 h-14 rounded-full bg-white flex items-center justify-center 
                        text-black text-xl font-bold">
                AJ
            </div>

            <div>
                <p class="font-bold text-lg">Anggita Jeon</p>
                <p class="text-yellow-400 text-sm">★★★★☆</p>
            </div>
        </div>

        <p class="mt-4 text-gray-300 leading-relaxed">
            Suasananya nyaman! Pelayan ramah & tempatnya cozy!
        </p>
    </div>

    {{-- Review Card 2 --}}
    <div class="bg-black/40 p-6 rounded-xl border border-white">

        <div class="flex items-center gap-4">
            
            {{-- Avatar --}}
            <div class="w-14 h-14 rounded-full bg-white flex items-center justify-center 
                        text-black text-xl font-bold">
                AN
            </div>

            <div>
                <p class="font-bold text-lg">Afra Naila</p>
                <p class="text-yellow-400 text-sm">★★★★★</p>
            </div>
        </div>

        <p class="mt-4 text-gray-300 leading-relaxed">
            Tempat biliar terbaik di Bogor! Harga terjangkau, kualitas meja mantap
        </p>
    </div>

</div>

    </div>
</section>

<footer class="bg-black text-[#F4EFE7] py-10">
  <div class="px-12">
    <img id="img-logo-random-shot" src="{{ asset('img/logo-rs.png') }}" alt="logo_random_shot"
         class="w-64 h-auto mb-4">
    
    <p class="text-gray-400 text-base mb-4">
      Perumahan Indogreen Blok D1 No.1<br>
      Gunung Sari, Citeureup, Bogor, Indonesia
    </p>

    <p class="text-gray-500 text-xs">
      © 2025 Random Shot Pool and Cafe. All rights reserved.
    </p>
  </div>
</footer>

</x-Layout>
