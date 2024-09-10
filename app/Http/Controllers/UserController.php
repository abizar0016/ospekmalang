<?php

// app/Http/Controllers/UserController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all(); // Ambil semua pengguna dari database
        $sessions = $request->session()->get('uname'); // Ambil username dari session
        return view('admin.user', compact('users', 'sessions')); // Kirim data pengguna ke view
    }

    //Create User
    public function createUser(Request $request)
    {
        $request->validate([
            'uname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'status' => 'required|in:admin,user',
        ]);

        $user = new User();
        $user->uname = $request->uname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->status = $request->status; // Status berasal dari input
        $user->save();

        return redirect()->back()->with('success', 'User successfully created.');
    }

    //Update User
    public function userUpdate(Request $request, User $user)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'uname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'status' => 'required|in:admin,user',
        ]);

        // Proses gambar jika ada
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $user->image = 'images/' . $imageName;
        }

        // Update user
        $user->update([
            'uname' => $request->input('uname'),
            'email' => $request->input('email'),
            'password' => $request->input('password') ? bcrypt($request->input('password')) : $user->password,
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
