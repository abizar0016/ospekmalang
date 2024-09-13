<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        //saat akses halaman dengan middleware guest akan diarahkan ke halaman tertentu sesuai logic di bawah jika user sudah punya session
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if($request->user()->namerole=='admin'){
                    return redirect()->route('admin');
                }elseif($request->user()->namerole=='user'){
                    return redirect()->route('user');
                }else{
                    return redirect()->route('logout');
                }        
            }
        }

        return $next($request);
    }
}