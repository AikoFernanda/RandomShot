<?php

namespace App\Http\Controllers;

// 1. Kita "impor" alat-alat yang kita butuhkan
use Illuminate\Http\Request; // Untuk mengambil data dari form
use App\Models\Customer;    // Untuk berinteraksi dengan tabel 'customers'
use Illuminate\Support\Facades\Session; // import session
use Illuminate\Support\Facades\Hash; // import facede hash

class AuthenticationController extends Controller
{
    // REGISTER
    public function showRegisterForm() 
    {
        return view('auth.register_form', ['title' => 'Register']); //perintah untuk mencari dan menampilkan file HTML "cari file Blade (HTML) dan tampilkan isinya". Perintah ini tidak mengubah URL di browser.
        // Tanda titik (.) di dalam view() adalah pengganti untuk garis miring (/) di dalam folder.
    }

    public function customeRegister(Request $request)
    {
        // 3. Validasi data yang masuk dari form
        // Jika gagal, Laravel otomatis kembali ke form & menampilkan error
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_telepon' => 'required|numeric', // Aturan 'tel' bukan aturan validasi bawaan Laravel. harus menggantinya dengan 'numeric' (Aturan numeric berarti: "Validasi ini lolos jika isi string-nya adalah angka")
            'email' => 'required|email|unique:customers', // unique seperti validasi, unique: Ini adalah nama aturannya. :test_customers: Ini memberi tahu Laravel, "Tolong cek di tabel test_customers apakah email ini sudah ada."
            'password' => 'required|string'
        ]);

        // 4. Jika validasi sukses, buat data baru di database
        // Data ini diambil dari 'name' di form HTML
        Customer::create([
            'nama' => $request->input('nama'),
            'no_telepon' => $request->input('no_telepon'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')) // Laravel akan menjalankan Hash::make('...') dan menyimpan string yang sangat panjang dan acak (disebut hash) ke database
        ]);

        // 5. Setelah berhasil, kembalikan user ke halaman lain (misal halaman home lagi)
        // dengan pesan sukses (opsional) dan set session status_login dengan success
        session(["status_login" => "success"]);
        return redirect('/home')->with('success', 'Customer berhasil ditambahkan!');
    }

    // LOGIN
    public function showLoginForm()
    {
        return view('auth.login_form', ['title' => 'Login']);
    }

    /**
     * Mengecek data customer yang sudah ada dari database
     */
    public function customerLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255', 
            'password' => 'required|string'
        ]);

        $cek_akun = Customer::where('email', $request->input('email'))->first();

        if ($cek_akun && Hash::check($request->input('password'), $cek_akun->password)) // jika masih ingin mengeceknya "manual" untuk memahami logikanya, harus menggunakan Hash'::check(), dengan ambil data user-nya dulu, lalu membandingkan password-nya di PHP. Ada cara lain dengan fitur login bawaan Laravel: Auth'::attempt().
        {
            session(["status_login" => "success"]); // Cara 1: Global Helper (Paling umum), // Cara 2: Via Request (Ini biasanya untuk data yang hanya hidup 1 request/redirect seperti ->with() yang di pakai, // Cara 3: Menggunakan Facade
            return redirect('/home')->with('success', 'Berhasil login, Selamat datang!');
        } else
        {
            return redirect('/login')->with('error', 'Email atau passwowrd yang anda masukkan salah');
        }
    }

    // LOGOUT
    public function customerLogout(Request $request)
    {
        // Opsi A: Hapus SEMUA data di session
        $request->session()->flush(); //flush(): Ini akan menghapus semua data dari session (termasuk flash message, dll). Ini adalah "logout" yang sebenarnya.

        // Opsi B: Hapus satu key spesifik
        // $request->session()->forget('status_login');

        return redirect('/home')->with('logout_success', 'Harap Login Kembali!');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
