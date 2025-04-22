@extends('layouts.app')
@push('style')
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="{{ asset('js/app.js') }}" type="text/js"></script>
@endpush
@section('content')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0">View Form</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('employee.index') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('employee.index') }}">Back</a></li>
            </ol>
          </div>
        </div>
      </div>
    </div>
   
    <section class="content">
      <div class="container-fluid">
      <div class="row justify-content-center">
      <div class="col-md-10">
        <h4 style="color:#3ea1e8;"><b>BC Details:-</b></h4>
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
            <th>No</th>
            <th>NAME</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>A_Mobile</th>
            <th>State</th>
            <th>District</th>
            <th>Bank</th>
            </tr>
          </thead>
          <tbody>
            <tr>
            <td >{{ $bcuser->ko_code }}</td>
            <td >{{ $bcuser->bc_name }}</td>
            <td >{{ $bcuser->fe_name }}</td>
            <td >{{ $bcuser->phone }}</td>
            <td >{{ $bcuser->alternate_no }}</td>
            <td >{{ $bcuser->state }}</td>
            <td >{{ $bcuser->district }}</td> 
            <td >{{ $bcuser->bank_name }}</td>                    
            </tr>
          </tbody>
        </table>

        <div class="row">
          <div class="form-inline col-sm-7">
            <form action="{{ route('employee.save', $bcuser->id) }}" method="post" enctype="multipart/form-data">
              @csrf
              <input type="text" class="form-control" id="bcu_id" name="bcu_id" value="{{ $bcuser->id }}" hidden> 
              <div class="form-row align-items-center">
                <div class="col-auto">
                  <label >Issue</label>
                  <div class="input-group mb-2">
                    <select class="form-control dropdown-toggle" id="issue" name="issue">
                      <option value="">Select</option>
                      <option value="Login Issue">Login Issue</option>
                      <option value="Software Installation">Software Installation</option>
                      <option value="Perry Service">Perry Service</option>
                      <option value="Account Opening">Account Opening</option>
                      <option value="Transaction Issue">Transaction Issue</option>
                      <option value="Pin-Pad Installation">Pin-Pad Installation</option>
                      <option value="Passbook Printer">Passbook Printer</option>
                      <option value="Unique-id Generation">Unique-id Generation</option>
                      <option value="RD and FD Issue">RD and FD Issue</option>
                      <option value="Insurance">Insurance</option>
                      <option value="Server Issue">Server Issue</option>
                    </select>
                  </div>
                </div>
                <div class="col-auto">
                  <label >Attend By</label>
                  <div class="input-group mb-2">
                    <select class="form-control dropdown-toggle" id="attend_by" name="attend_by">
                      <option value="">Select Name</option>
                      <option value="Abhishek Kumar">Abhishek Kumar</option>
                      <option value="Arvind Kumar">Arvind Kumar</option>
                      <option value="Anurashi">Anurashi</option>
                      <option value="Babita Mishra">Babita Mishra</option>
                      <option value="Digvijay Patil">Digvijay Patil</option>
                      <option value="Vishal Srivastava">Vishal Srivastava</option>
                    </select>
                  </div>
                </div>
                <div class="col-auto">
                  <button type="submit" class="btn btn-primary">Submit</button> 
                </div>
              </div>
            </form>
          </div>

          <div class="form-inline col-sm-5">
            <form action="{{ route('tech.savePhone', $bcuser->id) }}" method="post" enctype="multipart/form-data"><br>
              @csrf 
              <input type="text" class="form-control" id="bcu_id" name="bcu_id" value="{{ $bcuser->id }}" hidden>
              <div class="col-auto">
                <label >Update Phone</label>
                <div class="input-group mb-2">
                  <input type="text" class="form-control" name="alternate_no" id="alternate_no" value="{{$bcuser->alternate_no}}">
                </div>
              </div>
                <div class="col-auto">
                  <input type="submit" class="btn btn-primary" value="Update">
                </div>
            </form>
          </div>
        </div>

        <h5 style="color:palevioletred;"><b>BC Case-History:-</b></h5>
        @forelse ($allbcusers as $bcuser)
        <div><strong>S.No: </strong>{{ $loop->index + 1 }}</div>
        <div class="form-group row">
        <div class="col-4"><strong>Call Status: </strong>{{ $bcuser->call_status }}</div>
        <div class="col-4"><strong>Attended By: </strong>{{ $bcuser->attend_by }}</div>
        <div class="col-4"><strong>Issue: </strong>{{ $bcuser->issue }}</div>
        <div class="col-4"><strong>Open Date: </strong>{{$bcuser->created_at}}</div>
        <div class="col-4"><strong>Close Date: </strong>{{$bcuser->call_close}}</div>
        <!-- <div class="col-4"><strong>Difference: </strong></div> -->
        <div class="col-12"><strong>Remark: </strong>{{$bcuser->remark}}<br/><br/></div>
        </div>
        @empty
          <p class="btn btn-outline-danger">No record found, Please enter valid input!</p>
        @endforelse
      </div>
        </div>
      </div>
    </section>
    <script type="text/javascript">
      $('#call_close').datetimepicker({
      });
    </script>
</div>
@endsection