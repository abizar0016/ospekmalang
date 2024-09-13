<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Pastikan import ini ada
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Cek apakah pengguna tidak autentikasi (guest)
        if (Auth::guest()) {
            abort(403, 'Access denied. You are not authenticated.');
        }

        // Cek apakah pengguna bukan admin
        if (Auth::user()->status !== 'admin') {
            abort(403, 'Access denied. You are not an admin.');
        }

        // Jika pengguna adalah admin, tampilkan data
        $sessions = $request->session()->get('uname');
        $messageCount = Message::count();
        $userCount = User::count();
        $productCount = Product::count();

        return view('admin.index', compact('messageCount', 'userCount', 'productCount', 'sessions'));
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
        Auth::logout(); // Pastikan logout dilakukan
        return redirect('/');
    }
}
