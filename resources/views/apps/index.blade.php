@extends('layouts.admin')

@section('title')
    App Setting
@endsection
{{-- {{ dd($get) }} --}}
@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Apps Setting</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">App Setting</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">App Setting</h4>
            <br>
            <form action="{{ route('apps.update', $apps->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                 
                <div class="form-group">
                    <label for="name">Nama Aplikasi</label>
                    <input type="text" name="name" class="form-control {{ isValid($errors->first('name'))}}" value="{{ $apps->name }}" required>
                    <p class="invalid-feedback">{{ $errors->first('name') }}</p>
                </div>
                <div class="form-group">
                    <label for="desc">Deskripsi</label>
                    <textarea name="desc" class="form-control {{ isValid($errors->first('desc'))}}" id="desc" cols="30" rows="5">{{ $apps->desc }}</textarea>
                    <p class="invalid-feedback">{{ $errors->first('desc') }}</p>
                </div>
                <div class="form-group">
                    <label for="image_login">Image Login</label>
                    <input type="file" name="image_login" class="form-control  {{ isValid($errors->first('image_login')) }}" value="{{ old('image_login') }}" >
                    <p class="invalid-feedback">{{ $errors->first('image_login') }}</p>
                </div>
                <div class="form-group">
                    <label for="image_header">Image Header</label>
                    <input type="file" name="image_header" class="form-control  {{ isValid($errors->first('image_header')) }}" value="{{ old('image_header') }}" >
                    <p class="invalid-feedback">{{ $errors->first('image_header') }}</p>
                </div>
                <div class="form-group">
                    <label for="image_icon">Image Icon</label>
                    <input type="file" name="image_icon" class="form-control  {{ isValid($errors->first('image_icon')) }}" value="{{ old('image_icon') }}" >
                    <p class="invalid-feedback">{{ $errors->first('image_icon') }}</p>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        // swal.fire('ok','ok', 'error');
    </script>
@endsection