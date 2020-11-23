@extends('layouts.adminLayout')
@push('plugincss')
<script src="https://raw.githubusercontent.com/lcdsantos/jQuery-Selectric/master/public/selectric.css"></script>
<link href="{{url('assets/js/selectric.css')}}" rel="stylesheet">
@endpush
@section('user', 'active')
@section('konten')
<div class="row">
    <div class="col-md-7 col-sm-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Data</h6>
            </div>
            <div class="card-body">
                <form action="{{url('admin/user/update')}}/{{$user->id}}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" name="name" id="name" value="{{$user->name}}"
                            class="form-control @error('name') is-invalid @enderror" placeholder="Input Nama">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" value="{{$user->username}}"
                            class="form-control @error('username') is-invalid @enderror" placeholder="Input Username">
                        @error('username')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nohp">No HP</label>
                        <input type="text" name="nohp" id="nohp" value="{{$user->nohp}}"
                            class="form-control @error('nohp') is-invalid @enderror" placeholder="Input No HP">
                        @error('nohp')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select class="custom-select" name="role">
                            <option>{{$user->role}}</option>
                            <option value="Admin">Admin</option>
                            <option value="Karyawan">Karyawan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status Keaktifan</label>
                        <select class="custom-select" name="is_active">
                            <option value="true">Aktif</option>
                            <option value="false">Non Aktif</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <a href="{{url('admin/user')}}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary float-right">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-5 col-sm-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Password</h6>
            </div>
            <div class="card-body">
                <form action="{{url('admin/user/pass')}}/{{$user->id}}" method="POST">
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <label for="password">Password Baru</label>
                        <input type="password" name="password" id="password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Input Password">
                        @error('password')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password1">Repeat Password</label>
                        <input type="password" name="password1" id="password1"
                            class="form-control @error('password1') is-invalid @enderror" placeholder="Repeat password">
                        @error('password1')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <a href="{{url('admin/user')}}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary float-right">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('pluginjs')
<script src="{{url('assets/js/jquery.selectric.min.js')}}"></script>
<script>
    $(function() {
  $('select').selectric();
});
</script>
@endpush