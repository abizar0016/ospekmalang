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
    
    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
    
            // Validasi
            $request->validate([
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // opsional
                'uname' => 'required|string|max:255', // wajib
                'email' => 'required|string|email|max:255|unique:users,email,' . $id, // wajib
                'password' => 'nullable|string|min:8', // opsional
                'phone' => 'nullable|numeric', // opsional
                'dob' => 'nullable|date', // opsional
                'city' => 'nullable|string|max:255', // opsional
                'bio' => 'nullable|string|max:1000', // opsional
                'status' => 'required|in:admin,user', // wajib
            ]);
    
            // Proses upload gambar jika ada
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $user->image = 'images/' . $imageName;
            }
    
            // Update data user
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
    
            // Jika berhasil, redirect dengan pesan sukses
            return redirect()->route('admin.user')->with('success', 'User successfully updated.');
    
        } catch (\Exception $e) {
            // Menangkap error dan mengembalikan halaman dengan pesan error
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }    
}
