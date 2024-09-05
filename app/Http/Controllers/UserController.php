<?php

// app/Http/Controllers/UserController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Ambil semua pengguna dari database
        return view('admin.user', ['users' => $users]); // Kirim data pengguna ke view
    }

    //Create User
    public function create(Request $request)
    {
        $request->validate([
            'uname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'status' => 'required|in:admin,user',
        ]);

        User::create([
            'uname' => $request->input('uname'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'status' => $request->input('status'),
        ]);

        return redirect()->back()->with('success', 'User successfully created.');
    }

    //Update User
    public function update(Request $request, User $user)
    {
        $request->validate([
            'uname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'status' => 'required|in:admin,user',
        ]);

        $user->update([
            'uname' => $request->input('uname'),
            'email' => $request->input('email'),
            'password' => $request->input('password') ? bcrypt($request->input('password')) : $user->password,
            'status' => $request->input('status'),
        ]);

        return redirect()->back()->with('success', 'User successfully updated.');
    }

    //Delete User
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.user.index')->with('success', 'User successfully deleted.');
    }
}
