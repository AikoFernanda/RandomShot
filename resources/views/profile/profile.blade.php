<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="min-h-screen bg-black text-white flex">

        {{-- SIDEBAR --}}
        <aside class="w-72 bg-[#2e2e2c] py-24 px-8 flex flex-col">
            <h2 class="text-3xl">HALO,</h2>
            <h1 class="text-5xl mb-10 uppercase">PENGGUNA!</h1>

            <a href="{{ route('customer.profile') }}"
                class="w-full py-3 bg-black/40 border border-white rounded-xl mb-3 text-center">
                Informasi Akun
            </a>

            <a href="{{ route('customer.profile.activity') }}" class="w-full py-3 bg-transparent text-white text-center">
                Aktivitas Saya
            </a>
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
                    class="w-24 h-24 rounded-full bg-white 
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
                    class="fixed z-50 top-28 left-1/2 -translate-x-1/2 w-auto max-w-lg text-white px-6 py-3 rounded-lg shadow-lg font-semibold">
                </div>

                {{-- @submit.prevent untuk 'mencegat' submit --}}
                <form action="{{ route('customer.profile.update') }}" method="POST"
                    @submit.prevent="submitForm($event.target)" class="space-y-6 text-white">
                    @csrf
                    @method('PUT')

                    {{-- NAMA --}}
                    <div class="flex items-center gap-6">
                        <label for="nama" class="w-40 text-base font-semibold">Nama</label>
                        <input type="text" id="nama" name="nama" value="{{ $user->nama }}"
                            class="flex-1 bg-transparent border border-white rounded-xl
                                  px-4 py-3 focus:outline-none">
                    </div>

                    {{-- EMAIL --}}
                    <div class="flex items-center gap-6">
                        <label for="email" class="w-40 text-base font-semibold">Email</label>
                        <input type="email" id="email" name="email" value="{{ $user->email }}" readonly
                            class="flex-1 bg-gray-700/50 border border-white rounded-xl
                                  px-4 py-3 focus:outline-none cursor-not-allowed">
                    </div>

                    {{-- NO HP --}}
                    <div class="flex items-center gap-6">
                        <label for="no_telepon" class="w-40 text-base font-semibold">No. HP</label>
                        <input type="text" id="no_telepon" name="no_telepon" value="{{ $user->no_telepon }}"
                            class="flex-1 bg-transparent border border-white rounded-xl
                                  px-4 py-3 focus:outline-none">
                    </div>

                    {{-- JENIS KELAMIN --}}
                    <div class="flex items-center gap-6">
                        <label for="jenis_kelamin" class="w-40 text-base font-semibold">Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin"
                            class="flex-1 text-white bg-transparent border border-white rounded-xl 
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
                            class="flex-1 bg-transparent border border-white rounded-xl
                                  px-4 py-3 focus:outline-none">
                    </div>

                    {{-- TOMBOL SIMPAN --}}
                    <div class="flex justify-end pt-4">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            {{-- LOGOUT DI KANAN --}}
            <div class="max-w-3xl mx-auto mt-6 flex justify-end">
                <a href="#" {{-- Ganti ke route('logout') --}}
                    class="bg-red-700 px-16 py-3 text-white font-semibold 
                           rounded-xl hover:bg-red-700/60 transition">
                    Log Out
                </a>
            </div>

        </main>

    </section>

</x-Layout>
