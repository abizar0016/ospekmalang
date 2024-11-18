<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Pastikan import ini ada
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;

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
        $orders = Order::with('orderitem', 'user')->orderBy('id', 'desc')->get();
        $productCount = Product::count();
        $orderItems = OrderItem::with('user', 'product', 'order')->orderBy('created_at', 'desc')->get();

        return view('admin.index', compact('orderItems','orderCount', 'userCount', 'productCount', 'sessions', 'orders'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
