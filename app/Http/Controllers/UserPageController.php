<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;


class UserPageController extends Controller
{
    public function index(Request $request)
    {
        // Ambil kategori dari query string
        $categoryFilter = $request->input('category');
        // Ambil cart items berdasarkan user_id yang sedang login
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

        // Ambil kategori dan produk berdasarkan filter
        $categories = Category::all();
        $products = Product::when($categoryFilter, function ($query, $categoryFilter) {
            return $query->whereHas('category', function ($query) use ($categoryFilter) {
                $query->where('name', $categoryFilter);
            });
        })->get();

        // Ambil semua pengguna
        $users = User::all();

        $cartCount = $cartItems->sum('quantity'); // Menghitung total quantity

        // Ambil session uname
        $sessions = $request->session()->get('uname');

        // Kirim data ke view
        return view('user.index', compact('products', 'categories', 'users', 'sessions', 'cartItems', 'cartCount'));
    }

    public function productView(Request $request)
    {
        // Ambil kategori dari query string
        $categoryFilter = $request->input('category');

        // Ambil cart items berdasarkan user_id yang sedang login
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

        // Ambil kategori dan produk berdasarkan filter
        $categories = Category::all();
        $products = Product::when($categoryFilter, function ($query, $categoryFilter) {
            return $query->whereHas('category', function ($query) use ($categoryFilter) {
                $query->where('name', $categoryFilter);
            });
        })->get();
        
        $cartCount = $cartItems->sum('quantity'); // Menghitung total quantity

        // Ambil semua pengguna
        $users = User::all();
        // Ambil session uname
        $sessions = $request->session()->get('uname');
        
        // Kirim data ke view
        return view('user.product', compact('products', 'categories', 'users', 'sessions', 'cartItems', 'cartCount'));
    }

    public function delete($id)
    {
        // Contoh logika untuk menghapus item dari keranjang
        Cart::findOrFail($id)->delete();
    
        return redirect()->back()->with('success', 'Item berhasil dihapus');
    }
}


