<header class="mb-6 flex justify-between items-center pb-4">

    <div class="flex items-center space-x-4">

        <button @click="isSidebarOpen = true" x-show="!isSidebarOpen" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
            class="text-[#F4EFE7] /50" {{-- <-- Ubah warna ke 'text-gray-800' agar terlihat --}} title="Buka Sidebar">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" class="w-7 h-7">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>

        <img id="img-logo-random-shot" src="{{ asset('img/logo-rs.png') }}" alt="logo_random_shot" class="w-48 h-auto">
    </div>

    {{-- 
      Ini meniru logika dropdown dari header customer 
      menggunakan Alpine.js
    --}}
    <div x-data="{ open: false }" class="relative">
        <button @click="open = !open" class="flex items-center focus:outline-none" title="Pengaturan Akun">
            {{-- Ganti dengan foto profil admin, atau inisial --}}
            <div
                class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center text-[#F4EFE7]  font-semibold border-2 border-gray-700">
                A
            </div>
        </button>

        <div x-show="open" @click.away="open = false" x-transition
            class="absolute right-0 mt-2 w-48 bg-[#F4EFE7]  rounded-lg shadow-lg py-2 z-50 ring-1 ring-black ring-opacity-5">
            <div class="px-4 py-2 text-sm text-gray-700">
                Halo, <span class="font-medium">{{ session('nama') }}!</span>
            </div>
            {{-- <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                Edit Profil
            </a> --}}

            {{-- Ini form logout, sesuaikan action-nya --}}
            <form method="POST" action="{{ route('user.logout') }}">
                @csrf
                <button type="submit"
                    class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                    Logout
                </button>
            </form>
        </div>
    </div>

</header>
