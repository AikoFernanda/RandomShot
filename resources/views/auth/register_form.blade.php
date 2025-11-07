<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <!-- Kontainer Utama: Memusatkan konten di tengah halaman -->
    <div class="min-h-screen flex items-center justify-center bg-gray-100 p-4">

        <!-- Card/Panel untuk Konten -->
        <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-lg">

            <!-- Header Selamat Datang -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Selamat Datang</h1>
                <p class="text-gray-500">Isi data diri Anda untuk register</p>
            </div>

            <!-- notifikasi kesalahan-->
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

            <!-- Form Pendaftaran -->
            <form action='/test_register_customer' method="POST" class="space-y-4">
                @csrf

                <!-- Field Username -->
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                    <input type="text" id="username" name="nama" placeholder="Masukkan username..."
                        class="w-full border border-gray-300 rounded-md p-3 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Field Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" placeholder="Masukkan email..." required
                        class="w-full border border-gray-300 rounded-md p-3 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Field Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan password..." required
                        class="w-full border border-gray-300 rounded-md p-3 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Field No Telepon -->
                <div>
                    <label for="no_telepon" class="block text-sm font-medium text-gray-700 mb-1">Telepon</label>
                    <input type="text" id="no_telepon" name="no_telepon" placeholder="Masukkan nomor telepon..."
                        required
                        class="w-full border border-gray-300 rounded-md p-3 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Tombol Submit -->
                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200">
                        Daftar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-Layout>
