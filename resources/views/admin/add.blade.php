@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="pagetitle d-flex align-items-center justify-content-between">
            <div>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                        <li class="breadcrumb-item active">Project</li>
                    </ol>
                </nav>
            </div>
        </div>
        @if (session('error'))
        <div class="alert alert-danger" id="danger-alert">
            {{ session('error') }}
        </div>
      @elseif (session('success'))
        <div class="alert alert-success" id="success-alert">
            {{ session('success') }}
        </div>
      @endif
      
        <section class="content">
          <div class="row">
              <div class="col-md-12">
                  <div class="card">
                      <!-- Card Header with Right Add Button -->
                      <div class="card-header d-flex justify-content-between">
                          <h5 >User List</h5>
                          <a class="btn btn-primary btn-sm " data-bs-toggle="modal" data-bs-target="#addUserModal">
                            <i class="bi bi-plus"></i>
                          </a>
                      </div>
      
                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-hover datatable border">
                                  <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>Name</th>
                                          <th>Email</th>
                                          <th>Mobile</th>
                                          <th>Role</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @forelse ($users as $us)
                                          <tr>
                                              <td>{{ $loop->index + 1 }}</td>
                                              <td>{{ $us->name }}</td>
                                              <td>{{ $us->email }}</td>
                                              <td>{{ $us->mobile }}</td>
                                              <td>
                                                  @if ($us->role == 3)
                                                      Vertical Head
                                                  @else
                                                      Spoc
                                                  @endif
                                              </td>
                                          </tr>
                                      @empty
                                          <p class="btn btn-outline-danger">No record found, Please enter valid input!</p>
                                      @endforelse
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      
      <!-- Add User Modal -->
      <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
          <div class="modal-dialog ">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <!-- Form Inside Modal -->
                      <form class="row g-3" id="regForm" action="{{ route('admin.save') }}" method="post" enctype="multipart/form-data">
                          @csrf
                          <input type="hidden" id="added_by" name="added_by" value="{{ Auth::user()->id }}">
                          <div class="col-md-6">
                              <label for="name">Name:</label>
                              <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                              <font style="color:red">{{ $errors->has('name') ? $errors->first('name') : '' }}</font>
                          </div>
                          <div class="col-md-6">
                              <label for="email">Email:</label>
                              <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                          </div>
                          <div class="col-md-6">
                              <label for="password">Password:</label>
                              <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
                              <font style="color:red">{{ $errors->has('password') ? $errors->first('password') : '' }}</font>
                          </div>
                          <div class="col-md-6">
                              <label for="mobile">Mobile:</label>
                              <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Enter mobile">
                          </div>
                          <div class="col-md-6">
                              <label for="vertical">Vertical:</label>
                              <select class="form-control" id="vertical" name="vertical">
                                  <option selected hidden disabled>Select here</option>
                                  <option value="1">Training</option>
                                  <option value="2">Consultancy</option>
                                  <option value="3">Finance</option>
                                  <option value="4">Retail</option>
                                  <option value="5">Human Resource</option>
                              </select>
                          </div>
                          <div class="col-md-6">
                              <label for="role">Role:</label>
                              <select class="form-control" id="role" name="role">
                                  <option selected hidden disabled>Select here</option>
                                
                                  <option value="3">Vertical Head</option>
                                  <option value="4">Spoc Member</option>
                                
                              </select>
                          </div>
                          <div class="text-center">
                              <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
      
    </div>
@endsection
