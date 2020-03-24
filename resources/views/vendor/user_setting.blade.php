@extends('layouts.admin')

@section('title')
    Account Setting
@endsection

@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Account Setting</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Update Account</h4>
            <br>

            <form action="{{ route('update_user', $user->id) }}" method="post">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label for="">Nama</label>
                    <input type="text" name="name" 
                        value="{{ $user->name }}"
                        class="form-control {{ isValid($errors->has('name')) }}" required>
                    <p class="invalid-feedback">{{ $errors->first('name') }}</p>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="email" 
                        value="{{ $user->email }}"
                        class="form-control {{ isValid($errors->has('email')) }}" 
                        required readonly>
                    <p class="invalid-feedback">{{ $errors->first('email') }}</p>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" 
                        class="form-control {{ isValid($errors->has('password')) }}">
                    <p class="invalid-feedback">{{ $errors->first('password') }}</p>
                    <p class="text-warning">Biarkan kosong, jika tidak ingin mengganti password</p>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-sm">
                        <i class="fa fa-send"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection