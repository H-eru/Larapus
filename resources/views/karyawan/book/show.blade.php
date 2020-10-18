@extends('layouts.karyawanLayout')
@push('plugincss')
<style>
    img {
        max-height: 100%;
        max-width: 100%;
    }

    td {
        font-weight: 700;
        color: black;
        font-family: 'Roboto', sans-serif;
        padding: 6px;
        overflow: visible;
        white-space: unset;
        text-overflow: initial;
    }

    .tp {
        vertical-align: top;
    }
</style>
@endpush
@section('book', 'active')
@section('konten')
<h1 class="h3 mb-4 text-gray-800">Data Buku</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Buku</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <img src="{{url('cover')}}/{{$book->cover}}">
            </div>
            <div class="col-md-8">
                <table>
                    <tr>
                        <td>Judul</td>
                        <td> : </td>
                        <td>{{$book->title}}</td>
                    </tr>
                    <tr>
                        <td>Pengarang</td>
                        <td> : </td>
                        <td>{{$book->author}}</td>
                    </tr>
                    <tr>
                        <td>
                            Penerbit</td>
                        <td> : </td>
                        <td>{{$book->penerbit}}</td>
                    </tr>
                    <tr>
                        <td>
                            Tahun Terbit</td>
                        <td> : </td>
                        <td>{{$book->tahun}}</td>
                    </tr>
                    <tr>
                        <td>
                            Genre</td>
                        <td> : </td>
                        <td>{{$book->genre}}</td>
                    </tr>
                    <tr>
                        <td>
                            Kode Rak</td>
                        <td> : </td>
                        <td>{{$book->raks->kode_rak}}</td>
                    </tr>
                    <tr>
                        <td class="tp">
                            Sinopsis</td>
                        <td class="tp" class="mt-0"> : </td>
                        <td>
                            {{$book->sinopsis}}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection