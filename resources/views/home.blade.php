<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

<section id="home" 
    style="background-image: url('{{ asset('img/bghome.png') }}');"
    class="min-h-screen bg-cover bg-center bg-no-repeat p-">
    <div class="container pt-24 mx-auto relative z-10">
        <div class="flex flex-wrap">
            <div class="w-full self-center py-20 px-10">
                <h1 class="text-[#F4EFE7] text-center text-5xl leading-tight">
                    Waktu Luangmu, Tempat Serumu 
                </h1>
                <h2 class="text-[#F4EFE7] text-center text-8xl leading-tight">
                    RANDOM SHOT POOL AND CAFE
                </h2>
                <p class="text-[#F4EFE7] text-center text-xl font-medium leading-tight">
                    Waktu luang gak harus membosankan. Yuk ke Random Shot Pool and Cafe! 
                    <br>Main biliar, nikmatin kopi, dan temukan tempat nongkrong paling asik di Bogor
                </p>
                    
                <div class="mt-8 flex justify-center mb-48">
                        <a href="/reservation" 
                           class="border border-[#F4EFE7] bg-black/50 text-[#F4EFE7]
                            hover:text-black px-5 py-2 rounded-md text-base font-semibold hover:bg-gray-100/50 transition shadow-lg">
                           Reservasi Sekarang >
                        </a>
                    </div>

            </div>
        </div>
    </div>
</section>


{{-- PROMO TERBARU --}}
<section id="promo" class="bg-black text-[#F4EFE7] py-20 px-4">
  <div class="max-w-6xl mx-auto text-center">
    <h2 class="text-5xl mb-10">Promo Terbaru</h2>
    <div class="grid md:grid-cols-3 gap-8">
      <div class="bg-white text-black rounded-xl shadow-lg p-6">
        <img src="{{ asset('img/Promo1.png') }}" alt="Promo 1" class="rounded-lg mb-4">
        <h3 class="text-2xl mb-2">Diskon 25% untuk 10 kali reservasi</h3>
        <p class="text-base font-medium">Berlaku hingga Desember 2025</p>
      </div>

      <div class="bg-white text-black rounded-xl shadow-lg p-6">
        <img src="{{ asset('img/Promo2.png') }}" alt="Promo 1" class="rounded-lg mb-4">
        <h3 class="text-2xl mb-2">Turnamen Tenis Meja Spesial 2 Tahun</h3>
        <p class="text-base font-medium">Ikuti keseruannya dan menangkan hadiah menarik!</p>
      </div>
    
      <div class="bg-white text-black rounded-xl shadow-lg p-6">
        <img src="{{ asset('img/Promo3.png') }}" alt="Promo 1" class="rounded-lg mb-4">
        <h3 class="text-2xl mb-2">Paket Spesial Hemat dan Kenyang!</h3>
        <p class="text-base font-medium">Indomie Telur + Es Teh + Basreng dengan Rp 15.000 saja</p>
      </div>
    </div>
  </div>
</section>

{{-- MENU & MEJA FAVORIT --}}
<section id="menu" class="bg-[#F4EFE7] py-20 px-4">
  <div class="max-w-6xl mx-auto text-center">
    <h2 class="text-5xl mb-10 text-black">Menu dan Meja Favorit</h2>
    <div class="grid md:grid-cols-4 gap-8">
      <div class="bg-white rounded-xl shadow-lg p-4">
        <img src="{{ asset('img/mejabiliar1.png') }}" class="rounded-lg mb-4" alt="Meja Biliar 1">
        <h3 class="text-2xl">Meja Biliar 1</h3>
      </div>
      <div class="bg-white rounded-xl shadow-lg p-4">
        <img src="{{ asset('img/extrajoss.png') }}" class="rounded-lg mb-4" alt="Extrajoss + Susu">
        <h3 class="text-2xl">Extrajoss + Susu</h3>
      </div>
      <div class="bg-white rounded-xl shadow-lg p-4">
        <img src="{{ asset('img/mejatenis.png') }}" class="rounded-lg mb-4" alt="Meja Tenis">
        <h3 class="text-2xl">Meja Tenis</h3>
      </div>
      <div class="bg-white rounded-xl shadow-lg p-4">
        <img src="{{ asset('img/indomiegtelur.png') }}" class="rounded-lg mb-4" alt="Indomie telur">
        <h3 class="text-2xl">Indomie Goreng + Telur</h3>
      </div>
    </div>
  </div>
</section>

{{-- SOSIAL MEDIA --}}
<section class="bg-black py-10 text-center">
  <h2 class="text-5xl text-[#F4EFE7] mb-6">IKUTI KAMI DI INSTAGRAM</h2>
  <p class="text-gray-400 mb-10">Dapatkan update promo, event, dan konten seru seputar Random Shot Pool & Cafe di @rs.poolcafebgr</p>
    <a href="https://www.instagram.com/rs.poolcafebgr" class="bg-white text-black font-semibold px-8 py-3 rounded-lg hover:bg-gray-100/60 hover:text-[#F4EFE7] transition">
    Kunjungi Profil Instagram >
    </a>
</section>


{{-- AJAKAN RESERVASI --}}
<section id="reservasi" class="bg-[#273520] text-[#F4EFE7] text-center py-20 px-4">
  <h2 class="text-5xl mb-4">Yuk, Booking Sekarang!</h2>
  <p class="text-lg mb-8">Pilih meja favoritmu dan nikmati waktu santai bareng teman di Random Shot Pool and Cafe</p>
  <a href="//reservation" class="bg-white text-black font-semibold px-8 py-3 rounded-lg hover:bg-gray-100/60 hover:text-[#F4EFE7] transition">
    Reservasi Sekarang >
  </a>
</section>

{{-- FOOTER --}}
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

{{-- x'-data="{}": Ini adalah perintah untuk "menyalakan" Alpine.js di elemen <body> dan semua elemen di dalamnya. --}} {{-- x'-init="...kode...": Ini adalah perintah yang kamu cari. "Saat <body> selesai dimuat, jalankan kode JavaScript ini." --}}
{{-- Jadi, "dimasukin ke div semua" itu artinya kamu menentukan batas area mana yang akan dikontrol oleh Alpine.js di halaman itu. --}}