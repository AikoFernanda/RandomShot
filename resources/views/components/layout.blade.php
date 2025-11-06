<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Make sure your compiled CSS is included in the <head> then start using Tailwind’s utility classes to style your content and beri tahu Vite untuk memuat app.js --}}

    {{-- /* Folder public adalah satu-satunya folder di proyek Laravel-mu yang memang dirancang untuk bisa diakses langsung oleh browser. untuk me-link dari folder public, dari folder public, kamu harus menggunakan helper function Laravel yang bernama asset(). selalu menghasilkan URL absolut yang benar (akan selalu href root '/', misal http://random_shot.test/), tidak peduli kamu sedang ada di halaman mana.*/  --}}
    {{-- <link rel="stylesheet" href="css/landing_style.css"> href model begini sangat rapuh dan tidak direkomendasikan hanya akan berfungsi jika kamu sedang berada di halaman root (halaman utama) website-mu. Saya ada di root (/), jadi saya akan mencari file di http://random-shot.test/css/file.css--}}
</head>
<body>
    <x-Navbar></x-Navbar>
    <x-Header>{{ $title }}</x-Header>
    <main>
        @if (session('success'))
        <div id='popup-success' class="text-green-600 bg-green-100 p-2.5 border-green-500 rounded-[5px] mb-[15px]">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any() || session('error'))
        <div id='popup-error' class="text-red-600 bg-red-100 p-2.5 border border-red-500 rounded-[5px] mb-[15px]">
            <strong>Oops! Ada yang salah:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                <li>{{ session('error') }}</li>
            </ul>
        </div>
    @endif
    {{ $slot }}
    </main>
    <footer></footer>
</body>
</html>