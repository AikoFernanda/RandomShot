<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div x-data="{}" x-init="alert('Ini Contact');">
        <h2 class="text-xl font-semibold text-gray-800 mb-6">
            Selamat Datang Randomers! <br>
            Nikmati Suasana Bermain Biliar dan Cafe Cantik Terbaik Di Bogor!
        </h2>
        <img id="img-kucing" src="{{ asset('img/Kucing.png') }}" alt="default img" class="w-150">
    </div>
</x-Layout>

{{-- x'-data="{}": Ini adalah perintah untuk "menyalakan" Alpine.js di elemen <body> dan semua elemen di dalamnya. --}} {{-- x'-init="...kode...": Ini adalah perintah yang kamu cari. "Saat <body> selesai dimuat, jalankan kode JavaScript ini." --}}
{{-- Jadi, "dimasukin ke div semua" itu artinya kamu menentukan batas area mana yang akan dikontrol oleh Alpine.js di halaman itu. --}}