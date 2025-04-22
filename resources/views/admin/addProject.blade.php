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
            <h3 class="m-0">Add Project</h3>
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
        <form id="regForm" action="{{ route('admin.saveProject') }}" method="post" enctype="multipart/form-data">
             @csrf
  <!--<div class="form-row">-->
  <!--  <div class="form-group col-md-6">-->
  <!--    <label for="inputEmail4">Email</label>-->
  <!--    <input type="email" class="form-control" id="inputEmail4" placeholder="Email">-->
  <!--  </div>-->
  <!--  <div class="form-group col-md-6">-->
  <!--    <label for="inputPassword4">Password</label>-->
  <!--    <input type="password" class="form-control" id="inputPassword4" placeholder="Password">-->
  <!--  </div>-->
  <!--</div>-->
  <!--<div class="form-group">-->
  <!--  <label for="inputAddress">Address</label>-->
  <!--  <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">-->
  <!--</div>-->
  
  <div class="form-row">
    <div class="form-group col-md-5">
      <label for="">Project Name:</label>
      <input style="display: none;" id="added_by" name="added_by" value="{{ Auth::user()->id }}"></input>
      <input type="text" class="form-control" id='p_name' name="p_name" placeholder="Enter p_name">
      <font style="color:red">{{ $errors->has('p_name') ?  $errors->first('p_name') : '' }} </font>
    </div>
    <div class="form-group col-md-5">
       <label for="">Team Member:</label>
      <!-- <input type="text" class="form-control" name="n_spoc" id="n_spoc" > -->
      <select class="form-control dropdown-toggle" id="n_spoc" name="n_spoc">
        <option selected hidden disabled>Select here</option>
        @foreach ($users as $user)
          <option value="{{ $user->id }}">{{ $user->name }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group col-md-10">
      <label for="">Project Details:</label>
        <textarea type="text" class="form-control" row='6' id='p_details' name="p_details" placeholder="Enter p_details"></textarea>
    </div>
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
      </div> 
    </div>
  </section>
</div>
@endsection