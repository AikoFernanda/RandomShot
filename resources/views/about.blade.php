<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- mengangkat posisi Footer --}}
    <style>
        /* Memaksa elemen footer agar muncul di atas background fixed */
        footer {
            position: relative !important;
            z-index: 50 !important;
        }
    </style>

    {{-- WRAPPER UTAMA --}}
    <div class="relative min-h-screen font-poppins text-[#F4EFE7]">

        <div class="fixed inset-0 z-0">
            <div class="absolute inset-0 bg-cover bg-top bg-no-repeat"
                style="background-image: url('{{ asset('img/bgabout.png') }}');">
            </div>

            {{-- Gradient Overlay: Bagian atas tipis (30%) agar bola terlihat, bawah pekat --}}
            <div class="absolute inset-0 bg-gradient-to-b from-black/0 via-[#0e0f0b]/50 to-[#0e0f0b]"></div>
        </div>
        {{-- ================================================================== --}}

        {{-- KONTEN --}}
        <div class="relative z-10 container mx-auto px-6 py-24 md:py-32 space-y-20 max-w-6xl">

            {{-- 1. INTRO SECTION --}}
            <div class="text-center space-y-6">
                <h1 class="text-6xl md:text-8xl font-bebas tracking-wide text-[#e9d9c9] drop-shadow-lg">
                    TENTANG KAMI
                </h1>
                <div
                    class="max-w-3xl mx-auto space-y-6 text-gray-200 md:text-lg leading-relaxed font-medium drop-shadow-md">
                    <p>
                        Selamat datang di <span class="text-[#e9d9c9] font-bold">Random Shot Pool & Cafe</span>,
                        destinasi utama buat kamu yang mencari kombinasi sempurna antara olahraga ketangkasan,
                        tempat nongkrong asik, dan suasana kompetitif yang bersahabat.
                    </p>
                </div>
            </div>

            {{-- 2. CERITA & LAYANAN GRID --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 items-start">

                {{-- Kiri: Cerita Kami --}}
                <div class="bg-black/40 border border-white/10 p-8 rounded-2xl backdrop-blur-md shadow-xl h-full">
                    <h2 class="text-3xl font-bebas text-[#e9d9c9] mb-4 flex items-center gap-3">
                        <span class="w-8 h-0.5 bg-[#e9d9c9]"></span> CERITA KAMI
                    </h2>
                    <p class="text-gray-200 leading-relaxed mb-4 font-light">
                        Kami berdiri karena kecintaan mendalam terhadap suasana santai namun kompetitif dari permainan
                        biliar
                        yang dulu sering kami mainkan saat masa kuliah di Bandung.
                    </p>
                    <p class="text-gray-200 leading-relaxed font-light">
                        Melihat peluang di Citeureup yang kala itu minim hiburan berkualitas, kami hadir sebagai
                        jawaban.
                        Random Shot bukan sekadar tempat main, tapi rumah bagi komunitas.
                    </p>
                </div>

                {{-- Kanan: Fasilitas --}}
                <div class="space-y-6">
                    <h2 class="text-3xl font-bebas text-white mb-4 text-right md:text-left drop-shadow-md">FASILITAS &
                        LAYANAN</h2>

                    <div class="grid grid-cols-2 gap-4">
                        {{-- Card Layanan --}}
                        <div
                            class="group bg-black/40 border border-white/10 hover:border-[#e9d9c9] hover:bg-[#e9d9c9] p-4 rounded-xl transition duration-300 flex flex-col items-center justify-center gap-2 text-center cursor-default backdrop-blur-sm">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-8 w-8 text-[#e9d9c9] group-hover:text-black transition" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="8" x2="12" y2="12" />
                                <line x1="12" y1="16" x2="12.01" y2="16" />
                            </svg>
                            <span class="font-bebas text-xl text-gray-200 group-hover:text-black tracking-wide">Meja
                                Biliar</span>
                        </div>

                        <div
                            class="group bg-black/40 border border-white/10 hover:border-[#e9d9c9] hover:bg-[#e9d9c9] p-4 rounded-xl transition duration-300 flex flex-col items-center justify-center gap-2 text-center cursor-default backdrop-blur-sm">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-8 w-8 text-[#e9d9c9] group-hover:text-black transition" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M2 12h20M2 12l5-5m-5 5l5 5" />
                            </svg>
                            <span class="font-bebas text-xl text-gray-200 group-hover:text-black tracking-wide">Meja
                                Tenis</span>
                        </div>

                        <div
                            class="group bg-black/40 border border-white/10 hover:border-[#e9d9c9] hover:bg-[#e9d9c9] p-4 rounded-xl transition duration-300 flex flex-col items-center justify-center gap-2 text-center cursor-default backdrop-blur-sm">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-8 w-8 text-[#e9d9c9] group-hover:text-black transition" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round">
                                <rect x="2" y="3" width="20" height="14" rx="2" ry="2" />
                                <line x1="8" y1="21" x2="16" y2="21" />
                                <line x1="12" y1="17" x2="12" y2="21" />
                            </svg>
                            <span class="font-bebas text-xl text-gray-200 group-hover:text-black tracking-wide">PS
                                4</span>
                        </div>

                        <div
                            class="group bg-black/40 border border-white/10 hover:border-[#e9d9c9] hover:bg-[#e9d9c9] p-4 rounded-xl transition duration-300 flex flex-col items-center justify-center gap-2 text-center cursor-default backdrop-blur-sm">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-8 w-8 text-[#e9d9c9] group-hover:text-black transition" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M18 8h1a4 4 0 0 1 0 8h-1" />
                                <path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z" />
                                <line x1="6" y1="1" x2="6" y2="4" />
                                <line x1="10" y1="1" x2="10" y2="4" />
                                <line x1="14" y1="1" x2="14" y2="4" />
                            </svg>
                            <span class="font-bebas text-xl text-gray-200 group-hover:text-black tracking-wide">Cafe &
                                Chill</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 3. INFO SECTION (Jam & Reservasi) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Jam Operasional --}}
                <div
                    class="md:col-span-1 bg-[#e9d9c9]/90 backdrop-blur-sm text-black p-8 rounded-2xl shadow-[0_0_20px_rgba(233,217,201,0.2)] flex flex-col justify-between">
                    <div>
                        <h3 class="text-3xl font-bebas mb-4">JAM BUKA</h3> {{-- Layout Flexbox biar rapi --}}
                        <div class="space-y-2">
                            <div class="flex justify-between items-baseline border-b border-black/10 pb-2">
                                <span class="font-bebas text-4xl">10.00</span>
                                <span class="font-bold text-sm tracking-widest uppercase opacity-70">Pagi</span>
                            </div>
                            <div class="flex justify-center text-xs font-bold opacity-50">- SAMPAI -</div>
                            <div class="flex justify-between items-baseline pt-1">
                                <span class="font-bebas text-4xl">02.00</span>
                                <span class="font-bold text-sm tracking-widest uppercase opacity-70">Dini Hari</span>
                            </div>
                        </div>

                    </div>
                    <p class="text-sm mt-6 border-t border-black/10 pt-4 italic font-medium">
                        "Main sampai puas! Kami buka sampai dini hari (atau lebih lama)."
                    </p>
                </div>

                {{-- Cara Reservasi --}}
                <div
                    class="md:col-span-2 bg-black/40 border border-white/10 p-8 rounded-2xl backdrop-blur-md flex flex-col justify-center">
                    <h3 class="text-3xl font-bebas text-[#e9d9c9] mb-4">CARA RESERVASI</h3>
                    <p class="text-gray-200 text-lg mb-6 font-light">
                        Gak perlu ribet. Amankan mejamu sekarang lewat Website, WhatsApp, atau langsung gas ke lokasi.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-center gap-4 p-4 rounded-xl bg-black/30 border border-white/5">
                            <div
                                class="w-10 h-10 rounded-full bg-[#e9d9c9] flex items-center justify-center text-black shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-white">Online</h4>
                                <p class="text-xs text-gray-300">Via Website / WhatsApp</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 p-4 rounded-xl bg-black/30 border border-white/5">
                            <div
                                class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center text-white shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-white">On The Spot</h4>
                                <p class="text-xs text-gray-300">Datang Langsung</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 4. QUOTE --}}
            <div class="text-center pt-10 border-t border-white/10">
                <p class="text-xl md:text-2xl font-medium italic text-gray-300 max-w-4xl mx-auto drop-shadow-sm">
                    “Kami percaya hiburan terbaik bukan cuma soal permainan, tapi juga soal <span
                        class="text-[#e9d9c9] not-italic font-bold">suasana dan kebersamaan</span>”
                </p>
            </div>

        </div>
    </div>
</x-Layout>
