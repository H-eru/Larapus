@extends('layouts.karyawanLayout')
@section('pinjam', 'active')
@section('cart')
<!-- Nav Item - Cart -->
<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-shopping-cart fa-fw"></i>
        <!-- Counter - Messages -->
        <span class="badge badge-danger badge-counter">{{$carts->count()}}</span>
    </a>
    <!-- Dropdown - Messages -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="messagesDropdown">
        <h6 class="dropdown-header">
            Daftar Pinjaman
        </h6>
        @foreach ($carts as $cart)
        <a class="dropdown-item d-flex align-items-center" href="#">
            <div class="dropdown-list-image mr-3">
                <form action="{{url('karyawan/pinjam/'.$cart->id)}}" method="POST">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger rounded-circle btn-sm"><i class="fas fa-trash"></i></button>
                </form>
            </div>
            <div class="font-weight-bold">
                <div class="text-truncate">{{$cart->title}}</div>
                <div class="small text-gray-500">Durasi : {{$cart->durations}} hari</div>
            </div>
        </a>
        @endforeach
        <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
    </div>
</li>

<div class="topbar-divider d-none d-sm-block"></div>
@endsection
@section('konten')
<h1 class="h3 mb-4 text-gray-800">Data Buku</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <form action="{{url('karyawan/pinjam')}}" method="GET" class="row">
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
                            <form action="{{url('karyawan/pinjam/'.$book->id.'/addCart')}}" method="POST" class="mx-1">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <select class="form-control" name="durations">
                                            <option value="3">3 Hari</option>
                                            <option value="5">5 Hari</option>
                                            <option value="7">7 Hari</option>
                                            <option value="14">14 Hari</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-info " type="submit">Pinjam</button>
                                    </div>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{url('karyawan/pinjam/create')}}" class="btn btn-primary">Konfirmasi Pinjaman</a>
            <div class="float-right">
                {{ $books->appends(Request::all())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection