<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Halaman Utama
Route::get('/', function () {
    return view('guest.index');
})->name('guest.index');

// Halaman Produk
Route::get('/components/produk', function () {
    return view('components.produk');
})->name('components.produk');

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

// Halaman Produk Guest
Route::get('produk', function () {
    return view('guest.produk');
})->name('guest.produk');

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
