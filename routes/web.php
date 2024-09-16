<?php

use App\Http\Kernel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\UserPageController;
use App\Http\Controllers\UserAdminController;

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
    Route::get('admin/user', [UserAdminController::class, 'index'])->name('admin.user');
    Route::get('admin/user/create', [UserAdminController::class, 'create'])->name('admin.user.create');
    Route::post('admin/user/created', [UserAdminController::class, 'createUser'])->name('admin.user.createUser');
    Route::put('admin/user/update/{id}', [UserAdminController::class, 'updateUser'])->name('admin.user.update');
    Route::delete('admin/user/{user}', [UserAdminController::class, 'deleteUser'])->name('admin.user.delete');
    Route::get('admin/user/view/{id}', [UserAdminController::class, 'show'])->name('admin.user.view');

    Route::get('admin/message', [MessageController::class, 'index'])->name('message');
    Route::post('admin/message', [MessageController::class, 'createMessage'])->name('message.create');
    Route::post('admin/message/{id}/reply', [MessageController::class, 'replyMessage'])->name('message.reply');

    Route::get('admin/product', [ProductController::class, 'index'])->name('admin.product.index');
    Route::resource('admin/product/action', ProductController::class);

    Route::get('admin/profile', [ProfileController::class, 'index'])->name('admin.profile.index');
    Route::resource('admin/profile/action', ProfileController::class);

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


// Auth Routes
Route::get('/register', function(){
    if (Auth::check()) {
        // Cek status pengguna dan arahkan sesuai peran
        if (Auth::user()->status === 'admin') {
            return redirect()->route('admin.index');
        } else {
            return redirect()->route('user.index');
        }
    }

    return view('register');
})->name('register');
Route::post('/register', [AuthController::class, 'postRegister'])->name('register.post');

Route::get('/login', function () {
    if (Auth::check()) {
        // Cek status pengguna dan arahkan sesuai peran
        if (Auth::user()->status === 'admin') {
            return redirect()->route('admin.index');
        } else {
            return redirect()->route('user.index');
        }
    }

    return view('login');
})->name('login');
Route::post('/login', [AuthController::class, 'postLogin'])->name('login.post');

// Product Routes
Route::post('/product', [AuthController::class, 'addProduct'])->name('product.add');
Route::get('/product', [AuthController::class, 'product'])->name('product.list');
