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


    // Menyimpan produk baru
    public function createProduct(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
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
        Product::create([
            'name' => $request['name'],
            'deskripsi' => $request['deskripsi'],
            'image' => 'images/' . $imageName, // Simpan path gambar relatif
            'price' => $request['price'],
            'stock' => $request['stock'],
            'category' => $request['category'],
        ]);

        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil ditambahkan');
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

    // Menghapus produk
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->back()->with('success', 'Pesan berhasil dihapus');
    }
}
