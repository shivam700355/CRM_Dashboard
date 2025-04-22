@extends('layouts.app')
@push('style')
<script src="jquery/1.9.1/jquery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
<link rel="stylesheet" href="3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ route ('admin.index')}}">Back</a></li>
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
          <form action="{{ route('admin.saveDept') }}" method="post" enctype="multipart/form-data">
            @csrf
            {{ csrf_field() }} 
            <div class="row mb-2">       
            <div class="col-md-4">
              <label >Name</label>
              <input type="text" class="form-control" id="d_name" name="d_name" placeholder="Name">
            </div>
            <div class="col-md-2">
              <label >Fullname</label>
              <input type="text" id="d_fullname" name="d_fullname" class="form-control" placeholder="Fullname">
            </div>
            <div class="col-md-2">
              <label >Mobile</label>
              <input type="text" class="form-control" id="d_mobile" name="d_mobile" placeholder="Mobile">
            </div>
            <div class="col-md-3">
              <label >Website</label>
              <input type="text" class="form-control" id="d_website" name="d_website" placeholder="Designation">
            </div>
            <div class="col-md-3">
              <label >Email</label>
              <input type="email" class="form-control" id="d_email" name="d_email" placeholder="Department">
            </div>
            <div class="col-md-3">
              <label >Image</label>
              <input type="file" id="d_image" name="d_image" class="form-control-file"/>
            </div>
            <div class="col-md-3">
              <label >Address</label>
              <input type="text" class="form-control" id="d_address" name="d_address" placeholder="Address">
            </div>
            <div class="col-md-2">
              <label >Status</label>
              <input type="text" class="form-control" id="status" name="status" placeholder="Status">
            </div>
            <div class="cfasf" style="text-align: center; padding: 20px;">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div> 
            </div>
          </form>
        </div>
    </div>
  </div>

  @if(isset($gdgfhfh))
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  @endif
</body>
@endsection