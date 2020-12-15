@extends('layouts.homeLayout')
@section('pages')
<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link font-weight-bold" href="{{url('/')}}" style="color: #892cdc">
        Home
    </a>
</li>
<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link font-weight-bold aktif" href="{{url('search')}}" style="color: #892cdc">
        Search
    </a>
</li>
<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link font-weight-bold" href="{{url('list')}}" style="color: #892cdc">
        Books
    </a>
</li>
@endsection

@section('konten')
<div class="col-md-12 col-sm-12">
    <div class="card shadow mb-4">
        <div class="card-body">
            <h2 class="text-center font-weight-bold ungu pt-3">Pencarian Buku</h2>

            <form action="{{url('search')}}" method="POST" class="p-4">
                @csrf
                <div class="form-group row py-2">
                    <label for="title" class="col-sm-2 col-form-label">Judul Buku</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            name="title">
                        @error('title')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row py-2">
                    <label for="author" class="col-sm-2 col-form-label">Pengarang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('author') is-invalid @enderror" id="author"
                            name="author">
                        @error('author')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row py-2">
                    <label for="penerbit"
                        class="col-sm-2 col-form-label @error('penerbit') is-invalid @enderror">Penerbit</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="penerbit" name="penerbit">
                        @error('penerbit')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row py-2">
                    <label for="genre"
                        class="col-sm-2 col-form-label @error('genre') is-invalid @enderror">Genre</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="genre" name="genre">
                        @error('genre')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row py-2">
                    <label for="tahun" class="col-sm-2 col-form-label @error('tahun') is-invalid @enderror">Tahun
                        Terbit</label>
                    <div class="col-sm-10">
                        <input type="number" min="1" step="1"
                            onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control"
                            id="tahun" name="tahun">
                        @error('tahun')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary float-right"><i class="fas fa-search">&nbsp;</i>
                        Cari</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection