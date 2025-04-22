@extends('layouts.app')
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
@section('content')

<style type="text/css">
  .content-wrapper {
    min-height: 1080px!important;
}
</style>
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
<div class="content-wrapper">

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-danger">
            <div class="chart-container">
            <div class="chart has-fixed-height">
              <canvas id="pie_basic" style="width:100%; max-width:100%"></canvas>
            </div>
            </div>
          </div>

          <div class="card card-danger">
            <div class="chart-container">
            <div class="chart has-fixed-height">
              <canvas id="bar_basic" style="width:100%; max-width:100%"></canvas>
            </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
            <div class="card card-danger">
                <div class="chart-container">
                <div class="chart has-fixed-height">
                  <canvas id="bank_basic" style="width:100%; max-width:100%"></canvas>
                </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </section>
   
@section('eChart')
  <script src="{{ asset ('plugins/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset ('plugins/sparklines/sparkline.js') }}"></script>
  <script src="{{ asset ('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
  <script src="{{ asset ('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
  <script src="{{ asset ('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
  <script>
      var xValues = ["Vertical", "Spoc", "Teams"];
      var yValues = [{{$resolve_count}}, {{$open_count}}, {{$pending_bankcount}}];
      var barColors = [
        "#b91d47",
        "#00aba9",
        "#2b5797"
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
            text: "Role"
          }
        }
      });
  </script> 

  <script>
      var xValues = ["Training", "Consultancy", "Finance", "Retail", "HR"];
      var yValues = [{{$bob_count}}, {{$uco_count}}, {{$sbi_count}}, {{$pnb_count}}, {{$bupb_count}}];
      var barColors = [
        "#b91d47",
        "#00aba9",
        "#2b5797",
        "#e8c3b9",
        "#e6c867"
      ];
      new Chart("bank_basic", {
        type: "bar",
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
            text: "Vertical-wise Project Count"
          }
        }
      });
  </script> 
@endsection

@section('script')
  <script>
    $(function () {
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
</div>
@endsection