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
              <li class="breadcrumb-item"><a href="{{ route('openuser.searchSBI') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ route ('openuser.searchSBI')}}">Back</a></li>
              <!-- <li class="breadcrumb-item active">Dashboard</li> -->
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

  <section class="content">
      <div class="container-fluid">
        @forelse ($sbis->reverse() as $bob)
        <div class="row">
          <div class="col-12">
            <div class="card">
               <div class="card-header">
                <h3 class="card-title"><b>SBI Commission Month/Year: </b> {{ \Carbon\Carbon::parse($bob->month_year)->format('m-Y') }}</h3>
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
                      <td>CSP NAME</td>
                      <td>{{$bob->csp_name}}</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>CSP CODE</td>
                      <td>{{$bob->csp_code}}</td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>ACOP WITH 1000 ABOVE AVG BAL</td>
                      <td>{{$bob->acop_with_1k_above_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>ACOP WITH 1000 ABOVE SUM COMMISSION</td>
                      <td>{{$bob->acop_with_1k_above_sum_comm}}</td>
                    </tr>
                    <tr>
                      <td>5</td>
                      <td>ACOP WITH 100 BELOW AVG BAL</td>
                      <td>{{$bob->acop_with_hun_below_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>6</td>
                      <td>ACOP WITH 100 BELOW SUM COMMISSION</td>
                      <td>{{$bob->acop_with_hun_below_sum_comm}}</td>
                    </tr>
                    <tr>
                      <td>7</td>
                      <td>ACOP WITH B/W 100-499 AVG BAL</td>
                      <td>{{$bob->acop_with_btw_hun499_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>8</td>
                      <td>ACOP WITH B/W 100-499 SUM COMMISSION</td>
                      <td>{{$bob->acop_with_btw_hun499_sum_comm}}</td>
                    </tr>
                    <tr>
                      <td>9</td>
                      <td>ACOP WITH B/W 500-999 AVG BAL</td>
                      <td>{{$bob->acop_with_btw_five999_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>10</td>
                      <td>ACOP WITH B/W 500-999 SUM COMMISSION</td>
                      <td>{{$bob->acop_with_btw_five999_sum_comm}}</td>
                    </tr>
                    <tr>
                      <td>11</td>
                      <td>ACOP WITHOUT ABOVE 100 AVG BAL</td>
                      <td>{{$bob->acop_without_above_hun_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>12</td>
                      <td>ACOP WITHOUT ABOVE 100 SUM COMMISSION</td>
                      <td>{{$bob->acop_without_above_hun_sum_comm}}</td>
                    </tr>
                    <tr>
                      <td>13</td>
                      <td>ACOP WITHOUT BELOW 100 AVG BAL</td>
                      <td>{{$bob->acop_without_below_hun_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>14</td>
                      <td>ACOP WITHOUT BELOW 100 SUM COMMISSION</td>
                      <td>{{$bob->acop_without_below_hun_sum_comm}}</td>
                    </tr>
                    <tr>
                      <td>15</td>
                      <td>ADD INCENTIVE LWE DIST AVG BAL</td>
                      <td>{{$bob->add_incen_lwe_dist_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>16</td>
                      <td>ADD INCENTIVE LWE DIST SUM COMMISSION</td>
                      <td>{{$bob->add_incen_lwe_dist_sum_comm}}</td>
                    </tr>
                    <tr>
                      <td>17</td>
                      <td>ADD INCENTIVE NORTH-EAST DIST AVG BAL</td>
                      <td>{{$bob->add_incen_north_east_dist_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>18</td>
                      <td>ADD INCENTIVE NORTH-EAST DIST SUM COMMISSION</td>
                      <td>{{$bob->add_incen_north_east_dist_sum_comm}}</td>
                    </tr>
                    <tr>
                      <td>19</td>
                      <td>AEPS ACQ WITHDRAWL AVG BAL</td>
                      <td>{{$bob->aeps_acq_withdwl_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>20</td>
                      <td>AEPS ACQ WITHDRAWL SUM COMMISSION</td>
                      <td>{{$bob->aeps_acq_withdwl_sum_comm}}</td>
                    </tr>
                    <tr>
                      <td>21</td>
                      <td>AEPS MSTA ACQ UID AVG BALANCE</td>
                      <td>{{$bob->aeps_msta_acq_uid_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>22</td>
                      <td>AEPS MSTA ACQ UID SUM COMMISSION</td>
                      <td>{{$bob->aeps_msta_acq_uid_sum_comm}}</td>
                    </tr>
                    <tr>
                      <td>23</td>
                      <td>AEPS MSTA ONUS AVG BALANCE</td>
                      <td>{{$bob->aeps_msta_onus_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>24</td>
                      <td>AEPS MSTA ONUS SUM COMMISSION</td>
                      <td>{{$bob->aeps_msta_onus_sum_comm}}</td>
                    </tr>
                    <tr>
                      <td>25</td>
                      <td>AEPS ONUS FUNDTRASFER HOME AVG BALANCE</td>
                      <td>{{$bob->aeps_onus_fundtrnf_home_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>26</td>
                      <td>AEPS ONUS FUNDTRASFER HOME SUM COMMISSION</td>
                      <td>{{$bob->aeps_onus_fundtrnf_home_sum_comm}}</td>
                    </tr>
                    <tr>
                      <td>27</td>
                      <td>AEPS ONUS WITHDRWAL AVG BALANCE</td>
                      <td>{{$bob->aeps_onus_withdrwl_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>28</td>
                      <td>AEPS ONUS WITHDRWAL SUM COMMISSION</td>
                      <td>{{$bob->aeps_onus_withdrwl_sum_comm}}</td>
                    </tr>
                    <tr>
                      <td>29</td>
                      <td>AVG BALANCE MAINTAIN AVG BALANCE</td>
                      <td>{{$bob->aeps_onus_depo_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>30</td>
                      <td>AVG BALANCE MAINTAIN SUM COMMISSION</td>
                      <td>{{$bob->aeps_onus_depo_sum_comm}}</td>
                    </tr>
                    <tr>
                      <td>31</td>
                      <td>BBPS DTH AVG BALANCE</td>
                      <td>{{$bob->bbps_dth_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>32</td>
                      <td>BBPS DTH SUM COMMISSION</td>
                      <td>{{$bob->bbps_dth_sum_comm}}</td>
                    </tr>
                    <tr>
                      <td>33</td>
                      <td>CASH DEPOSIT AVG BALANCE</td>
                      <td>{{$bob->cash_deposit_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>34</td>
                      <td>CASH DEPOSIT SUM COMMISSION</td>
                      <td>{{$bob->cash_deposit_sum_comm}}</td>
                    </tr>
                    <tr>
                      <td>35</td>
                      <td>CASH WITHDRAWAL AVG BALANCE</td>
                      <td>{{$bob->cash_withdrwl_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>36</td>
                      <td>CASH WITHDRAWAL SUM COMMISSION</td>
                      <td>{{$bob->cash_withdrwl_sum_comm}}</td>
                    </tr>
                    <tr>
                      <td>37</td>
                      <td>DEBIT BLOCKED AVG BALANCE</td>
                      <td>{{$bob->debit_blocked_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>38</td>
                      <td>DEBIT BLOCKED SUM COMMISSION</td>
                      <td>{{$bob->debit_blocked_sum_comm}}</td>
                    </tr>
                    <tr>
                      <td>39</td>
                      <td>DEBIT OFFUS AVG BALANCE</td>
                      <td>{{$bob->debit_offus_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>40</td>
                      <td>DEBIT OFFUS SUM COMMISSION</td>
                      <td>{{$bob->debit_offus_sum_comm}}</td>
                    </tr>
                    <tr>
                      <td>41</td>
                      <td>debit_onus_avg_bal</td>
                      <td>{{$bob->debit_onus_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>42</td>
                      <td>debit_onus_sum_comm</td>
                      <td>{{$bob->debit_onus_sum_comm}}</td>
                    </tr>
                    <tr>
                      <td>43</td>
                      <td>ekyc_certi_for_ckyc_avg_bal</td>
                      <td>{{$bob->ekyc_certi_for_ckyc_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>44</td>
                      <td>ekyc_certi_for_ckyc_sum_comm</td>
                      <td>{{$bob->ekyc_certi_for_ckyc_sum_comm}}</td>
                    </tr>
                    <tr>
                      <td>45</td>
                      <td>fundtrnf_home_avg_bal</td>
                      <td>{{$bob->fundtrnf_home_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>46</td>
                      <td>fundtrnf_home_sum_comm</td>
                      <td>{{$bob->fundtrnf_home_sum_comm}}</td>
                    </tr>
                    <tr>
                      <td>47</td>
                      <td>fundtrnf_non_home_avg_bal</td>
                      <td>{{$bob->fundtrnf_non_home_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>48</td>
                      <td>fundtrnf_non_home_sum_comm</td>
                      <td>{{$bob->fundtrnf_non_home_sum_comm}}</td>
                    </tr>
                    <tr>
                      <td>49</td>
                      <td>green_pin_genrate_avg_bal</td>
                      <td>{{$bob->green_pin_genrate_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>50</td>
                      <td>green_pin_genrate_sum_comm</td>
                      <td>{{$bob->green_pin_genrate_sum_comm}}</td>
                    </tr>
                    <tr>
                      <td>51</td>
                      <td>imps_money_trnf_avg_bal</td>
                      <td>{{$bob->imps_money_trnf_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>52</td>
                      <td>imps_money_trnf_sum_comm</td>
                      <td>{{$bob->imps_money_trnf_sum_comm}}</td>
                    </tr>
                    <tr>
                      <td>53</td>
                      <td>loan_deposit_avg_bal</td>
                      <td>{{$bob->loan_deposit_avg_bal}}</td>
                    </tr>
                  
                    <tr>
                      <td>54</td>
                      <td>loan_deposit_sum_comm</td>
                      <td>{{$bob->loan_deposit_sum_comm}}</td>
                    </tr>
                    <tr>
                      <td>55</td>
                      <td>matm_mini_state_avg_bal</td>
                      <td>{{$bob->matm_mini_state_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>56</td>
                      <td>matm_mini_state_sum_comm</td>
                      <td>{{$bob->matm_mini_state_sum_comm}}</td>
                    </tr>
                    <tr>
                      <td>57</td>
                      <td>matm_onus_deposit_avg_bal</td>
                      <td>{{$bob->matm_onus_deposit_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>58</td>
                      <td>matm_onus_deposit_sum_comm</td>
                      <td>{{$bob->matm_onus_deposit_sum_comm}}</td>
                    </tr>
                    <tr>
                      <td>59</td>
                      <td>matm_onus_ftrnf_home_avg_bal</td>
                      <td>{{$bob->matm_onus_ftrnf_home_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>60</td>
                      <td>matm_onus_ftrnf_home_sum_comm</td>
                      <td>{{$bob->matm_onus_ftrnf_home_sum_comm}}</td>
                    </tr>
                       <tr>
                      <td>61</td>
                      <td>MONEY TRANSFER AVG BALANCE</td>
                      <td>{{$bob->money_trnf_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>62</td>
                      <td>MONEY TRANSFER SUM COMMISSION</td>
                      <td>{{$bob->money_trnf_sum_comm}}</td>
                    </tr>
                    <tr>
                      <td>63</td>
                      <td>PASSBOOK PRINT COST REIMBURS AVG BALANCE</td>
                      <td>{{$bob->pbook_print_cost_reimburs_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>64</td>
                      <td>PASSBOOK PRINT COST REIMBURS SUM COMMISSION</td>
                      <td>{{$bob->pbook_print_cost_reimburs_sum_comm}}</td>
                    </tr>
                    <tr>
                      <td>65</td>
                      <td>PASSBOOK PRINT AVG BALANCE</td>
                      <td>{{$bob->pbook_print_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>66</td>
                      <td>PASSBOOK PRINT SUM COMMISSION</td>
                      <td>{{$bob->pbook_print_sum_comm}}</td>
                    </tr>
                    <tr>
                      <td>67</td>
                      <td>PENALTY CSP INACT AVG BALANCE</td>
                      <td>{{$bob->penalty_csp_inact_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>68</td>
                      <td>PENALTY CSP INACT SUM COMMISSION</td>
                      <td>{{$bob->penalty_csp_inact_sum_comm}}</td>
                    </tr>
                    <tr>
                      <td>69</td>
                      <td>RD OPEN AVG BALANCE</td>
                      <td>{{$bob->rd_open_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>70</td>
                      <td>RD OPEN SUM COMMISSION</td>
                      <td>{{$bob->rd_open_sum_comm}}</td>
                    </tr>
                    <tr>
                      <td>71</td>
                      <td>RURAL COMMISSION AVG BALANCE</td>
                      <td>{{$bob->rural_comm_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>72</td>
                      <td>RURAL COMMISSION SUM COMMISSION</td>
                      <td>{{$bob->rural_comm_sum_comm}}</td>
                    </tr>
                    <tr>
                      <td>73</td>
                      <td>STDR OPEN AVG BALANCE</td>
                      <td>{{$bob->stdr_open_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>74</td>
                      <td>STDR OPEN SUM COMMISSION</td>
                      <td>{{$bob->stdr_open_sum_comm}}</td>
                    </tr>
                    <tr>
                      <td>75</td>
                      <td>YONO CASH AVG BALANCE</td>
                      <td>{{$bob->yono_cash_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>76</td>
                      <td>YONO CASH SUM COMMISSION</td>
                      <td>{{$bob->yono_cash_sum_comm}}</td>
                    </tr>
                     <tr>
                      <td>77</td>
                      <td>AVG BALANCE MAINTAIN AVG BALANCE</td>
                      <td>{{$bob->avg_bal_maintain_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>78</td>
                      <td>AVG BALANCE MAINTAIN SUM COMMISSION</td>
                      <td>{{$bob->avg_bal_maintain_sum_comm}}</td>
                    </tr>
                    <tr>
                      <td>79</td>
                      <td>CHEQUE ISSUE REQUEST AVG BALANCE</td>
                      <td>{{$bob->cheque_issue_request_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>80</td>
                      <td>CHEQUE ISSUE REQUEST SUM COMMISSION</td>
                      <td>{{$bob->cheque_issue_request_sum_comm}}</td>
                    </tr>
                    <tr>
                      <td>81</td>
                      <td>PMJJBY AVG BALANCE</td>
                      <td>{{$bob->pmjjby_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>82</td>
                      <td>PMJJBY SUM COMMISSION</td>
                      <td>{{$bob->pmjjby_sum_comm}}</td>
                    </tr>
                    <tr>
                      <td>83</td>
                      <td>PMSBY AVG BALANCE</td>
                      <td>{{$bob->pmsby_avg_bal}}</td>
                    </tr>
                    <tr>
                      <td>84</td>
                      <td>PMSBY SUM COMMISSION</td>
                      <td>{{$bob->pmsby_sum_comm}}</td>
                    </tr>
                    <tr>
                      <td>85</td>
                      <td><b>LOCATION TYPE</b></td>
                      <td><b>{{$bob->location_type}}</b></td>
                    </tr>
                    <tr>
                      <td>86</td>
                      <td><b>TOTAL AVG BALANCE</b></td>
                      <td><b>{{$bob->total_avg_bal}}</b></td>
                    </tr>
                    <tr>
                      <td>87</td>
                      <td><b>TOTAL SUM COMMISSION</b></td>
                      <td><b>{{$bob->total_sum_comm}}</b></td>
                    </tr>
                    <tr>
                      <td>88</td>
                      <td><b>CSP SHARE</b></td>
                      <td><b>{{$bob->bc_share}}</b></td>
                    </tr>
                      <tr>
                      <td>89</td>
                      <td><b>TDS</b></td>
                      <td><b>{{$bob->tds}}</b></td>
                    </tr>
                    <tr>
                      <td>90</td>
                      <td><b>NET PAYABLE</b></td>
                      <td><b>{{$bob->net_payable}}</b></td>
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