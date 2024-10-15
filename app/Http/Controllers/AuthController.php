<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function postRegister(Request $request)
    {
        // Validasi input
        $request->validate([
            'uname' => 'required|string|max:255|min:8',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8|regex:/^[a-zA-Z0-9]*$/',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi file gambar opsional
        ]);
    
        // Membuat pengguna baru
        $user = new User();
        
        // Jika ada file gambar yang di-upload, simpan file tersebut
        if ($request->hasFile('image')) {
            $fileName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $fileName);
            $user->image = $fileName;
        } else {
            // Jika tidak ada file yang diupload, set image sebagai null
            $user->image = null;
        }
    
        $user->uname = $request->uname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->status = 'user';
        $user->save();
    
        // Redirect ke halaman login dengan pesan sukses
        return redirect('login')->with('success', 'Registration successful!');
    }
    

    public function login()
    {
        return view('login');
    }
    
    public function postLogin(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|regex:/^[a-zA-Z0-9]*$/',
        ]);
    
        // Persiapan kredensial untuk login
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
    
        $user = User::where('email', $request->email)->first();
    
        if (!$user) {
            // Jika email tidak ditemukan, kembalikan dengan pesan error
            return redirect()->back()->withErrors([
                'email' => 'Email tidak terdaftar. Silakan coba lagi.',
            ])->withInput($request->only('email'));
        }
    
        // Proses login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Regenerasi session untuk keamanan
    
            // Ambil pengguna
            $user = Auth::user();
    
            // Simpan data ke dalam sesi
            $request->session()->put('user_image', $user->image);
    
            // Arahkan berdasarkan status pengguna
            if ($user->status === 'admin') {
                return redirect()->intended('admin')->with('success', 'Login berhasil!');
            } else {
                return redirect()->intended('user')->with('success', 'Login berhasil!');
            }
        } else {
            // Password salah
            return redirect()->back()->withErrors([
                'password' => 'Password yang Anda masukkan salah. Silakan coba lagi.',
            ])->withInput($request->only('email'));
        }
    }
    
    
    
    

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate(); // Menghapus session
        $request->session()->regenerateToken(); // Mengenerate ulang token CSRF

        return redirect('/');
    }
}