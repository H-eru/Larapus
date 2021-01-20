@extends('layouts.adminLayout')
@section('book', 'active')
@section('konten')
<h1 class="h3 mb-4 text-gray-800">Data Buku</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <form action="{{url('admin/book')}}" method="GET" class="row">
            <div class="col-md-3 col-sm-12 my-1">
                <input class="form-control" type="text" name="title" placeholder="Judul Buku">
            </div>
            <div class="col-md-3 col-sm-12 my-1">
                <input class="form-control" type="text" name="author" placeholder="Nama Pengarang">
            </div>
            <div class="col-md-3 col-sm-12 my-1">
                <input class="form-control" type="text" name="penerbit" placeholder="Nama Penerbit">
            </div>
            <div class="col-md-3 col-sm-12 my-1">
                <button type="submit" class="btn btn-success"><i class="fas fa-search"></i>&nbsp; Cari</button>
            </div>
        </form>
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
                        <th>Ketersediaan</th>
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
                        <td>{{$book->stok_now}}</td>
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
            <a href="{{url('admin/book/create')}}" class="btn btn-primary">Tambah Buku</a>
            <div class="float-right">
                {{ $books->appends(Request::all())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection