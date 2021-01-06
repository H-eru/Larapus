<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if (Auth::user()->role == 'Admin') {
                return redirect('/admin');
            } elseif (Auth::user()->role == 'Pustakawan') {
                return redirect('/karyawan');
            } elseif (Auth::user()->role == 'Anggota') {
                return redirect('/');
            }
        }

        return $next($request);
    }
}
