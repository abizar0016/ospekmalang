<?php

// app/Http/Controllers/UserController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;

class UserAdminController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all(); // Ambil semua pengguna dari database
        $sessions = $request->session()->get('uname'); // Ambil username dari session
        return view('admin.userManage.index', compact('users', 'sessions')); // Kirim data pengguna ke view
    }
    
    public function show($id)
    {
        if (!is_numeric($id)) {
            abort(404, 'Invalid user ID.');
        }

        $user = User::findOrFail($id);
        return view('admin.userManage.view', compact('user'));
    }

    //Delete User
    public function delete(User $id)
    {
        $id->delete();
        return redirect()->back()->with('success', 'User successfully deleted.');
    }
}
