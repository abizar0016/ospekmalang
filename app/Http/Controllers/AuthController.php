<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password; // Pastikan ini diimpor
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
            'uname' => 'required|string|max:255',
            'email' => 'required|email:dns|unique:users,email',
            'password' => 'required|min:8|regex:/^[a-zA-Z0-9]*$/', // Hanya huruf dan angka
        ]);

        // Membuat pengguna baru
        $user = new User();
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
        // Validasi input dengan pesan kustom
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|regex:/^[a-zA-Z0-9]*$/',
        ], [
            'email.required' => 'Email harus diisi.', // Jika email tidak diisi
            'email.email' => 'Format email tidak valid.', // Jika format email salah
            'password.required' => 'Password harus diisi.', // Jika password tidak diisi
            'password.min' => 'Password harus memiliki setidaknya 8 karakter.', // Jika panjang password kurang dari 8 karakter
            'password.regex' => 'Password hanya boleh terdiri dari huruf dan angka.' // Jika password mengandung karakter selain huruf dan angka
        ]);
    
        // Persiapan kredensial untuk login
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
    
        // Proses login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Regenerasi session untuk keamanan
    
            // Periksa status pengguna
            $user = Auth::user();
            if ($user->status === 'admin') {
                return redirect()->intended('admin')->with('success', 'Login berhasil!');
            } else {
                return redirect()->intended('user')->with('success', 'Login berhasil!');
            }
        }
    
        // Jika login gagal
        return back()->withErrors([
            'email' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
        ])->onlyInput('email');
    }
    
    

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate(); // Menghapus session
        $request->session()->regenerateToken(); // Mengenerate ulang token CSRF

        return redirect()->route('login');
    }
}
