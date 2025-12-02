<header class="fixed top-0 left-0 right-0 bg-black/25 backdrop-blur-lg z-50 shadow-lg">
    <!-- Kontainer Utama Navigasi -->
    <div class="max-w-6xl mx-auto flex justify-between items-center px-4 py-4">

        <!-- Kiri: Logo (Image) -->
        <!-- Sesuaikan kelas 'w-48' atau lainnya untuk mengatur ukuran logo Anda -->
        <img id="img-logo-random-shot" src="{{ asset('img/logo-rs.png') }}" alt="logo_random_shot" class="w-26 h-auto">
        {{-- 'w-48' akan membuat lebar gambar sekitar 12rem (192px), sesuaikan nilai ini jika terlalu besar/kecil. --}}

        <x-Navbar></x-Navbar>

        @if (session('status_login') == 'success')
            <!-- Kanan: dropdown profil dan history-->
            @if (!request()->routeIs('customer.*'))
                <div class="flex items-center space-x-2">
                    {{-- cek dgn url supaya tidak muncul di /customer, gunakan wildcard (*) untuk mengecek semua rute yang berawalan customer. --}}
                    <div x-data="{ open: false }" class="relative"> {{-- Alpine.js reactive state... --}}
                        <button @click="open = !open" class="flex items-center focus:outline-none">
                            <img src="{{ asset('img/profilsaya.png') }}" alt="User" class="w-10 h-10 rounded-full">
                        </button>
                        <div x-show="open" @click.away="open = false" x-transition
                            class="absolute right-0 mt-2 w-40 bg-[#F4EFE7]  rounded-lg shadow-lg py-2 z-50">
                            <a href="{{ route('customer.profile') }}"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition">Profile</a>
                            <form method="POST" action="{{ route('user.logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 transition">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                {{-- 
                      Render "kotak" tak kasat mata seukuran tombol (w-10 h-10)
                      untuk "memegang" ruang agar layout tidak bergeser.
                    --}}
                <div class="flex items-center space-x-2">
                    <div class="w-10 h-10"></div>
                </div>
            @endif
        @else
            <!-- Kanan: Navigasi Login/Register dengan style tombol -->
            <nav class="flex items-center space-x-2">

                <!-- Tombol Daftar -->
                <a href="{{ route('register') }}"
                    class="bg-gray-600 hover:bg-gray-400 text-[#F4EFE7]  font-medium text-sm py-1 px-3 rounded-md transition duration-150 ease-in-out">
                    Daftar
                </a>

                <!-- Tombol Login -->
                <a href="{{ route('login') }}"
                    class="bg-[#F4EFE7]  hover:bg-gray-400 text-black font-medium text-sm py-1 px-3 rounded-md transition duration-150 ease-in-out">
                    Masuk
                </a>

            </nav>
        @endif
    </div>
</header>
