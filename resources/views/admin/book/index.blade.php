@extends('layouts.adminLayout')
@push('plugincss')
<link href="{{url('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush
@section('book', 'active')
@section('konten')
<h1 class="h3 mb-4 text-gray-800">Data Buku</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{url('admin/book/create')}}" class="btn btn-primary">Tambah Buku</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Judul Buku</th>
                        <th>Pengarang</th>
                        <th>Penerbit</th>
                        <th>Tahun Terbit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                    <tr>
                        <td>{{$book->title}}</td>
                        <td>{{$book->author}}</td>
                        <td>{{$book->penerbit}}</td>
                        <td>{{$book->tahun}}</td>
                        <td>
                            <a class="btn btn-info btn-sm mx-1" href="{{url('admin/book/'.$book->id)}}">Lihat</a>
                            <a class="btn btn-warning btn-sm mx-1"
                                href="{{url('admin/book/'.$book->id.'/edit')}}">Edit</a>
                            <form action="{{url('admin/book/'.$book->id)}}" method="POST" class="d-inline mx-1">
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