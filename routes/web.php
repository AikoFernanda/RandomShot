<?php

use Illuminate\Support\Facades\Route; // impor Route untuk Shortcut-nya: Route, Route::get, dll.

// Import controller customer (di luar folder Admin)
use App\Http\Controllers\AuthenticationController; // use alamat_lengkap; Perintah use, yang pada dasarnya adalah "shortcut" atau "impor" di PHP. Kemudian ada alamat lengkap App\Http\Controllers\Test_auth_controller. Jadi, Shortcut-nya: Test_auth_controller. nanti tinggal definisi aja [Test_auth_controller::class, 'logout_acc']. jadi bisa seperi ' rutekan ke alamat itu (yg diimport awal), class Test_auth_controller, dan pada fungsi logout_acc'.

// Import controller admin (di dalam folder Admin)
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
use App\Http\Controllers\Admin\TableController as AdminTableController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;


// --- Rute untuk Customer ---
Route::get('/', function () {
    // return view('landing');
    return view('landing', ['title' => 'Landing Page']);
})->name('landing');

Route::get('/biliar-reservation', function () {
    return view('reservation.biliar-reservation', ['title' => 'Reservation Page']);
})->name('reservation');

Route::get('/tenis-reservation', function () {
    return view('reservation.tenis-reservation', ['title' => 'Reservation Page']);
});

Route::get('/ps4-reservation', function () {
    return view('reservation.ps4-reservation', ['title' => 'Reservation Page']);
});

Route::get('/cafe-reservation', function () {
    return view('reservation.cafe-reservation', ['title' => 'Reservation Page']);
});

Route::get('/drink-reservation', function () {
    return view('reservation.drink-reservation', ['title' => 'Reservation Page']);
});

Route::get('/cart', function () {
    return view('cart', ['title' => 'My Cart Page']);
});

Route::get('/payment', function () {
    return view('payment', ['title' => 'Payment Page']);
});

Route::get('/detail-meja1', function () {
    return view('detail.detail-meja1', ['title' => 'Detail Page']);
});

Route::get('/detail-meja2', function () {
    return view('detail.detail-meja2', ['title' => 'Detail Page']);
});


Route::get('/home', function () {
    return view('home', ['title' => 'Home Page']);
})->name('home');

Route::get('/register', function () {
    // 2. Tampilkan file Blade yang berisi form register HTML (view: test_register.blade.php)
    return view('auth.register_form', ['title' => 'Register Page']);
})->name('register');

Route::get('/login', function () {
    return view('auth.login_form', ['title' => 'Login Page']); // // Tanda titik (.) di dalam view() adalah pengganti untuk garis miring (/) di dalam folder. perintah return view() untuk mencari dan menampilkan file HTML "cari file Blade (HTML) dan tampilkan isinya". Perintah ini tidak mengubah URL di browser, redirect('/...) itu yang mengubah alamat url.
})->name('login');

Route::get('/cafe', function () {
    return view('cafe', ['title' => 'Cafe Page']); // // Tanda titik (.) di dalam view() adalah pengganti untuk garis miring (/) di dalam folder. perintah return view() untuk mencari dan menampilkan file HTML "cari file Blade (HTML) dan tampilkan isinya". Perintah ini tidak mengubah URL di browser, redirect('/...) itu yang mengubah alamat url.
});

Route::get('/contact', function () {
    return view('contact', ['title' => 'Contact Us']); // // Tanda titik (.) di dalam view() adalah pengganti untuk garis miring (/) di dalam folder. perintah return view() untuk mencari dan menampilkan file HTML "cari file Blade (HTML) dan tampilkan isinya". Perintah ini tidak mengubah URL di browser, redirect('/...) itu yang mengubah alamat url.
})->name('contact_us');

Route::get('/about', function () {
    return view('about', ['title' => 'About Us']); // // Tanda titik (.) di dalam view() adalah pengganti untuk garis miring (/) di dalam folder. perintah return view() untuk mencari dan menampilkan file HTML "cari file Blade (HTML) dan tampilkan isinya". Perintah ini tidak mengubah URL di browser, redirect('/...) itu yang mengubah alamat url.
})->name('about');

