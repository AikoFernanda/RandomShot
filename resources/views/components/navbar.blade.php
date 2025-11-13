<!-- Kanan: Tautan Navigasi -->
<nav class="flex items-center space-x-14 text-white">
    <a href="{{ route('home') }}"
        class="font-reguler text-sm hover:text-yellow-400 transition duration-200 {{ Request::is('home') ? 'text-yellow-400 font-semibold' : 'text-white hover:text-yellow-400' }}">
        Beranda
    </a>
    <a href="#"
        class="font-reguler text-sm hover:text-yellow-400 transition duration-200 {{ Request::is('reservation') ? 'text-yellow-400 font-semibold' : 'text-white hover:text-yellow-400' }}">
        Reservasi
    </a>
    <a href="#"
        class="font-reguler text-sm hover:text-yellow-400 transition duration-200 {{ Request::is('cafe') ? 'text-yellow-400 font-semibold' : 'text-white hover:text-yellow-400' }}">
        Cafe
    </a>
    <a href="#"
        class="font-reguler text-sm hover:text-yellow-400 transition duration-200 {{ Request::is('about') ? 'text-yellow-400 font-semibold' : 'text-white hover:text-yellow-400' }}">
        Tentang Kami
    </a>
    <a href="{{ route('contact_us') }}"
        class="font-reguler text-sm hover:text-yellow-400 transition duration-200 {{ Request::is('contact') ? 'text-yellow-400 font-semibold' : 'text-white hover:text-yellow-400' }}">
        Kontak Kami
    </a>
</nav>
