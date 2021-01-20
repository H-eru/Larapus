@extends('layouts.adminLayout')
@push('plugincss')
<script src="https://raw.githubusercontent.com/lcdsantos/jQuery-Selectric/master/public/selectric.css"></script>
<link href="{{url('assets/js/selectric.css')}}" rel="stylesheet">
@endpush
@section('user', 'active')
@section('konten')
<div class="col-md-7 col-sm-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Data</h6>
        </div>
        <div class="card-body">
            <form action="{{url('admin/user')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                        placeholder="Input Nama">
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username"
                        class="form-control @error('username') is-invalid @enderror" placeholder="Input Username">
                    @error('username')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password"
                        class="form-control @error('password') is-invalid @enderror" placeholder="Input Password">
                    @error('password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nohp">No HP</label>
                    <input type="text" name="nohp" id="nohp" class="form-control @error('nohp') is-invalid @enderror"
                        placeholder="Input No HP">
                    @error('nohp')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" id="role" name="role">
                        <option value="Admin">Admin</option>
                        <option value="Pustakawan">Pustakawan</option>
                        <option value="Anggota">Anggota</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Foto</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('foto') is-invalid @enderror" id="customFile"
                            name="foto" required>
                        @error('foto')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>
                <div class="form-group">
                    <a href="{{url('admin/user')}}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary float-right">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('pluginjs')
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
<script src="{{url('assets/js/jquery.selectric.min.js')}}"></script>

<script>
    $(document).ready(function () {
    bsCustomFileInput.init()
  });

  $(function() {
  $('select').selectric();
});
</script>
@endpush