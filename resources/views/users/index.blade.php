@extends('layouts.admin')

@section('title')
    Manajemen User
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
                            <li class="breadcrumb-item active">Manajemen User</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-5 align-self-center">
                <div class="customize-input float-right">
                    <a href="{{  route('users.create')  }}" class="btn btn-primary custom-radius text-center"><span class="fas fa-plus"></span> Tambah Data</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">List User</h4>
                <br>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <td>#</td>
                                <td>Nama</td>
                                <td>Email</td>
                                <td>Role</td>
                                <td>Status</td>
                                <td width='150px'>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @forelse ($users as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->email }}</td>
                                <td>
                                    @foreach ($row->getRoleNames() as $role)
                                    <label for="" class="badge badge-info">{{ $role }}</label>
                                    @endforeach
                                </td>
                                <td>
                                    @if ($row->status)
                                    <label class="badge badge-success">Aktif</label>
                                    @else
                                    <label for="" class="badge badge-default">Suspend</label>
                                    @endif
                                </td>
                                <td class="text-center">
                                     @if ($row->id != 5) {{-- if not superadmin --}}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <a href="{{ route('users.roles', $row->id) }}" class="btn btn-info btn-sm"><i class="fa fa-user-secret"></i></a>
                                        <a href="{{ route('users.edit', $row->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                        <button class="btn btn-danger btn-sm btn-delete" data-remote='{{ route('users.destroy', $row->id) }}'><i class="fa fa-trash"></i></button>
                                    @else
                                        Super-admin   
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection