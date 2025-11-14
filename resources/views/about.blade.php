<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

{{-- Konten About Us Page --}}
<section id="about"
    style="background-image: url('{{ asset('img/bgabout.png') }}');"
    class="min-h-screen flex justify-center bg-cover bg-center bg-no-repeat py-24">

    <div class="container pt-8 mx-auto relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-5xl text-white mb-16">TENTANG KAMI</h2>
            <p class="text-white font-medium text-lg leading-relaxed mb-10">
                Selamat datang di Random Shot Pool & Cafe, tempat seru buat kamu yang pengin main biliar, 
                nongkrong santai, atau sekadar ngisi waktu bareng teman.
            </p>

            <p class="text-white font-medium text-lg leading-relaxed mb-10">
                Kami berdiri karena kecintaan kami terhadap suasana santai dan kompetitif dari permainan biliar yang dulu sering dimainkan saat berkuliah di Bandung.
                Melihat peluang bisnis biliar yang menjanjikan di daerah Citeureup, di mana waktu itu hanya ada satu tempat biliar, akhirnya lahirlah Random Shot Pool and Cafe.
            </p>

    <div class="container pt-32 mx-auto relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-5xl text-white mb-8">LAYANAN DI RANDOM SHOT POOL & CAFE</h2>

    <!-- Kotak-kotak menu -->
    <div class="flex flex-wrap justify-center gap-4">
    <div class="border border-white text-white rounded-lg px-6 py-3">Meja Biliar</div>
    <div class="border border-white text-white rounded-lg px-6 py-3">Meja Tenis</div>
    <div class="border border-white text-white rounded-lg px-6 py-3">PlayStation 4</div>
    <div class="border border-white text-white rounded-lg px-6 py-3">Cafe</div>
    </div>
        
        <div class="container pt-32 mx-auto relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-5xl text-white mb-8">CARA RESERVASI</h2> 
            <p class="text-white font-medium text-lg leading-relaxed mb-10">
                Kamu bisa reservasi meja dengan mudah lewat Website ini, WhatsApp, 
                atau langsung datang ke tempat. Reservasi bersifat fleksibel. Selama masih ada karyawan di tempat, 
                kamu tetap bisa main bahkan hingga dini hari.
            </p>
        
        <div class="container pt-32 mx-auto relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-5xl text-white mb-8">JAM OPERASIONAL</h2> 
            <p class="text-white font-medium text-lg leading-relaxed mb-10">
                🕙 10.00 – 02.00 WIB<br>jam operasional fleksibel, bisa lebih lama jika masih ada pelanggan<br>yang ingin menikmati permainan
            </p>
            
            <p class="text-white font-medium italic text-lg leading-relaxed mb-10">
            “Kami percaya hiburan terbaik bukan cuma soal permainan, tapi juga soal suasana dan kebersamaan”
            </p>
        </section>

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


      </div>
</x-Layout>