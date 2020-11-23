@extends('layouts.homeLayout')
@push('plugincss')
<style>
    .zoom {
        transition: transform .4s;
    }

    .zoom:hover {
        transform: scale(1.03);
    }
</style>
@endpush
@section('konten')
<div class="col-md-12 col-sm-12">
    <div class="card shadow mb-4">
        <div class="card-body">
            <h2 class="text-center font-weight-bold ungu">Selamat Datang di Larapus</h2>
            <div class="row">
                <div class="col-md-6 col-sm-12 px-5 py-3">
                    <div class="card shadow-sm">
                        <a href="search.blade.php" class="card-link">
                            <div class="card-body">
                                <img src="{{url('assets/img/search.png')}}" class="img img-fluid zoom">
                                <h4 class="text-center font-weight-bold ungu">Pencarian Buku</h4>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 px-5 py-3">
                    <div class="card shadow-sm">
                        <a href="list.blade.php" class="card-link">
                            <div class="card-body">
                                <img src="{{url('assets/img/stack.png')}}" class="img img-fluid zoom">
                                <h4 class="text-center font-weight-bold ungu">List Buku</h4>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection