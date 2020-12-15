@extends('layouts.adminLayout')
@section('user', 'active')
@section('konten')
<h1 class="h3 mb-4 text-gray-800">Data User</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <form action="{{url('admin/user/search')}}" method="POST" class="row">
            @csrf
            <div class="col">
                <input class="form-control" type="text" name="id_anggota" placeholder="ID Anggota">
            </div>
            <div class="col">
                <input class="form-control" type="text" name="name" placeholder="Nama Karyawan">
            </div>
            <div class="col">
                <button type="submit" class="btn btn-success"><i class="fas fa-search"></i>&nbsp; Cari</button>
            </div>
        </form>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID Anggota</th>
                        <th>Nama Karyawan</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id_anggota}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->role}}</td>
                        @if ($user->is_active == 'true')
                        <td>Aktif</td>
                        @elseif($user->is_active == 'false')
                        <td>Non Aktif</td>
                        @endif
                        <td>
                            <a class="btn btn-info btn-sm mx-1"
                                href="{{url('admin/user/'.$user->id.'/show')}}">Lihat</a>
                            <a class="btn btn-warning btn-sm mx-1"
                                href="{{url('admin/user/'.$user->id.'/edit')}}">Edit</a>
                            <form action="{{url('admin/user/'.$user->id)}}" method="POST" class="d-inline mx-1">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger btn-sm" type="submit"
                                    onclick="return confirm('Hapus data ini?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{url('admin/user/create')}}" class="btn btn-primary">Tambah User</a>
            <div class="float-right">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection