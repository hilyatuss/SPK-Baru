<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SPK Beasiswa Bidikmisi | @yield('title')</title>

    <link rel="icon" href="{{ asset('images/pnm.png') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
   
    <!--Font Awesome-->
    <link rel="stylesheet" href="{{asset('adminlte3/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('adminlte3/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte3/plugins/flat-barometer/style.css')}}">
    <!-- daterange picker -->
  <link rel="stylesheet" href="{{asset('adminlte3/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{asset('adminlte3/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('adminlte3/plugins/toastr/toastr.min.css')}}">
    
    <!-- jQuery -->
    <script src="{{asset('adminlte3/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('adminlte3/dist/js/adminlte.min.js')}}"></script>
    
    <script src="{{asset('adminlte3/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <!-- Toastr -->
    <script src="{{asset('adminlte3/plugins/toastr/toastr.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('adminlte3/dist/js/demo.js')}}"></script>
   
    <link rel="stylesheet" href="{{asset('adminlte3/plugins/select2/css/select2.min.css')}}">
    
    <link rel="stylesheet" href="{{asset('adminlte3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    
    <script src="{{ asset('adminlte3/plugins/select2/js/select2.min.js') }}"></script>
    
    <script src="{{ asset('adminlte3/plugins/flat-barometer/script.js') }}"></script>
    
    <script>
        $(function() {
            $('select:not(.default)').select2({
                theme: 'bootstrap4',
            });
        })
    </script>
    <script type="text/javascript">
        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        })
    </script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <!-- <li class="nav-item d-none d-sm-inline-block" hidden>
                    <a href="{{route('home')}}" class="nav-link">Home</a>
                </li> -->
            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-3" hidden>
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <?php 
               $nama = DB::table("tb_mahasiswa")->where(['nim' => Auth::user()->nim])->first();
               if(empty($nama->nama_mahasiswa)){
                   $nama = Auth::user()->username;
               }else{
                   $nama = $nama->nama_mahasiswa;
               }
            ?>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">{{ $nama }} ({{ Auth::user()->level }})</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li><a href="{{ route('user.profil') }}" class="dropdown-item">Profil</a></li>
                        <li><a href="{{ route('user.password') }}" class="dropdown-item">Password</a></li>
                        <li><a href="{{ route('user.logout') }}" class="dropdown-item">Logout</a></li>
                        <!-- End Level two -->
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{route('home')}}" class="brand-link">
                <span class="brand-text font-weight-bold">SPK Beasiswa Bidikmisi</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('images/user.png') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="{{ route('user.profil') }}" class="d-block">{{ $nama }}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline" hidden>
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item" {{ is_hidden('home') }}>
                            <a href="{{ route('home') }}" class="nav-link {{ set_active('home') }}">
                                <i class="nav-icon fas fa-th text-primary"></i>
                                <p>
                                    Home
                                </p>
                            </a>
                        </li>
                        <li class="nav-item" {{ is_hidden('user.index') }}>
                            <a href="{{ route('user.index') }}" class="nav-link {{ set_active('user.index') }}">
                                <i class="nav-icon fas fa-users text-primary"></i>
                                <p>
                                    User
                                </p>
                            </a>
                        </li>
                        <li class="nav-item" {{ is_hidden('periode.index') }}>
                            <a href="{{ route('periode.index') }}" class="nav-link {{ set_active('periode.index') }}">
                                <i class="nav-icon far fa-clock text-primary"></i>
                                <p>
                                    Periode Beasiswa
                                </p>
                            </a>
                        </li>
                        <li class="nav-item" {{ is_hidden('kriteria.index') }}>
                            <a href="{{ route('kriteria.index') }}" class="nav-link {{ set_active('kriteria.index') }}">
                                <i class="nav-icon far fa-edit text-primary"></i>
                                <p>
                                    Data Kriteria
                                </p>
                            </a>
                        </li>
                        <li class="nav-item" {{ is_hidden('data_mahasiswa.index') }}>
                            <a href="{{ route('data_mahasiswa.index') }}" class="nav-link {{ set_active(['data_mahasiswa.index', 'dataPerPeriode']) }}">
                                <i class="nav-icon far fa-user text-primary"></i>
                                <p>
                                    Data Mahasiswa
                                </p>
                            </a>
                        </li>
                        <li class="nav-item" {{ is_hidden('nilai_mahasiswa.index') }}>
                            <a href="{{ route('nilai_mahasiswa.index') }}" class="nav-link {{ set_active('nilai_mahasiswa.index') }}">
                                <i class="nav-icon fas fa-chart-pie text-primary"></i>
                                <p>
                                    Nilai Mahasiswa
                                </p>
                            </a>
                        </li>
                        <li class="nav-item" {{ is_hidden('hitung.index') }}>
                            <a href="{{ route('hitung.index') }}" class="nav-link {{ set_active(['hitung.index', 'hitungPerPeriode']) }}">
                                <i class="nav-icon far fa-copy text-primary"></i>
                                <p>
                                    Hasil Perhitungan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item" {{ is_hidden('mahasiswa.create') }}>
                            <a href="{{ route('mahasiswa.create') }}" class="nav-link {{ set_active('mahasiswa.create') }}">
                                <i class="nav-icon far fa-copy text-primary"></i>
                                <p>
                                    Daftar Beasiswa Bidikmisi
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h1>@yield('title')</h1>
                        </div>
                        <div class="col-sm-6" hidden>
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Blank Page</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer d-print-none">
            <div class="float-right d-none d-sm-block">
                Designed by
                <strong>AdminLTE</strong>
            </div>
            <strong>Copyright &copy; {{ date('Y') }} SPK Beasiswa Bidikmisi </strong>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <!-- <script type="text/javascript">
        $('.form-control').attr('autocomplete', 'off');
    </script>  -->

    </body>

</html>