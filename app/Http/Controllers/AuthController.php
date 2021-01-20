<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->is_active == 'true') {
                if (Auth::user()->role == 'Admin') {
                    return redirect('/admin');
                } elseif (Auth::user()->role == 'Pustakawan') {
                    return redirect('/karyawan');
                } elseif (Auth::user()->role == 'Anggota') {
                    return redirect('/');
                }
            } else {
                Auth::logout();
                Alert::error('Login Gagal', 'Akun anda belum aktif, silahkan hubungi petugas perpustakaan');
                return redirect('/login');
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

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|without_spaces',
            'password' => 'required',
            'nohp' => 'required',
            'foto' => 'required|mimes:jpeg,jpg,png,JPG,JPEG,PNG'
        ]);

        // create custom id_anggota
        $id_anggota = 'AN' . '-' . date('dmY') . '-' . substr(time(), -5);

        $file = $request->file('foto');
        $nama_file = time() . "_" . $file->getClientOriginalName();

        // merging the request
        $request = new Request($request->all());
        $request->merge([
            'password' => Hash::make($request->password),
            'is_active' => 'false',
            'id_anggota' => $id_anggota,
            'foto' => $nama_file,
            'role' => 'Anggota',
        ]);

        Storage::putFileAs('foto', new File($file), $nama_file);

        User::create($request->all());

        Alert::html('Registrasi Sukses', "ID Anggota anda : <b>$id_anggota</b> <br>
        Silahkan datang ke perpustakaan dengan membawa <b>foto</b> dan tunjukkan <b>ID Anggota</b> kepada petugas perpustakaan untuk aktivasi akun", 'success')->autoClose(false);
        return redirect('/');
    }
}
