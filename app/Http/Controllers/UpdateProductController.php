<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class UpdateProductController extends Controller
{
    public function index($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.update', compact('product'));
    }

    // Memperbarui produk
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category' => 'required|string',
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $product->image = $imagePath;
        }

        $product->update([
            'name' => $validated['name'],
            'deskripsi' => $validated['deskripsi'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'category' => $validated['category'],
        ]);

        return redirect()->route('product.index')->with('success', 'Produk berhasil diperbarui');
    }
}
