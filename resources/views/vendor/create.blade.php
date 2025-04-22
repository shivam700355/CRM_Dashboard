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
    .table td, .table th {
        padding: 0.45rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }

    body {
        margin: 0;
        font-family: "Source Sans Pro",-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
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
            <h5 class="m-0">Dashboard</h5>
            <!-- <a type="button" class="abc">Break</a> -->
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('employee.index') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ route ('employee.index')}}">Back</a></li>
              <!-- <li class="breadcrumb-item active">Dashboard</li> -->
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
  <div class="content">
      <div class="container-fluid">
       <!--  <form action="{{ route('employee.savePunch') }}" method="post" enctype="multipart/form-data">
          @csrf
          {{ csrf_field() }} 
          <div class="row mb-2">       
            <div class="col-md-2">
              <label >Date</label>
              <input type="date" class="form-control" id="checkin_date" name="checkin_date" placeholder="PunchIN">
            </div>
            <div class="col-md-2">
              <label >Time</label>
              <input type="time" class="form-control" id="checkin_time" name="checkin_time" placeholder="PunchTime">
            </div>
            <div class="cfasf" style="text-align: center; padding: 20px;">
              <button type="submit" class="btn btn-primary">Punch-In</button>
            </div> 
          </div>
        </form> -->

        <form action="{{ route('employee.savePunch') }}" method="post">
            @csrf
            <button type="submit" id="checkin_time" name="checkin_time">Check-in</button>
        </form>

        <form action="{{ route('employee.savePunch') }}" method="post">
            @csrf
            <button type="submit" id="checkout_time" name="checkout_time">Check-out</button>
        </form>
      </div>
             
      <!-- /.card-header -->
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Name</th>
              <th>Date</th>
              <th>P-IN</th>
              <th>P-OUT</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($attendances as $attendance)
            <tr>
              <td >{{ $loop->index + 1 }}</td>
              <td >{{ $attendance->u_name }}</td>
              <td >{{ $attendance->checkin_date }}</td>
              <td >{{ $attendance->checkin_time }}</td>
              <td >{{ $attendance->checkout_time }}</td>
              <td >{{ $attendance->status }}</td>
            </tr>
            @empty
              <p class="btn btn-outline-danger">No record found, Please enter valid input!</p>
            @endforelse
          </tbody>
        </table>
      </div>
  </div>
</div>

@if(isset($gdgfhfh))
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
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
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