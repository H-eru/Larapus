@extends('layouts.homeLayout')
@push('plugincss')
<style>
    /* .gambar {
        max-height: 100%;
        max-width: 100%;
        padding: 5px;
        border-radius: 100px;
    } */

    td {
        padding: 5px;
        overflow: visible;
        white-space: unset;
        text-overflow: initial;
    }

    .tp {
        vertical-align: top;
    }
</style>
@endpush
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
<h2 class="text-center font-weight-bold ungu pt-3">Hasil Pencarian</h2>

@if ($res == false)
<div class="col-md-8 col-sm-12 p-4 mx-auto">
    <div class="card shadow-sm text-center mb-4">
        <div class="card-body">
            <img src="{{url('assets/img/nope.png')}}" class="img img-fluid">
        </div>
    </div>
</div>
@else

<div class="row p-4">
    @foreach ($books as $book)
    <div class="col-md-6 col-sm-12 px-4">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">
                    {{$book->title}}
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 py-2 px-3">
                        <img src="{{asset('books/'.$book->cover)}}" class="img img-fluid rounded">
                    </div>
                    <div class="col-md-8">
                        <table>
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
                {{-- belum --}}
                @if (Auth::check())
                <div class="float-right">
                    <form action="{{url('cart')}}/{{$book->id}}" method="POST">
                        @csrf
                        <button class="btn btn-primary">Pinjam</button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif

@endsection