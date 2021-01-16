@extends('layouts.karyawanLayout')
@section('user', 'active')
@section('konten')
<div class="col-md-9 col-sm-12 col-xs-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="p-4">
                        <img src="{{asset('foto/'.$user->foto)}}" class="card-img rounded img-fluid">
                    </div>
                </div>
                <div class="col-md-8">
                    <table cellpadding="5">
                        <tr>
                            <td>Nama Lengkap</td>
                            <td> : </td>
                            <td>{{$user->name}}</td>
                        </tr>

                        <tr>
                            <td>No HP lore</td>
                            <td> : </td>
                            <td>{{$user->nohp}}</td>
                        </tr>

                        <tr>
                            <td>Username</td>
                            <td> : </td>
                            <td>{{$user->username}}</td>
                        </tr>

                        <tr>
                            <td>ID Anggota</td>
                            <td> : </td>
                            <td>{{$user->id_anggota}}</td>
                        </tr>

                        <tr>
                            <td>Role</td>
                            <td> : </td>
                            <td>{{$user->role}}</td>
                        </tr>

                        <tr>
                            <td>Status</td>
                            <td> : </td>
                            <td>{{$status}}</td>
                        </tr>

                        <tr>
                            <td>Tanggal Bergabung</td>
                            <td> : </td>
                            <td>{{$user->created_at->format('d-m-Y | h:i A')}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{url('karyawan/user')}}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection