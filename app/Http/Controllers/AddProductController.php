<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class AddProductController extends Controller
{
    public function index(){
        return view('admin.product.create');
    }

    public function create(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:100',
            'descriptions' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category' => 'required|string',
        ]);

        // Ambil file gambar dari request
        $image = $request->file('image');

        // Buat nama file unik
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        // Pindahkan gambar ke folder public/images
        $image->move(public_path('images'), $imageName);

        // Simpan data produk ke database
        $product = new Product;
        $product->name = $request->name;
        $product->descriptions = $request->descriptions;
        $product->image = 'images/'. $imageName;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->category = $request->category;
        $product->save(); 

        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil ditambahkan');
    }

}
