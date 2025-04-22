<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="shortcut icon" type="image/png" href="dist/img/ffavicon.png"> -->
    <title>UPICON | Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" charset="utf-8">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/4.1.0/echarts-en.common.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
</head>

<style type="text/css">
    .sidebar-dark-primary {
        background-color: #141414cf !important;
    }

    .nav-link.active {
        background-color: #522d4e80 !important;
        color: #fff;
    }
</style>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <!-- <img class="animation__shake" src="{{ asset('dist/img/ffavicon.png') }}" alt="VAA Logo" height="60" width="60"> -->
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <ul class="navbar-nav ml-auto">

                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="d-flex flex-row align-items-center justify-content-center">
                            <span class="mr-3 border rounded bg-light px-2 py-1"><b>{{ Auth::user()->name }}</b></span>
                            <a class="btn btn-primary btn-sm" href="{{ route('logout') }}"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            {{--
                            <a id="nav-link" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @if (Auth::user()->role == 4)
                                <a class="dropdown-item" href="#">{{ __('Profile') }}</a>
                                @endif
                                @if (Auth::user()->role == 5)
                                <a class="dropdown-item" href="#">{{ __('Profile') }}</a>
                                @endif
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                            --}}
                        </li>
                    @endguest
                </ul>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            @if (Auth::user()->role == 1)
                <a href="{{ route('director.sadmin') }}" class="brand-link">
                    <img src="{{ url('dist/img/upicon_logo.png') }}" alt="UPICON Logo" class="brand-image elevation-3"
                        style="opacity: 20.2">
                    <span class="brand-text font-weight-light">Director</span>
                </a>
            @endif
            @if (Auth::user()->role == 2)
                <a href="{{ route('admin.index') }}" class="brand-link">
                    <img src="{{ url('dist/img/upicon_logo.png') }}" alt="UPICON Logo" class="brand-image elevation-3"
                        style="opacity: 20.2">
                    <span class="brand-text font-weight-light">Admin</span>
                </a>
            @endif
            @if (Auth::user()->role == 3)
                <a href="{{ route('vertical.index') }}" class="brand-link">
                    <img src="{{ url('dist/img/upicon_logo.png') }}" alt="VAA Logo" class="brand-image elevation-3"
                        style="opacity: 20.2">
                    <span class="brand-text font-weight-light">Vertical</span>
                </a>
            @endif
            @if (Auth::user()->role == 4)
                <a href="{{ route('spoc.index') }}" class="brand-link">
                    <img src="{{ asset('assets/img/upicon.png') }}" alt="UFS Logo" class="brand-image elevation-3"
                        style="opacity: 20.2">
                    <span class="brand-text font-weight-light">SPOC</span>
                </a>
            @endif
            @if (Auth::user()->role == 5)
                <a href="{{ route('team.index') }}" class="brand-link">
                    <img src="{{ url('dist/img/upicon_logo.png') }}" alt="UFS Logo" class="brand-image elevation-3"
                        style="opacity: 20.2">
                    <span class="brand-text font-weight-light">Team</span>
                </a>
            @endif
            @if (Auth::user()->role == 6)
                <a href="{{ route('vendor.index') }}" class="brand-link">
                    <img src="{{ url('dist/img/upicon_logo.png') }}" alt="UFS Logo" class="brand-image elevation-3"
                        style="opacity: 20.2">
                    <span class="brand-text font-weight-light">Vendor</span>
                </a>
            @endif
            @if (Auth::user()->role == 7)
                <a href="{{ route('beneficiary.index') }}" class="brand-link">
                    <img src="{{ url('dist/img/upicon_logo.png') }}" alt="UFS Logo" class="brand-image elevation-3"
                        style="opacity: 20.2">
                    <span class="brand-text font-weight-light">Beneficiary</span>
                </a>
            @endif

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        @if (Auth::user()->role == 1)
                            <li class="nav-item menu-open">
                                <a href="{{ route('director.sadmin') }}" class="nav-link active">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>Dashboard
                                        <!-- <i class="right fas fa-angle-left"></i> -->
                                    </p>
                                </a>
                            </li>
                            <!--<li class="nav-item">-->
                            <!--  <a href="#" class="nav-link">-->
                            <!--    <i class="nav-icon fas fa-edit"></i>-->
                            <!--    <p>Import List-->
                            <!-- <i class="fas fa-angle-left right"></i> -->
                            <!--    </p>-->
                            <!--  </a>-->
                            <!--</li>-->
                        @endif

                        @if (Auth::user()->role == 2)
                            <li class="nav-item menu-open">
                                <a href="{{ route('admin.index') }}" class="nav-link active">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>Dashboard
                                        <!-- <i class="right fas fa-angle-left"></i> -->
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.add') }}" class="nav-link">
                                    <i class="nav-icon fas fa-edit"></i>
                                    <p>Add User
                                        <!-- <i class="fas fa-angle-left right"></i> -->
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.addProject') }}" class="nav-link">
                                    <i class="nav-icon fas fa-edit"></i>
                                    <p>Add Project</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.addTeam') }}" class="nav-link">
                                    <i class="nav-icon fas fa-edit"></i>
                                    <p>Add Team</p>
                                </a>
                            </li>
                        @endif

                        @if (Auth::user()->role == 3)
                            <li class="nav-item menu-open">
                                <a href="{{ route('vertical.index') }}" class="nav-link active">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>Dashboard
                                        <!-- <i class="right fas fa-angle-left"></i> -->
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('vertical.addProject') }}" class="nav-link">
                                    <i class="nav-icon fas fa-edit"></i>
                                    <p>Add Project</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('vertical.addTeam') }}" class="nav-link">
                                    <i class="nav-icon fas fa-edit"></i>
                                    <p>Add Team</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('vertical.addMember') }}" class="nav-link">
                                    <i class="nav-icon fas fa-edit"></i>
                                    <p>Add Member</p>
                                </a>
                            </li>
                            <!--<li class="nav-item">-->
                            <!--  <a href="{{ route('vertical.statusP') }}" class="nav-link">-->
                            <!--    <i class="nav-icon fas fa-th"></i>-->
                            <!--    <p>Status</p>-->
                            <!--  </a>-->
                            <!--</li>-->
                        @endif

                        @if (Auth::user()->role == 4)
                            <li class="nav-item menu-open">
                                <a href="{{ route('spoc.index') }}" class="nav-link active">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>My Dashboard
                                        <!-- <i class="right fas fa-angle-left"></i> -->
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('spoc.add') }}" class="nav-link">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>Add Vendor</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('spoc.assignP') }}" class="nav-link">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>Assigned Project</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('spoc.vendorLogin') }}" class="nav-link">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>Vendor Login</p>
                                </a>
                            </li>
                            <!-- <li class="nav-item">
                                    <a href="{{ route('spoc.media') }}" class="nav-link">
                                        <i class="nav-icon fas fa-th"></i>
                                        <p>Media

                                        </p>
                                    </a>
                                </li> -->
                        @endif

                        @if (Auth::user()->role == 5)
                            <li class="nav-item menu-open">
                                <a href="{{ route('team.index') }}" class="nav-link active">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>My Dashboard
                                        <!-- <i class="right fas fa-angle-left"></i> -->
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{ route('team.upload') }}" class="nav-link">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>Upload Report
                                        <!-- <i class="right fas fa-angle-left"></i> -->
                                    </p>
                                </a>
                            </li>

                        @endif
                        @if (Auth::user()->role == 6)
                            <li class="nav-item menu-open">
                                <a href="{{ route('vendor.index') }}" class="nav-link active">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>My Dashboard
                                        <!-- <i class="right fas fa-angle-left"></i> -->
                                    </p>
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->role == 7)
                            <li class="nav-item menu-open">
                                <a href="{{ route('beneficiary.index') }}" class="nav-link active">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>My Dashboard
                                        <!-- <i class="right fas fa-angle-left"></i> -->
                                    </p>
                                </a>
                            </li>
                        @endif

                    </ul>
                </nav>
            </div>
        </aside>

        @yield('content')

        <footer class="main-footer">
            <strong>Copyright &copy; 2018-2024 <a href="https://upicon.in">UPICON</a>.</strong> All rights reserved.
            <div class="float-right d-none d-sm-inline-block"> <!-- <b>Version</b> 3.2.0 --> </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark"> </aside>
        <!-- /.control-sidebar -->
    </div>

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/javascript.util/0.12.12/javascript.util.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.css" />
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script type="text/javascript">
        $('#call_close').datetimepicker({});
    </script>
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

    <script>
        const dropdownElementList = document.querySelectorAll('.dropdown-toggle')
        const dropdownList = [...dropdownElementList].map(dropdownToggleEl => new bootstrap.Dropdown(dropdownToggleEl))
    </script>

    @yield('eChart')

</body>

</html>