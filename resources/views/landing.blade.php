<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- Konten Landing Page --}}
    <section id="landing" 
        div style="background-image: url('{{ asset('img/bglanding.png') }}');"
        class="min-h-screen flex items-center justify-center bg-cover bg-center bg-no-repeat p-4">
        <div class="container pt-24 mx-auto relative z-10">
            <div class="flex flex-wrap">
                <div class="w-full self-center py-20 px-10">
                    <h1 class="text-white text-center text-9xl">RANDOM SHOT<br>POOL AND CAFE
                    </h1>

                    <div class="mt-8 flex justify-center mb-48">
                        <a href="#reservasi" 
                           class="border border-white bg-gray-100/70 text-black hover:text-white px-5 py-2 rounded-md text-base font-medium hover:bg-black/75 transition shadow-lg">
                           Lihat Layanan >
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

{{-- Section Layanan --}}
    <section id="layanan" class="pt-20 pb-20 px-0 bg-black text-white">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-5xl text-center mb-20">Apa yang ada di Random Shot Pool and Cafe?</h2>
              <div class="max-w-8xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-5 px-8">

    <!-- Card 1 -->
    <div class="bg-white text-black rounded-xl shadow-xl overflow-hidden">
      <div class="bg-[#273520] text-white py-2 text-center text-xl font-bold">MEJA BILIAR</div>
      <img src="{{ asset('img/biliar.jpeg') }}" alt="Meja Biliar" class="w-full h-64 object-cover">
      <div class="p-4">
        <p class="text-gray-800 font-semibold text-center">Harga Reservasi</p>
        <p class="text-gray-800 font-semibold text-center">Mulai Rp 20.000/jam</p>
      </div>
    </div>

   <!-- Card 2 -->
    <div class="bg-white text-black rounded-xl shadow-xl overflow-hidden">
      <div class="bg-[#273520] text-white py-2 text-center text-xl font-bold">MEJA TENIS</div>
      <img src="{{ asset('img/tenis.jpeg') }}" alt="Meja Tenis" class="w-full h-64 object-cover">
      <div class="p-4">
        <p class="text-gray-800 font-semibold text-center">Harga Reservasi</p>
        <p class="text-gray-800 font-semibold text-center">Mulai Rp 10.000/jam</p>
      </div>
    </div>

    <!-- Card 2 -->
    <div class="bg-white text-black rounded-xl shadow-xl overflow-hidden">
      <div class="bg-[#273520] text-white py-2 text-center text-xl font-bold">PLAYSTATION 4</div>
      <img src="{{ asset('img/ps4.jpeg') }}" alt="PS4" class="w-full h-64 object-cover">
      <div class="p-4">
        <p class="text-gray-800 font-semibold text-center">Harga Reservasi</p>
        <p class="text-gray-800 font-semibold text-center">Mulai Rp 8.000/jam</p>
      </div>
    </div>
  </div>
</section>
        
{{-- Section Info --}}
<section id="layanan" class="pt-20 pb-20 px-0 bg-black text-white">
  <div class="max-w-6xl mx-auto">
    <h2 class="text-5xl text-center mb-20">
      PROMO? TURNAMEN? MAIN SAMBIL NGOPI & NYEMIL?
    </h2>

    <div class="max-w-4xl mx-auto flex flex-col md:flex-row items-center">
      <!-- Gambar kiri -->
      <div class="md:w-1/2 w-full flex justify-center">
        <img src="{{ asset('img/main.jpeg') }}" alt="Bermain biliar di Random Shot" class="rounded-xl max-w-sm">
      </div>

      <!-- Kotak kanan -->
      <div class="md:w-1/2 w-full flex flex-col items-center md:items-start gap-6 font-['Poppins']">
        <!-- Kotak 1 -->
        <div class="bg-white text-black rounded-xl shadow-md px-6 py-4 text-base font-medium">
          Di sini kamu bisa main sambil ngopi, nyemil, dan nikmatin berbagai menu makanan serta minuman
          yang bakal nemenin waktu santaimu bareng temen-temen
        </div>

        <!-- Kotak 2 -->
        <div class="bg-white text-black rounded-xl shadow-md px-6 py-4 text-base font-medium">
          Nantikan info promo dan turnamen seru di Random Shot Pool and Cafe!
        </div>

        <!-- Kotak 3 -->
        <div class="bg-white text-black rounded-xl shadow-md px-6 py-4 text-base font-medium">
          Bawa temen-temenmu nongkrong di Random Shot Pool and Cafe. Main biliar, pingpong, dan PS4 sambil ngopi. Tunggu apa lagi? Ayo reservasi sekarang juga!
        </div>
      </div>
    </div>
  </div>
</section>

<footer class="bg-black text-white py-10">
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

    </section>
</x-Layout>

{{-- x'-data="{}": Ini adalah perintah untuk "menyalakan" Alpine.js di elemen <body> dan semua elemen di dalamnya. --}} {{-- x'-init="...kode...": Ini adalah perintah yang kamu cari. "Saat <body> selesai dimuat, jalankan kode JavaScript ini." --}}
{{-- Jadi, "dimasukin ke div semua" itu artinya kamu menentukan batas area mana yang akan dikontrol oleh Alpine.js di halaman itu. --}}