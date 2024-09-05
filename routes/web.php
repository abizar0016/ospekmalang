<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

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
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/user', [UserController::class, 'index'])->name('admin.user.index');
    Route::post('/user/create', [UserController::class, 'create'])->name('admin.user.create');
    Route::put('/user/update', [UserController::class, 'update'])->name('admin.user.update');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('admin.user.destroy');

    Route::get('/message', [MessageController::class, 'index'])->name('admin.message.index');
    Route::post('/message/create', [MessageController::class, 'createMessage'])->name('admin.message.create');
    Route::put('/message/update', [MessageController::class, 'replyMessage'])->name('admin.message.reply');
    Route::delete('/message/{id}', [MessageController::class, 'destroy'])->name('admin.message.destroy');

    Route::get('/product', [ProductController::class, 'index'])->name('admin.product.index');
    Route::post('/product', [ProductController::class, 'createProduct'])->name('admin.product.create');
    Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('admin.product.update');
    Route::delete('/product{idproduct}}', [ProductController::class, 'destroy'])->name('admin.product.destroy');
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
