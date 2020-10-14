@extends('layouts.karyawanLayout')
@push('plugincss')
<link href="{{url('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush
@section('rak', 'active')
@section('konten')
<h1 class="h3 mb-4 text-gray-800">Data Rak Buku</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{url('karyawan/rak/create')}}" class="btn btn-primary">Tambah Rak</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Rak</th>
                        <th>Nama Rak</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($raks as $no => $rak)
                    <tr>
                        <td>{{$no+1}}</td>
                        <td>{{$rak->kode_rak}}</td>
                        <td>{{$rak->nama_rak}}</td>
                        <td>
                            <a class="btn btn-warning btn-sm mx-1" href="rak/{{$rak->id}}/edit">Edit</a>
                            <form action="rak/{{$rak->id}}" method="POST" class="d-inline mx-1">
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
        </div>
    </div>
</div>
@endsection
@push('pluginjs')
<script src="{{url('assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script>
    $(document).ready(function() {
    $('#dataTable').DataTable();
    
} );
</script>
@endpush