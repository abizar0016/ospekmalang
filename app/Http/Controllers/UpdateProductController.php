<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class UpdateProductController extends Controller
{
    public function index($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.product.update', compact('product', 'categories'));
    }

    // Memperbarui produk
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'descriptions' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'category_id' => 'required|exists:categorys,id',
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $product->image = $imagePath;
        }

        $product = Product::findOrFail($id);
        $product->name = $request->input('name');
        $product->descriptions = $request->input('descriptions');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->category_id = $request->input('category_id');

        // Simpan perubahan
        $product->save();

        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil diperbarui');
    }
}
