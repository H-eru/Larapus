<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
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
            'username' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        $request->merge([
            'password' => Hash::make($request->password),
        ]);

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
            'role' => 'required'
        ]);

        User::where('id', $id)->update([
            'name' => $request->name,
            'username' => $request->username,
            'role' => $request->role
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
}
