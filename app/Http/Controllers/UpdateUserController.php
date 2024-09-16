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
        return view('admin.userManage.update', compact('user'));
    }
    
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'uname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'phone' => 'nullable|numeric',
            'dob' => 'nullable|date',
            'city' => 'required|string|max:255',
            'bio' => 'nullable|string|max:1000',
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
            'phone' => $request->input('phone'),
            'dob' => $request->input('dob'),
            'city' => $request->input('city'),
            'bio' => $request->input('bio'),
            'status' => $request->input('status'),
        ]);
    
        return redirect()->route('admin.user')->with('success', 'User successfully updated.');
    }
    
}
