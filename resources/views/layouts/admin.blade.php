<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<meta name="description" content="Base App">
	<meta name="author" content="Farhan Riuzaki">
	<meta name="author" content="riuzakif@gmail.com">
    <meta name="keyword" content="aplikasi base administrator">
  	<!-- PERHATIKAN BAGIAN INI, APAPUN YANG DIAPIT OLEH @~SECTION('TITLE') PADA VIEW YANG MENGGUNAKAN MASTER INI, MAKA AKAN ME-REPLACE CODE DIBAWAH -->
  	<!-- TITLE MENJADI KATA KUNCI, JADI JIKA MENGGUNAKAN KEY TITLE PADA @~YIELD, MAKA GUNAKAN KEY TITLE PADA @~SECTION -->

    <title>{{ $appSetting->name }} | @yield('title')</title>

    <!-- UNTUK ME-LOAD ASSET DARI PUBLIC, KITA GUNAKAN HELPER ASSET() -->
    <link rel="shortcut icon" href="{{asset('storage/images/' . $appSetting->image_icon)}}"/>

	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('select2/dist/css/select2.css') }}" rel="stylesheet" />
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- @//INCLUDE SAMA DENGAN FUNGSI INCLUDE DI PHP, HANYA SAJA PENULISAN DIBLADE MENJADI @//INCLUDE, BERARTI KITA ME-LOAD FILE LAINNYA -->
        <!-- KENAPA HEADER DIPISAHKAN? AGAR LEBIH RAPI SAJA JADI LEBIH MUDAH MAINTENANCENYA -->
        <!-- KETIKA MELOAD FILE BLADE, MAKA EKSTENSI .BLADE.PHP TIDAK PERLU DITULISKAN -->
        @include('layouts.module.header')


        <!-- SIDEBAR JUGA KITA PISAHKAN CODENYA MENJADI FILE TERSENDIRI -->
        <!-- KETIKA MELOAD FILE BLADE, MAKA EKSTENSI .BLADE.PHP TIDAK PERLU DITULISKAN -->
        @include('layouts.module.sidebar')

        <div class="page-wrapper">

            <!-- BAGIAN INI AKAN DI-REPLACE SESUAI ISI YANG DIAPIT DARI @/SECTION('CONTENT') -->
            @yield('content')

            <footer class="footer text-center text-muted">
                2020 © Farhan Riuzaki.
            </footer>
        </div>

    </div>
    <script src="{{ asset('js/app.js') }}"></script>

    {{-- <script src="{{ asset('js/bundle.js') }}"></script> --}}
    {{-- <script src="{{ asset('adminart/src/assets/libs/jquery/dist/jquery.min.js') }}"></script> --}}
    <script src="{{ asset('adminart/src/assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('adminart/src/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- apps -->

    <!-- apps -->
    <script src="{{ asset('adminart/src/dist/js/app-style-switcher.js') }}"></script>
    <script src="{{ asset('adminart/src/dist/js/feather.min.js') }}"></script>
    <script src="{{ asset('adminart/src/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('adminart/src/dist/js/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('adminart/src/dist/js/custom.min.js') }}"></script>
    <script src="{{ asset('select2/dist/js/select2.js') }}"></script>
    @include('sweet::alert')

    @yield('js')

    <script src="{{ asset('js/custom.js') }}"></script>
    <script>
        // START DYNAMIS TEMA
        $(function () {
            document.documentElement.setAttribute('theme', '{{  $appSetting->theme }}');
        });
        $('body').on('click', '#light' , function(){
            document.documentElement.setAttribute('theme', 'light');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route("apps.theme")}}',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    theme: 'light',
                    _token: "{{ csrf_token() }}",
                }
            })
        });

        $('body').on('click', '#dark' , function(){
            document.documentElement.setAttribute('theme', 'dark');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route("apps.theme")}}',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    theme: 'dark',
                    _token: "{{ csrf_token() }}",
                }
            })
        });
        // END DYNAMIS TEMA


        // FUNGSI DELETE DENGAN AJAX ALL FORM
        $('body').on('click', '.btn-delete', function (e) {
            e.preventDefault();
            var url = $(this).data('remote');

            swal.fire({
            title: 'Are you sure?',
            text: "It will permanently deleted !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
            }).then(function(e) {
                if(e.value){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    // confirm then
                    $.ajax({
                        url: url,
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            _method: 'DELETE',
                            submit: true,
                            _token: "{{ csrf_token() }}",
                        },
                        success: function (param) {
                            if(param.code == 'success'){
                                swal.fire('Berhasil', param.msg, param.code)
                            }
                            if(param.code == 'error'){
                                swal.fire('Oops', param.msg, param.code)
                            }
                            cekDataTable = $('.dataTable').html();
                            if(cekDataTable){
                                $('.dataTable').DataTable().draw(false);
                            }else{
                                window.location.reload();
                            }

                        },
                        error: function (param) {
                            swal.fire('Oops', 'Terjadi kesalahan', 'error')
                        }
                    })
                }
            })
        });
    </script>
</body>
</html>
