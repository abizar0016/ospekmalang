<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if(in_array($request->user()->namerole, $roles)){
            return $next($request);
        }
        return redirect('/');
    }
}
