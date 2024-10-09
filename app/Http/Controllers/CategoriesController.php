<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index() {
        $categories = Categories::all();
        return view ('admin.categories.index', compact('categories'));
    }
}
