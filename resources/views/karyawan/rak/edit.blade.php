@extends('layouts.karyawanLayout')
@section('rak', 'active')
@section('konten')
<div class="col-md-6 col-sm-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ubah Data</h6>
        </div>
        <div class="card-body">
            <form action="{{url('karyawan/rak/update')}}/{{$rak->id}}" method="POST">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="kode_rak">Kode Rak</label>
                    <input type="text" name="kode_rak" id="kode_rak" value="{{$rak->kode_rak}}" readonly
                        class="form-control @error('kode_rak') is-invalid @enderror" placeholder="Input kode rak">
                    @error('kode_rak')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nama_rak">Nama Lengkap</label>
                    <input type="text" name="nama_rak" id="nama_rak" value="{{$rak->nama_rak}}"
                        class="form-control @error('nama_rak') is-invalid @enderror" placeholder="Input Nama">
                    @error('nama_rak')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary float-right">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection