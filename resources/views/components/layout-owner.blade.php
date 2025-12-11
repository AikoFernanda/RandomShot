<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

    {{-- ALPINE JS --}}
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- SWEETALERT CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- FONTS --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins'; }
        h1, h2, h3 { font-family: 'Bebas Neue'; }
        [x-cloak] { display: none !important; }

        /* CUSTOM STYLE SWEETALERT (Dark & Gold Theme) */
        div:where(.swal2-container).swal2-top-end>.swal2-popup,
        div:where(.swal2-container).swal2-top-right>.swal2-popup {
            grid-column: 2;
            align-self: start;
            justify-self: end;
            background: #1a1a19 !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: #F4EFE7 !important;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.5) !important;
        }
        .swal2-title {
            font-family: 'Poppins', sans-serif !important;
            font-size: 0.9rem !important;
            font-weight: 600 !important;
        }
        .swal2-timer-progress-bar { background: #e9d9c9 !important; }
    </style>
</head>

<body class="bg-[#F4EFE7]"> 

    {{-- Wrapper Utama Flex --}}
    <div x-data="{ isSidebarOpen: false }" class="flex min-h-screen">
        
        {{-- SIDEBAR --}}
        <aside x-cloak
            class="w-72 bg-[#3C3D37] text-[#F4EFE7] p-6 flex flex-col space-y-8 fixed inset-y-0 left-0 z-20
                   transform transition-transform duration-300 ease-in-out -translate-x-full"
            :class="{ 'translate-x-0': isSidebarOpen, '-translate-x-full': !isSidebarOpen }">

            <div class="flex justify-between items-center">
                <h1 class="text-4xl font-bold-1/2 tracking-wide">HALO,<br>OWNER!</h1>
                <button @click="isSidebarOpen = false" title="Tutup Sidebar" class="text-[#F4EFE7]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>
                </button>
            </div>

            <nav class="flex flex-col space-y-3">
                
                {{-- 1. PERFORMA BISNIS --}}
                <a href="{{ route('owner.performance') }}"
                    class="text-lg py-2 px-3 rounded-lg transition-colors duration-150 
                    {{ request()->routeIs('owner.performance*') 
                        ? 'bg-black border border-[#F4EFE7] text-[#F4EFE7] font-semibold' 
                        : 'text-[#F4EFE7] hover:bg-white/5' }}">
                    Performa Bisnis
                </a>

                {{-- 2. LAPORAN BISNIS (DROPDOWN) --}}
                <div x-data="{ open: {{ request()->routeIs('owner.laporan*') ? 'true' : 'false' }} }" class="space-y-1">
                    
                    <button @click="open = !open"
                        class="w-full flex items-center justify-between text-lg py-2 px-3 rounded-lg transition-colors duration-150 
                        {{ request()->routeIs('owner.laporan*') ? 'bg-black border border-[#F4EFE7] text-[#F4EFE7] font-semibold' : 'text-[#F4EFE7] hover:bg-white/5' }}">
                        <span>Laporan Bisnis</span>
                        <svg :class="open ? 'rotate-90' : ''" class="w-4 h-4 transition-transform"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>

                    <div x-show="open" x-collapse x-cloak class="ml-4 space-y-1 border-l border-white/20 pl-2">
                        
                        {{-- Laporan Keuangan --}}
                        <a href="{{ route('owner.laporan.keuangan') }}"
                            class="block text-sm py-2 px-3 rounded-lg transition-colors duration-150 
                            {{ request()->routeIs('owner.laporan.keuangan') ? 'text-[#e9d9c9] font-bold bg-white/5' : 'text-gray-400 hover:text-white' }}">
                            Laporan Keuangan
                        </a>
                        
                        {{-- Laporan Penjualan --}}
                        <a href="{{ route('owner.laporan.penjualan') }}"
                            class="block text-sm py-2 px-3 rounded-lg transition-colors duration-150 
                            {{ request()->routeIs('owner.laporan.penjualan') ? 'text-[#e9d9c9] font-bold bg-white/5' : 'text-gray-400 hover:text-white' }}">
                            Laporan Penjualan
                        </a>
                    </div>
                </div>

                {{-- 3. DATA OPERASIONAL --}}
                <a href="{{ route('owner.data.operasional') }}"
                    class="text-lg py-2 px-3 rounded-lg transition-colors duration-150 
                    {{ request()->routeIs('owner.data.operasional') 
                        ? 'bg-black border border-[#F4EFE7] text-[#F4EFE7] font-semibold' 
                        : 'text-[#F4EFE7] hover:bg-white/5' }}">
                    Data Operasional
                </a>

                {{-- 4. FEEDBACK PELANGGAN --}}
                <a href="{{ route('owner.feedback') }}"
                    class="text-lg py-2 px-3 rounded-lg transition-colors duration-150 
                    {{ request()->routeIs('owner.feedback') 
                        ? 'bg-black border border-[#F4EFE7] text-[#F4EFE7] font-semibold' 
                        : 'text-[#F4EFE7] hover:bg-white/5' }}">
                    Feedback Pelanggan
                </a>

                {{-- 5. KELOLA ADMIN --}}
                <a href="{{ route('owner.data-admin') }}"
                    class="text-lg py-2 px-3 rounded-lg transition-colors duration-150 
                    {{ request()->routeIs('owner.data-admin') 
                        ? 'bg-black border border-[#F4EFE7] text-[#F4EFE7] font-semibold' 
                        : 'text-[#F4EFE7] hover:bg-white/5' }}">
                    Kelola Data Admin
                </a>

            </nav>
        </aside>

        {{-- MAIN CONTENT --}}
        <main class="flex-1 p-8 transition-all duration-300 ease-in-out bg-[#181C14] ml-0"
            :class="{ 'ml-72': isSidebarOpen, 'ml-0': !isSidebarOpen }">

            {{-- HEADER ( pakai komponen owner yang sama, ini untuk laravel cari view compoent, kalau HeaderOwner untuk class component) --}}
            <x-header-owner />

            {{ $slot }}

        </main>
    </div>

    {{-- SWEETALERT JS --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        @if (session('success'))
            Toast.fire({ icon: 'success', title: "{{ session('success') }}", iconColor: '#4ade80' });
        @endif

        @if (session('error'))
            Toast.fire({ icon: 'error', title: "{{ session('error') }}", iconColor: '#ef4444' });
        @endif

        @if (session('info'))
            Toast.fire({ icon: 'info', title: "{{ session('info') }}", iconColor: '#3b82f6' });
        @endif
    </script>

</body>
</html>