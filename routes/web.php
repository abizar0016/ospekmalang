<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\AdminController;

// Halaman Utama
Route::prefix('/')->group(function(){
    Route::get('/', function () {
        return view('guest.index');
    })->name('guest.index');

    Route::get('produk', function () {
        return view('guest.produk');
    })->name('guest.produk');

    Route::get('about', function () {
        return view('guest.about');
    })->name('guest.about');
});

// Routes untuk User
Route::prefix('user')->group(function () {
    Route::get('/', function () {
        return view('user.index');
    })->name('user.index');

    Route::get('/produk', function () {
        return view('user.produk');
    })->name('user.produk');

    Route::get('/kategori', function () {
        return view('user.kategori');
    })->name('user.kategori');
});

Route::prefix('admin')->group(function(){
    Route::get('/', function(){
        return view('admin.index');
    });

    Route::get('/user', function(){
        return view('admin.user');
    });

    Route::get('/message', function(){
        return view('admin.message');
    });

    Route::get('/help', function(){
        return view('admin.help');
    });

    Route::get('/settings', function(){
        return view('admin.settings');
    });

    Route::get('/help', function(){
        return view('admin.help');
    });
});


// Halaman Produk Guest


// Halaman Khusus
Route::get('/your-page', [HomeController::class, 'link'])->name('your-page');

// Auth Routes
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'postRegister'])->name('register.post');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin'])->name('login.post');

// Product Routes
Route::post('/product', [AuthController::class, 'addProduct'])->name('product.add');
Route::get('/product', [AuthController::class, 'product'])->name('product.list');


// Route untuk tampilan forgot password
Route::get('password/reset', [PasswordResetController::class, 'showResetForm'])->name('password.request');

// Route untuk menangani pengiriman link reset password
Route::post('password/email', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');

// Route untuk menangani reset password
Route::get('password/reset/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [PasswordResetController::class, 'reset'])->name('password.update');

