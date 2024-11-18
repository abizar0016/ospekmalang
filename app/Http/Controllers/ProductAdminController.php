<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductAdminController extends Controller
{
    // Menampilkan daftar produk
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->paginate(5);
        $categories = Category::all();
        return view('admin.product.index', compact('products', 'categories'));
    }

    public function create(Request $request)
    {
        // Validasi input, termasuk tiga gambar
        $request->validate([
            'name' => 'required|string|max:100',
            'descriptions' => 'required|string',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,jfif',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,jfif',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,jfif',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categorys,id'
        ]);

        // Memproses gambar 1
        $imageName1 = $this->uploadImage($request, 'image1');

        // Memproses gambar 2
        $imageName2 = $this->uploadImage($request, 'image2');

        // Memproses gambar 3
        $imageName3 = $this->uploadImage($request, 'image3');

        // Simpan data produk ke database
        $product = new Product();
        $product->name = $request->name;
        $product->descriptions = $request->descriptions;
        $product->image1 = $imageName1;
        $product->image2 = $imageName2;
        $product->image3 = $imageName3;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->category_id = $request->category_id;
        $product->save(); 

        return response()->json(['success' => true, 'message' => 'Produk berhasil ditambahkan']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'descriptions' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'category_id' => 'required|exists:categorys,id',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,jfif',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,jfif',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,jfif',
        ]);
    
        $product = Product::findOrFail($id);
    
        // Memproses gambar 1
        $imageName1 = $this->uploadImage($request, 'image1');
        $imageName2 = $this->uploadImage($request, 'image2');
        $imageName3 = $this->uploadImage($request, 'image3');
    
        // Memperbarui informasi produk
        $product->name = $request->input('name');
        $product->descriptions = $request->input('descriptions');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->category_id =  $request->category_id;;
    
        // Update images only if new ones are uploaded
        $product->image1 = $imageName1 ?: $product->image1;
        $product->image2 = $imageName2 ?: $product->image2;
        $product->image3 = $imageName3 ?: $product->image3;
    
        // Simpan perubahan
        $product->save();
    
        return response()->json(['success' => true, 'message' => 'Produk berhasil diperbarui']);
    }
    

    // Menghapus produk
    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['success' => true, 'message' => 'Produk berhasil dihapus']);
    }

    // Helper function to upload images
    private function uploadImage(Request $request, $imageField)
    {
        if ($request->hasFile($imageField)) {
            $image = $request->file($imageField);
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            return $imageName;
        }
        return null;
    }
}
