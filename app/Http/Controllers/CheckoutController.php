<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;

class CheckoutController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false; // Ubah ke true jika sudah di production
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    // Menampilkan halaman checkout
    public function index()
    {
        $Items = Cart::where('user_id', Auth::id())->with('product')->get();
        $cartCount = $Items->sum('quantity');

        // Ambil snapToken dari session jika ada
        $snapToken = session('snapToken');

        return view('user.checkout', compact('Items', 'cartCount', 'snapToken'));
    }

    // Memproses pesanan dan menghasilkan snapToken
    public function checkout(Request $request)
    {
        // Validasi request
        $validated = $request->validate([
            'selected_products' => 'required|json',
        ]);

        // Decode JSON produk yang dipilih
        $selectedProducts = json_decode($validated['selected_products'], true);

        // Simpan produk yang dipilih ke session
        session(['selectedProducts' => $selectedProducts]);

        // Hitung total harga
        $totalAmount = array_reduce(
            $selectedProducts,
            function ($carry, $item) {
                return $carry + $item['price'] * $item['quantity'];
            },
            0,
        );

        // Buat Snap Token
        $params = [
            'transaction_details' => [
                'order_id' => uniqid('ORDER-'),
                'gross_amount' => $totalAmount,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->uname,
                'email' => Auth::user()->email,
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            session(['snapToken' => $snapToken]);

            return redirect()->back()->with('snapToken', $snapToken);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat Snap Token.');
        }
    }

    public function handleCallback(Request $request)
{
    // Debug data callback
    $user = Auth::user();

    // Ambil produk yang dipilih dari session
    $selectedProducts = session('selectedProducts', []);

    if (empty($selectedProducts)) {
        return redirect()->back()->with('error', 'Tidak ada produk yang dipilih untuk checkout.');
    }

    // Inisialisasi total amount
    $totalAmount = 0;

    // Buat order utama untuk user
    $order = Order::create([
        'total_price' => 0, // Akan diupdate nanti
        'user_id' => $user->id,
        'status' => 'tertunda',
    ]);

    // Proses setiap item yang dipilih
    foreach ($selectedProducts as $productId) {
        // Cari item keranjang berdasarkan user dan product_id
        $cartItem = Cart::where('user_id', $user->id)->where('product_id', $productId)->first();

        if ($cartItem) {
            // Hitung total amount
            $totalAmount += $cartItem->product->price * $cartItem->quantity;

            // Tambahkan item ke dalam order
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'user_id' => $user->id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->price,
            ]);

            // Hapus item dari keranjang setelah diproses
            $cartItem->delete();
        }
    }

    // Update total harga order setelah semua item diproses
    $order->update(['total_price' => $totalAmount]);

    // Hapus session setelah digunakan
    session()->forget(['selectedProducts', 'snapToken']);

    return redirect()
        ->route('user.order')
        ->with('success', 'Pesanan Anda berhasil dibuat!');
}


    public function delete(Cart $id)
    {
        $id->delete();
        return response()->json(['success' => 'Item telah dihapus']);
    }
}
