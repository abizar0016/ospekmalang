<?php

use App\Http\Kernel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AddUserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserPageController;
use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\AddProductController;
use App\Http\Controllers\UpdateUserController;
use App\Http\Controllers\ProductAdminController;

//not fount page

Route::fallback(function () {
    abort(404, 'Halaman Tidak Ditemukan');
});
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

    // --------------------VIEW ADMIN--------------------------//

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    //--------------------------------VIEW MANAGE USER-------------------------------------//

    Route::get('admin/user', [UserAdminController::class, 'index'])->name('admin.user');
    Route::get('admin/user/view/{id}', [UserAdminController::class, 'show'])->name('admin.user.view');

    //---------------------------CREATE USER-----------------------------------------------------//

    Route::get('admin/user/create', [AddUserController::class, 'index'])->name('admin.user.create');
    Route::post('admin/user/create', [AddUserController::class, 'create'])->name('admin.user.create.post');

    //---------------------------------UPDATE USER----------------------------------------------------------------------------//

    Route::get('admin/user/update/{id}', [UpdateUserController::class, 'index'])->name('admin.user.update');
    Route::put('admin/user/update/{id}', [UpdateUserController::class, 'update'])->name('admin.user.update.post');

    //------------------------------------DELETE USER-----------------------------------------------------

    Route::delete('admin/user/{id}', [UserAdminController::class, 'delete'])->name('admin.user.delete');

    //---------------------------------------PRODUCT ADMIN--------------------------------------------------------//

    Route::get('admin/product', [ProductAdminController::class, 'index'])->name('admin.product.index');
    Route::get('admin/product/create', [AddProductController::class, 'index'])->name('admin.product.create');

    //----------------------------------VIEW MESSAGE FROM USER------------------------------------------//

    Route::get('admin/message', [MessageController::class, 'index'])->name('message');
    Route::post('admin/message', [MessageController::class, 'createMessage'])->name('message.create');
    Route::post('admin/message/{id}/reply', [MessageController::class, 'replyMessage'])->name('message.reply');

    Route::get('admin/profile', [ProfileController::class, 'index'])->name('admin.profile.index');
    Route::resource('admin/profile/action', ProfileController::class);

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


// Auth Routes
Route::get('/register', function () {
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
