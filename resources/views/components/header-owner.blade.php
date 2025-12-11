<header class="mb-6 flex justify-between items-center pb-4 border-b border-white/10">

    <div class="flex items-center space-x-4">

        {{-- TOMBOL BUKA SIDEBAR --}}
        <button @click="isSidebarOpen = true" x-show="!isSidebarOpen" x-cloak
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100" class="relative text-[#F4EFE7] hover:text-white transition"
            title="Buka Sidebar">

            {{-- Ikon Hamburger --}}
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" class="w-7 h-7">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg> 
        </button>

        {{-- Logo --}}
        <img id="img-logo-random-shot" src="{{ asset('img/logo-rs.png') }}" alt="logo_random_shot"
            class="w-32 md:w-48 h-auto">
    </div>

    {{-- DROPDOWN PROFIL --}}
    <div x-data="{ open: false }" class="relative">
        <button @click="open = !open" class="flex items-center focus:outline-none gap-2 group" title="Pengaturan Akun">
            <div class="hidden md:block text-right">
                <p class="text-sm font-bold text-[#F4EFE7] group-hover:text-white transition">
                    {{ session('nama') ?? 'Administrator' }}
                </p>
                <p class="text-[10px] text-gray-400 uppercase tracking-wider">Admin</p>
            </div>
            <div class="w-10 h-10 rounded-full bg-[#3C3D37] flex items-center justify-center text-[#F4EFE7] font-bold border border-white/10 group-hover:border-[#F4EFE7] transition">
                {{ substr(session('nama') ?? 'A', 0, 1) }}
            </div>
        </button>

        {{-- Menu Dropdown --}}
        <div x-show="open" x-cloak @click.away="open = false" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
            class="absolute right-0 mt-2 w-48 bg-[#F4EFE7] rounded-lg shadow-xl py-2 z-50 ring-1 ring-black ring-opacity-5 overflow-hidden">

            <div class="px-4 py-2 text-xs text-gray-500 border-b border-gray-200 md:hidden">
                Login sebagai: <br>
                <span class="font-bold text-gray-800 text-sm">{{ session('nama') ?? 'Admin' }}</span>
            </div>

            <form method="POST" action="{{ route('user.logout') }}">
                @csrf
                <button type="submit"
                    class="w-full text-left flex items-center gap-2 px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 2.062-5M12 12h9.75" />
                    </svg>
                    Keluar / Logout
                </button>
            </form>
        </div>
    </div>
</header>