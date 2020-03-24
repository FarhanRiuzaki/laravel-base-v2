@extends('layouts.admin')

@section('title')
    Manajemen Roles
@endsection

@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Role</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Manajemen Role</li>
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
                    <h4 class="card-title">Tambah Data</h4>
                    <br>

                    <form action="{{ route('roles.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Role</label>
                            <input type="text" 
                            name="name"
                            class="form-control {{ isValid($errors->has('name')) }}" id="name" required>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary btn-sm">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">List Role</h4>
                    <br>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dataTable">
                            <thead>
                                <tr class="text-center">
                                    <td width='25px'>#</td>
                                    <td>Role</td>
                                    <td>Guard</td>
                                    <td>Created At</td>
                                    <td width='50px'>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- DATA BY AJAX DATATABLE --}}
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
    $(document).ready(function(){
        
        option = {
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('roles.index') }}",
            columns: [
                {
                data: 'DT_RowIndex', 
                name: 'DT_RowIndex',
                className: "text-center",
                },
                {
                data: 'name',
                name: 'name'
                },
                {
                data: 'guard_name',
                name: 'guard_name'
                },
                {
                data: 'created_at',
                name: 'created_at',
                class: "text-center",
                },
                {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                class: 'text-center'
                }
            ]
        };
        // FUNCTION DATATABLE DISINI
        $('.dataTable').DataTable(option).on( 'draw', function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    });
    </script>
@endsection