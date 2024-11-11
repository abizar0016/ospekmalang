<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        // Debug untuk melihat apakah data 'items' ada di request
        dd($request->input('items'));
    
        $items = $request->input('items');
        
        // Pastikan $items bukan null sebelum menggunakan foreach
        if ($items) {
            $totalPrice = 0;
            foreach ($items as $item) {
                $productPrice = $item['price'];
                $quantity = $item['quantity'];
                $totalPrice += $productPrice * $quantity;
            }
        } else {
            // Jika $items null, lakukan penanganan error atau pengalihan
            return redirect()->back()->withErrors(['items' => 'Tidak ada produk yang dipilih.']);
        }
    
        return view('payment', ['totalPrice' => $totalPrice]);
    }
    
}
