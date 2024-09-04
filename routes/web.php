<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use App\Models\Message;

// Halaman Utama
Route::prefix('/')->group(function () {
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

    Route::get('/checkout', function () {
        return view('user.checkout');
    })->name('user.kategori');
});


// Route untuk menampilkan halaman admin dan menghitung jumlah pesan
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    
    // Rute lain tetap sama
    Route::get('/user', [AdminController::class, 'user'])->name('admin.user');
    Route::get('/message', [AdminController::class, 'message'])->name('admin.message');
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::get('/product', function () {
        return view('admin.product');
    });

        // Menampilkan pengguna
        Route::get('/user', [UserController::class, 'index'])->name('admin.user.index');

        // Menyimpan pengguna baru
        Route::post('/user/create', [UserController::class, 'create'])->name('admin.user.create');
    
        //update pengguna
        Route::put('/user/update', [UserController::class, 'update'])->name('admin.user.update');
    
        // Menghapus pengguna
        Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('admin.user.destroy');
    
        // Menampilkan pesan
        Route::get('/message', [MessageController::class, 'index'])->name('admin.index');
    
        // Menampilkan formulir untuk membuat pesan baru
        Route::post('message/create', [MessageController::class, 'createMessage'])->name('admin.message.create');
    
        // Menyimpan balasan pesan
        Route::put('message/update', [MessageController::class, 'replyMessage'])->name('admin.message.reply');
    
        //menghapus pesan
        Route::delete('/message/{id}', [MessageController::class, 'destroy'])->name('admin.message.destroy');
});


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


Route::middleware('auth')->group(function () {
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
});
