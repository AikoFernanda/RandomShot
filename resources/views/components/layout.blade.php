<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

    {{-- Plugin Collapse (WAJIB DI ATAS SCRIPT UTAMA ALPINE) --}}
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>

    {{-- Script Utama Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- SweetAlert2 CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        html,
        body {
            background-color: #181C14;
        }

        /* FORCE SMOOTH SCROLL */
        html {
            scroll-behavior: smooth !important;
        }

        body {
            font-family: 'Poppins', sans-serif;
        }

        h1,
        h2,
        h3 {
            font-family: 'Bebas Neue', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }

        /* Toast Custom */
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

        .swal2-timer-progress-bar {
            background: #e9d9c9 !important;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#181C14] text-white">

    <x-Header></x-Header>

    <main>
        {{ $slot }}
    </main>

    <x-Footer></x-Footer>

    {{-- SweetAlert2 --}}
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
            Toast.fire({
                icon: 'success',
                title: "{{ session('success') }}",
                iconColor: '#4ade80'
            });
        @endif

        @if (session('error'))
            Toast.fire({
                icon: 'error',
                title: "{{ session('error') }}",
                iconColor: '#ef4444'
            });
        @endif

        @if (session('info'))
            Toast.fire({
                icon: 'info',
                title: "{{ session('info') }}",
                iconColor: '#3b82f6'
            });
        @endif
    </script>

</body>

</html>