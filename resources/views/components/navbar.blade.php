<header class="fixed top-0 left-0 right-0 bg-black/25 backdrop-blur-lg z-50 shadow-lg">
    <!-- Kontainer Utama Navigasi -->
    <div class="max-w-6xl mx-auto flex justify-between items-center px-0 py-4">

        <!-- Kiri: Logo (Image) -->
        <!-- Sesuaikan kelas 'w-48' atau lainnya untuk mengatur ukuran logo Anda -->
        <img id="img-logo-random-shot" src="{{ asset('img/logo-rs.png') }}" alt="logo_random_shot"
            class="w-26 h-auto">
        {{-- 'w-48' akan membuat lebar gambar sekitar 12rem (192px), sesuaikan nilai ini jika terlalu besar/kecil. --}}

        <!-- Kanan: Tautan Navigasi -->

        <nav class="flex items-center space-x-14 text-white">
            <a href="{{ asset('/home') }}" class="font-reguler text-sm hover:text-yellow-400 transition duration-200 {{ Request::is('home') ? 'text-yellow-400 font-semibold' : 'text-white hover:text-yellow-400' }}">
                Beranda
            </a>
            <a href="{{ asset('/reservasi') }}" class="font-reguler text-sm hover:text-yellow-400 transition duration-200 {{ Request::is('reservasi') ? 'text-yellow-400 font-semibold' : 'text-white hover:text-yellow-400' }}">
                Reservasi
            </a>
            <a href="{{ asset('/cafe') }}" class="font-reguler text-sm hover:text-yellow-400 transition duration-200 {{ Request::is('cafe') ? 'text-yellow-400 font-semibold' : 'text-white hover:text-yellow-400' }}">
                Cafe
            </a>
            <a href="{{ asset('/about') }}" class="font-reguler text-sm hover:text-yellow-400 transition duration-200 {{ Request::is('about') ? 'text-yellow-400 font-semibold' : 'text-white hover:text-yellow-400' }}">
                Tentang Kami
            </a>
            <a href="{{ asset('/contact') }}" class="font-reguler text-sm hover:text-yellow-400 transition duration-200 {{ Request::is('contact') ? 'text-yellow-400 font-semibold' : 'text-white hover:text-yellow-400' }}">
                Kontak Kami
            </a>
        </nav>

        @if (session('status_login') == 'success')
            <!-- Kanan: dropdown profil -->
            <div x-data="{ open: false }" class="relative"> {{-- Alpine.js reactive state buat buka/tutup dropdown. --}}
                <button @click="open = !open" class="flex items-center focus:outline-none">
                    <img src="{{ asset('img/default_profil.png') }}" alt="User"
                        class="w-10 h-10 rounded-full border-2 border-white">
                </button>
                <!-- Dropdown Menu -->
                <div x-show="open" @click.away="open = false" x-transition
                    class="absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg py-2 z-50">
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition">Profile</a>
                    <form method="POST" action="/logout">
                        @csrf {{--  untuk keamanan, wajib untuk post --}}
                        <button type="submit"
                            class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 transition">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        @else
            <!-- Kanan: Navigasi Login/Register dengan style tombol -->
            <nav class="flex items-center space-x-2">

                <!-- Tombol Daftar -->
                <a href="/register"
                    class="bg-gray-600 hover:bg-gray-400 text-white font-medium text-sm py-1 px-3 rounded-md transition duration-150 ease-in-out">
                    Daftar
                </a>

                <!-- Tombol Login -->
                <a href="/login"
                    class="bg-white hover:bg-gray-400 text-black font-medium text-sm py-1 px-3 rounded-md transition duration-150 ease-in-out">
                    Masuk
                </a>

            </nav>
        @endif
    </div>
</header>
