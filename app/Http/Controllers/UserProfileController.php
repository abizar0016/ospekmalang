<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function index(Request $request)
    {
        // Ambil kategori dari query string
        $categoryFilter = $request->input('category');
        // Ambil cart items berdasarkan user_id yang sedang login
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

        // Ambil kategori dan produk berdasarkan filter
        $categories = Categories::all();
        $products = Product::when($categoryFilter, function ($query, $categoryFilter) {
            return $query->whereHas('category', function ($query) use ($categoryFilter) {
                $query->where('name', $categoryFilter);
            });
        })->get();

        // Ambil semua pengguna
        $users = Auth::user();

        $cartCount = $cartItems->sum('quantity'); // Menghitung total quantity

        // Ambil session uname
        $sessions = $request->session()->get('uname');

        // Kirim data ke view
        return view('user.profile', compact('products', 'categories', 'users', 'sessions', 'cartItems', 'cartCount'));
    }

    public function update(Request $request, $id)
    {
        // Temukan pengguna berdasarkan ID
        $user = User::findOrFail($id);
    
        // Validasi data yang diterima
        $request->validate([
            'uname' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'phone' => 'nullable|string|max:20',
            'dob' => 'nullable|date',
            'city' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
        ]);
    
        // Ambil file gambar dari request jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($user->image && file_exists(public_path($user->image))) {
                unlink(public_path($user->image));
            }
    
            // Simpan gambar baru
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $user->image = 'images/' . $imageName;
        }
    
        // Perbarui data pengguna
        $user->uname = $request->uname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->dob = $request->dob;
        $user->city = $request->city;
        $user->bio = $request->bio;
        $user->save();
    
        return response()->json(['success' => 'User telah diperbarui']);
    }
}
