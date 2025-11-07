<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <!-- Kontainer Utama: Memusatkan konten di tengah halaman -->
    <div class="min-h-screen flex items-center justify-center bg-gray-100 p-4">

        <!-- Card/Panel untuk Login Form -->
        <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-lg">

            <!-- Header Form -->
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800 mb-1">Masuk</h1>
                <p class="text-sm text-gray-500">Jadilah Randomers Sekarang Juga!</p>
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
            <form action="/test_login_customer" method="POST" class="space-y-4">
                @csrf

                <!-- Field Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" placeholder="you@example.com" required
                        class="w-full border border-gray-300 rounded-md p-3 focus:ring-green-500 focus:border-green-500">
                </div>

                <!-- Field Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" id="password" name="password" placeholder="********" required
                        class="w-full border border-gray-300 rounded-md p-3 focus:ring-green-500 focus:border-green-500">
                </div>

                <!-- Tombol Login -->
                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200">
                        Login
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-Layout>
