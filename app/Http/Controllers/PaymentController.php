<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use App\Models\Cart;
use Midtrans\Config;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Set konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false; // Set ke true jika sudah di production
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function checkoutPage()
    {
        $userId = Auth::id();
        $cartItems = Cart::with('product')->where('user_id', $userId)->get();

        return view('user.checkout', [
            'Items' => $cartItems
        ]);
    }

    public function processOrder(Request $request)
    {
        $selectedProducts = json_decode($request->selected_products);

        // Membuat order baru
        $order = new Order();
        $order->user_id = Auth::id();
        $order->total_price = 0;
        $order->status = 'pending';
        $order->save();

        foreach ($selectedProducts as $selected) {
            $product = Product::find($selected->product_id);

            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $product->id;
            $orderItem->quantity = $selected->quantity;
            $orderItem->price = $product->price;
            $orderItem->save();

            $order->total_price += $product->price * $selected->quantity;
        }

        $order->save();

        // Midtrans Snap Token
        $transactionDetails = [
            'order_id' => $order->id,
            'gross_amount' => $order->total_price,
        ];

        $items = [];
        foreach ($selectedProducts as $selected) {
            $product = Product::find($selected->product_id);
            $items[] = [
                'id' => $product->id,
                'price' => $product->price,
                'quantity' => $selected->quantity,
                'name' => $product->name,
            ];
        }

        $transactionData = [
            'transaction_details' => $transactionDetails,
            'item_details' => $items,
            'customer_details' => [
                'first_name' => Auth::user()->uname,
                'email' => Auth::user()->email,
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($transactionData);

            return response()->json([
                'snap_token' => $snapToken,
                'order_id' => $order->id,
                'total_price' => $order->total_price
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error: ' . $e->getMessage()]);
        }
    }

    public function deleteCartItem($id)
    {
        $cartItem = Cart::find($id);
        if ($cartItem) {
            $cartItem->delete();
        }
        return redirect()->back()->with('success', 'Item berhasil dihapus.');
    }
}
