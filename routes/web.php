<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;

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
    })->name('user.checkout');
});

// Route untuk Admin

    Route::prefix('admin')->group(function (){
        //routing buat index
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        
        //routing buat user
        Route::get('/user', [UserController::class, 'index'])->name('admin.user');
        Route::post('/user', [UserController::class, 'createUser'])->name('admin.user.create');
        Route::put('/user', [UserController::class, 'updateUser'])->name('admin.user.update');
        Route::delete('/user', [UserController::class, 'deleteUser'])->name('admin.user.delete');
            
        
        Route::get('/message', [MessageController::class, 'index'])->name('admin.message');
        
        Route::get('/product', [ProductController::class, 'index'])->name('admin.product.index');
        
        Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile.index');
    });

// Auth Routes
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'postRegister'])->name('register.post');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin'])->name('login.post');

// Product Routes
Route::post('/product', [AuthController::class, 'addProduct'])->name('product.add');
Route::get('/product', [AuthController::class, 'product'])->name('product.list');