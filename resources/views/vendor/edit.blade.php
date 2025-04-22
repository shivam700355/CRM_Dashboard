@extends('layouts.app')
@push('style')
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
@endpush
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3 class="m-0">BC Update Form</h3>
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
    <div class="row justify-content-center">
      <div class="col-md-10">
        <!--  <div class="form-group" style="float: right;">
            <a href="{{ route('tech.list') }}" class="btn btn-success">Back</a>
        </div> -->
        @if(session()->has('message'))
          <p class="btn btn-success btn-block btn-sm custom_message text-left">{{ session()->get('message') }}</p>
        @endif
        <!-- <legend style="color: green; font-weight: bold;">BC Update Form </legend> -->
    <form action="{{ route('tech.update',$complaint->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
      <div class="form-group row">
        <div class="col-3">
          <label >Issue</label>
          <select class="form-control dropdown-toggle" id="issue" name="issue">
            <option value="{{$complaint->issue}}">{{$complaint->issue}}</option>
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
        <div class="col-3">
          <label for="">Attend By:</label>
          <select class="form-control dropdown-toggle" id="attend_by" name="attend_by">
            <option value="{{$complaint->attend_by}}">{{$complaint->attend_by}}</option>
              <option value="Abhishek Kumar">Abhishek Kumar</option>
              <option value="Arvind Kumar">Arvind Kumar</option>
              <option value="Anurashi">Anurashi</option>
              <option value="Babita Mishra">Babita Mishra</option>
              <option value="Digvijay Patil">Digvijay Patil</option>
              <option value="Vishal Srivastava">Vishal Srivastava</option>
          </select>
        </div>
        <div class="col-3">
          <label >Call Status:</label>
          <select class="form-control dropdown-toggle" id="call_status" name="call_status">
          <option value="{{$complaint->call_status}}">{{$complaint->call_status}}</option>
          <option value="Open">Open</option>
          <option value="Pending at Bank-end">Pending at Bank-end</option>
          <option value="Pending at BC-end">Pending at BC-end</option>
          <option value="Pending at Technical team">Pending at Technical team</option>
          <option value="Resolved">Resolved</option>
          <option value="Work-in-Progress">Work-in-Progress</option>
          </select>
        </div>
        <div class="col-3">
          <label for="">Call Close:</label>
          <input type="texts" class="form-control" name="call_close" id="call_close" value="{{$complaint->call_close}}">
        </div>
            
        <div class="col-12">
          <label for=""><br>Remark:</label>
          <textarea type="text" rows="3" class="form-control" name="remark" id="remark" value="{{$complaint->remark}}"></textarea>
        </div>
        </div> 
        <div class="form-group" style="margin-top: 24px;">
          <input type="submit" class="btn btn-success" value="Update">
        </div>
    </form>
      </div>
    </div>
  </div>
</section>
</div>
@endsection
 