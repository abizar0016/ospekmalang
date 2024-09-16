<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AddUserController extends Controller
{
    public function index() {
        return view('admin.userManage.create');
    }

    public function create(Request $request)
    {
        $request->validate([
            'uname' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'status' => 'required|in:admin,user',
            'phone' => 'required|string|max:20',
            'dob' => 'required|date',
            'city' => 'required|string|max:255',
            'bio' => 'nullable|string',
        ]);
    
        // Ambil file gambar dari request
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        } else {
            $imageName = 'images/default-profile.jpg';
        }
    
        $user = new User();
        $user->image = 'images/' . $imageName;
        $user->uname = $request->uname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->status = $request->status;
        $user->phone = $request->phone;
        $user->dob = $request->dob;
        $user->city = $request->city;
        $user->bio = $request->bio;
        $user->save();
    
        return redirect()->route('admin.user')->with('success', 'User successfully created.');
    }
    
}
