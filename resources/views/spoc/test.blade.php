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
<style type="text/css">
    .table td,
    .table th {
        padding: 0.45rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }

    body {
        margin: 0;
        font-family: "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
        font-size: 14px;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        text-align: left;
        background-color: #fff;
    }

    .order-card {
        color: #fff;
    }

    .card {
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
        box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
        border: none;
        margin-bottom: 30px;
        -webkit-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
    }

    .card .card-block {
        padding: 25px;
    }

    .order-card i {
        font-size: 26px;
    }

    .f-left {
        float: left;
    }

    .f-right {
        float: right;
    }
</style>

<body class="hold-transition sidebar-mini">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                        <!-- <a type="button" class="abc">Break</a> -->
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('director.sadmin') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('director.sadmin') }}">Back</a></li>

                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-xl-3">
                        <div class="card  order-card" style="background: linear-gradient(45deg, #4099ff, #73b4ff); color: #fff;">
                            <div class="card-block">
                                <h6 class="m-b-20"></i></h6>
                                <h2 class="text-right"><span>{{ $users->count() }}</span></h2>
                                <p class="m-b-0"><span class="f-right text-dark">project</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-3">
                        <div class="card  order-card" style="background: linear-gradient(45deg, #2ed8b6, #59e0c5);">

                            <div class="card-block">
                                <h6 class="m-b-20"></i></h6>
                                <h2 class="text-right"><span>{{$vendors->count()}}</span></h2>
                                <p class="m-b-0"><span class="f-right text-dark">Vendor</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-3">
                        <div class="card  order-card" style="  background: linear-gradient(45deg, #FFB64D, #ffcb80);">
                            <div class="card-block">
                                <h6 class="m-b-20"></i></h6>
                                <h2 class="text-right"><span>2</span></h2>
                                <p class="m-b-0"><span class="f-right text-dark">Assign Project</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-3">
                        <div class="card bg-c-blue order-card" style="background: linear-gradient(45deg, #FF5370, #ff869a);">
                            <div class="card-block">
                                <h6 class="m-b-20"></i></h6>
                                <h2 class="text-right"><span>0</span></h2>
                                <p class="m-b-0"><span class="f-right text-dark">Unknow</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    

                    <div class="table-responsive mb-3">
                        <h3 class="mb-3">Vendor Details</h3>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>NAME</th>
                                    <th>Details</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($users as $bcuser)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td><a href="{{ route('spoc.assignP', $bcuser->id) }}">{{ $bcuser->p_name }}</a></td>
                                    <!-- <td ></td> -->
                                    <td>{{ $bcuser->p_details }}</td>
                                    <!-- <td ></td> -->
                                    <td>
                                        @if($bcuser->status == 0)
                                        STOP
                                        @elseif($bcuser->status == 1)
                                        ONGOING
                                        @elseif($bcuser->status == 2)
                                        PENDING
                                        @elseif($bcuser->status == 3)
                                        COMPLETED
                                        @endif
                                    </td>

                                </tr>
                                @empty
                                <p class="btn btn-outline-danger">No record found, Please enter valid input!</p>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive mb-3">
                        <h3 class="mb-3">Project Details</h3>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>

                                <tr>
                                    <th>S.No</th>
                                    <th>NAME</th>

                                    <th>State</th>
                                    <th>District</th>
                                    <th>Action</th>
                                    
                                </tr>


                            </thead>
                            <tbody>
                                @forEach($vendors as $vendor)
                                <tr>
                                    <td>{{$vendor->id}}</td>
                                    <td>{{$vendor->name}}</td>

                                    <td>{{$vendor->state}}</td>
                                    <td>{{$vendor->district}}</td>
                                    <td><a href="{{ route('spoc.view', $vendor->id) }}" class="btn btn-sm btn-outline-success py-0">View</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

        </section>
    </div>

    @if (true)
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
</body>
@endsection

@section('script')
@endsection