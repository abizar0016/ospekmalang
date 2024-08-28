<?php

namespace App\Http\Controllers;
namespace App\Models;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id)
{
    $product = product::find($id); // Pastikan menggunakan model yang sesuai
    return view('user.product-detail', compact('product'));
}

}
