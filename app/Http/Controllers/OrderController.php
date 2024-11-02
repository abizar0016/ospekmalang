<?php

namespace App\Http\Controllers;
use App\Models\Order;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::orderBy('id', 'desc')->get();
    
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
        $order->payment_status = $request->input('payment_status');
        $order->order_status = $request->input('order_status');
        
        // Simpan perubahan
        $order->save();

        // Redirect atau respon balik
        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function delete(Order $id){
        $id->delete();
        return redirect()->back()->with('sucess', 'Kategori Berhasil di Hapus');
    }

}
