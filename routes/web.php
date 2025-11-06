<?php

use Illuminate\Support\Facades\Route; // impor Route untuk Shortcut-nya: Route, Route::get, dll.
use App\Http\Controllers\Test_auth_controller; // use alamat_lengkap; Perintah use, yang pada dasarnya adalah "shortcut" atau "impor" di PHP. Kemudian ada alamat lengkap App\Http\Controllers\Test_auth_controller. Jadi, Shortcut-nya: Test_auth_controller. nanti tinggal definisi aja [Test_auth_controller::class, 'logout_acc']. jadi bisa seperi ' rutekan ke alamat itu (yg diimport awal), class Test_auth_controller, dan pada fungsi logout_acc'.

// Bentuk 1 (Closure): Logikanya dikerjakan langsung di tempat (di file rute). Ini bagus untuk rute yang sangat sederhana dan tidak punya banyak logika
Route::get('/', function () {
    // return view('welcome');
    return view('welcome');
});

Route::get('/test', function () {
    // return view('test_register')
    return view('test_landing', ['title' => 'Landing Page']);
});

Route::get('/test_register', function () {
    // 2. Tampilkan file Blade yang berisi form register HTML (view: test_register.blade.php)
    return view('test_register', ['title' => 'Register Page']);
});

 

// Bentuk 2 (Controller): Logikanya didelegasikan atau "dilempar" ke file lain yang khusus (yaitu Controller). Sangat Rapi (Best Practice) karena logika tersimpan rapi di file Controller-nya masing-masing. Ini dipakai untuk 99% semua pekerjaan yang punya logika, seperti: Menyimpan data (CRUD), Login, Logout, Menampilkan data dari database, dll
Route::get('/test_logout', [Test_auth_controller::class, 'logout_acc']); // /route, [] kurung siku ini berisi data (key & value) array yg akan dikirimkan ke route yg akan dituju

Route::post('/test_register_customer', [Test_auth_controller::class, 'register_acc']);

Route::post('/test_login_customer', [Test_auth_controller::class, 'login_acc']);