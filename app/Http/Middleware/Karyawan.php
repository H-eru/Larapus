<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Karyawan
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->role != 'Pustakawan') {
                abort(403, 'Maaf, Anda tidak dapat mengakses halaman ini 😤');
            }
        }
        return $next($request);
    }
}
