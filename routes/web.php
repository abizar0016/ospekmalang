<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;



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

    Route::get('/kategori', function () {
        return view('user.kategori');
    })->name('user.kategori');
});

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    });

    Route::get('/user', function () {
        return view('admin.user');
    });

    Route::get('/message', function () {
        return view('admin.message');
    });

    Route::get('/settings', function () {
        return view('admin.settings');
    });

    Route::get('/produk', function () {
        return view('admin.produk');
    });
});

//halaman admin

Route::prefix('admin')->group(function () {
    // Menampilkan pesan
    Route::get('/message', [MessageController::class, 'showMessages'])->name('admin.message');

    // Menampilkan formulir untuk membuat pesan baru
    Route::get('message/create', [MessageController::class, 'showMessageForm'])->name('admin.message.create');

    // Menyimpan pesan baru
    Route::post('message/save', [MessageController::class, 'saveMessage'])->name('admin.message.save');

    // Menampilkan pengguna
    Route::get('/user', [UserController::class, 'index'])->name('admin.index');

    // Menggunakan resource controller untuk pengguna
    Route::resource('/user', UserController::class);

    // Menyimpan pengguna baru
    Route::post('/user', [UserController::class, 'store'])->name('admin.user.store');

    // Menghapus pengguna
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('admin.user.destroy');
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
