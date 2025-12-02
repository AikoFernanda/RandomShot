<?php

use Illuminate\Support\Facades\Route; // impor Route untuk Shortcut-nya: Route, Route::get, dll.

// Import controller customer (di luar folder Admin)
use App\Http\Controllers\AuthenticationController; // use alamat_lengkap; Perintah use, yang pada dasarnya adalah "shortcut" atau "impor" di PHP. Kemudian ada alamat lengkap App\Http\Controllers\Test_auth_controller. Jadi, Shortcut-nya: Test_auth_controller. nanti tinggal definisi aja [Test_auth_controller::class, 'logout_acc']. jadi bisa seperi ' rutekan ke alamat itu (yg diimport awal), class Test_auth_controller, dan pada fungsi logout_acc'.
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TransactionHistoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

// Import controller admin (di dalam folder Admin)
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
use App\Http\Controllers\Admin\TableController as AdminTableController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use Psy\ManualUpdater\Checker;

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
        Route::get('/profil-pengguna', [ProfileController::class, 'index'])->name('profile');

        Route::put('/profile-pengguna', [ProfileController::class, 'update'])->name('profile.update'); // form mengirimkan request PUT dan inti dari desain Resourceful (atau RESTful) di Laravel: Satu URL (/profil-pengguna) bisa menangani banyak aksi, asalkan Method-nya (kata kerjanya) berbeda.

        Route::post('/reservation/save-table', [ReservationController::class, 'store'])->name('reservation.cart');

        Route::get('/cart', [CartController::class, 'index'])->name('cart');

        Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');

        Route::delete('/cart/remove', [CartController::class, 'destroy'])->name('cart.remove');

        Route::post('/cart/select-table', [CartController::class, 'selectTable'])->name('cart.selectTable');

        Route::get('/transaction-history', [TransactionHistoryController::class, 'index'])->name('transaction.history');

        Route::post('/transaction-history', [TransactionHistoryController::class, 'show'])->name('transaction.detail');

        Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout');

        Route::get('/payment/{transaction}', [CheckoutController::class, 'index'])->name('payment');

        Route::post('/payment-cancel', [PaymentController::class, 'cancelTransaction'])->name('payment.cancel');

        Route::post('/payment', [PaymentController::class, 'processPayment'])->name('payment.validation');

        Route::get('/invoice/{transaction}', [PaymentController::class, 'index'])->name('invoice');
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

    Route::get('/review', function () {
        return view('review', ['title' => 'Review']);
    })->name('review');

    Route::get('/reservation', [ReservationController::class, 'index'])->name('reservation');

    Route::get('/reservation/{id}', [ReservationController::class, 'show'])->name('reservation.detail');


    Route::get('/cafe', [MenuController::class, 'index'])
        ->name('cafe');

    Route::get('/contact', function () {
        return view('contact', ['title' => 'Contact Us']);
    })->name('contact_us');

    Route::get('/about', function () {
        return view('about', ['title' => 'About Us']);
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

        Route::get('/data-meja', function () {
            return view('admin.data-meja', [
                'title' => 'Data Meja',
            ]);
        })->name('data.meja');

        Route::get('/data-menu', function () {
            return view('admin.data-menu', [
                'title' => 'Data Menu',
            ]);
        })->name('data.menu');

        Route::get('/data-transaksi', function () {
            return view('admin.data-transaksi', [
                'title' => 'Data Transaksi',
            ]);
        })->name('transaksi');


        Route::get('/customer-data', [AdminCustomerController::class, 'index'])
            ->name('customer'); //Tanda titik (.) di dalam view() adalah pengganti untuk garis miring (/) di dalam folder. perintah return view() untuk mencari dan menampilkan file HTML "cari file Blade (HTML) dan tampilkan isinya". Perintah ini tidak mengubah URL di browser, redirect('/...) itu yang mengubah alamat url.

        Route::post('/customer/{id}/status', [AdminCustomerController::class, 'updateStatus'])
            ->name('updateStatus'); // Rute ini akan menangani update status
    });

// --- Rute untuk Owner ---
Route::prefix('owner')->name('owner.')
    ->middleware('role:Owner')
    ->group(function () {

        Route::get('/performa', function () {
            return view('owner.performance', [
                'title' => 'Performa Bisnis',
            ]);
        })->name('performa');

        Route::get('/laporan-keuangan', function () {
            return view('owner.finance-report', [
                'title' => 'Laporan Keuangan',
            ]);
        })->name('laporan.keuangan');

        Route::get('/laporan-penjualan', function () {
            return view('owner.sale-report', [
                'title' => 'Laporan Penjualan',
            ]);
        })->name('laporan.penjualan');

        Route::get('/data-operasional', function () {
            return view('owner.operational', [
                'title' => 'Data Operasional',
            ]);
        })->name('data.operasional');

        Route::get('/feedback', function () {
            return view('owner.feedback', [
                'title' => 'Feedback Pelanggan',
            ]);
        })->name('feedback');

        Route::get('/data-admin', function () {
            return view('owner.data-admin', [
                'title' => 'Data Admin',
            ]);
        })->name('data-admin');
    });



// --- Rute untuk Customer, Admin, dan Owner    
Route::prefix()->name('user.')
    ->middleware(
        'role:Customer,Employee,Owner'
    )
    ->group(function () {
        Route::post('/logout', [AuthenticationController::class, 'userLogout'])->name('logout'); // /route, [] kurung siku ini berisi data (key & value) array yg akan dikirimkan ke route yg akan dituju
    });

// Bentuk 1 (Closure): Logikanya dikerjakan langsung di tempat (di file rute). Ini bagus untuk rute yang sangat sederhana dan tidak punya banyak logika
// Bentuk 2 (Controller): Logikanya didelegasikan atau "dilempar" ke file lain yang khusus (yaitu Controller). Sangat Rapi (Best Practice) karena logika tersimpan rapi di file Controller-nya masing-masing. Ini dipakai untuk 99% semua pekerjaan yang punya logika, seperti: Menyimpan data (CRUD), Login, Logout, Menampilkan data dari database, dll