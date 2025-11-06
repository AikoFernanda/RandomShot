<x-Layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <h1 class="text-3xl font-bold mb-4"> Selamat Datang </h1> {{-- tidak lagi bergantung pada id= atau file CSS terpisah. kita langsung memberi class Tailwind. --}}
    <h2 class="text-xl font-semibold text-gray-600 mb-6">Bebas dah lu mau login atau register dah gede</h2>
    <br>
    <form action='/test_register_customer' method="POST">
        @csrf
        <h3 class="text-xs font-semibold text-gray-600 mb-6">Isi sendiri buat register</h3>
        <div>
            <label for="username">Username</label><br>
            <input type="string" id="username" name="nama" placeholder="..." class="border border-gray-300 rounded-md p-2">
        </div>

        <div>
            <label for="email">Email</label><br>
            <input type="email" id="email" name="email" placeholder="..." required class="border border-gray-300 rounded-md p-2">
        </div>

        <div>
            <label for="password">Password</label><br>
            <input type="string" id="password" name="password" placeholder="..." required class="border border-gray-300 rounded-md p-2">
        </div>

        <div>
            <label for="alamat">Alamat</label><br>
            <textarea name="alamat" placeholder="..." class="border border-gray-300 rounded-md p-2 resize-y"></textarea>
        </div>

        <div>
            <label for="no_telepon">Telepon</label><br>
            <input type="numeric" id="no_telepon" name="no_telepon" placeholder="..." required class="border border-gray-300 rounded-md p-2">
        </div>

        <div>
            <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded">Daftar</button>
        </div>
    </form>

    <br>
    <form action="/test_login_customer" method="POST">
        @csrf
        <h3 class="text-xs font-semibold text-gray-600 mb-6">Isi sendiri buat login</h3>
        <div>
            <label for="email">Email</label><br>
            <input type="email" id="email" name="email" placeholder="..." required class="border border-gray-300 rounded-md p-2">
        </div>
        <div>
            <label for="password">Password</label><br>
            <input type="string" id="password" name="password" placeholder="..." required class="border border-gray-300 rounded-md p-2">
        </div>
        <div>
            <button type="submit" class="bg-green-500 text-white font-bold py-2 px-4 rounded">Login</button>
        </div>
    </form>

    <div>
        <h3 class="text-xs font-semibold text-gray-600 mb-6">Session:</h3>
        @if (session('status_login') == 'success')
            <p>Status: {{ session('status_login') }}</p>
        @else
            <p>Status: Lu belum login kocag</p>
        @endif
    </div>

    @if (session('status_login') == 'success')
    <div>
        <form action='/test_logout' method='GET'>
            <button type="submit" class="bg-red-500 text-white font-bold py-2 px-4 rounded">Logout</button>
        </form>
    </div>
    @endif
</x-Layout>
