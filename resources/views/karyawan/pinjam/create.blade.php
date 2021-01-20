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
<h1 class="h3 mb-4 text-gray-800">Data Pinjaman</h1>
<div class="card shadow mb-4">
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
                    @foreach ($carts as $cart)
                    <tr>
                        <td>{{$cart->title}}</td>
                        <td>{{$cart->author}}</td>
                        <td>{{$cart->penerbit}}</td>
                        <td>{{$cart->tahun}}</td>
                        <td>{{$cart->stok_now}}</td>
                        <td>
                            <form action="{{url('karyawan/pinjam/'.$cart->id)}}" method="POST">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger rounded-circle btn-sm"><i
                                        class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <a class="btn btn-primary float-right" href="#" data-toggle="modal" data-target="#confirmModal">
                <i class="fas fa-clipboard-check fa-sm fa-fw mr-2"></i>
                Konfirmasi Pinjaman
            </a>
            {{-- <a href="{{url('karyawan/pinjam/create')}}" class="btn btn-primary">Konfirmasi Pinjaman</a> --}}
        </div>
    </div>
</div>

<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pinjaman</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{url('karyawan/pinjam')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="users_id_anggota">ID Anggota</label>
                        <input type="text" name="users_id_anggota" id="users_id_anggota"
                            class="form-control @error('users_id_anggota') is-invalid @enderror"
                            placeholder="Input ID Anggota Peminjam" required>
                        @error('users_id_anggota')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <button class="btn btn-secondary mx-1" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary mx-1 float-right">Konfirmasi</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection