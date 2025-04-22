@extends('layouts.app')
@push('style')
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <script src="jquery/1.9.1/jquery.js"></script>
    <link rel="stylesheet" href="3.3.6/css/bootstrap.min.css">
    <!-- <link href="http://meyerweb.com/eric/tools/css/reset/reset.css" rel="stylesheet" />-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
@endpush
@section('content')

<body class="hold-transition sidebar-mini">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3 class="m-0">Dashboard</h3>
                        <!-- <a type="button" class="abc">Break</a> -->
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('director.sadmin') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('director.sadmin') }}">Back</a></li>
                            <!-- <li class="breadcrumb-item active">Dashboard</li> -->
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        
        <section class="content">
            <div class="container-fluid">
                <!--  <div class="row">-->
                <!--    <div class="col-lg-4 col-4">-->
                <!-- small box -->
                <!--      <div class="small-box bg-info">-->
                <!--        <div class="inner">-->
                <!--          <h3>567</h3>-->
                <!--          <p>All Employee</p>-->
                <!--        </div>-->
                <!--        <div class="icon">-->
                <!--          <i class="ion ion-android-open"></i>-->
                <!--        </div>-->
                <!--        <a href="#" class="small-box-footer">Today:- </a>-->
                <!--      </div>-->
                <!--    </div>-->
                <!-- ./col -->
                <!--    <div class="col-lg-4 col-4">-->
                <!-- small box -->
                <!--      <div class="small-box bg-danger">-->
                <!--        <div class="inner">-->
                <!--          <h3>54</h3>-->
                <!--          <p>Vertical</p>-->
                <!--        </div>-->
                <!--        <div class="icon">-->
                <!--          <i class="ion ion-stats-bars"></i>-->
                <!--        </div>-->
                <!--        <a href="#" class="small-box-footer">Today:-  </a>-->
                <!--      </div>-->
                <!--    </div>-->
                <!-- ./col -->
                <!--    <div class="col-lg-4 col-4">-->
                <!-- small box -->
                <!--      <div class="small-box bg-danger">-->
                <!--        <div class="inner">-->
                <!--          <h3>67</h3>-->
                <!--          <p>Project </p>-->
                <!--        </div>-->
                <!--        <div class="icon">-->
                <!--          <i class="ion ion-stats-bars"></i>-->
                <!--        </div>-->
                <!--        <a href="#" class="small-box-footer">Today:-  </a>-->
                <!--      </div>-->
                <!--    </div>-->
                <!--</div>-->
                <div class="row d-flex flex-row justify-content-space-evenly">
                    <div class="col-lg-3 col-4">
                        <!-- small box -->
                        <a href="/director/project">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ sizeof($projects) }}</h3> <p>Projects</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-file-contract"></i>
                                    {{-- <i class="ion ion-android-open"></i> --}}
                                </div>
                                {{-- <a href="#" class="small-box-footer">Today:- </a>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-file-contract"></i></a> --}}
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-4">
                        <!-- small box -->
                        <a href="/director/user">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ sizeof($users) }}</h3> <p>Users</p>
                                </div>
                                <div class="icon">
                                    {{-- <i class="ion ion-stats-bars"></i> --}}
                                    <i class="fas fa-user"></i>
                                </div>
                                {{-- <a href="#" class="small-box-footer">Today:- </a>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-user"></i></a> --}}
                            </div>
                        </a>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-4">
                        <!-- small box -->
                        <a href="/director/vendor/">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ sizeof($vendors) }}</h3> <p>Vendors</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-clipboard"></i>
                                    {{-- <i class="ion ion-android-settings"></i> --}}
                                </div>
                                {{-- <a href="#" class="small-box-footer">Today:- </a>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-clipboard"></i></a> --}}
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3"></div>
                    <!-- ./col -->
                    <div class="col-12 my-4">
                        <h3>Verticals</h3>
                    </div>

                    @foreach ($verticals as $vertical)
                        <div class="col-lg-3 col-4">
                            <!-- small box -->
                            <a href="/director/vertical/{{ $vertical->id }}">
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h4>{{ $vertical->name }}</h4>
                                        <p>&nbsp;</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-clipboard"></i>
                                        {{-- <i class="ion ion-android-settings"></i> --}}
                                    </div>
                                    {{-- <a href="#" class="small-box-footer">Today:- </a>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-clipboard"></i></a> --}}
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>

    @if (isset($gdgfhfh))
        <!-- jQuery -->
        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- DataTables  & Plugins -->
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
    @endif
</body>
@endsection

@section('script')
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection