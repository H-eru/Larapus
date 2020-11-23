<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Rak;
use Illuminate\Http\Request;

class RakManagementController extends Controller
{
    public function index()
    {
        $raks = Rak::all();
        return view('admin/rak/index', compact('raks'));
    }

    public function create()
    {
        return view('admin/rak/create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_rak' => 'required|unique:raks',
            'nama_rak' => 'required'
        ]);

        Rak::create($request->all());
        return redirect('admin/rak')->withToastSuccess('Data Created Successfully!');
    }

    public function edit($id)
    {
        $rak = Rak::find($id);
        return view('admin/rak/edit', compact('rak'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_rak' => 'required'
        ]);

        Rak::find($id)->update([
            'nama_rak' => $request->nama_rak
        ]);
        return redirect('admin/rak')->withToastInfo('Data Updated Successfully!');
    }

    public function destroy($id)
    {
        Rak::find($id)->delete();
        return redirect('admin/rak')->withToastWarning('Data Deleted Successfully!');
    }
}
