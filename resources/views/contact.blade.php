<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>


    <!-- Background -->
    <div class="relative w-full min-h-screen bg-black overflow-hidden">
        <img src="{{ asset('img/kontak.png') }}"
            class="absolute inset-0 w-full h-full object-cover object-center mix-blend-lighten opacity-50">

        <!-- Kontak Kami -->
        <div class="text-center text-[#FFF4E4] font-bold-1/2 ">
            <h1 class="text-8xl mt-15 mb-15">Kontak kami</h1>
            <p class="text-2xl mb-40 w-3xl mx-auto">
                Punya pertanyaan, mau reservasi meja, atau sekadar tanya menu? Kami dengan senang hati siap membantu
                kamu!
            </p>
        </div>

        <!-- Maps dan Informasi -->
        <div class="flex justify-center gap-15 relative z-10">
            <iframe class="rounded-xl ml-45"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3768.0901162341!2d106.89857757475292!3d-6.491611893500439!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c10029dbb1e1%3A0x6fb32a5ac5a27d5a!2sRandom%20Shot%20Pool%20And%20Cafe!5e0!3m2!1sen!2sid!4v1762845024245!5m2!1sen!2sid"
                width="450" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
            <div class="text-[#FFF4E4]">
                <h2 class="text-5xl tracking-wide font-bold-1/2 mb-5">Yuk cari tau tentang Random Shot and Pool!</h2>
                <p class="text-xl leading-10">WhatsApp: 0812-3456-7890 <br>
                    Email: randomshot.cafe@gmail.com <br>
                    Alamat: Perumahan indogreen Blok D1 No 1, Gunung Sari, Citeureup, Bogor, Indonesia</p>
            </div>
        </div>

        <!-- Medsos -->
        <div class="text-[#FFF4E4] text-center">
            <h2 class="text-5xl tracking-wide font-bold-1/2 mt-35 mb-10">media sosial</h2>
            <p class="text-xl">
                Ikuti kami biar nggak ketinggalan info turnamen, promo, dan event seru lainnya!</p>
            <div class="text-xl mt-10 mb-4">
                <a href="instagram">@rspoolcafe.bgr</a>
            </div>
            <div class="text-xl mt-8 mb-25">
                <a href="tiktok">@randomshot.poolandcafe</a>
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