<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        // Validasi input
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);
    
        // Simpan ke cart
        Cart::create([
            'user_id' => Auth::id(),  // ID pengguna yang sedang login
            'product_id' => $request->product_id,
            'quantity' => $request->quantity
        ]);
    
        // Respons untuk AJAX
        return response()->json(['success' => true, 'message' => 'Product added to cart!']);
    }
    
}
