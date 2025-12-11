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
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FeedbackReviewController;

// Import controller admin (di dalam folder Admin)
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
use App\Http\Controllers\Admin\TableController as AdminTableController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\MenuOrderController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;

// import controller owner (didalam folder owner)
use App\Http\Controllers\Owner\PerformanceController;
use App\Http\Controllers\Owner\SaleReportController;
use App\Http\Controllers\Owner\OperationalCostController;
use App\Http\Controllers\Owner\FinancialReportController;
use App\Http\Controllers\Owner\AdminController;


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

        Route::post('/cart/update-note', [CartController::class, 'updateNote'])->name('cart.updateNote');

        Route::post('/cart/select-table', [CartController::class, 'selectTable'])->name('cart.selectTable');

        Route::get('/transaction-history', [TransactionHistoryController::class, 'index'])->name('transaction.history');

        Route::post('/transaction-history', [TransactionHistoryController::class, 'show'])->name('transaction.detail');

        Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout');

        Route::get('/payment/{transaction}', [CheckoutController::class, 'index'])->name('payment');

        Route::post('/payment-cancel', [PaymentController::class, 'cancelTransaction'])->name('payment.cancel');

        Route::post('/payment', [PaymentController::class, 'processPayment'])->name('payment.validation');

        Route::get('/invoice/{transaction}', [PaymentController::class, 'index'])->name('invoice');

        Route::post('/review', [FeedbackReviewController::class, 'store'])->name('review.store');
    });

// --- Rute untuk 'Tamu' dan Customer ---
Route::middleware('block')->group(function () {
    Route::get('/', function () {
        // return view('landing');
        return view('landing', ['title' => 'Landing Page']);
    })->name('landing');

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/review', [FeedbackReviewController::class, 'index'])->name('review');

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

    Route::get('/login-required', function () {
        return redirect()->route('login')->with('error', 'Silakan masuk terlebih dahulu');
    })->name('login.required');
});


// --- Rute untuk Admin ---
Route::prefix('admin')->name('admin.')
    ->middleware(
        'role:Employee'
    )
    ->group(function () {

        Route::get('/reservation', [AdminReservationController::class, 'index'])->name('reservation'); // Sesuai sidebar menu

        Route::post('/reservation/{id}/status', [AdminReservationController::class, 'updateStatus'])->name('reservation.update');  // Route untuk update status via AJAX

        Route::get('/data-pesanan', [MenuOrderController::class, 'index'])->name('order');

        Route::post('/pesanan/{id}/status', [MenuOrderController::class, 'updateStatus'])->name('order.update');

        Route::get('/data-transactions', [TransactionController::class, 'index'])->name('transaction');

        Route::get('/data-transactions/{id}', [TransactionController::class, 'show'])->name('transaction.show');

        Route::put('/data-transactions/{id}', [TransactionController::class, 'update'])->name('transaction.update');

        Route::get('/customer-data', [AdminCustomerController::class, 'index'])
            ->name('customer'); //Tanda titik (.) di dalam view() adalah pengganti untuk garis miring (/) di dalam folder. perintah return view() untuk mencari dan menampilkan file HTML "cari file Blade (HTML) dan tampilkan isinya". Perintah ini tidak mengubah URL di browser, redirect('/...) itu yang mengubah alamat url.

        Route::post('/customer/{id}/status', [AdminCustomerController::class, 'updateStatus'])
            ->name('updateStatus'); // Rute ini akan menangani update status

        // CRUD MENU
        Route::get('/data-menu', [AdminMenuController::class, 'index'])->name('menu');
        Route::post('/menu', [AdminMenuController::class, 'store'])->name('menu.store');
        Route::put('/menu/{id}', [AdminMenuController::class, 'update'])->name('menu.update');
        Route::delete('/menu/{id}', [AdminMenuController::class, 'destroy'])->name('menu.destroy');

        // CRUD MEJA
        Route::get('/data-meja', [AdminTableController::class, 'index'])->name('table');
        Route::post('/meja', [AdminTableController::class, 'store'])->name('table.store');
        Route::put('/meja/{id}', [AdminTableController::class, 'update'])->name('table.update');
        Route::delete('/meja/{id}', [AdminTableController::class, 'destroy'])->name('table.destroy');
    });

// --- Rute untuk Owner ---
Route::prefix('owner')->name('owner.')
    ->middleware('role:Owner')
    ->group(function () {

        Route::get('/performance', [PerformanceController::class, 'index'])->name('performance');

        Route::get('/laporan-keuangan', [FinancialReportController::class, 'index'])->name('laporan.keuangan');

        Route::get('/laporan-penjualan', [SaleReportController::class, 'index'])->name('laporan.penjualan');

        Route::get('/owner/transaksi/{id}', [SaleReportController::class, 'show'])->name('transaksi.detail');

        Route::get('/biaya-operasional', [OperationalCostController::class, 'index'])->name('data.operasional');

        // CRUD data admin
        Route::get('/data-admin', [AdminController::class, 'index'])->name('data.admin');
        Route::post('/data-admin', [AdminController::class, 'store'])->name('data.admin.store');
        Route::put('/data-admin/{id}', [AdminController::class, 'update'])->name('data.admin.update');
        Route::delete('/data-admin/{id}', [AdminController::class, 'destroy'])->name('data.admin.destroy');

        // CRUD BIAYA OPERASIONAL
        Route::get('/biaya-operasional', [OperationalCostController::class, 'index'])->name('data.operasional');
        Route::post('/biaya-operasional', [OperationalCostController::class, 'store'])->name('data.operasional.store');
        Route::put('/biaya-operasional/{id}', [OperationalCostController::class, 'update'])->name('data.operasional.update');
        Route::delete('/biaya-operasional/{id}', [OperationalCostController::class, 'destroy'])->name('data.operasional.destroy');

        Route::get('/feedback', function () {
            return view('owner.feedback', [
                'title' => 'Feedback Pelanggan',
            ]);
        })->name('feedback');
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