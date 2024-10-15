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
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        $cartCount = $cartItems->sum('quantity'); // Menghitung total quantity

        return view('user.checkout', compact('cartItems','cartCount'));
    }

    public function processCheckout(Request $request)
    {
        // Ambil barang yang dipilih untuk di-checkout
        $selectedItems = $request->input('selected_items', []);

        if (empty($selectedItems)) {
            return redirect()->back()->withErrors('Pilih setidaknya satu barang untuk checkout.');
        }

        // Lakukan proses checkout untuk barang yang dipilih
        // Misalnya, simpan ke database atau kirim ke gateway pembayaran

        return redirect()->route('payment.page')->with('success', 'Barang berhasil di-checkout!');
    }
}
