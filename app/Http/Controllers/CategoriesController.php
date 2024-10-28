<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index() {
        $categories = Categories::all();
        return view ('admin.categories.index', compact('categories'));
    }

    public function add(Request $request){
        $request->validate([
            'name' => 'string|max:50'
        ]);

        $categori = new Category();
        $categori->name = $request->name;
        $categori->save();

        return redirect()->back()->with('sucess', 'Kategori Telah di Tambahkan');
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'string|max:50'
        ]);

        $categories = Category::findOrFail($id);
        $categories->name = $request->name;
        $categories->save();

        return redirect()->back()->with('sucess', 'Kategori telah di perbarui');
    }

    public function delete(Category $id){
        $id->delete();
        return redirect()->back()->with('sucess', 'Kategori Berhasil di Hapus');
    }
}
