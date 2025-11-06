<?php

namespace App\Http\Controllers;

// 1. Kita "impor" alat-alat yang kita butuhkan
use Illuminate\Http\Request; // Untuk mengambil data dari form
use App\Models\Customer;    // Untuk berinteraksi dengan tabel 'customers'
use Illuminate\Support\Facades\Session; // import session
use Illuminate\Support\Facades\Hash; // import facede hash

class Test_auth_controller extends Controller
{
    /**
     * Mengecek data customer yang sudah ada dari database
     */
    public function login_acc(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255', 
            'password' => 'required|string'
        ]);

        $cek_akun = Customer::where('email', $request->input('email'))->first();

        if ($cek_akun && Hash::check($request->input('password'), $cek_akun->password)) // jika masih ingin mengeceknya "manual" untuk memahami logikanya, kamu harus menggunakan Hash'::check(), dengan ambil data user-nya dulu, lalu membandingkan password-nya di PHP. Ada cara lain dengan fitur login bawaan Laravel: Auth'::attempt().
        {
            session(["status_login" => "success"]); // Cara 1: Global Helper (Paling umum), // Cara 2: Via Request (Ini biasanya untuk data yang hanya hidup 1 request/redirect seperti ->with() yang kamu pakai, // Cara 3: Menggunakan Facade
            return redirect('/test_register')->with('success', 'sip dah login, tapi gw males buat halaman, jadi balik sini aja');
        } else
        {
            return redirect('/test_register')->with('error', 'apasi, email/passwowrd lu salah kocag');
        }
    }

    public function logout_acc(Request $request)
    {
        // Opsi A: Hapus SEMUA data di session
        $request->session()->flush(); //flush(): Ini akan menghapus semua data dari session (termasuk flash message, dll). Ini adalah "logout" yang sebenarnya.

        // Opsi B: Hapus satu key spesifik
        // $request->session()->forget('status_login');

        return redirect('/test')->with('success', 'Harap Login Kembali!');
    }

    /**
     * Menyimpan data customer baru dari form ke database.
     */
    public function register_acc(Request $request)
    {
        // 3. Validasi data yang masuk dari form
        // Jika gagal, Laravel otomatis kembali ke form & menampilkan error
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_telepon' => 'required|numeric', // Aturan 'tel' bukan aturan validasi bawaan Laravel. Kamu harus menggantinya dengan 'numeric' (Aturan numeric berarti: "Validasi ini lolos jika isi string-nya adalah angka")
            'email' => 'required|email|unique:customers', // unique seperti validasi, unique: Ini adalah nama aturannya. :test_customers: Ini memberi tahu Laravel, "Tolong cek di tabel test_customers apakah email ini sudah ada."
            'password' => 'required|string'
        ]);

        // 4. Jika validasi sukses, buat data baru di database
        // Data ini diambil dari 'name' di form HTML-mu
        Customer::create([
            'nama' => $request->input('nama'),
            'no_telepon' => $request->input('no_telepon'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')) // Laravel akan menjalankan Hash::make('...') dan menyimpan string yang sangat panjang dan acak (disebut hash) ke database
        ]);

        // 5. Setelah berhasil, kembalikan user ke halaman lain (misal halaman form lagi)
        // dengan pesan sukses (opsional)
        return redirect('/test_register')->with('success', 'Customer berhasil ditambahkan!');
    }
}