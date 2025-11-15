<?php

use Illuminate\Support\Facades\Route; // impor Route untuk Shortcut-nya: Route, Route::get, dll.

// Import controller customer (di luar folder Admin)
use App\Http\Controllers\AuthenticationController; // use alamat_lengkap; Perintah use, yang pada dasarnya adalah "shortcut" atau "impor" di PHP. Kemudian ada alamat lengkap App\Http\Controllers\Test_auth_controller. Jadi, Shortcut-nya: Test_auth_controller. nanti tinggal definisi aja [Test_auth_controller::class, 'logout_acc']. jadi bisa seperi ' rutekan ke alamat itu (yg diimport awal), class Test_auth_controller, dan pada fungsi logout_acc'.
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;


// Import controller admin (di dalam folder Admin)
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
use App\Http\Controllers\Admin\TableController as AdminTableController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;



// --- Rute khusus untuk 'Tamu' ---
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthenticationController::class, 'showRegisterForm'])->name('register');

    Route::get('/login', [AuthenticationController::class, 'showLoginForm'])->name('login');

    Route::post('/register', [AuthenticationController::class, 'customerRegister'])->name('register.validation');

    Route::post('/login', [AuthenticationController::class, 'userLogin'])->name('login.validation');
});




// --- Rute untuk Customer ---
Route::prefix('customer')->name('customer.')
->middleware('role:Customer')
->group(function () {
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
    
    Route::post('/cart-update', [CartController::class, 'update'])->name('cart.update');
});



// --- Rute untuk 'Tamu' dan Customer ---
Route::middleware('block')->group(function () {
Route::get('/', function () {
    // return view('landing');
    return view('landing', ['title' => 'Landing Page']);
})->name('landing');

Route::get('/home', function () {
    return view('home', ['title' => 'Home Page']);
})->name('home');

Route::get('/cafe', [MenuController::class, 'index'])
    ->name('cafe');

Route::get('/contact', function () {
    return view('contact', ['title' => 'Contact Us']); // // Tanda titik (.) di dalam view() adalah pengganti untuk garis miring (/) di dalam folder. perintah return view() untuk mencari dan menampilkan file HTML "cari file Blade (HTML) dan tampilkan isinya". Perintah ini tidak mengubah URL di browser, redirect('/...) itu yang mengubah alamat url.
})->name('contact_us');

Route::get('/about', function () {
    return view('about', ['title' => 'About Us']); // // Tanda titik (.) di dalam view() adalah pengganti untuk garis miring (/) di dalam folder. perintah return view() untuk mencari dan menampilkan file HTML "cari file Blade (HTML) dan tampilkan isinya". Perintah ini tidak mengubah URL di browser, redirect('/...) itu yang mengubah alamat url.
})->name('about');
});


// --- Rute untuk Admin ---
Route::prefix('admin')->name('admin.')
    ->middleware( 
        'role:Employee'    
    )
    ->group(function () {
        Route::get('/reservation-data', [AdminReservationController::class, 'index'])
            ->name('reservation');

        Route::get('/table-data', [AdminTableController::class, 'index'])
            ->name('table');

        Route::get('/customer-data', [AdminCustomerController::class, 'index'])
            ->name('customer'); //Tanda titik (.) di dalam view() adalah pengganti untuk garis miring (/) di dalam folder. perintah return view() untuk mencari dan menampilkan file HTML "cari file Blade (HTML) dan tampilkan isinya". Perintah ini tidak mengubah URL di browser, redirect('/...) itu yang mengubah alamat url.

        Route::post('/customer/{id}/status', [AdminCustomerController::class, 'updateStatus'])
            ->name('updateStatus'); // Rute ini akan menangani update status
    });



// --- Rute untuk Customer, Admin, dan Owner    
Route::prefix('user')->name('user.')
    ->middleware(  
        'role:Customer,Employee,Owner'
    )
    ->group(function () {
        Route::post('/logout', [AuthenticationController::class, 'userLogout'])->name('logout'); // /route, [] kurung siku ini berisi data (key & value) array yg akan dikirimkan ke route yg akan dituju
    });


// Bentuk 1 (Closure): Logikanya dikerjakan langsung di tempat (di file rute). Ini bagus untuk rute yang sangat sederhana dan tidak punya banyak logika
// Bentuk 2 (Controller): Logikanya didelegasikan atau "dilempar" ke file lain yang khusus (yaitu Controller). Sangat Rapi (Best Practice) karena logika tersimpan rapi di file Controller-nya masing-masing. Ini dipakai untuk 99% semua pekerjaan yang punya logika, seperti: Menyimpan data (CRUD), Login, Logout, Menampilkan data dari database, dll