<?php

namespace App\Http\Controllers;

// 1. Kita "impor" alat-alat yang kita butuhkan
use Illuminate\Http\Request; // Untuk mengambil data dari form
use App\Models\User;    // Untuk berinteraksi dengan tabel 'users'
use Illuminate\Support\Facades\Session; // import session
use Illuminate\Support\Facades\Hash; // import facede hash
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    // REGISTER
    public function showRegisterForm() 
    {
        return view('auth.register_form', ['title' => 'Register']); //perintah untuk mencari dan menampilkan file HTML "cari file Blade (HTML) dan tampilkan isinya". Perintah ini tidak mengubah URL di browser.
        // Tanda titik (.) di dalam view() adalah pengganti untuk garis miring (/) di dalam folder.
    }

    public function customerRegister(Request $request)
    {
        // 3. Validasi data yang masuk dari form
        // Jika gagal, Laravel otomatis kembali ke form & menampilkan error
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_telepon' => 'required|numeric|unique:users', // Aturan 'tel' bukan aturan validasi bawaan Laravel. harus menggantinya dengan 'numeric' (Aturan numeric berarti: "Validasi ini lolos jika isi string-nya adalah angka"). diberi unique supaya tidak error didatabasenya, tapi errornya di validasi, jadi tidak ada kesalahan database yang membuat halaman error laravel muncul
            'email' => 'required|email|unique:users', // unique seperti validasi, unique: Ini adalah nama aturannya. :test_customers: Ini memberi tahu Laravel, "Tolong cek di tabel test_customers apakah email ini sudah ada."
            'password' => 'required|string'
        ]);

        // 4. Jika validasi sukses, buat data baru di database
        // Data ini diambil dari 'name' di form HTML
        User::create([
            'nama' => $request->input('nama'),
            'no_telepon' => $request->input('no_telepon'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')) // Laravel akan menjalankan Hash::make('...') dan menyimpan string yang sangat panjang dan acak (disebut hash) ke database
        ]);

        // 5. Setelah berhasil, kembalikan user ke halaman lain (misal halaman home lagi)
        // dengan pesan sukses (opsional) dan set session status_login dengan success
        session(["status_login" => "success"]);
        return redirect()->route('home')->with('success', 'Register berhasil, selamat datang!');
    }

    // LOGIN
    public function showLoginForm()
    {
        return view('auth.login_form', ['title' => 'Login']);
    }

    /**
     * Mengecek data customer yang sudah ada dari database
     */
    public function userLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255', 
            'password' => 'required|string'
        ]);

        $user = User::where('email', $request->input('email'))->first();

        if (($user) && (Hash::check($request->input('password'), $user->password))) // jika masih ingin mengeceknya "manual" untuk memahami logikanya, harus menggunakan Hash'::check(), dengan ambil data user-nya dulu, lalu membandingkan password-nya di PHP. Ada cara lain dengan fitur login bawaan Laravel: Auth'::attempt().
        {
            if ($user->status == 'Aktif') {
                session([
                    "status_login" => "success",
                    "user_id" => $user->user_id,
                    "nama" => $user->nama,
                    "peran" => $user->peran
                ]); // Cara 1: Global Helper (Paling umum), // Cara 2: Via Request (Ini biasanya untuk data yang hanya hidup 1 request/redirect seperti ->with() yang di pakai, // Cara 3: Menggunakan Facade
                if ($user->peran == 'Customer') {
                    return redirect()->route('home')->with('success', 'Berhasil login, Selamat datang!');
                } elseif ($user->peran == 'Employee') {
                    return redirect()->route('admin.reservation')->with('success', 'Berhasil login, Selamat datang!');
                } elseif ($user->peran == 'Owner') {
                    return redirect()->route('owner.performa')->with('success', 'Berhasil login, Selamat datang!');
                }
            } else {
                return redirect()->route('login')->with('error', 'Akun anda telah di nonaktifkan');
            }
        } else
        {
            return redirect()->route('login')->with('error', 'Email atau passwowrd yang anda masukkan salah');
        }
    }

    // LOGOUT
    public function userLogout(Request $request)
    {
        // 1. Logout dari Guard (menghapus status login user)
        Auth::logout();

        // 2. Ini menghapus semua data sesi DAN membuat ID Sesi baru. Jauh lebih aman daripada flush().
        $request->session()->invalidate();

        // 3. Regenerate Token CSRF Supaya form login berikutnya aman dari serangan CSRF lama.
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('logout_success', 'Harap Login Kembali!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
