<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductAdminController extends Controller
{
    // Menampilkan daftar produk
    public function index()
    {
        $products = Product::all();
        // dd($products); // Debugging untuk melihat data
        return view('admin.product.index', compact('products'));
    }

    public function show($id)
    {
        abort(404, 'Invalid user ID.');
        if (!is_numeric($id)) {
        }

        $product = Product::findOrFail($id);
        return view('admin.product.view', compact('product'));
    }

    // Menghapus produk
    public function delete($id)
    {
        $product = Product::findOrFail($id); // Cari produk berdasarkan ID
        $product->delete();

        return redirect()->route('admin.product.index')->with('success', 'Pesan berhasil dihapus');
    }
}
