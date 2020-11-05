<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserManagementController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set("Asia/Jakarta");
        setlocale(LC_TIME, 'id_ID.UTF-8', 'Indonesian_indonesia.1252', 'Indonesian');
    }

    public function index(Request $request)
    {
        $users = User::paginate(10);
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|without_spaces',
            'password' => 'required',
            'role' => 'required',
            'nohp' => 'required',
            'foto' => 'required'
        ]);

        // create custom id_anggota
        $getRole = substr(strtoupper($request->role), 0, 2);
        $id_anggota = $getRole . '-' . date('dmY') . '-' . substr(time(), -5);

        $file = $request->file('foto');
        $nama_file = time() . "_" . $file->getClientOriginalName();

        // merging the request
        $request = new Request($request->all());
        $request->merge([
            'password' => Hash::make($request->password),
            'is_active' => 'true',
            'id_anggota' => $id_anggota,
            'foto' => $nama_file,
        ]);

        Storage::putFileAs('foto', new File($file), $nama_file);

        User::create($request->all());
        return redirect('admin/user')->withToastSuccess('Data Created Successfully!');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'nohp' => 'required',
            'role' => 'required',
            'is_active' => 'required',
        ]);

        User::where('id', $id)->update([
            'name' => $request->name,
            'username' => $request->username,
            'nohp' => $request->nohp,
            'role' => $request->role,
            'is_active' => $request->is_active,
        ]);
        return redirect('admin/user')->withToastInfo('Data Updated Successfully!');
    }

    public function pass(Request $request, $id)
    {
        $request->validate([
            'password' => 'required',
            'password1' => 'required'
        ]);

        if ($request->password == $request->password1) {
            User::find($id)->update([
                'password' => Hash::make($request->password)
            ]);
            return redirect('admin/user')->withToastInfo('Data Updated Successfully!');
        } else {
            return redirect('admin/user')->withToastError('Data Gagal Update!');
        }
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect('admin/user')->withToastWarning('Data Deleted Successfully!');
    }

    public function search(Request $request)
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
        })->paginate(10);

        return view('admin.user.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::find($id);
        if ($user->is_active == 'true') {
            $status  = 'Aktif';
        } elseif ($user->is_active == 'false') {
            $status  = 'Non Aktif';
        }
        return view('admin/user/show', compact('user', 'status'));
    }
}
