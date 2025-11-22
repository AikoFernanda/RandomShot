<x-LayoutAdmin>
    <x-slot:title>{{ $title }}</x-slot:title>
    {{-- Kartu Konten Utama --}}
    <div class="bg-[#181C14]">

        <!-- Ini pilih meja biliar, tenis apa ps
        <div class="grid grid-cols-3 gap-2 w-3xl ml-10 text-[#FFF4E4] p-4 mb-5 ">
            <button type="biliar" class="hover:bg-[#FFF2E0]/38 border rounded-xl px-4 py-3">Meja Biliar</button>
            <button type="tenis" class="hover:bg-[#FFF2E0]/38 border rounded-xl px-4 py-3">Meja Tenis</button>
            <button type="ps" class="hover:bg-[#FFF2E0]/38 border rounded-xl px-4 py-3">PlayStation</button>
        </div> -->

        <!-- Ini pilih makanan/minuman
        <div class="grid grid-cols-2 gap-2 w-3xl ml-10 text-[#FFF4E4] p-4 mb-5 ">
            <button type="biliar" class="hover:bg-[#FFF2E0]/38 border rounded-xl px-4 py-3">Makanan</button>
            <button type="tenis" class="hover:bg-[#FFF2E0]/38 border rounded-xl px-4 py-3">Minuman</button>
        </div> -->

        <!-- INI EDIT MEJA -->
        <div class="border-t-0 border-3 border-[#3C3D37] rounded-2xl h-79 mb-5">
            <p class="bg-[#697565] rounded-t-2xl text-center text-[#FFF4E4] font-bold p-4 mb-3">Nama dan Deskripsi</p>
            <label for="namaMenu" class="text-[#FFF4E4] p-3">Nama Meja</label>
            <div class=" px-6 py-3">
                <input type="text" name="namaMenu" id="namaMenu"
                    class="w-full border-2 rounded border-[#3C3D37] p-2">
            </div>
            <label for="deskripsiMeja" class="text-[#FFF4E4] p-3">Deskripsi Meja</label>
            <div class=" px-6 py-3">
                <input type="text" name="deskripsiMeja" id="deskripsiMeja"
                    class="w-full border-2 rounded border-[#3C3D37] p-8">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
            <div class="border-t-0 border-3 border-[#3C3D37] rounded-2xl h-90 ">
                <p class="bg-[#697565] rounded-t-2xl text-center text-[#FFF4E4] font-bold p-4 mb-3">Data Meja
                </p>
                <label for="durasi" class="text-[#FFF4E4] p-3">Durasi (menit)</label>
                <div class=" px-6 py-3">
                    <input type="text" name="durasi" id="durasi"
                        class="w-full border-2 rounded border-[#3C3D37] p-2">
                </div>

                <label for="rentangPukul" class="text-[#FFF4E4] p-3">Rentang Pukul</label>
                <div class=" px-6 py-3">
                    <input type="text" name="rentangPukul" id="rentangPukul"
                        class="w-full border-2 rounded border-[#3C3D37] p-2">
                </div>

                <label for="hargaMeja" class="text-[#FFF4E4] p-3">Harga Meja</label>
                <div class=" px-6 py-3">
                    <input type="text" name="hargaMeja" id="hargaMeja"
                        class="w-full border-2 rounded border-[#3C3D37] p-2">
                </div>
            </div>
            <div class="grid grid-rows-2 w-full text-[#FFF4E4]">
                <div class="border-t-0 border-3 border-[#3C3D37] rounded-2xl h-40">
                    <p class="bg-[#697565] rounded-t-2xl text-center text-[#FFF4E4] font-bold p-4 mb-3">Kategori
                    </p>
                    <label for="kategoriMeja" class="text-[#FFF4E4] p-3">Kategori Meja</label>
                    <div class=" px-6 py-3">
                        <input type="text" name="kategoriMeja" id="kategoriMeja"
                            class="w-full border-2 rounded border-[#3C3D37] p-2">
                    </div>
                </div>
                <div class="border-t-0 border-3 border-[#3C3D37] rounded-2xl h-45">
                    <p class="bg-[#697565] rounded-t-2xl text-center text-[#FFF4E4] font-bold p-4 mb-3">Gambar Meja
                    </p>
                    <label for="uploadMeja"
                        class="border-2 border-[#3C3D37] rounded mx-5 my-4 h-22 md:h-22 flex flex-col items-center justify-center cursor-pointer">
                        <div class="flex flex-col items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 24 24"
                                fill="none" stroke="#FFF4E4" stroke-width="1.8" stroke-linecap="round"
                                stroke-linejoin="round">
                                <rect x="7" y="7" width="10" height="10" rx="2"></rect>
                                <rect x="3" y="3" width="10" height="10" rx="2"></rect>
                                <line x1="12" y1="9" x2="12" y2="13"></line>
                                <line x1="10" y1="11" x2="14" y2="11"></line>
                            </svg>
                            <p class="text-[#FFF4E4]">Unggah Gambar</p>
                        </div>
                    </label>
                    <input type="file" name="uploadMeja" id="uploadMeja" class="hidden">
                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-2 w-100 mx-auto text-[#FFF4E4] p-4">
            <button type="biliar" class="hover:bg-[#B80F0A] border rounded-xl px-4 py-3">Batal</button>
            <button type="tenis" class="hover:bg-[#64B449] border rounded-xl px-4 py-3">Simpan</button>
        </div>




        <!-- INI EDIT MENU
        <div class="border-t-0 border-3 border-[#3C3D37] rounded-2xl h-78 mb-5">
            <p class="bg-[#697565] rounded-t-2xl text-center text-[#FFF4E4] font-bold p-4 mb-3">Nama dan Deskripsi</p>
            <label for="namaMenu" class="text-[#FFF4E4] p-3">Nama Menu</label>
            <div class=" px-6 py-3">
                <input type="text" name="namaMenu" id="namaMenu"
                    class="w-full border-2 rounded border-[#3C3D37] p-2">
            </div>
            <label for="deskripsiMenu" class="text-[#FFF4E4] p-3">Deskripsi Menu</label>
            <div class=" px-6 py-3">
                <input type="text" name="deskripsiMenu" id="deskripsiMenu"
                    class="w-full border-2 rounded border-[#3C3D37] p-8">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
            <div class="border-t-0 border-3 border-[#3C3D37] rounded-2xl h-90 ">
                <p class="bg-[#697565] rounded-t-2xl text-center text-[#FFF4E4] font-bold p-4 mb-3">Gambar Menu
                </p>
                <label for="uploadMenu"
                    class="border-2 border-[#3C3D37] rounded mx-5 my-4 h-48 md:h-67 flex flex-col items-center justify-center cursor-pointer">
                    <div class="flex flex-col items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 24 24"
                            fill="none" stroke="#FFF4E4" stroke-width="1.8" stroke-linecap="round"
                            stroke-linejoin="round">
                            <rect x="7" y="7" width="10" height="10" rx="2"></rect>
                            <rect x="3" y="3" width="10" height="10" rx="2"></rect>
                            <line x1="12" y1="9" x2="12" y2="13"></line>
                            <line x1="10" y1="11" x2="14" y2="11"></line>
                        </svg>
                        <p class="text-[#FFF4E4]">Unggah Gambar</p>
                    </div>
                </label>
                <input type="file" name="uploadMenu" id="uploadMenu" class="hidden">
            </div>

            <div class="border-t-0 border-3 border-[#3C3D37] rounded-2xl h-90">
                <p class="bg-[#697565] rounded-t-2xl text-center text-[#FFF4E4] font-bold p-4 mb-3">Data Menu
                </p>
                <label for="kategori" class="text-[#FFF4E4] p-3">Kategori Menu</label>
                <div class=" px-6 py-3">
                    <input type="text" name="kategori" id="kategori"
                        class="w-full border-2 rounded border-[#3C3D37] p-2">
                </div>
                <label for="hargaMenu" class="text-[#FFF4E4] p-3">Harga Menu</label>
                <div class=" px-6 py-3">
                    <input type="text" name="hargaMenu" id="hargaMenu"
                        class="w-full border-2 rounded border-[#3C3D37] p-2">
                </div>
                <label for="stokMenu" class="text-[#FFF4E4] p-3">Stok Menu</label>
                <div class=" px-6 py-3">
                    <input type="text" name="stokMenu" id="stokMenu"
                        class="w-full border-2 rounded border-[#3C3D37] p-2">
                </div>
            </div>
        
            <div class="grid grid-cols-2 gap-2 w-100 mx-auto text-[#FFF4E4] p-4">
                <button type="biliar" class="hover:bg-[#B80F0A] border rounded-xl px-4 py-3">Batal</button>
                <button type="tenis" class="hover:bg-[#64B449] border rounded-xl px-4 py-3">Simpan</button>
            </div>
        </div>-->

    </div>
</x-LayoutAdmin>
