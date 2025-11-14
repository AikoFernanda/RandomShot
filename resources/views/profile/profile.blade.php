<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

<section class="min-h-screen bg-black text-white flex">

    {{-- SIDEBAR --}}
    <aside class="w-72 bg-[#2e2e2c] py-24 px-8 flex flex-col">
        <h2 class="text-3xl">HALO,</h2>
        <h1 class="text-5xl mb-10 uppercase">PENGGUNA!</h1>

        <a href="/profil-pengguna" 
           class="w-full py-3 bg-black/40 border border-white rounded-xl mb-3 text-center">
           Informasi Akun
        </a>

        <a href="/aktivitas-meja" 
           class="w-full py-3 bg-transparent text-white text-center">
           Aktivitas Saya
        </a>
    </aside>


    {{-- PROFIL --}}
    <main class="flex-1 py-24">

        {{-- Alpine.js untuk avatar + nama --}}
        <div x-data="{ nama: 'Anggita Jeon' }">

            {{-- AVATAR --}}
            <div class="flex justify-center mb-10">
                <div class="w-24 h-24 rounded-full bg-white 
                            flex items-center justify-center 
                            text-3xl font-bold text-black">
                    {{-- 2 huruf pertama dari nama --}}
                    <span x-text="nama.substring(0,2).toUpperCase()"></span>
                </div>
            </div>


{{-- FORM --}}
<div class="max-w-3xl mx-auto space-y-6">

    {{-- NAMA --}}
    <div class="flex items-center gap-6">
        <label class="w-40 text-base font-semibold">Nama</label>
        <input type="text" value="Anggita Jeon"
               class="flex-1 bg-transparent border border-white rounded-xl
                      px-4 py-3 focus:outline-none">
    </div>

    {{-- EMAIL --}}
    <div class="flex items-center gap-6">
        <label class="w-40 text-base font-semibold">Email</label>
        <input type="email" value="anggita@gmail.com"
               class="flex-1 bg-transparent border border-white rounded-xl
                      px-4 py-3 focus:outline-none">
    </div>

    {{-- NO HP --}}
    <div class="flex items-center gap-6">
        <label class="w-40 text-base font-semibold">No. HP</label>
        <input type="text" value="081234567890"
               class="flex-1 bg-transparent border border-white rounded-xl
                      px-4 py-3 focus:outline-none">
    </div>

    {{-- JENIS KELAMIN --}}
    <div class="flex items-center gap-6">
        <label class="w-40 text-base font-semibold">Jenis Kelamin</label>
        <select class="flex-1 text-white bg-transparent border border-white rounded-xl 
                       px-4 py-3 focus:outline-none">
            <option>Perempuan</option>
            <option>Laki-laki</option>
        </select>
    </div>

    {{-- PASSWORD --}}
    <div class="flex items-center gap-6">
        <label class="w-40 text-base font-semibold">Password Akun</label>
        <input type="password" value="********"
               class="flex-1 bg-transparent border border-white rounded-xl
                      px-4 py-3 focus:outline-none">
    </div>
</div>

    
    <div class="max-w-3xl pl-20 pr-26 mt-6 ml-auto">

    {{-- SIMPAN --}}
    <button class="w-full py-3 bg-white text-black font-semibold rounded-xl 
                   hover:bg-white/70 transition hover:text-white">Simpan
    </button>

    {{-- LOGOUT DI KANAN --}}
    <div class="mt-6 flex justify-end">
        <a href="/logout"
           class="bg-red-700 px-15 py-3 text-white font-semibold 
                  rounded-xl hover:bg-red-700/60 transition">Log Out
        </a>
    </div>

</div>


        </div>

    </main>

</section>

</x-Layout>
