@extends('layouts.homeLayout')
@section('pages')
<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link font-weight-bold" href="{{url('/')}}" style="color: #892cdc">
        Home
    </a>
</li>
<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link font-weight-bold" href="{{url('search')}}" style="color: #892cdc">
        Search
    </a>
</li>
<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link font-weight-bold" href="{{url('list')}}" style="color: #892cdc">
        Books
    </a>
</li>
@endsection
@section('login', 'aktif')
@section('konten')
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-6 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-4">
                <div class="card-body p-0">
                    <div class="p-5">
                        <div class="text-center">
                            {{-- <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
                            <h6 class="text-primary">Silahkan login untuk mengakses aplikasi </h6> --}}
                            <img src="{{url('assets/img/logo_long.png')}}" class="img img-fluid logo mb-3"
                                style="margin-top: -25px" alt="">
                        </div>
                        <form class="user" action="{{url('authenticate')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="username"
                                    class="form-control form-control-user @error('username') is-invalid @enderror"
                                    placeholder="Masukkan Username" required>
                                @error('username')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" name="password"
                                    class="form-control form-control-user @error('password') is-invalid @enderror"
                                    placeholder="Masukkan Password" required>
                                @error('password')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Login
                            </button>
                        </form>
                        <hr>
                        <form class="user">
                            <div class="text-center user">
                                <a class="btn btn-success btn-user btn-block" href="{{url('register')}}">Registrasi
                                    Akun</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection