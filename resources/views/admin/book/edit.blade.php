@extends('layouts.adminLayout')
@push('plugincss')
<style>
    img {
        max-width: 100%;
        max-height: 100%;
    }

    .foto {
        height: 200px;
        width: 130px;
    }
</style>
<script src="https://raw.githubusercontent.com/lcdsantos/jQuery-Selectric/master/public/selectric.css"></script>
<link href="{{url('assets/js/selectric.css')}}" rel="stylesheet">
@endpush
@section('book', 'active')
@section('konten')
<div class="col-md-8 col-sm-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ubah Data</h6>
        </div>
        <div class="card-body">
            <form action="{{url('admin/book')}}/{{$book->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="title">Judul</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                        placeholder="Input Judul Buku" required value="{{$book->title}}">
                    @error('title')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="author">Pengarang</label>
                    <input type="text" name="author" id="author"
                        class="form-control @error('author') is-invalid @enderror" placeholder="Input Pengarang"
                        value="{{$book->author}}" required>
                    @error('author')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="penerbit">Penerbit</label>
                    <input type="text" name="penerbit" id="penerbit"
                        class="form-control @error('penerbit') is-invalid @enderror" placeholder="Input Penerbit"
                        value="{{$book->penerbit}}" required>
                    @error('penerbit')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tahun">Tahun</label>
                    <input type="number" name="tahun" id="tahun"
                        class="form-control @error('tahun') is-invalid @enderror" placeholder="Input Tahun"
                        value="{{$book->tahun}}" min="1" step="1"
                        onkeypress="return event.charCode >= 48 && event.charCode <= 57" title="Numbers only" required>
                    @error('tahun')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="sinopsis">Sinopsis</label>
                    <textarea name="sinopsis" id="sinopsis" cols="30" rows="5"
                        class="form-control @error('sinopsis') is-invalid @enderror">{{$book->sinopsis}}</textarea>
                    @error('sinopsis')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="genre">Genre</label>
                    <input type="text" name="genre" id="genre" class="form-control @error('genre') is-invalid @enderror"
                        value="{{$book->genre}}" placeholder="Input Genre">
                    @error('genre')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="rak_id">Rak</label>
                    <select class="form-control" id="rak_id" name="rak_id">
                        <option value="{{$book->rak_id}}">{{$book->raks->kode_rak}} - {{$book->raks->nama_rak}}</option>
                        @foreach ($raks as $rak)
                        <option value="{{$rak->id}}">{{$rak->kode_rak}} - {{$rak->nama_rak}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Cover</label>
                    <div class="form-group foto">
                        <img src="{{asset('books/'.$book->cover)}}" class="img img-fluid">
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="cover">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="penerbit">Jumlah Stock</label>
                    <input type="number" value="{{$book->stok}}" disabled class="form-control"
                        placeholder="Input Penerbit" required>
                </div>
                <div class="form-group">
                    <label for="stok">Tambah Stock Baru</label>
                    <input type="number" name="stok" id="stok" class="form-control @error('stok') is-invalid @enderror"
                        placeholder="Input stok baru" min="1" step="1"
                        onkeypress="return event.charCode >= 48 && event.charCode <= 57" title="Numbers only">
                    @error('stok')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <a href="{{url('admin/book')}}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary float-right">Simpan</button>
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