<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index() {
        $users = User::all();
        return view('admin.profile', ['users' => $users]); // Kirim data pengguna ke view
    }
}
