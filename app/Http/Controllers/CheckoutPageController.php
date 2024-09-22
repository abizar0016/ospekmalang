<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutPageController extends Controller
{
    public function index(){
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        $cartCount = $cartItems->sum('quantity'); // Menghitung total quantity

        return view('user.checkout', compact('cartCount'));
    }

}
