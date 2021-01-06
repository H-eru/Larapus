<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role == 'Admin') {
                return redirect('/admin');
            } elseif (Auth::user()->role == 'Pustakawan') {
                return redirect('/karyawan');
            } elseif (Auth::user()->role == 'Anggota') {
                return redirect('/');
            }
        } else {
            Alert::error('Login Gagal', 'Username atau Password Salah');
            return redirect('/login');
        }
    }

    public function logout()
    {
        Auth::logout();
        Alert::warning('Logout', 'Behasil Logout');
        return redirect('/');
    }
}
