@extends('layouts.admin')

@section('title')
    Role Permission
@endsection

@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Role Permission</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Role Permission</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add New Permission</h4>
                    <br>

                    <form action="{{ route('users.add_permission') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}" required>
                            <p class="text-danger">{{ $errors->first('name') }}</p>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-sm">
                                Add New
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">List Permission</h4>
                    <br>

                    <form action="{{ route('users.roles_permission') }}" method="GET">
                        <div class="form-group">
                            <label for="">Roles</label>
                            <div class="input-group">
                                <div class="row" style="width: 100%">
                                    <div class="col-md-10">
                                        <select name="role" class="form-control">
                                            @foreach ($roles as $value)
                                                <option value="{{ $value }}" {{ request()->get('role') == $value ? 'selected':'' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <span class="input-group-btn">
                                            <button class="btn btn-danger btn-block">Check!</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    {{-- jika $permission tidak bernilai kosong --}}
                    @if (!empty($permissions))
                    <form action="{{ route('users.setRolePermission', request()->get('role')) }}" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-group">
                                    <div class="nav-tabs-custom">
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#tab_1" data-toggle="tab">Permissions</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_1">
                                                @php $no = 1; @endphp
                                                @foreach ($permissions as $key => $row)
                                                    <input type="checkbox" 
                                                        name="permission[]" 
                                                        class="minimal-red" 
                                                        value="{{ $row }}"
                                                        {{--  CHECK, JIKA PERMISSION TERSEBUT SUDAH DI SET, MAKA CHECKED --}}
                                                        {{ in_array($row, $hasPermission) ? 'checked':'' }}
                                                        > {{ $row }} <br>   
                                                    @if ($no++%4 == 0)
                                                    <br>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="pull-left">
                                    <button class="btn btn-primary btn-sm">
                                        <i class="fa fa-send"></i> Set Permission
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection