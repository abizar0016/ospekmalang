<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Support\Facades\Log;

class AddProductController extends Controller
{
    public function index()
    {
        $categories = Categories::all();  
        return view('admin.product.create', compact('categories'));
    }

    public function create(Request $request)
    {
        // Validasi input, termasuk tiga gambar
        $request->validate([
            'name' => 'required|string|max:100',
            'descriptions' => 'required|string',
            'image1' => 'required|image|mimes:jpeg,png,jpg,gif,webp,jfif',
            'image2' => 'required|image|mimes:jpeg,png,jpg,gif,webp,jfif',
            'image3' => 'required|image|mimes:jpeg,png,jpg,gif,webp,jfif',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categorys,id'
        ]);

        Log::info('Request data:', $request->all());

        // Memproses gambar 1
        $imageName1 = null;
        if ($request->hasFile('image1')) {
            $image1 = $request->file('image1');
            $imageName1 = time() . '.' . $image1->getClientOriginalExtension();
            $image1->move(public_path('images'), $imageName1);
        }

        // Memproses gambar 2 (opsional)
        $imageName2 = null;
        if ($request->hasFile('image2')) {
            $image2 = $request->file('image2');
            $imageName2 = time() . '.' . $image2->getClientOriginalExtension();
            $image2->move(public_path('images'), $imageName2);
        }

        // Memproses gambar 3 (opsional)
        $imageName3 = null;
        if ($request->hasFile('image3')) {
            $image3 = $request->file('image3');
            $imageName3 = time() . '.' . $image3->getClientOriginalExtension();
            $image3->move(public_path('images'), $imageName3);
        }

        // Simpan data produk ke database
        $product = new Product();
        $product->name = $request->name;
        $product->descriptions = $request->descriptions;
        $product->image1 = $imageName1;
        $product->image2 = $imageName2; // Gambar kedua opsional
        $product->image3 = $imageName3; // Gambar ketiga opsional
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->category_id = $request->category_id; // Perbaikan bagian ini
        $product->save();

        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil ditambahkan');
    }
}
