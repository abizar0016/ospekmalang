<?php

use App\Http\Kernel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AddUserController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserPageController;
use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\AddProductController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\UpdateUserController;
use App\Http\Controllers\ProductAdminController;
use App\Http\Controllers\UpdateProductController;

//not fount page

Route::fallback(function () {
    abort(404, 'Halaman Tidak Ditemukan');
});
// Halaman Utama
Route::prefix('/')->group(function () {
    Route::get('/', function () {
        if (Auth::check()) {
            // Cek status pengguna dan arahkan sesuai peran
            if (Auth::user()->status === 'admin') {
                return redirect()->route('admin.index');
            } else {
                return redirect()->route('user.index');
            }
        }

        return view('guest.index');
    })->name('guest.index');

    Route::get('produk', function () {

        if (Auth::check()) {
            // Cek status pengguna dan arahkan sesuai peran
            if (Auth::user()->status === 'admin') {
                return redirect()->route('admin.index');
            } else {
                return redirect()->route('user.index');
            }
        }

        return view('guest.produk');
    })->name('guest.produk');

    Route::get('about', function () {
        if (Auth::check()) {
            // Cek status pengguna dan arahkan sesuai peran
            if (Auth::user()->status === 'admin') {
                return redirect()->route('admin.index');
            } else {
                return redirect()->route('user.index');
            }
        }
        
        return view('guest.about');
    })->name('guest.about');
});

// Routes untuk User
Route::group(['middleware' => ['auth']],function(){
    Route::prefix('user')->group(function () {
        Route::get('/', [UserPageController::class, 'index'])->name('user.index');
        Route::delete('cart/{id}', [UserPageController::class, 'delete'])->name('user.cart.delete');
    
        Route::get('/product', [UserPageController::class, 'productView'])->name('user.product');
        
        Route::get('/checkout', [CheckoutController::class, 'index'])->name('user.checkout');
        
        Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');

        Route::get('/cart', [CartController::class, 'getCart'])->name('user.cart');

    });
});

// Route untuk Admin

Route::group(['middleware' => ['auth']], function () {

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    Route::get('admin/user', [UserAdminController::class, 'index'])->name('admin.user');
    Route::post('admin/user/create', [UserAdminController::class, 'create'])->name('admin.user.create');
    Route::put('admin/user/update/{id}', [UserAdminController::class, 'update'])->name('admin.user.update');
    Route::delete('admin/user/{id}', [UserAdminController::class, 'delete'])->name('admin.user.delete');

    //---------------------------------------PRODUCT ADMIN--------------------------------------------------------//

    Route::get('admin/product', [ProductAdminController::class, 'index'])->name('admin.product.index');

    Route::post('admin/product/create', [ProductAdminController::class, 'create'])->name('admin.product.create');

    Route::put('admin/product/update/{id}', [ProductAdminController::class, 'update'])->name('admin.product.update');

    Route::delete('admin/product/{id}', [ProductAdminController::class, 'delete'])->name('admin.product.delete');

    Route::get('admin/order', [OrderController::class, 'index'])->name('admin.oder.index');
    Route::put('admin/order/update/{id}', [OrderController::class, 'update'])->name('admin.order.update');
    Route::delete('admin/order/delete/{id}', [OrderController::class, 'delete'])->name('admin.order.delete');

    Route::get('admin/categories', [CategoriesController::class, 'index'])->name('admin.categories.index');

    Route::post('admin/categories/add', [CategoriesController::class, 'add'])->name('admin.categories.add');

    Route::delete('admin/categories/delete/{id}', [CategoriesController::class, 'delete'])->name(('admin.categories.delete'));

    Route::put('admin/categories/update/{id}', [CategoriesController::class, 'update'])->name('admin.categories.update');

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
