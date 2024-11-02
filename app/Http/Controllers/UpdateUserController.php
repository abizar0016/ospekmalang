<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UpdateUserController extends Controller
{
    public function index($id) {
        // Menampilkan halaman update dengan data user yang akan di-update
        $user = User::findOrFail($id);
        return view('admin.user.update', compact('user'));
    }
    
   
}
