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
              <li class="breadcrumb-item"><a href="{{ route('openuser.searchUCO') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ route ('openuser.searchUCO')}}">Back</a></li>
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
         @forelse ($ucoes->reverse() as $bob)
        <div class="row">
          <div class="col-12">
            <div class="card">
               <div class="card-header">
                <h3 class="card-title"><b>UCO COMMISSION Month/Year: </b> {{ \Carbon\Carbon::parse($bob->month_year)->format('m-Y') }}</h3>
              </div> 
              <!-- /.card-header -->
              <div class="card-body">
                <table id="dsfdfl" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>S.No.</th>
                      <th>TYPE/KEY</th>
                      <th>VALUE/COMMISSION</th>
                    </tr>
                    </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>STATE NAME</td>
                      <td>{{$bob->STATE_NAME}}</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>ZONE NAME</td>
                      <td>{{$bob->ZONE_NAME}}</td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>DISTRICT</td>
                      <td>{{$bob->DIST}}</td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>Mandal</td>
                      <td>{{$bob->Mandal}}</td>
                    </tr>
                    <tr>
                      <td>5</td>
                      <td>BASE BRANCH</td>
                      <td>{{$bob->BASE_BRANCH}}</td>
                    </tr>
                    <tr>
                      <td>6</td>
                      <td>SOL ID</td>
                      <td>{{$bob->SOL_ID}}</td>
                    </tr>
                    <tr>
                      <td>7</td>
                      <td>VILLAGE NAME</td>
                      <td>{{$bob->VILLAGE_NAME}}</td>
                    </tr>
                    <tr>
                      <td>8</td>
                      <td>BCA NAME</td>
                      <td>{{$bob->BCA_NAME}}</td>
                    </tr>
                    <tr>
                      <td>9</td>
                      <td>AGENT ID BANK</td>
                      <td>{{$bob->AGENT_ID_BANK}}</td>
                    </tr>
                    <tr>
                      <td>10</td>
                      <td>AGENT ID</td>
                      <td>{{$bob->AGENT_ID}}</td>
                    </tr>
                    <tr>
                      <td>11</td>
                      <td>SETT ACC NO</td>
                      <td>{{$bob->SETT_ACCNO}}</td>
                    </tr>
                    <tr>
                      <td>12</td>
                      <td>DATE OF JOINING</td>
                      <td>{{$bob->DATE_OF_JOINING}}</td>
                    </tr>
                    <tr>
                      <td>13</td>
                      <td>PAN CARD</td>
                      <td>{{$bob->pan_card}}</td>
                    </tr>
                    <tr>
                      <td>14</td>
                      <td>VENDOR ID</td>
                      <td>{{$bob->VENDOR_ID}}</td>
                    </tr>
                    <tr>
                      <td>15</td>
                      <td>Company_Name</td>
                      <td>{{$bob->Company_Name}}</td>
                    </tr>
                     <tr>
                      <td>16</td>
                      <td>LOGIN DAYS</td>
                      <td>{{$bob->Login_Days}}</td>
                    </tr>
                    <tr>
                      <td>17</td>
                      <td>Device ID</td>
                      <td>{{$bob->Device_ID}}</td>
                    </tr>
                    <tr>
                      <td>18</td>
                      <td>NON FUNDED NO OF ACCT OPN</td>
                      <td>{{$bob->NON_FUNDED_NO_OF_ACCT_OPN}}</td>
                    </tr>
                    <tr>
                      <td>19</td>
                      <td>NON FUNDED COMM ACCT OPN</td>
                      <td>{{$bob->NON_FUNDED_COMM_ACCT_OPN}}</td>
                    </tr>
                    <tr>
                      <td>20</td>
                      <td>FUNDED NO OF ACCT OPN</td>
                      <td>{{$bob->FUNDED_NO_OF_ACCT_OPN}}</td>
                    </tr>
                    <tr>
                      <td>21</td>
                      <td>FUNDED COMM ACCT OPN</td>
                      <td>{{$bob->FUNDED_COMM_ACCT_OPN}}</td>
                    </tr>
                    <tr>
                      <td>22</td>
                      <td>TOTAL NO OF ACCT OPN</td>
                      <td>{{$bob->TOTAL_NO_OF_ACCT_OPN}}</td>
                    </tr>
                    <tr>
                      <td>23</td>
                      <td>TOTAL COMM ACCT OPN</td>
                      <td>{{$bob->TOTAL_COMM_ACCT_OPN}}</td>
                    </tr>
                    <tr>
                      <td>24</td>
                      <td>FINANCIAL TXN</td>
                      <td>{{$bob->FINANCIAL_TXN}}</td>
                    </tr>
                    <tr>
                      <td>25</td>
                      <td>TXN AMT</td>
                      <td>{{$bob->TXN_AMT}}</td>
                    </tr>
                    <tr>
                      <td>26</td>
                      <td>TXN COMM</td>
                      <td>{{$bob->TXN_COMM}}</td>
                    </tr>
                    <tr>
                      <td>27</td>
                      <td>Remmittance Count</td>
                      <td>{{$bob->Remmittance_Count}}</td>
                    </tr>
                    <tr>
                      <td>28</td>
                      <td>REMMITTANCE Rs10</td>
                      <td>{{$bob->Remmittance_Rs10}}</td>
                    </tr>
                    <tr>
                      <td>29</td>
                      <td>FIXED COMMISION</td>
                      <td>{{$bob->FIXED_COMMISION}}</td>
                    </tr>
                    <tr>
                      <td>30</td>
                      <td>APY COUNT</td>
                      <td>{{$bob->APY_COUNT}}</td>
                    </tr>
                    <tr>
                      <td>31</td>
                      <td>APY COMM</td>
                      <td>{{$bob->APY_COMM}}</td>
                    </tr>
                    <tr>
                      <td>32</td>
                      <td>SBY COUNT</td>
                      <td>{{$bob->SBY_COUNT}}</td>
                    </tr>
                    <tr>
                      <td>33</td>
                      <td>SBY COMM</td>
                      <td>{{$bob->SBY_COMM}}</td>
                    </tr>
                    <tr>
                      <td>34</td>
                      <td>JBY COUNT</td>
                      <td>{{$bob->JBY_COUNT}}</td>
                    </tr>
                    <tr>
                      <td>35</td>
                      <td>JBY COMM</td>
                      <td>{{$bob->JBY_COMM}}</td>
                    </tr>
                    <tr>
                      <td>36</td>
                      <td>TEN PER INCENTIVE FOR SSS</td>
                      <td>{{$bob->TEN_PER_INCENTIVE_FOR_SSS}}</td>
                    </tr>
                    <tr>
                      <td>37</td>
                      <td><b>NET COMMISSION</b></td>
                      <td><b>{{$bob->NET_COMMISSION}}</b></td>
                    </tr>
                    <tr>
                      <td>38</td>
                      <td><b>BC COMMISSION</b></td>
                      <td><b>{{$bob->BC_COMM}}</b></td>
                    </tr>
                    <tr>
                      <td>39</td>
                      <td><b>TDS</b></td>
                      <td><b>{{$bob->TDS}}</b></td>
                    </tr>
                    <tr>
                      <td>40</td>
                      <td><b>NET PAYBLE</b></td>
                      <td><b>{{$bob->NET_PAYBLE}}</b></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- /.col -->
        </div>
        @empty
        <p class="btn btn-outline-danger">No record found, Please enter valid input!</p>
        @endforelse
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
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