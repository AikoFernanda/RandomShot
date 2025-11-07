<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div>
        <!-- notifikasi -->
        <div>
            @if (session('success'))
                <div id='popup-success'
                    class="text-green-600 bg-green-100 p-2.5 border-green-500 rounded-[5px] mb-[15px]">
                    {{ session('success') }}
                </div>
            @elseif (session('logout_success'))
                <div id='popup-success'
                    class="text-green-600 bg-green-100 p-2.5 border-green-500 rounded-[5px] mb-[15px]">
                    {{ session('logout_success') }}
                </div>
            @endif
        </div>

        <h2 class="text-xl font-semibold text-black-600 mb-6">Nikmati Suasana Bermain Biliar dan Cafe Cantik Terbaik Di
            Bogor!</h2>
    </div>

    <!-- Area Sesi/Status -->
    <div class="mt-8 pt-4 border-t">
        <h3 class="text-sm font-semibold text-gray-600 mb-2">Session Status:</h3>
        @if (session('status_login') == 'success')
            <p class="text-green-600 font-medium">Status: {{ session('status_login') }}</p>
        @else
            <p class="text-red-600">Status: Belum login</p>
        @endif
    </div>

</x-Layout>

{{-- x'-data="{}": Ini adalah perintah untuk "menyalakan" Alpine.js di elemen <body> dan semua elemen di dalamnya. --}} {{-- x'-init="...kode...": Ini adalah perintah yang kamu cari. "Saat <body> selesai dimuat, jalankan kode JavaScript ini." --}}
{{-- Jadi, "dimasukin ke div semua" itu artinya kamu menentukan batas area mana yang akan dikontrol oleh Alpine.js di halaman itu. --}}
