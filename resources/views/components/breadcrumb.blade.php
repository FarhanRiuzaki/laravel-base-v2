<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">{{ @$header }}</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">{{ @$header }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        @if (@$add_route)
            @php
                $route = $add_route->__toString();
            @endphp
            @if ($route)
                @php
                    $data = $route;    
                    $type = substr($data, strpos($data, ".") + 1);    
                    // dd($type);
                @endphp
                @if ($type == 'create')
                    <div class="col-5 align-self-center">
                        <div class="customize-input float-right">
                            <a href="{{  route($route)  }}" class="btn btn-primary custom-radius text-center"><span class="fas fa-plus"></span> Tambah Data</a>
                        </div>
                    </div>
                @endif

                @if ($type == 'index')
                    <div class="col-5 align-self-center">
                        <div class="customize-input float-right">
                            <a href="{{  route($route)  }}" class="btn btn-warning custom-radius text-center"><span class="fas fa-angle-double-left"></span> Kembali</a>
                        </div>
                    </div>
                @endif
            @endif
        @endif
    </div>
</div>