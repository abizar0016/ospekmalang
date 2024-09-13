<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserPageController;
use App\Http\Kernel;

use App\Models\User;

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
    Route::get('/', [UserPageController::class, 'index'])->name('user.index')->middleware('auth');

    Route::get('/produk', function () {
        return view('user.produk');
    })->name('user.produk');

    Route::get('/checkout', function () {
        return view('user.checkout');
    })->name('user.checkout');
});

// Route untuk Admin

Route::group(['middleware' => ['auth']], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    // Rute lainnya yang hanya boleh diakses oleh admin
    Route::get('admin/user', [UserAdminController::class, 'index'])->name('user');
    Route::post('admin/user', [UserAdminController::class, 'createUser'])->name('user.create');
    Route::put('admin/user/{id}', [UserAdminController::class, 'updateUser'])->name('user.update');
    Route::delete('admin/user/{user}', [UserAdminController::class, 'deleteUser'])->name('user.delete');

    Route::get('/message', [MessageController::class, 'index'])->name('message');
    Route::post('/message', [MessageController::class, 'createMessage'])->name('message.create');
    Route::post('/message/{id}/reply', [MessageController::class, 'replyMessage'])->name('message.reply');

    Route::get('/product', [ProductController::class, 'index'])->name('admin.product.index');
    Route::resource('/product/action', ProductController::class);

    Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile.index');
    Route::resource('/profile/action', ProfileController::class);

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


// Auth Routes
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'postRegister'])->name('register.post');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin'])->name('login.post');

// Product Routes
Route::post('/product', [AuthController::class, 'addProduct'])->name('product.add');
Route::get('/product', [AuthController::class, 'product'])->name('product.list');
