<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AnggotaController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set("Asia/Jakarta");
        setlocale(LC_TIME, 'id_ID.UTF-8', 'Indonesian_indonesia.1252', 'Indonesian');
    }

    public function index(Request $request)
    {
        $filters = [
            'id_anggota' => $request->id_anggota,
            'name'    => $request->name,
        ];

        $users = User::where(function ($query) use ($filters) {
            if ($filters['id_anggota']) {
                $query->where('id_anggota', 'like', '%' . $filters['id_anggota'] . '%');
            }
            if ($filters['name']) {
                $query->where('name', 'like', '%' . $filters['name'] . '%');
            }
            $query->where('role', '=', 'Anggota');
        })->paginate(10);
        return view('karyawan.user.index', compact('users'));
    }

    public function create()
    {
        return view('karyawan/user/create');
    }

    public function store(Request $request)
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
            'is_active' => 'true',
            'id_anggota' => $id_anggota,
            'foto' => $nama_file,
            'role' => 'Anggota',
        ]);

        Storage::putFileAs('foto', new File($file), $nama_file);

        User::create($request->all());
        return redirect('karyawan/user')->withToastSuccess('Data Created Successfully!');
    }

    public function show($id)
    {
        $user = User::find($id);
        if ($user->is_active == 'true') {
            $status  = 'Aktif';
        } elseif ($user->is_active == 'false') {
            $status  = 'Non Aktif';
        }
        return view('karyawan/user/show', compact('user', 'status'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        if ($user->is_active == 'true') {
            $status  = 'Aktif';
        } elseif ($user->is_active == 'false') {
            $status  = 'Non Aktif';
        }
        return view('karyawan.user.edit', compact('user', 'status'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'nohp' => 'required',
            'is_active' => 'required',
        ]);

        User::where('id', $id)->update([
            'name' => $request->name,
            'nohp' => $request->nohp,
            'is_active' => $request->is_active,
        ]);
        return redirect('karyawan/user')->withToastInfo('Data Updated Successfully!');
    }

    public function destroy($id)
    {
        $del = User::findOrFail($id);
        Storage::delete('foto/' . $del->foto);
        $del->delete();
        return redirect('karyawan/user')->withToastWarning('Data Deleted Successfully!');
    }
}
