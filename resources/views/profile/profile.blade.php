<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="min-h-screen bg-[#0e0f0b] text-[#F4EFE7] flex font-poppins pt-20">

        {{-- SIDEBAR --}}
        <aside
            class="w-64 bg-[#1a1a19] border-r border-white/10 py-6 px-6 flex flex-col sticky top-20 h-[calc(100vh-5rem)] overflow-y-auto hidden md:flex shrink-0">

            <h2 class="text-lg text-gray-400 font-light mb-1">HALO,</h2>
            <h1 class="text-2xl font-bebas tracking-wide mb-8 uppercase text-[#e9d9c9] truncate">
                {{ session('nama') ?? 'PENGGUNA' }}!
            </h1>

            <nav class="space-y-2 flex-1">
                <a href="{{ route('customer.profile') }}"
                    class="group flex items-center gap-3 w-full py-2.5 px-3 rounded-lg text-left transition duration-300 text-sm
                    {{ Route::is('customer.profile') ? 'bg-[#e9d9c9] text-black font-bold shadow-[0_0_15px_rgba(233,217,201,0.3)]' : 'hover:bg-white/5 text-gray-400 hover:text-white' }}">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4 {{ Route::is('customer.profile') ? 'text-black' : 'text-gray-500 group-hover:text-white' }}"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Informasi Akun
                </a>
                <a href="{{ route('customer.transaction.history') }}"
                    class="group flex items-center gap-3 w-full py-2.5 px-3 rounded-lg text-left transition duration-300 text-sm
                   {{ Route::is('transaction.history') ? 'bg-[#e9d9c9] text-black font-bold shadow-[0_0_15px_rgba(233,217,201,0.3)]' : 'hover:bg-white/5 text-gray-400 hover:text-white' }}">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4 {{ Route::is('transaction.history') ? 'text-black' : 'text-gray-500 group-hover:text-white' }}"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Riwayat Transaksi
                </a>
            </nav>
        </aside>

        {{-- KONTEN UTAMA --}}
        <main class="flex-1 p-4 md:p-8 w-full" x-data="{
            nama: '{{ $user->nama }}',
        
            submitForm(formElement) {
                const formData = new FormData(formElement);
        
                // Loading state: Disable tombol saat proses
                const submitBtn = formElement.querySelector('button[type=submit]');
                const originalText = submitBtn.innerText;
                submitBtn.disabled = true;
                submitBtn.innerText = 'Menyimpan...';
        
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
                            // 1. Update UI Avatar & Nama jika berubah
                            if (formData.get('nama')) this.nama = formData.get('nama');
        
                            // 2. Panggil SweetAlert Toast (dari Layout)
                            Toast.fire({
                                icon: 'success',
                                title: data.message || 'Profil berhasil diperbarui!',
                                iconColor: '#4ade80'
                            });
                        } else {
                            // Error Validasi
                            Toast.fire({
                                icon: 'error',
                                title: data.message || 'Update Gagal! Cek kembali data Anda.',
                                iconColor: '#ef4444'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Error Sistem/Jaringan
                        Toast.fire({
                            icon: 'error',
                            title: 'Terjadi kesalahan sistem.',
                            iconColor: '#ef4444'
                        });
                    })
                    .finally(() => {
                        // Kembalikan tombol ke kondisi semula
                        submitBtn.disabled = false;
                        submitBtn.innerText = originalText;
                    });
            }
        }">

            <div class="max-w-4xl mx-auto space-y-6">

                {{-- HEADER HALAMAN --}}
                <div class="border-b border-white/10 pb-3 flex flex-col md:flex-row justify-between items-center gap-4">
                    <div>
                        <h1 class="text-3xl font-bebas tracking-wide mb-1">INFORMASI AKUN</h1>
                        <p class="text-sm text-gray-400">Kelola informasi profil Anda.</p>
                    </div>

                    <form method="POST" action="{{ route('user.logout') }}">
                        @csrf
                        <button type="submit"
                            class="px-3 py-1.5 border border-red-500/50 text-red-400 hover:bg-red-500 hover:text-white rounded-md transition text-xs font-bold flex items-center gap-2">
                            Logout
                        </button>
                    </form>
                </div>

                {{-- CARD FORM --}}
                <div class="bg-white/5 border border-white/10 rounded-xl p-5 md:p-8 shadow-lg">

                    <form action="{{ route('customer.profile.update') }}" method="POST"
                        @submit.prevent="submitForm($event.target)" class="space-y-6">

                        @csrf
                        @method('PUT')

                        <div class="flex flex-col lg:flex-row gap-8">

                            {{-- KOLOM KIRI (AVATAR) --}}
                            <div class="flex flex-col items-center lg:items-start gap-3 lg:w-1/4">
                                <div
                                    class="w-28 h-28 lg:w-32 lg:h-32 rounded-full bg-gradient-to-br from-[#e9d9c9] to-[#cbbcae] 
                                    flex items-center justify-center text-4xl font-bebas text-black shadow-lg border-4 border-black/30 mx-auto lg:mx-0">
                                    <span x-text="nama.substring(0,2).toUpperCase()"></span>
                                </div>
                                <div class="text-center lg:text-left">
                                    <h3 class="text-base font-bold text-white mb-0.5" x-text="nama"></h3>
                                    <p class="text-xs text-gray-400">Customer Member</p>
                                </div>
                            </div>

                            {{-- KOLOM KANAN (INPUT) --}}
                            <div class="flex-1 space-y-4 lg:border-l lg:border-white/10 lg:pl-8">

                                {{-- Nama --}}
                                <div class="space-y-1">
                                    <label for="nama"
                                        class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Nama
                                        Lengkap</label>
                                    <input type="text" id="nama" name="nama" value="{{ $user->nama }}"
                                        x-model="nama"
                                        class="w-full bg-black/20 border border-white/20 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-[#e9d9c9] focus:ring-1 focus:ring-[#e9d9c9] transition">
                                </div>

                                {{-- Email --}}
                                <div class="space-y-1 opacity-70">
                                    <label for="email"
                                        class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Email</label>
                                    <input type="email" id="email" name="email" value="{{ $user->email }}"
                                        readonly
                                        class="w-full bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm text-gray-400 cursor-not-allowed">
                                </div>

                                {{-- HP & Gender --}}
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="space-y-1">
                                        <label for="no_telepon"
                                            class="text-xs font-semibold text-gray-400 uppercase tracking-wider">No.
                                            Handphone</label>
                                        <input type="text" id="no_telepon" name="no_telepon"
                                            value="{{ $user->no_telepon }}"
                                            class="w-full bg-black/20 border border-white/20 rounded-lg px-3 py-2 text-sm text-white focus:border-[#e9d9c9] transition">
                                    </div>

                                    <div class="space-y-1">
                                        <label for="jenis_kelamin"
                                            class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Jenis
                                            Kelamin</label>
                                        <select id="jenis_kelamin" name="jenis_kelamin"
                                            class="w-full bg-black/20 border border-white/20 rounded-lg px-3 py-2 text-sm text-white appearance-none cursor-pointer">
                                            <option value="Pria" @selected($user->jenis_kelamin == 'Pria')>Pria</option>
                                            <option value="Wanita" @selected($user->jenis_kelamin == 'Wanita')>Wanita</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Password --}}
                                <div class="space-y-1 pt-3 border-t border-white/10">
                                    <label for="password"
                                        class="text-xs font-semibold text-[#e9d9c9] uppercase tracking-wider">Ganti
                                        Password</label>
                                    <input type="password" id="password" name="password"
                                        placeholder="Kosongkan jika tidak ingin mengubah"
                                        class="w-full bg-black/20 border border-white/20 rounded-lg px-3 py-2 text-sm text-white placeholder-gray-600">
                                </div>

                            </div>
                        </div>

                        {{-- Tombol Simpan --}}
                        <div class="flex justify-end pt-4 border-t border-white/10">
                            <button type="submit"
                                class="bg-[#e9d9c9] hover:bg-white text-black font-bold py-2.5 px-6 rounded-lg shadow-lg transition text-sm disabled:opacity-50 disabled:cursor-not-allowed">
                                Simpan Perubahan
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </main>

    </div>
</x-Layout>