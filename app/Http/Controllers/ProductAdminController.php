<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        if (!is_numeric($id)) {
            abort(404, 'ID produk tidak valid.');
        }
    
        $product = Product::findOrFail($id);
        $categorys = Category::all();
        
        return view('admin.product.view', compact('product', 'categorys'));
    }
    

    // Menghapus produk
    public function delete($id)
    {
        $product = Product::findOrFail($id); // Cari produk berdasarkan ID
        $product->delete();

        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil dihapus');
    }
}
