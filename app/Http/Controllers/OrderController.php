<?php

namespace App\Http\Controllers;
use App\Models\Order;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::orderBy('id', 'desc')->paginate(5);
    
        return view('admin.order.index', compact('orders'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'payment_status' => 'required|string',
            'order_status' => 'required|string',
        ]);

        // Cari pesanan berdasarkan ID
        $order = Order::findOrFail($id);

        // Update status pembayaran dan status pesanan
        $order->payment_status = $request->payment_status;
        $order->order_status = $request->order_status;
        
        // Simpan perubahan
        $order->save();

        // Redirect atau respon balik
        return response()->json(['success' => 'User telah ditambahkan']);
    }

    public function delete(Order $id){
        $id->delete();
        return response()->json(['success' => 'Data telah dihapus']);
    }

}
