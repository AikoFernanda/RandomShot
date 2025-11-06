<?php

namespace App\Http\Controllers;

// 1. Kita "impor" alat-alat yang kita butuhkan
use Illuminate\Http\Request; // Untuk mengambil data dari form
use App\Models\Test_auth;    // Untuk berinteraksi dengan tabel 'customers'
use Illuminate\Support\Facades\Session; // import session

class Test_auth_controller extends Controller
{
    /**
     * Menampilkan halaman form untuk membuat customer baru.
     */
    public function form_register()
    {
        // 2. Tampilkan file Blade yang berisi form HTML
        return view('test_register');
    }

    /**
     * Mengecek data customer yang sudah ada dari database
     */
    public function login_acc(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255', 
            'password' => 'required|string|max:255'
        ]);

        $cek_akun = Test_auth::where('email', $request->input('email'))->where('password', $request->input('password'))->exists();

        if ($cek_akun) 
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
            'email' => 'required|email|unique:test_customers', // unique seperti validasi, unique: Ini adalah nama aturannya. :test_customers: Ini memberi tahu Laravel, "Tolong cek di tabel test_customers apakah email ini sudah ada."
            'password' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'no_telepon' => 'required|numeric', // Aturan 'tel' bukan aturan validasi bawaan Laravel. Kamu harus menggantinya dengan 'numeric' (Aturan numeric berarti: "Validasi ini lolos jika isi string-nya adalah angka")
        ]);

        // 4. Jika validasi sukses, buat data baru di database
        // Data ini diambil dari 'name' di form HTML-mu
        Test_auth::create([
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'alamat' => $request->input('alamat'),
            'no_telepon' => $request->input('no_telepon'),
        ]);

        // 5. Setelah berhasil, kembalikan user ke halaman lain (misal halaman form lagi)
        // dengan pesan sukses (opsional)
        return redirect('/test_register')->with('success', 'Customer berhasil ditambahkan!');
    }
}