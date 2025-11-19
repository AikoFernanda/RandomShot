<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>


    <!-- Background -->
    <div class="relative w-full min-h-screen bg-black overflow-hidden">
        <img src="{{ asset('img/kontak.png') }}"
            class="absolute inset-0 w-full h-full object-cover object-center mix-blend-lighten opacity-50">

        <!-- Kontak Kami -->
        <div class="text-center text-[#F4EFE7] font-bold-1/2 ">
            <h1 class="text-8xl py-10 mt-20">Kontak kami</h1>
            <p class="text-2xl mb-30 w-3xl mx-auto">
                Punya pertanyaan, mau reservasi meja, atau sekadar tanya menu? Kami dengan senang hati siap membantu
                kamu!
            </p>
        </div>

        <!-- Maps dan Informasi -->
        <div class="flex justify-center gap-10 relative z-10">
            <iframe class="rounded-xl"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3768.0901162341!2d106.89857757475292!3d-6.491611893500439!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c10029dbb1e1%3A0x6fb32a5ac5a27d5a!2sRandom%20Shot%20Pool%20And%20Cafe!5e0!3m2!1sen!2sid!4v1762845024245!5m2!1sen!2sid"
                width="450" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
            <div class="text-[#F4EFE7] bg-black p-5 rounded-2xl w-fit max-w-[750px] h-fit">
                <h2 class="text-5xl tracking-wide font-bold-1/2 mb-5">Yuk cari tau tentang Random Shot Pool and
                    Cafe!
                </h2>
                <p class="text-xl leading-10">WhatsApp: 0812-3456-7890 <br>
                    Email: randomshot.cafe@gmail.com <br>
                    Alamat: Perumahan indogreen Blok D1 No 1, Gunung Sari, Citeureup, Bogor, Indonesia</p>
            </div>
        </div>

        <!-- Medsos -->
        <div class="text-[#F4EFE7] text-center">
            <h2 class="text-5xl tracking-wide font-bold-1/2 mt-35 mb-10">media sosial</h2>
            <p class="text-xl">
                Ikuti kami biar nggak ketinggalan info turnamen, promo, dan event seru lainnya!</p>
            <div class="text-xl text-center mt-10">
                <a href="https://instagram.com/rspoolcafe.bgr"
                    class="ttext-[#F4EFE7] hover:text-[#3C3D37] transition flex items-center justify-center gap-2">

                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.5">
                        <rect x="3" y="3" width="18" height="18" rx="5" ry="5" />
                        <circle cx="12" cy="12" r="3.2" />
                        <circle cx="17.5" cy="6.5" r="0.8" fill="currentColor" />
                    </svg>@rspoolcafe.bgr</a>
            </div>

            <div class="text-xl mt-8 mb-25">
                <a href="https://tiktok.com/rspoolcafe.bgr"
                    class="ttext-[#F4EFE7] hover:text-[#3C3D37] transition flex items-center justify-center gap-2">
                    <svg class="text-[#F4EFE7] w-8 h-8" viewBox="0 0 24 24" fill="currentColor"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M16.75 2.5c.1 1.1.6 2.1 1.4 2.8.7.7 1.7 1.2 2.8 1.3v3c-1.5-.1-3-.6-4.2-1.5v7.4c0 4-3.2 7.3-7.3 7.3S2.5 19 2.5 15c0-4 3.2-7.3 7.3-7.3h1v3h-1c-2.4 0-4.3 2-4.3 4.3s2 4.3 4.3 4.3 4.3-2 4.3-4.3V2.5h3z" />
                    </svg>@rspoolcafe.bgr</a>
            </div>
            <p class="text-2xl font-bold italic mx-auto max-w-6xl mb-25">
                Kami selalu berusaha memberikan pelayanan terbaik dan pengalaman bermain yang seru. Jangan ragu untuk
                menghubungi kami. Tim Random Shot siap bantu kamu kapan pun!
            </p>
        </div>
    </div>

    <footer class="bg-black text-white py-10">
        <div class="px-12">
            <img id="img-logo-random-shot" src="{{ asset('img/logo-rs.png') }}" alt="logo_random_shot"
                class="w-64 h-auto mb-4">

            <p class="text-gray-400 text-base mb-4">
                Perumahan Indogreen Blok D1 No.1<br>
                Gunung Sari, Citeureup, Bogor, Indonesia
            </p>

            <p class="text-gray-500 text-xs">
                © 2025 Random Shot Pool and Cafe. All rights reserved.
            </p>
        </div>
    </footer>

</x-Layout>
