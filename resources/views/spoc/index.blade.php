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

 
</style>

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
              <li class="breadcrumb-item"><a href="{{ route('spoc.index') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('spoc.index') }}">Back</a></li>
              <!-- <li class="breadcrumb-item active">Dashboard</li> -->
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->

    <section class="content">
      <div class="container-fluid">
        
        <div class="row">
          <div class="col-lg-3 col-3">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $projects->count() }}</h3>
                <p>Project Count</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-open"></i>
              </div>
              <a href="#" class="small-box-footer"></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-3">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$vendors->count()}}</h3>
                <p>Vendor </p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer"> </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-3">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$associations->count()}}</h3>
                <p>Assign Project</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer"></a>
            </div>
          </div>
          <div class="col-lg-3 col-3">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>0</h3>
                <p>unknown</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer"> </a>
            </div>
          </div>
         

          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Project</h3>
              </div>

              <div class="card-body">

                <table id="example2" class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>NAME</th>
                      <th>Details</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($data as $project)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{$project['name'] }}</td>
                      <td>{{ $project['details'] }}</td>
                      <td>
                        @if($project['status'] === 'Active')
                        <a class="btn btn-success py-0">{{ $project['status'] }}</a>
                        @else
                        <a class="btn btn-danger py-0">{{ $project['status'] }}</a>
                        @endif
                      </td>
                      <td>
                        <a href="/spoc/project/{{ $project['id'] }}" class="btn btn-sm btn-outline-primary py-0">View</a>
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="5" class="text-center">No record found, Please enter valid input!</td>
                    </tr>
                    @endforelse

                  </tbody>
                </table>
              </div>
              <div class="card-header">
                <h3 class="card-title">Assign Project</h3>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Project name </th>
                      <th>Vendor Name</th>
                      <th>State</th>
                      <th>District</th>
                      <th>Start Date </th>
                      <th>End Date </th>
                      <th>Status </th>
                    </tr>
                  </thead>
                  <tbody>
                    @forEach($associations as $association)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $association->p_name }}</td>
                      <td>{{ $association->vendor_name }}</td>
                      <td>{{ $association->state }}</td>
                      <td>{{ $association->district }}</td>
                      <td>{{ $association->start_date }}</td>
                      <td>{{ $association->end_date ? $association->end_date : 'NA' }}</td>
                      @if($association->status_name === 'Start')
                      <td><a class="btn btn-success py-0 ">{{ $association->status_name }}</a></td>
                      @elseif($association->status_name === 'Ongoing')
                      <td><a class="btn btn-warning py-0 ">{{ $association->status_name }}</a></td>
                      @elseif($association->status_name === 'Pending')
                      <td><a class="btn btn-danger py-0 ">{{ $association->status_name }}</a></td>
                      @elseif($association->status_name === 'Completed')
                      <td><a class="btn btn-info py-0 ">{{ $association->status_name }}</a></td>
                      @endif
                    </tr>
                    @endforeach

                  </tbody>
                </table>
              </div>
              <div class="card-header">
                <h3 class="card-title">Vendor details</h3>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>NAME</th>
                      <th>State</th>
                      <th>District</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forEach($vendors as $vendor)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{$vendor->name}}</td>
                      <td>{{$vendor->state}}</td>
                      <td>{{$vendor->district}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
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