Route::post('/register', [AuthenticationController::class, 'customerRegister'])->name('register');

Route::post('/login', [AuthenticationController::class, 'userLogin'])->name('login');

Route::get('/profil-pengguna', function () {
    return view('profile.profile', ['title' => 'User Profile']); // // Tanda titik (.) di dalam view() adalah pengganti untuk garis miring (/) di dalam folder. perintah return view() untuk mencari dan menampilkan file HTML "cari file Blade (HTML) dan tampilkan isinya". Perintah ini tidak mengubah URL di browser, redirect('/...) itu yang mengubah alamat url.
});

Route::get('/aktivitas-meja', function () {
    return view('profile.table-activity', ['title' => 'User Activity']); // // Tanda titik (.) di dalam view() adalah pengganti untuk garis miring (/) di dalam folder. perintah return view() untuk mencari dan menampilkan file HTML "cari file Blade (HTML) dan tampilkan isinya". Perintah ini tidak mengubah URL di browser, redirect('/...) itu yang mengubah alamat url.
});

Route::get('/aktivitas-cafe', function () {
    return view('profile.cafe-activity', ['title' => 'User Activity']); // // Tanda titik (.) di dalam view() adalah pengganti untuk garis miring (/) di dalam folder. perintah return view() untuk mencari dan menampilkan file HTML "cari file Blade (HTML) dan tampilkan isinya". Perintah ini tidak mengubah URL di browser, redirect('/...) itu yang mengubah alamat url.
});

Route::get('/riwayat-meja', function () {
    return view('history.table-history', ['title' => 'User History']); // // Tanda titik (.) di dalam view() adalah pengganti untuk garis miring (/) di dalam folder. perintah return view() untuk mencari dan menampilkan file HTML "cari file Blade (HTML) dan tampilkan isinya". Perintah ini tidak mengubah URL di browser, redirect('/...) itu yang mengubah alamat url.
});

Route::get('/riwayat-cafe', function () {
    return view('history.cafe-history', ['title' => 'User History']); // // Tanda titik (.) di dalam view() adalah pengganti untuk garis miring (/) di dalam folder. perintah return view() untuk mencari dan menampilkan file HTML "cari file Blade (HTML) dan tampilkan isinya". Perintah ini tidak mengubah URL di browser, redirect('/...) itu yang mengubah alamat url.
});

Route::post('/logout', [AuthenticationController::class, 'userLogout'])->name('logout'); // /route, [] kurung siku ini berisi data (key & value) array yg akan dikirimkan ke route yg akan dituju



// --- Rute untuk Admin ---
Route::get('/reservation-data', [AdminReservationController::class, 'index'])
     ->name('admin.reservation');

Route::get('/Table-data', [AdminTableController::class, 'index'])
     ->name('admin.table');

Route::get('/customer-data', [AdminCustomerController::class, 'index'])
    ->name('admin.customer'); //Tanda titik (.) di dalam view() adalah pengganti untuk garis miring (/) di dalam folder. perintah return view() untuk mencari dan menampilkan file HTML "cari file Blade (HTML) dan tampilkan isinya". Perintah ini tidak mengubah URL di browser, redirect('/...) itu yang mengubah alamat url.

Route::post('/customer/{id}/status', [AdminCustomerController::class, 'updateStatus'])
    ->name('customer.updateStatus'); // Rute ini akan menangani update status


// Bentuk 1 (Closure): Logikanya dikerjakan langsung di tempat (di file rute). Ini bagus untuk rute yang sangat sederhana dan tidak punya banyak logika
// Bentuk 2 (Controller): Logikanya didelegasikan atau "dilempar" ke file lain yang khusus (yaitu Controller). Sangat Rapi (Best Practice) karena logika tersimpan rapi di file Controller-nya masing-masing. Ini dipakai untuk 99% semua pekerjaan yang punya logika, seperti: Menyimpan data (CRUD), Login, Logout, Menampilkan data dari database, dll