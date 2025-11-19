<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="relative w-full min-h-full bg-[#181C14] text-[#F4EFE7] px-12 pb-20 mt-25">

        <div class="flex items-center justify-between mb-6">
            <h2 class="text-5xl tracking-wide">ULASAN</h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            {{-- Rating Summary --}}
            <div class="bg-black/40 p-6 rounded-xl border border-[#F4EFE7] h-110">
                <p class="text-5xl font-bold">4.9 <span class="text-2xl">/ 5</span></p>
                <p class="text-gray-300 mb-4">2518 Penilaian</p>

                {{-- Bar Graph --}}
                <div class="space-y-2">
                    @for ($i = 5; $i >= 1; $i--)
                        <div class="flex items-center gap-4">
                            <span class="w-8">{{ $i }}</span>
                            <div class="flex-1 h-2 bg-[#F4EFE7]/20 rounded-full">
                                <div class="h-2 bg-yellow-400 rounded-full w-[{{ rand(40, 100) }}%]"></div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            {{-- Individual Reviews --}}
            <div class="space-y-6">

                {{-- Review Card 1 --}}
                <div class="bg-black/40 p-6 rounded-xl border border-[#F4EFE7]">

                    <div class="flex items-center gap-4">

                        {{-- Avatar + Initials Style (mirip profil halaman akun) --}}
                        <div
                            class="w-14 h-14 rounded-full bg-[#F4EFE7] flex items-center justify-center 
                        text-black text-xl font-bold">
                            AJ
                        </div>

                        <div>
                            <p class="font-bold text-lg">Anggita Jeon</p>
                            <p class="text-yellow-400 text-sm">★★★★☆</p>
                        </div>
                    </div>

                    <p class="mt-4 text-gray-300 leading-relaxed">
                        Suasananya nyaman! Pelayan ramah & tempatnya cozy!
                    </p>
                </div>

                {{-- Review Card 2 --}}
                <div class="bg-black/40 p-6 rounded-xl border border-[#F4EFE7]">

                    <div class="flex items-center gap-4">

                        {{-- Avatar --}}
                        <div
                            class="w-14 h-14 rounded-full bg-[#F4EFE7] flex items-center justify-center 
                        text-black text-xl font-bold">
                            AN
                        </div>

                        <div>
                            <p class="font-bold text-lg">Afra Naila</p>
                            <p class="text-yellow-400 text-sm">★★★★★</p>
                        </div>
                    </div>

                    <p class="mt-4 text-gray-300 leading-relaxed">
                        Tempat biliar terbaik di Bogor! Harga terjangkau, kualitas meja mantap
                    </p>
                </div>

            </div>

        </div>
    </section>

</x-Layout>
