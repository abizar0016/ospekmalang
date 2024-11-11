<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(){
        $Items = Cart::where('user_id', Auth::id())->with('product')->get();
        $cartCount = $Items->sum('quantity'); // Menghitung total quantity

        return view('user.checkout', compact('Items','cartCount'));
    }

    public function delete(Cart $id){
        $id->delete();
        return response()->json(['success' => 'Item telah dihapus']);
    }
    
    public function processPayment(Request $request)
    {
        // Memastikan data sudah sampai
        $products = $request->input('products');
        $quantities = $request->input('quantities');
        $prices = $request->input('prices');
    
        // Cek data yang dikirim untuk debugging
        dd($products, $quantities, $prices);  // Menggunakan dd() untuk melihat data yang diterima
    
        return view('user.payment', compact('products', 'quantities', 'prices'));
    }
    
}
