@extends('layouts.admin')

@section('title')
    Add New Users
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
                        <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">User</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Tambah User</h4>
            <br>

            <form action="{{ route('users.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="">Nama</label>
                    <input type="text" name="name" class="form-control {{ isValid($errors->has('name')) }}"  value="{{ old('name') }}" required>
                    <p class="invalid-feedback">{{ $errors->first('name') }}</p>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control {{ isValid($errors->has('email')) }}"  value="{{ old('email') }}" required>
                    <p class="invalid-feedback">{{ $errors->first('email') }}</p>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control {{ isValid($errors->has('password')) }}" required>
                    <p class="invalid-feedback">{{ $errors->first('password') }}</p>
                </div>
                <div class="form-group">
                    <label for="">Role</label>
                    <select name="role" class="form-control {{ isValid($errors->has('role')) }}" required>
                        <option value="">Pilih</option>
                        @foreach ($roles as $row)
                        <option value="{{ $row->name }}" {{ old('role') == $row->id ? 'selected':'' }}>{{ $row->name }}</option>
                        @endforeach
                    </select>
                    <p class="invalid-feedback">{{ $errors->first('role') }}</p>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck1" name="status">
                    <label class="custom-control-label" for="customCheck1">Status</label>
                </div>
                <br>
                <div class="form-group">
                    <button class="btn btn-primary btn-sm">
                        <i class="fa fa-send"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

