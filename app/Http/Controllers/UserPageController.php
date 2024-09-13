<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserPageController extends Controller
{
    public function index(Request $request){
        $users = User::all();
        $sessions = $request->session()->get('uname');
        return view('user.index', compact('users', 'sessions'));
    }
}
