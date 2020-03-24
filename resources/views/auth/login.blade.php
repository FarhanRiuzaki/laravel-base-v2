@extends('layouts.auth')

@section('title')
    <title>Login</title>
@endsection

@section('content')
    <style>
        div.center img{
            position: absolute;
            margin: 0;
            top: 50%;
            left: 50%;
            margin-right: -50%;
            transform: translate(-50%, -50%)
        }
        div.center h1{
            position: absolute;
            margin: 0;
            top: 50%;
            left: 50%;
            margin-right: -50%;
            transform: translate(-50%, -50%);
        }
    </style>
    <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative" style="background-color: rgb(205, 211, 225)">
            <div class="auth-box row">
                <div class="col-lg-6 col-md-6 modal-bg-img center" style="background-image: url({{asset('storage/images/' . $appSetting->image_login)}});">
                    {{-- <img src="{{asset('storage/images/' . $appSetting->image_header)}}" alt="homepage" class="dark-logo" style="height:60px" /> --}}
                    {{-- <h1><b>{{$appSetting->name}}</b></h1> --}}
                </div>
                <div class="col-lg-6 col-md-6 bg-white">
                    <div class="p-3">
                        <h3 class="mt-3 text-dark">Login</h3>
                        <p>Welcome back, please login to your account.</p>
                        <!-- ACTIONNYA MENGARAH PADA URL /LOGIN -->
                      	<!-- UNTUK MENCARI TAU TUJUAN URI DARI ROUTE NAME DIBAWAH, PADA COMMAND LINE, KETIKKAN PHP ARTISAN ROUTE:LIST DAN CARI URI YANG MENGGUNAKAN METHOD POST -->
                      	<!-- KARENA URI /LOGIN DENGAN METHOD GET DIGUNAKAN UNTUK ME-LOAD VIEW HALAMAN LOGIN -->
                      	<!-- PENGGUNAAN ROUTE() APABILA ROUTING TERSEBUT MEMILIKI NAMA, ADAPUN NAMENYA ADA PADA COLOM NAME ROUTE:LIST -->
                      	<!-- JIKA ROUTINGNYA TIDAK MEMILIKI NAMA, MAKA GUNAKAN HELPER URL() DAN DIDALAMNYA ADALAH URINYA. CONTOH URL('/LOGIN') -->
                        <form action="{{ route('login') }}" method="post">
                        @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-default" style="font-size: 12px" for="uname">Email</label>
                                        <!-- $errors->has('email') AKAN MENGECEK JIKA ADA ERROR DARI HASIL VALIDASI LARAVEL, SEMUA KEGAGALAN VALIDASI LARAVEL AKAN DISIMPAN KEDALAM VARIABLE $errors -->
                                        <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" 
                                        type="text" 
                                        name="email"
                                        placeholder="Email Address" 
                                        value="{{ old('email') }}" 
                                        autofocus 
                                        required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-default" style="font-size: 12px" for="pwd">Password</label>
                                        <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" 
                                        type="password" 
                                        name="password"
                                        placeholder="Password" 
                                        required>
                                    </div>
                                </div>
                                @if (session('error'))
                                <div class="col-md-12">
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error') }}
                                    </div>
                                </div>
                                @endif
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn btn-block btn-dark">Login</button>
                                </div>
                                <br>

                                <div class="col-lg-12 text-center mt-5">
                                    Don't have an account? <a href="#" class="text-danger">Sign Up</a> <br>
                                    {{-- or <button class="btn btn-link px-0" type="button">Forgot password?</button> --}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
@endsection