<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Pastikan import ini ada
use App\Http\Controllers\Controller;
use App\Models\Order;

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
        $userCount = User::count();
        $orderCount = Order::count();
        $productCount = Product::count();
        $recentOrders = Order::with('user', 'product')->orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.index', compact('orderCount', 'userCount', 'productCount', 'sessions', 'recentOrders'));
    }

    public function logout()
    {
        Auth::logout(); // Pastikan logout dilakukan
        return redirect('/');
    }
}
