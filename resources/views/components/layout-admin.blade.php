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

        /* CUSTOM STYLE SWEETALERT */
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

    <div x-data="{ isSidebarOpen: false }" class="flex min-h-screen">
        
        {{-- SIDEBAR --}}
        <aside x-cloak
            class="w-72 bg-[#3C3D37] text-[#F4EFE7] p-6 flex flex-col space-y-8 fixed inset-y-0 left-0 z-20
                   transform transition-transform duration-300 ease-in-out -translate-x-full"
            :class="{ 'translate-x-0': isSidebarOpen, '-translate-x-full': !isSidebarOpen }">

            <div class="flex justify-between items-center">
                <h1 class="text-4xl font-bold-1/2 tracking-wide">HALO,<br>ADMIN!</h1>
                <button @click="isSidebarOpen = false" title="Tutup Sidebar" class="text-[#F4EFE7]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>
                </button>
            </div>

            <nav class="flex flex-col space-y-3">
                
                {{-- 1. DATA RESERVASI & PESANAN (DIPERBAIKI: ADD BADGE) --}}
                <a href="{{ route('admin.reservation') }}"
                    class="group flex items-center justify-between text-lg py-2 px-3 rounded-lg transition-colors duration-150 
                    {{ request()->routeIs('admin.reservation*') || request()->routeIs('admin.order*') 
                        ? 'bg-black border border-[#F4EFE7] text-[#F4EFE7] font-semibold' 
                        : 'text-[#F4EFE7] hover:bg-white/5' }}">
                    
                    <span>Data Reservasi & Pesanan</span>

                    {{-- BADGE MERAH (Untuk Pesanan Menu yg Menunggu Dibuat) --}}
                    @if (isset($pendingOrdersCount) && $pendingOrdersCount > 0)
                        <span class="flex items-center justify-center w-5 h-5 text-[10px] font-bold text-white bg-red-500 rounded-full animate-pulse shadow-[0_0_10px_rgba(239,68,68,0.6)]">
                            {{ $pendingOrdersCount > 99 ? '99+' : $pendingOrdersCount }}
                        </span>
                    @endif
                </a>

                {{-- 2. DATA TRANSAKSI --}}
                <a href="{{ route('admin.transaction') }}"
                    class="group flex items-center justify-between text-lg py-2 px-3 rounded-lg transition-colors duration-150
                    {{ request()->routeIs('admin.transaction*')
                        ? 'bg-black border border-[#F4EFE7] text-[#F4EFE7] font-semibold'
                        : 'text-[#F4EFE7] hover:bg-white/5' }}">

                    <span>Data Transaksi</span>

                    {{-- Badge Notifikasi (Untuk Unpaid) --}}
                    @if (isset($pendingTrxCount) && $pendingTrxCount > 0)
                        <span
                            class="flex items-center justify-center w-5 h-5 text-[10px] font-bold text-white bg-red-500 rounded-full animate-pulse shadow-[0_0_10px_rgba(239,68,68,0.6)]">
                            {{ $pendingTrxCount > 99 ? '99+' : $pendingTrxCount }}
                        </span>
                    @endif
                </a>

                {{-- 3. DATA MEJA DAN MENU (DROPDOWN) --}}
                {{-- Perbaikan: Cek route admin.menu*, bukan admin.order* --}}
                <div x-data="{ open: {{ request()->routeIs('admin.table*') || request()->routeIs('admin.menu*') ? 'true' : 'false' }} }" class="space-y-1">
                    
                    <button @click="open = !open"
                        class="w-full flex items-center justify-between text-lg py-2 px-3 rounded-lg transition-colors duration-150 
                        {{ request()->routeIs('admin.table*') || request()->routeIs('admin.menu*') ? 'bg-black border border-[#F4EFE7] text-[#F4EFE7] font-semibold' : 'text-[#F4EFE7] hover:bg-white/5' }}">
                        <span>Data Meja & Menu</span>
                        <svg :class="open ? 'rotate-90' : ''" class="w-4 h-4 transition-transform"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>

                    <div x-show="open" x-collapse x-cloak class="ml-4 space-y-1 border-l border-white/20 pl-2">
                        {{-- SUBMENU MEJA --}}
                        <a href="{{ route('admin.table') }}"
                            class="block text-sm py-2 px-3 rounded-lg transition-colors duration-150 
                            {{ request()->routeIs('admin.table*') ? 'text-[#e9d9c9] font-bold bg-white/5' : 'text-gray-400 hover:text-white' }}">
                            Data Meja
                        </a>
                        
                        {{-- SUBMENU MENU (Perbaikan: Link ke admin.menu, bukan admin.order) --}}
                        <a href="{{ route('admin.menu') }}"
                            class="block text-sm py-2 px-3 rounded-lg transition-colors duration-150 
                            {{ request()->routeIs('admin.menu*') ? 'text-[#e9d9c9] font-bold bg-white/5' : 'text-gray-400 hover:text-white' }}">
                            Data Menu
                        </a>
                    </div>
                </div>

                {{-- 4. INFORMASI PELANGGAN --}}
                <a href="{{ route('admin.customer') }}"
                    class="text-lg py-2 px-3 rounded-lg transition-colors duration-150 {{ request()->routeIs('admin.customer') ? 'bg-black border border-[#F4EFE7] text-[#F4EFE7] font-semibold' : 'text-[#F4EFE7] hover:bg-white/5' }}">
                    Informasi Pelanggan
                </a>
            </nav>
        </aside>

        {{-- MAIN CONTENT --}}
        <main class="flex-1 p-8 transition-all duration-300 ease-in-out bg-[#181C14] ml-0"
            :class="{ 'ml-72': isSidebarOpen, 'ml-0': !isSidebarOpen }">

            <x-HeaderAdmin></x-HeaderAdmin>

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
    </script>

</body>
</html>