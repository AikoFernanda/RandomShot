<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div x-data="{}" x-init="alert('Apakah kamu manusia bodoh itu!');">
        <h2 class="text-xl font-semibold text-gray-600 mb-6">Selamat datang pintar, klik button dibawah!</h2>
        <img id="img-kucing" src="{{ asset('img/Kucing.png') }}" alt="default img" class="w-96">
        <form action="/test_register" method="get">
            @csrf {{-- Token @csrf hanya wajib untuk POST, PUT, PATCH, atau DELETE untuk keamanan. --}}
            <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded">CLICK!</button>
        </form>
        <br>
        <a href="/test_register" class="bg-blue-500 text-white font-bold py-2 px-4 rounded">
            CLICK!
        </a> {{-- <form> hanya untuk membuat tombol yang bisa di-klik yang mengarah ke halaman /test_register. Ini cara yang "aneh". --}}
    </div>
</x-Layout>

{{-- x'-data="{}": Ini adalah perintah untuk "menyalakan" Alpine.js di elemen <body> dan semua elemen di dalamnya. --}} {{-- x'-init="...kode...": Ini adalah perintah yang kamu cari. "Saat <body> selesai dimuat, jalankan kode JavaScript ini." --}}
{{-- Jadi, "dimasukin ke div semua" itu artinya kamu menentukan batas area mana yang akan dikontrol oleh Alpine.js di halaman itu. --}}