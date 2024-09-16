<?php

// app/Http/Controllers/UserController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserAdminController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all(); // Ambil semua pengguna dari database
        $sessions = $request->session()->get('uname'); // Ambil username dari session
        return view('admin.userManage.index', compact('users', 'sessions')); // Kirim data pengguna ke view
    }

    //Create User
    public function create()
    {
        return view('admin.userManage.create'); // Pastikan view ini ada
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'uname' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'status' => 'required|in:admin,user',
        ]);

        // Ambil file gambar dari request
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);

        $user = new User();
        $user->image = 'images/' . $imageName;
        $user->uname = $request->uname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->status = $request->status;
        $user->save();

        return redirect()->route('admin.user')->with('success', 'User successfully created.');
    }


    public function show($id)
    {
        if (!is_numeric($id)) {
            abort(404, 'Invalid user ID.');
        }

        $user = User::findOrFail($id);
        return view('admin.userManage.view', compact('user'));
    }

    // Update User
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id); // Cari pengguna berdasarkan id

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'uname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'status' => 'required|in:admin,user',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $user->image = 'images/' . $imageName;
        }

        $user->update([
            'uname' => $request->input('uname'),
            'email' => $request->input('email'),
            'password' => $request->input('password') ? Hash::make($request->input('password')) : $user->password,
            'status' => $request->input('status'),
        ]);

        return redirect()->back()->with('success', 'User successfully updated.');
    }


    //Delete User
    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'User successfully deleted.');
    }
}
