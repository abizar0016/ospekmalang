<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index'); // Sesuaikan dengan nama file Blade yang sesuai
    }

    public function home()
    {
        return view('admin.home');
    }

    public function user()
    {
        return view('admin.user');
    }

    public function message()
    {
        return view('admin.message');
    }

    public function help()
    {
        return view('admin.help');
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function logout()
    {
        // Logika logout, jika diperlukan
        return redirect('/');
    }
}
