<header class="bg-gray-800 shadow-lg">
    <!-- Kontainer Utama Navigasi -->
    <div class="flex justify-between items-center p-4">

        <!-- Kiri: Logo (Image) -->
        <!-- Sesuaikan kelas 'w-48' atau lainnya untuk mengatur ukuran logo Anda -->
        <img id="img-logo-randomshot" src="{{ asset('img/logo_random_shot.png') }}" alt="logo_random_shot"
            class="w-28 h-auto">
        {{-- 'w-48' akan membuat lebar gambar sekitar 12rem (192px), sesuaikan nilai ini jika terlalu besar/kecil. --}}

        <!-- Kanan: Tautan Navigasi -->
        <nav class="flex items-center space-x-6 text-white">
            <a href="{{ asset('/home') }}" class="font-medium hover:text-blue-400 transition duration-200 {{ Request::is('home') ? 'text-blue-400 font-semibold' : 'text-white hover:text-blue-400' }}">
                Home
            </a>
            <a href="#" class="font-medium hover:text-blue-400 transition duration-200 {{ Request::is('reservasi') ? 'text-blue-400 font-semibold' : 'text-white hover:text-blue-400' }}">
                Reservasi
            </a>
            <a href="#" class="font-medium hover:text-blue-400 transition duration-200 {{ Request::is('menu') ? 'text-blue-400 font-semibold' : 'text-white hover:text-blue-400' }}">
                Menu
            </a>
            <a href="#" class="font-medium hover:text-blue-400 transition duration-200 {{ Request::is('layanan_kami') ? 'text-blue-400 font-semibold' : 'text-white hover:text-blue-400' }}">
                Layanan kami
            </a>
            <a href="#" class="font-medium hover:text-blue-400 transition duration-200 {{ Request::is('kontak_kami') ? 'text-blue-400 font-semibold' : 'text-white hover:text-blue-400' }}">
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
            <nav class="flex items-center space-x-4">

                <!-- Tombol Daftar -->
                <a href="/register"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                    Daftar
                </a>

                <!-- Tombol Login -->
                <a href="/login"
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                    Login
                </a>

            </nav>
        @endif
    </div>
</header>
