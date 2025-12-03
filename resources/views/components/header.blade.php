{{-- 
    x-data: Membuat komponen Alpine dengan state 'isScrolled'
    @scroll.window: Event listener pada window untuk mendeteksi scroll
--}}
<header 
    x-data="{ isScrolled: false }" 
    @scroll.window="isScrolled = (window.pageYOffset > 20)" 
    :class="{ 
        'bg-black/80 backdrop-blur-md shadow-lg': isScrolled, 
        'bg-transparent': !isScrolled 
    }"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 ease-in-out">
    
    <div class="max-w-6xl mx-auto flex justify-between items-center px-4 py-4">

        {{-- LOGO --}}
        <a href="/">
            <img id="img-logo-random-shot" src="{{ asset('img/logo-rs.png') }}" alt="logo_random_shot" class="w-26 h-auto">
        </a>

        <x-Navbar></x-Navbar>

        @if (session('status_login') == 'success')
            
            {{-- VARIABEL $hasUnpaid di appserviceprovider --}}
            @if (!request()->routeIs('customer.*'))
                <div class="flex items-center space-x-4">
                    
                    {{-- DROPDOWN PROFIL --}}
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center focus:outline-none relative">
                            <img src="{{ asset('img/profilsaya.png') }}" alt="User" class="w-10 h-10 rounded-full border-2 border-transparent hover:border-[#F4EFE7] transition">
                            
                            {{-- INDIKATOR TITIK MERAH --}}
                            @if($hasUnpaid)
                                <span class="absolute top-0 right-0 block h-3 w-3 rounded-full ring-2 ring-black bg-red-500 animate-pulse"></span>
                            @endif
                        </button>

                        {{-- DROPDOWN MENU --}}
                        <div x-show="open" @click.away="open = false" x-transition
                            class="absolute right-0 mt-2 w-48 bg-[#F4EFE7] rounded-lg shadow-xl py-2 z-50 overflow-hidden text-sm">
                            
                            <a href="{{ route('customer.profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200 transition">
                                Profile
                            </a>

                            <a href="{{ route('customer.transaction.history') }}" class="flex justify-between items-center px-4 py-2 text-gray-700 hover:bg-gray-200 transition">
                                <span>Riwayat Transaksi</span>
                                @if($hasUnpaid)
                                    <span class="bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">!</span>
                                @endif
                            </a>

                            <div class="h-px bg-gray-300 my-1"></div>

                            <form method="POST" action="{{ route('user.logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 transition font-medium">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <div class="flex items-center space-x-2">
                    <div class="w-10 h-10"></div>
                </div>
            @endif

        @else
            {{-- TOMBOL LOGIN / REGISTER --}}
            <nav class="flex items-center space-x-2">
                <a href="{{ route('register') }}" class="bg-gray-600 hover:bg-gray-500 text-[#F4EFE7] font-medium text-sm py-2 px-4 rounded-full transition duration-150 ease-in-out">
                    Daftar
                </a>
                <a href="{{ route('login') }}" class="bg-[#F4EFE7] hover:bg-white text-black font-medium text-sm py-2 px-4 rounded-full transition duration-150 ease-in-out">
                    Masuk
                </a>
            </nav>
        @endif

    </div>
</header>