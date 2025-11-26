{{-- resources/views/components/layout-admin.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Font Poppins (jika Anda load dari Google Fonts) --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins';
        }

        h1,
        h2,
        h3 {
            font-family: 'Bebas Neue';
        }
    </style>

</head>

<body> {{-- Background pink ada di body --}}

    {{-- Wrapper Utama Flex --}}
    <div x-data="{ isSidebarOpen: true }" class="flex min-h-screen">

        {{-- Kode sidebar --}}
        <aside
            class="w-72 bg-[#3C3D37] text-[#F4EFE7]  p-6 flex flex-col space-y-8 fixed inset-y-0 left-0 z-20
                   transform transition-transform duration-300 ease-in-out"
            :class="{ 'translate-x-0': isSidebarOpen, '-translate-x-full': !isSidebarOpen }">
            <div class="flex justify-between items-center">
                <h1 class="text-3xl leading-tight">HALO,<br>OWNER!</h1>

                {{-- 
                  Ubah <a> menjadi <button> dan tambahkan @click
                  Ini sekarang akan menutup sidebar
                --}}
                <button @click="isSidebarOpen = false" title="Tutup Sidebar" class="text-[#F4EFE7] ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>
                </button>
            </div>

            <nav class="flex flex-col space-y-3">

                <a href="{{ route('owner.performa') }}"
                    class="text-lg py-2 px-3 rounded-lg transition-colors duration-150
                    {{ request()->routeIs('owner.performa') ? 'bg-black border border-[#F4EFE7]  text-[#F4EFE7]  font-semibold' : 'text-[#F4EFE7] ' }}">
                    Performa Bisnis
                </a>

                <div x-data="{ open: false }" class="space-y-1">

                    <button @click="open = !open"
                        class="w-full flex items-center justify-between text-lg py-2 px-3 rounded-lg transition-colors duration-150
                           {{ request()->routeIs('owner.laporan.keuangan') ? 'bg-black border border-[#F4EFE7] font-semibold' : '' }}">
                        <span>Laporan Bisnis</span>

                        <svg :class="open ? 'rotate-90' : ''" class="w-4 h-4 transition-transform"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>

                    <div x-show="open" x-collapse class="ml-4 space-y-2">

                        {{-- LAPORAN KEUANGAN --}}
                        <a href="{{ route('owner.laporan.keuangan') }}"
                            class="block text-sm py-2 px-3 rounded-lg transition-colors duration-150
                        {{ request()->routeIs('owner.laporan.keuangan') ? 'bg-black/20 border border-[#F4EFE7]' : '' }}">
                            Laporan Keuangan
                        </a>

                        {{-- LAPORAN PENJUALAN (opsional) --}}
                        <a href="{{ route('owner.laporan.penjualan') }}"
                            class="block text-sm py-2 px-3 rounded-lg transition-colors duration-150
                        {{ request()->routeIs('owner.laporan.penjualan') ? 'bg-black/20 border border-[#F4EFE7]' : '' }}">
                            Laporan Penjualan
                        </a>

                    </div>
                </div>

                <a href="{{ route('owner.data.operasional') }}"
                    class="text-lg py-2 px-3 rounded-lg transition-colors duration-150
                    {{ request()->routeIs('owner.data.operasional') ? 'bg-black border border-[#F4EFE7]  text-[#F4EFE7]  font-semibold' : 'text-[#F4EFE7] ' }}">
                    Data Operasional
                </a>

                <a href="{{ route('owner.feedback') }}"
                    class="text-lg py-2 px-3 rounded-lg transition-colors duration-150
                    {{ request()->routeIs('owner.feedback') ? 'bg-black border border-[#F4EFE7]  text-[#F4EFE7]  font-semibold' : 'text-[#F4EFE7] ' }}">
                    Feedback
                </a>

                <a href="{{ route('owner.data-admin') }}"
                    class="text-lg py-2 px-3 rounded-lg transition-colors duration-150
                    {{ request()->routeIs('owner.data-admin') ? 'bg-black border border-[#F4EFE7]  text-[#F4EFE7]  font-semibold' : 'text-[#F4EFE7] ' }}">
                    Data Admin
                </a>

            </nav>
        </aside>
        {{-- 
          class binding ke <main>
          - 'ml-72': Beri margin kiri se-lebar sidebar (saat isSidebarOpen = true)
          - 'ml-0': Margin kiri 0 (saat isSidebarOpen = false)
          - 'transition-all duration-300' untuk animasi margin
        --}}
        <main class="flex-1 p-8 transition-all duration-300 ease-in-out bg-black"
            :class="{ 'ml-72': isSidebarOpen, 'ml-0': !isSidebarOpen }">

            <x-HeaderAdmin></x-HeaderAdmin>

            {{-- Konten $slot sekarang ada di bawah header baru --}}
            {{ $slot }}

        </main>
    </div>

</body>

</html>
