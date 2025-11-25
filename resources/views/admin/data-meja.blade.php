<x-layout-admin>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="bg-[#181C14]">

        <!-- Pilihan meja -->
        <div class="grid grid-cols-3 gap-2 w-3xl ml-10 text-[#FFF4E4] p-4 mb-5 ">
            <button type="biliar" class="hover:bg-[#FFF2E0]/38 border rounded-xl px-4 py-3">Meja Biliar</button>
            <button type="tenis" class="hover:bg-[#FFF2E0]/38 border rounded-xl px-4 py-3">Meja Tenis</button>
            <button type="ps" class="hover:bg-[#FFF2E0]/38 border rounded-xl px-4 py-3">PlayStation</button>
        </div>

        <div class="bg-[#3C3D37] rounded-2xl p-6 text-[#F4EFE7]">
            <div class="relative">
                <input type="text" name="search" placeholder="Cari berdasarkan nama..."
                    value="{{ request('search') }}" {{-- Menampilkan query search saat ini --}}
                    class="w-full bg-[#757572] rounded-lg py-3 pl-12 pr-4 text-[#F4EFE7] placeholder-gray-100 focus:outline-none focus:ring-1 focus:ring-blue-500">
                {{-- Ikon search di dalam input --}}
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[#F4EFE7]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </span>
                {{-- Tombol submit tersembunyi, form akan submit saat menekan Enter --}}
            </div>

            <div class="flex mt-4">
                <p class="inline-block border px-2 py-2 ml-auto">10/page v</p>
            </div>

            <div class="overflow-x-auto mt-6">
                <table class="table-auto w-full text-left">
                    <tbody class="text-[#FFF3E1]">

                        <!-- Meja 1 -->
                        <tr class="border-b border-[#FFF3E1]/50">
                            <td class="py-3 w-30">
                                <img src="{{ asset('img/meja1.png') }}" class="w-30 h-25 object-cover rounded"
                                    alt="">
                            </td>
                            <td class="py-3 pl-5 align-middle text-lg">
                                Biliar 1
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex items-center justify-end gap-4 text-right">
                                    <p class="border rounded bg-[#B80F0A] py-2 px-4">Edit</p>
                                    <p class="border rounded bg-[#757572] py-2 px-4">Hapus</p>
                                </div>
                            </td>
                        </tr>

                        <!-- Meja 2 -->
                        <tr class="border-b border-[#FFF3E1]/50">
                            <td class="py-3 w-30">
                                <img src="{{ asset('img/meja1.png') }}" class="w-30 h-25 object-cover rounded"
                                    alt="">
                            </td>
                            <td class="py-3 pl-5 align-middle text-lg">
                                Biliar 2
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex items-center justify-end gap-4 text-right">
                                    <p class="border rounded bg-[#B80F0A] py-2 px-4">Edit</p>
                                    <p class="border rounded bg-[#757572] py-2 px-4">Hapus</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
            </div>




        </div>
    </div>
</x-layout-admin>
