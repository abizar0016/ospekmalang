<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::orderBy('id', 'desc')->paginate(5);
        $orderItems = OrderItem::with('user', 'product', 'order')->orderBy('created_at', 'desc')->get();
    
        return view('admin.order.index', compact('orders','orderItems'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'status' => 'required|string',
        ]);

        // Cari pesanan berdasarkan ID
        $order = Order::findOrFail($id);

        // Update status pembayaran dan status pesanan
        $order->status = $request->status;
        
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
