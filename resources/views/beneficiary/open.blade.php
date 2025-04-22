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
          <div class="col-sm-5">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('openuser.list') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ route ('openuser.list')}}">Back</a></li>
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
        <!-- <button class="btn btn-success" href="{{ route ('openuser.list')}}">Refresh</button> -->
    <div class="row">  
      <div class="card col-md-6">
        <div class="card-body">
        <label>Search BOB Commission by KO-Code</label>
          <form action="{{ route('openuser.showBOB') }}" method="GET">
            <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Enter Code (19560099)" aria-describedby="basic-addon2" name="vle_id">
            <input type="text" id="" class="form-control" name="pan_card" placeholder="Enter PAN No.">
            <button class="btn btn-secondary" type="submit">Search BOB</button>
            </div>
          </form>
        </div>
      </div>
      <div class="card col-md-6">
        <div class="card-body">
        <label>Search PNB Commission by KO-Code</label>
            <form action="{{ route('openuser.showPNB') }}" method="GET">
            <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Enter Code (K4400021)" aria-describedby="basic-addon2" name="AGENT_ID">
            <input type="text" id="" class="form-control" name="pan_card" placeholder="Enter PAN No.">
            <button class="btn btn-secondary" type="submit">Search PNB</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="row">  
      <div class="card col-md-6">
        <div class="card-body">
        <label>Search SBI Commission by KO-Code</label>
          <form action="{{ route('openuser.showSBI') }}" method="GET">
            <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Enter Code (1B000271)" aria-describedby="basic-addon2" name="csp_code">
            <input type="text" id="" class="form-control" name="pan_card" placeholder="Enter PAN No.">
            <button class="btn btn-secondary" type="submit">Search SBI</button>
            </div>
          </form>
        </div>
      </div>
      <div class="card col-md-6">
        <div class="card-body">
        <label>Search UCO Commission by KO-Code</label>
            <form action="{{ route('openuser.showUCO') }}" method="GET">
            <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Enter Code (17407)" aria-describedby="basic-addon2" name="AGENT_ID">
            <input type="text" id="" class="form-control" name="pan_card" placeholder="Enter PAN No.">
            <button class="btn btn-secondary" type="submit">Search UCO</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="row">  
      <div class="card col-md-6">
        <div class="card-body">
        <label>Search BUPB Commission by KO-Code</label>
         <form action="{{ route('openuser.showBUPB') }}" method="GET">
            <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Enter Code (13130071)" aria-describedby="basic-addon2" name="VLE_ID">
            <input type="text" id="" class="form-control" name="pan_card" placeholder="Enter PAN No.">
            <button class="btn btn-secondary" type="submit">Search BUPB</button>
            </div>
          </form>
        </div>
      </div>
      <div class="card col-md-6">
        <div class="card-body">
        <label>Search BGGB Commission by KO-Code</label>
         <form action="{{ route('openuser.showBGGB') }}" method="GET">
            <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Enter Code (11100002)" aria-describedby="basic-addon2" name="VLE_ID">
            <input type="text" id="" class="form-control" name="pan_card" placeholder="Enter PAN No.">
            <button class="btn btn-secondary" type="submit">Search BGGB</button>
            </div>
          </form>
        </div>
      </div>
    </div>

  </section>
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