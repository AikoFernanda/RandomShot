<x-Layout>
<x-slot:title>{{ $title }}</x-slot:title>

{{-- WRAPPER UTAMA: Flexbox untuk membagi Sidebar (Kiri) dan Konten (Kanan) --}}
<div class="min-h-screen bg-[#0e0f0b] text-[#F4EFE7] flex font-poppins mt-5">

    {{-- ================= SIDEBAR ================= --}}
    {{-- sticky top-0 h-screen: Agar sidebar tetap diam saat konten di-scroll --}}
    <aside
        class="w-72 bg-[#1a1a19] border-r border-white/10 py-12 px-8 flex flex-col sticky top-0 h-screen overflow-y-auto hidden md:flex shrink-0">

        <h2 class="text-xl text-gray-400 font-light mb-1">HALO,</h2>
        {{-- Menampilkan nama user (optional, jika ada di session) --}}
        <h1 class="text-3xl font-bebas tracking-wide mb-12 uppercase text-[#e9d9c9] truncate">
            {{ session('nama') ?? 'PENGGUNA' }}!
        </h1>

        <nav class="space-y-4 flex-1">

            {{-- Menu 1: Profil --}}
            <a href="{{ route('customer.profile') }}"
                class="group flex items-center gap-3 w-full py-3 px-4 rounded-xl text-left transition duration-300
                    {{ Route::is('customer.profile') ? 'bg-[#e9d9c9] text-black font-bold shadow-[0_0_15px_rgba(233,217,201,0.3)]' : 'hover:bg-white/5 text-gray-400 hover:text-white' }}">

                {{-- Ikon User --}}
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 {{ Route::is('customer.profile') ? 'text-black' : 'text-gray-500 group-hover:text-white' }}"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Informasi Akun
            </a>

            {{-- Menu 2: Riwayat (Aktif) --}}
            <a href="{{ route('customer.transaction.history') }}" {{-- Pastikan route name benar --}}
                class="group flex items-center gap-3 w-full py-3 px-4 rounded-xl text-left transition duration-300
                   {{ Route::is('customer.transaction.history') ? 'bg-[#e9d9c9] text-black font-bold shadow-[0_0_15px_rgba(233,217,201,0.3)]' : 'hover:bg-white/5 text-gray-400 hover:text-white' }}">

                {{-- Ikon Riwayat --}}
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 {{ Route::is('transaction.history') ? 'text-black' : 'text-gray-500 group-hover:text-white' }}"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                Riwayat Transaksi
            </a>

        </nav>

        {{-- Tombol Logout (Optional di bawah sidebar) --}}
        {{-- <form action="/logout" method="POST"> @csrf <button class="...">Logout</button> </form> --}}
    </aside>


        {{-- 
          PROFIL 
          gabung SEMUA logic Alpine.js di satu x-data di <main> 
        --}}
        <main class="flex-1 py-24" x-data="{
            nama: '{{ $user->name }}',
            successMessage: '',
            showNotification: false,
        
            submitForm(formElement) {
                const formData = new FormData(formElement);
        
                fetch(formElement.action, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': formData.get('_token')
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            this.successMessage = data.message;
                            this.showNotification = true;
                            setTimeout(() => { this.showNotification = false }, 3000);
        
                        } else {
                            console.error('Update gagal');
                            this.successMessage = 'Update Gagal! Cek kembali data anda.';
        
                            // Agar pop-up merah muncul
                            this.showNotification = true;
        
                            // agar menyembunyikan pop-up, bukan cuma teks
                            setTimeout(() => { this.showNotification = false }, 3000);
                        }
                    });
            }
        }">

            {{-- AVATAR --}}
            <div class="flex justify-center mb-10">
                <div
                    class="w-24 h-24 rounded-full bg-[#F4EFE7] 
                        flex items-center justify-center 
                        text-3xl font-bold text-black">
                    {{-- 2 huruf pertama dari nama (sekarang ambil dari 'nama' di x-data) --}}
                    <span x-text="nama.substring(0,2).toUpperCase()"></span>
                </div>
            </div>

            {{-- FORM --}}
            <div class="max-w-3xl mx-auto space-y-6">

                {{-- POP UP --}}
                <div x-show="showNotification" x-text="successMessage" {{-- Animasi --}}
                    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
                    x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
                    style="display:none;" {{-- Warna (Sudah Benar) --}}
                    :class="{
                        'bg-green-600 border-green-700': successMessage.toLowerCase().includes('berhasil'),
                        'bg-red-600 border-red-700': successMessage.toLowerCase().includes('gagal')
                    }"
                    {{-- KELAS POSISI BARU (TENGAH ATAS) --}}
                    class="fixed z-50 top-28 left-1/2 -translate-x-1/2 w-auto max-w-lg text-[#F4EFE7] px-6 py-3 rounded-lg shadow-lg font-semibold">
                </div>

                {{-- @submit.prevent untuk 'mencegat' submit --}}
                <form action="{{ route('customer.profile.update') }}" method="POST"
                    @submit.prevent="submitForm($event.target)" class="space-y-6 text-[#F4EFE7]">
                    @csrf
                    @method('PUT')

                    {{-- NAMA --}}
                    <div class="flex items-center gap-6">
                        <label for="nama" class="w-40 text-base font-semibold">Nama</label>
                        <input type="text" id="nama" name="nama" value="{{ $user->nama }}"
                            class="flex-1 bg-transparent border border-[#F4EFE7] rounded-xl
                                  px-4 py-3 focus:outline-none">
                    </div>

                    {{-- EMAIL --}}
                    <div class="flex items-center gap-6">
                        <label for="email" class="w-40 text-base font-semibold">Email</label>
                        <input type="email" id="email" name="email" value="{{ $user->email }}" readonly
                            class="flex-1 bg-gray-700/50 border border-[#F4EFE7] rounded-xl
                                  px-4 py-3 focus:outline-none cursor-not-allowed">
                    </div>

                    {{-- NO HP --}}
                    <div class="flex items-center gap-6">
                        <label for="no_telepon" class="w-40 text-base font-semibold">No. HP</label>
                        <input type="text" id="no_telepon" name="no_telepon" value="{{ $user->no_telepon }}"
                            class="flex-1 bg-transparent border border-[#F4EFE7] rounded-xl
                                  px-4 py-3 focus:outline-none">
                    </div>

                    {{-- JENIS KELAMIN --}}
                    <div class="flex items-center gap-6">
                        <label for="jenis_kelamin" class="w-40 text-base font-semibold">Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin"
                            class="flex-1 text-[#F4EFE7] bg-transparent border border-[#F4EFE7] rounded-xl 
                                   px-4 py-3 focus:outline-none
                                   appearance-none bg-no-repeat bg-right-4"
                            style="background-image: url('data:image/svg+xml;charset=UTF-8,<svg ... (ikon panah)> ... </svg>'); background-position-x: 95%;">

                            <option value="Pria" @selected($user->jenis_kelamin == 'Pria')>Pria</option>
                            <option value="Wanita" @selected($user->jenis_kelamin == 'Wanita')>Wanita</option>
                        </select>
                    </div>

                    {{-- PASSWORD --}}
                    <div class="flex items-center gap-6">
                        <label for="password" class="w-40 text-base font-semibold">Password Baru</label>
                        <input type="password" id="password" name="password"
                            placeholder="Isi jika ingin ganti password"
                            class="flex-1 bg-transparent border border-[#F4EFE7] rounded-xl
                                  px-4 py-3 focus:outline-none">
                    </div>

                    {{-- TOMBOL SIMPAN --}}
                    <div class="flex justify-end pt-4">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-[#F4EFE7] font-bold py-2 px-6 rounded-lg transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            {{-- LOGOUT DI KANAN --}}
            <div class="max-w-3xl mx-auto mt-6 flex justify-end">
                <a href="#" {{-- Ganti ke route('logout') --}}
                    class="bg-red-700 px-16 py-3 text-[#F4EFE7] font-semibold 
                           rounded-xl hover:bg-red-700/60 transition">
                    Log Out
                </a>
            </div>

        </main>

    </section>

</x-Layout>
