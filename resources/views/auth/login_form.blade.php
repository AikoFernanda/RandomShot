<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <!-- Kontainer Utama: Memusatkan konten di tengah halaman -->
    <div style="background-image: url('{{ asset('img/login.png') }}');"
        class="min-h-screen flex items-center justify-center bg-cover bg-center bg-no-repeat p-4">

        <!-- Card/Panel untuk Login Form -->
        <div class="w-1/3 bg-[#101B08] border border-[#FFF4E4] p-8 rounded-lg shadow-lg transform -translate-x-10">

            <!-- Header Form -->
            <div class="text-center mb-8">
                <h1 class="text-5xl font-bold-1/2 text-[#FFF4E4] mb-2">Selamat Datang</h1>
                <p class="text-[#FFF4E4]">Silahkan login untuk ke laman selanjutnya</p>
            </div>

            <!-- notifikasi kesalahan -->
            <div>
                @if ($errors->any() || session('error'))
                    <div id='popup-error'
                        class="text-red-600 bg-red-100 p-2.5 border border-red-500 rounded-[5px] mb-[15px]">
                        <strong>Oops! Ada yang salah:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            <li>{{ session('error') }}</li>
                        </ul>
                    </div>
                @endif
            </div>

            <!-- Form Login -->
            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Field Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-[#FFF4E4] mb-1">Email</label>
                    <input type="email" id="email" name="email" placeholder="you@example.com" required
                        class="w-full bg-[#FFF4E4]/30 text-[#FFF4E4] border border-[#FFF4E4] rounded-md p-3 focus:ring-green-500 focus:border-green-500">
                </div>

                <!-- Field Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-[#FFF4E4] mb-1">Password</label>
                    <input type="password" id="password" name="password" placeholder="********" required
                        class="w-full bg-[#FFF4E4]/30 text-[#FFF4E4] border border-[#FFF4E4] rounded-md p-3 focus:ring-green-500 focus:border-green-500">
                </div>

                <!-- Tombol Login -->
                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-[#ECDFCC] hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200">
                        Login
                    </button>
                </div>
            </form>

        </div>

        <!-- logo -->
        <img src="{{ asset('img/logo-rs.png') }}" class=" translate-x-25">

    </div>
</x-Layout>
