@extends('layouts.admin')

@section('title')
    Edit User
@endsection

@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Users</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item "><a href="{{ route('users.index') }}">User</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit User</h4>
            <br>

            <form action="{{ route('users.update', $user->id) }}" method="post">
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
                    <label for="">Username</label>
                    <input type="text" name="username"
                    value="{{ $user->username }}"
                     class="form-control {{ isValid($errors->has('username')) }}"  value="{{ old('username') }}" readonly>
                    <p class="invalid-feedback">{{ $errors->first('username') }}</p>
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
                    <p class="invalid-feedback">
                        @if ($errors->first('password'))
                            The password must be at least 6 character should contain at least 3 of a-z or A-Z and number and special character.
                        @endif
                        {{-- {{ $errors->first('password') }} --}}
                    </p>
                    <p class="text-warning">Biarkan kosong, jika tidak ingin mengganti password</p>
                </div>
                {{ Form::inputSelect('Cabang', 'branch', $branch, null,[],$user->branch) }}

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck1" name="status" {{ $user->status == '1' ? 'checked' : '' }}>
                    <label class="custom-control-label" for="customCheck1">Status</label>
                </div>
                <br>
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