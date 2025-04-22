@extends('layouts.app')
@section('content')
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset ('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0">Report</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('tech.list') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('tech.list') }}">Back</a></li>
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
          <div class="col-md-6">
             <!-- PIE CHART -->
            <div class="card card-danger">
             
               <div class="chart-container">
                <canvas id="pie_basic" style="width:100%;max-width:600px"></canvas>
              <!-- <div class="chart has-fixed-height" id="pie_basic"></div> -->
            </div>
              <!-- /.card-body -->
            </div>         
          </div>
          <!-- /.col -->
          <!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

@endsection

@section('eChart')
 
<script>
    var xValues = ["Resolved", "Open", "Pending at Bank-end", "Pending at Bank-end", "Pending at Bank-end", "Work-in-Progress"];
    var yValues = [{{$resolve_count}}, {{$open_count}}, {{$pending_bankcount}}, {{$pending_bccount}}, {{$pending_techcount}}, {{$work_count}}];
    var barColors = [
      "#b91d47",
      "#00aba9",
      "#2b5797",
      "#e8c3b9",
      "#ekf3b9",
      "#1e7145"
    ];
    new Chart("pie_basic", {
      type: "pie",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {
        title: {
          display: true,
          text: "All call record status"
        }
      }
    });
</script> 
@endsection