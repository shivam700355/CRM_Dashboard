@extends('layouts.app')
@push('style')
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<script src="jquery/1.9.1/jquery.js"></script>
<link rel="stylesheet" href="3.3.6/css/bootstrap.min.css">
<!-- <link href="http://meyerweb.com/eric/tools/css/reset/reset.css" rel="stylesheet" />-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
@endpush
@section('content')
<div class="content-wrapper">
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3 class="m-0">Add User</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div>
  </div>
  <section class="content">
    <div class="container-fluid">   
      <div class="col-md-10">
        <body>
        <form id="regForm" action="{{ route('admin.save') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group row">
            <div class="col-3">
              <label for="">Name:</label>
              <input type="text" class="form-control" id='name' name="name" placeholder="Enter name">
              <font style="color:red">{{ $errors->has('name') ?  $errors->first('name') : '' }} </font>
            </div>
            <div class="col-3">
              <label for="">Email:</label>
              <input type="email" class="form-control" id='email' name="email" placeholder="Enter email">
            </div>
            <div class="col-4">
              <label for="">Password:</label>
              <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
              <font style="color:red"> {{ $errors->has('password') ?  $errors->first('password') : '' }} </font>
            </div>
            <div class="col-3">
              <label for="">Mobile:</label>
              <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Enter mobile">
            </div> 
            <div class="col-4">
              <label for="">Vertical:</label>
              <select class="form-control dropdown-toggle" id="vertical" name="vertical">
              <option selected hidden disabled>Select here</option>
              <option value="1">Training</option>
              <option value="2">Consultancy</option>
              <option value="3">Finance</option>
              <option value="4">Retail</option>
              <option value="5">Human Resource</option>
              </select>
            </div>
            <div class="col-3">
              <label for="">Role:</label>
              <select class="form-control dropdown-toggle" id="role" name="role">
              <option selected hidden disabled>Select here</option>
              <option value="1">Director</option>
              <option value="2">Admin</option>
              <option value="3">Vertical Head</option>
              <option value="4">Team Member</option>
              <option value="5">Other Member</option>
              </select>
            </div> 
          </div>
          <div style="float:right;">
              <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
        </body>
      </div> 
    </div>
  </section>
</div>
@endsection