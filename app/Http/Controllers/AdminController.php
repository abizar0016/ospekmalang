<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use App\Models\Product;

class AdminController extends Controller
{
    public function index()
    {
        // Hitung jumlah pesan
        $messageCount = Message::count();
        $userCount = User::count();
        $productCount = Product::count();

        return view('admin.index', compact('messageCount', 'userCount', 'productCount'));
    }

    public function user()
    {
        return view('admin.user');
    }

    public function message()
    {
        return view('admin.message');
    }

    public function product()
    {
        return view('admin.product');
    }

    public function help()
    {
        return view('admin.help');
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function logout()
    {
        // Logika logout, jika diperlukan
        return redirect('/');
    }
}
