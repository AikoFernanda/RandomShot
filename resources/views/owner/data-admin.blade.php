<x-layout-owner>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="bg-black min-h-screen text-[#F4EFE7]">
        <div class="bg-[#3C3D37] rounded-2xl p-6 text-[#F4EFE7]">
            <div
                class="w-14 h-14 shrink-0 rounded-full bg-[#F4EFE7] flex items-center justify-center 
                        text-black text-2xl ml-auto">
                +
            </div>

            <!-- Admin 1
            <div class="p-6 border-b border-[#FFF3E1]/50">
                <div class="flex items-start gap-10 relative z-10">
                    <div class="flex w-full items-center justify-between pt-3">
                        <p class="text-[#F4EFE7] font-medium">Arul Tia</p>
                        <div class="flex items-center gap-4">
                            <p class="text-sm cursor-pointer border px-5 py-2 rounded-xl hover:bg-[#697565]">Edit</p>
                            <p class="text-sm cursor-pointer border px-5 py-2 rounded-xl hover:bg-[#B80F0A]">Hapus</p>
                        </div>
                    </div>

                </div>
            </div> -->

            <!-- Admin 2
            <div class="p-6 border-b border-[#FFF3E1]/50">
                <div class="flex items-start gap-10 relative z-10">
                    <div class="flex w-full items-center justify-between pt-3">
                        <p class="text-[#F4EFE7] font-medium">Aiko</p>
                        <div class="flex items-center gap-4">
                            <p class="text-sm cursor-pointer border px-5 py-2 rounded-xl hover:bg-[#697565]">Edit</p>
                            <p class="text-sm cursor-pointer border px-5 py-2 rounded-xl hover:bg-[#B80F0A]">Hapus</p>
                        </div>
                    </div>
                </div>
            </div> -->

            <div class="bg-[#ECDFCC] rounded-2xl p-6 w-1/2 text-[#F4EFE7] mx-auto">
                <label for="namaAdmin" class="text-black font-bold p-3">Nama Admin</label>
                <div class=" px-3 mb-4">
                    <input type="text" name="namaAdmin" id="namaAdmin" class="w-full rounded bg-[#3C3D37] py-2 ">
                </div>
                <label for="email" class="text-black font-bold p-3">Email</label>
                <div class=" px-3 mb-4">
                    <input type="text" name="email" id="email" class="w-full rounded bg-[#3C3D37] py-2">
                </div>
                <label for="no_hp" class="text-black font-bold p-3">No. Handphone</label>
                <div class=" px-3 mb-4">
                    <input type="tel" name="no_hp" id="no_hp" class="w-full rounded bg-[#3C3D37] py-2">
                </div>
                <label for="gender" class="text-black font-bold p-3">Jenis Kelamin</label>
                <div class="px-3 mb-4">
                    <select name="gender" id="gender" class="w-full rounded bg-[#3C3D37] py-2">
                        <option value="">--Pilih Jenis Kelamin--</option>
                        <option value="lakilaki">Laki-laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                </div>
                <label for="alamat" class="text-black font-bold p-3">Alamat</label>
                <div class=" px-3 mb-4">
                    <input type="text" name="alamat" id="alamat" class="w-full rounded bg-[#3C3D37] py-2">
                </div>
                <label for="gaji" class="text-black font-bold p-3">Gaji</label>
                <div class=" px-3 mb-4">
                    <input type="text" name="gaji" id="gaji" class="w-full rounded bg-[#3C3D37] py-2">
                </div>
                <label for="tanggal" class="text-black font-bold p-3">Tanggal Bergabung</label>
                <div class=" px-3 mb-4">
                    <input type="text" name="tanggal" id="tanggal" class="w-full rounded bg-[#3C3D37] py-2">
                </div>
                <div class="flex justify-end mt-10 px-3">
                    <div class="bg-[#64B449] hover:bg-[#2D631B] p-2 w-45 text-center rounded">Simpan
                        perubahan
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout-owner>
