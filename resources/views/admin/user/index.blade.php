@extends('layouts.adminLayout')
@push('plugincss')
<link href="{{url('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush
@section('user', 'active')
@section('konten')
<h1 class="h3 mb-4 text-gray-800">Data User</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{url('admin/user/create')}}" class="btn btn-primary">Tambah User</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Nama Karyawan</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $no => $user)
                    <tr>
                        <td>{{$no+1}}</td>
                        <td>{{$user->username}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->role}}</td>
                        <td>
                            <a class="btn btn-warning btn-sm mx-1" href="{{$user->id}}/edit">Edit</a>
                            <form action="{{$user->id}}" method="POST" class="d-inline mx-1">
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