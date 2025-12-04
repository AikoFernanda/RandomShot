<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- Footer muncul di atas background --}}
    <style>
        footer {
            position: relative !important;
            z-index: 50 !important;
        }
    </style>

    {{-- WRAPPER UTAMA --}}
    <div class="relative min-h-screen font-poppins text-[#F4EFE7]">

        <div class="fixed inset-0 z-0">
            {{-- Gambar Background --}}
            <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
                style="background-image: url('{{ asset('img/kontak.png') }}');">
            </div>
            
            {{-- Gradient Overlay --}}
            {{-- Atas agak terang (50%), Bawah gelap pekat (biar footer/konten bawah enak dibaca) --}}
            <div class="absolute inset-0 bg-gradient-to-b from-black/30 via-[#0e0f0b]/100 to-[#0e0f0b]"></div>
        </div>

        {{-- KONTEN --}}
        <div class="relative z-10 container mx-auto px-6 py-24 md:py-32 space-y-20 max-w-6xl">

            {{-- 1. HEADER SECTION --}}
            <div class="text-center space-y-6">
                <h1 class="text-6xl md:text-8xl font-bebas tracking-wide text-[#e9d9c9] drop-shadow-lg">
                    HUBUNGI KAMI
                </h1>
                <p class="max-w-2xl mx-auto text-gray-200 text-lg leading-relaxed font-medium drop-shadow-md">
                    Punya pertanyaan, mau reservasi meja, atau sekadar tanya menu? 
                    Jangan ragu, Tim <span class="text-[#e9d9c9] font-bold">Random Shot</span> siap membantu kamu!
                </p>
            </div>

            {{-- 2. CONTACT & MAP GRID --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-stretch">

                {{-- Kiri: Informasi Kontak --}}
                <div class="space-y-6">
                    <h2 class="text-3xl font-bebas text-white mb-6 drop-shadow-md">INFORMASI KONTAK</h2>

                    {{-- Card: Alamat --}}
                    <div class="bg-black/40 border border-white/10 p-6 rounded-2xl flex items-start gap-5 hover:border-[#e9d9c9] transition duration-300 group backdrop-blur-sm shadow-lg">
                        <div class="w-12 h-12 rounded-full bg-[#e9d9c9] flex items-center justify-center shrink-0 text-black group-hover:scale-110 transition duration-300 shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        </div>
                        <div>
                            <h3 class="font-bebas text-xl text-[#e9d9c9] mb-1">ALAMAT</h3>
                            <p class="text-gray-200 text-sm leading-relaxed font-light">
                                Perumahan Indogreen Blok D1 No 1,<br>Gunung Sari, Citeureup, Bogor, Indonesia
                            </p>
                        </div>
                    </div>

                    {{-- Card: WhatsApp --}}
                    <a href="https://wa.me/6281234567890" target="_blank" class="bg-black/40 border border-white/10 p-6 rounded-2xl flex items-center gap-5 hover:border-[#e9d9c9] hover:bg-white/5 transition duration-300 group backdrop-blur-sm shadow-lg">
                        <div class="w-12 h-12 rounded-full bg-[#e9d9c9] flex items-center justify-center shrink-0 text-black group-hover:scale-110 transition duration-300 shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                        </div>
                        <div>
                            <h3 class="font-bebas text-xl text-[#e9d9c9] mb-1">WHATSAPP</h3>
                            <p class="text-gray-200 text-sm font-light">0812-3456-7890</p>
                        </div>
                    </a>

                    {{-- Card: Email --}}
                    <a href="mailto:randomshot.cafe@gmail.com" class="bg-black/40 border border-white/10 p-6 rounded-2xl flex items-center gap-5 hover:border-[#e9d9c9] hover:bg-white/5 transition duration-300 group backdrop-blur-sm shadow-lg">
                        <div class="w-12 h-12 rounded-full bg-[#e9d9c9] flex items-center justify-center shrink-0 text-black group-hover:scale-110 transition duration-300 shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                        </div>
                        <div>
                            <h3 class="font-bebas text-xl text-[#e9d9c9] mb-1">EMAIL</h3>
                            <p class="text-gray-200 text-sm font-light">randomshot.cafe@gmail.com</p>
                        </div>
                    </a>

                </div>

                {{-- Kanan: MAPS --}}
                <div class="h-full min-h-[400px] w-full bg-[#1a1a19] rounded-2xl border border-white/10 overflow-hidden shadow-2xl relative group">
                    {{-- Embed Maps --}}
                    <iframe class="w-full h-full opacity-80 group-hover:opacity-100 transition duration-500"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.952912260219!2d106.8665!3d-6.527!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMzEnMzcuMiJTIDEwNsKwNTEnNTkuNCJF!5e0!3m2!1sen!2sid!4v1600000000000!5m2!1sen!2sid"
                        style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            {{-- 3. SOCIAL MEDIA SECTION --}}
            <div class="pt-10 border-t border-white/10 text-center">
                <h2 class="text-4xl font-bebas tracking-wide mb-8 text-white drop-shadow-md">IKUTI KAMI DI SOSIAL MEDIA</h2>
                <p class="text-gray-300 mb-8 max-w-xl mx-auto font-light">
                    Biar nggak ketinggalan info turnamen, promo, dan event seru lainnya!
                </p>

                <div class="flex flex-col md:flex-row justify-center gap-6">
                    
                    {{-- Instagram Button --}}
                    <a href="https://instagram.com/rspoolcafe.bgr" target="_blank"
                        class="group bg-gradient-to-br from-purple-900/40 to-pink-900/40 border border-white/10 hover:border-pink-500 hover:scale-105 transition duration-300 rounded-xl px-8 py-4 flex items-center justify-center gap-4 w-full md:w-64 backdrop-blur-sm shadow-lg">
                        <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                        </svg>
                        <span class="text-white font-bold group-hover:text-pink-400 transition">@rspoolcafe.bgr</span>
                    </a>

                    {{-- TikTok Button --}}
                    <a href="https://tiktok.com/@rspoolcafe.bgr" target="_blank"
                        class="group bg-black/40 border border-white/10 hover:border-cyan-400 hover:scale-105 transition duration-300 rounded-xl px-8 py-4 flex items-center justify-center gap-4 w-full md:w-64 backdrop-blur-sm shadow-lg">
                        <svg class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
                        </svg>
                        <span class="text-white font-bold group-hover:text-cyan-400 transition">@rspoolcafe.bgr</span>
                    </a>

                </div>
            </div>

            {{-- 4. FOOTER QUOTE --}}
            <div class="text-center">
                <p class="text-lg md:text-xl font-medium italic text-gray-400 max-w-4xl mx-auto drop-shadow-sm">
                    “Kami selalu berusaha memberikan pelayanan terbaik. Tim Random Shot siap bantu kamu kapan pun!”
                </p>
            </div>

        </div>
    </div>
</x-Layout>