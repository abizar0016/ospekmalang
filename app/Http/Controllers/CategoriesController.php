<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index() {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function add(Request $request) {
        $request->validate([
            'name' => 'required|string|max:50'
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->save();

        return response()->json(['success' => 'Kategori telah ditambahkan']);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:50'
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->save();

        return response()->json(['success' => 'Kategori telah diperbarui']);
    }

    public function delete(Category $id) {
        $id->delete();
        return response()->json(['success' => 'Kategori berhasil dihapus']);
    }
}
