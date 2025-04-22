
@extends('layouts.app')
@push('style')
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<script src="{{ asset('js/app.js') }}" type="text/js"></script>

@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
          
          <div class="form-group" style="margin-top: 24px;">
          <a href="{{ route('superadmin.list') }}" class="btn btn-success">Back</a>
          <a href="{{ route('superadmin.list') }}" class="btn btn-success" style="float: right; display: block;"> BC LIST</a>
          </div>
          <legend style="color: #38c172; font-weight: bold;">BC Details</legend>
          
        <h4><b>Personal Detail:-</b></h4>
          <div class="form-group row">
          <div class="col-4"><strong>FE Name: </strong>{{$bcuser->fe_name}}</div>
          <div class="col-4"><strong>BC Name: </strong>{{ $bcuser->bc_name }}</div>
          <div class="col-4"><strong>Email: </strong>{{$bcuser->email}}</div>
          <div class="col-4"><strong>Date of Birth: </strong>{{$bcuser->dob}}</div>
          <div class="col-4"><strong>Phone: </strong>{{ $bcuser->phone }}</div>
          <div class="col-4"><strong>Zone: </strong>{{$bcuser->zone}}</div>
          <div class="col-4"><strong>District: </strong>{{$bcuser->district}}</div>
          <div class="col-4"><strong>Sub-District: </strong>{{ $bcuser->sub_district }}</div>
          <div class="col-4"><strong>Region: </strong>{{$bcuser->region}}</div>
          <div class="col-4"><strong>Block: </strong>{{$bcuser->block}}</div>
          <div class="col-4"><strong>Outlet Location: </strong>{{ $bcuser->outlet_loc }}</div>
          <div class="col-4"><strong>Aadhaar: </strong>{{$bcuser->aadhaar}}</div>
          <div class="col-4"><strong>PAN: </strong>{{ $bcuser->pan }}</div>
          </div>
        <br/>
            
        <h4><b>Permanent Address:-</b></h4>
          <div class="form-group row">
          <div class="col-4"><strong>Address: </strong>{{$bcuser->address}}</div>
          <div class="col-4"><strong>Address2: </strong>{{$bcuser->address2}}</div>
          <div class="col-4"><strong>City: </strong>{{$bcuser->city}}</div>
          <div class="col-4"><strong>Post office: </strong>{{$bcuser->post_office}}</div>
          <div class="col-4"><strong>State: </strong>{{$bcuser->state}}</div>
          <div class="col-4"><strong>Pin Code: </strong>{{$bcuser->pin_code}}</div>
          </div>
        <br/>
             
        <h4><b>Professional Detail:-</b></h4>
          <div class="form-group row">
          <div class="col-4"><strong>Sol ID: </strong>{{ $bcuser->sol_id }}</div>
          <div class="col-4"><strong>Cust ID: </strong>{{$bcuser->cust_id}}</div>
          <div class="col-4"><strong>IIBF Status: </strong>{{$bcuser->iibf_status}}</div>
          <div class="col-4"><strong>Certificate Status: </strong>{{ $bcuser->certi_status }}</div>
          <div class="col-4"><strong>DRA Status: </strong>{{$bcuser->dra_status}}</div>
          <div class="col-4"><strong>Pax Status: </strong>{{$bcuser->pax_status}}</div>
          <div class="col-4"><strong>Job Status: </strong>{{ $bcuser->job_status }}</div>
          <div class="col-4"><strong>Police Verification: </strong>{{$bcuser->police_verify}}</div>
          <div class="col-4"><strong>UFS Agreement: </strong>{{$bcuser->ufs_agreement}}</div>
          <div class="col-8"><strong>Remark: </strong>{{$bcuser->agreement_remark}}</div>
          </div>
        <br/>
           
        <h4><b>Financial Detail:-</b></h4>
          <div class="form-group row">
          <div class="col-4"><strong>Bank Name: </strong>{{ $bcuser->bank_name }}</div>
          <div class="col-4"><strong>KO Code: </strong> {{$bcuser->ko_code}}</div>
          <div class="col-4"><strong>Link Branch Name: </strong>{{$bcuser->link_branch}}</div>
          <div class="col-4"><strong>Account No: </strong>{{$bcuser->account_no}}</div>
          <div class="col-4"><strong>Saving Account: </strong>{{$bcuser->saving_ac}} </div>
          <div class="col-4"><strong>IFSC Code: </strong>{{ $bcuser->ifsc_code }}</div>
          <div class="col-4"><strong>Activation Approval: </strong>{{$bcuser->approval}}</div>
          <div class="col-4"><strong>Amount: </strong>{{$bcuser->amount}}</div>
          <div class="col-4"><strong>Payment Date: </strong>{{$bcuser->payment_date}}</div>
          <div class="col-4"><strong>Payment Status: </strong>{{ $bcuser->payment_status }}</div>
          <div class="col-4"><strong>UTR No.: </strong> {{$bcuser->utr_no}}</div>
          <div class="col-4"><strong>Branding Status: </strong>{{ $bcuser->branding_status }}</div>
          <div class="col-4"><strong>OD Account: </strong>{{ $bcuser->od_account }}</div>
          <div class="col-4"><strong>Request Sent Date: </strong> {{$bcuser->request_sent_date}}</div>
          <div class="col-4"><strong>KO Creation Date: </strong>{{$bcuser->ko_creation_date}}</div>
          <div class="col-4"><strong>Payment Bank Name: </strong>{{$bcuser->branch_name}} </div>
          <div class="col-4"><strong>Installation Done by: </strong>{{$bcuser->installation_done_by}}</div>
          <div class="col-4"><strong>Installation Date: </strong>{{$bcuser->installation_date}}</div>
          <div class="col-4"><strong>Dispatch Date: </strong>{{$bcuser->dispatch_date}}</div>
          <div class="col-4"><strong>Village Code: </strong>{{$bcuser->village_code}} </div>
          <div class="col-4"><strong>Location Type: </strong>{{$bcuser->location_type}}</div>
          <div class="col-4"><strong>Mandate Type: </strong>{{$bcuser->mandate_type}}</div>
          <div class="col-4"><strong>Latitude: </strong>{{$bcuser->latitude}}</div>
          <div class="col-4"><strong>Longitude: </strong>{{$bcuser->longitude}}</div>
          </div>
                       
        </div>
    </div>
</div>
@endsection
 