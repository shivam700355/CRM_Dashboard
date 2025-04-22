@extends('layouts.app')
@section('content')

<div class="pagetitle d-flex align-items-center justify-content-between">
  <div>
  <nav>
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Home</li>
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
        <div class="card-header">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link active" id="user-list-tab" data-bs-toggle="tab" href="#userList" role="tab" aria-controls="userList" aria-selected="true">User List</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="project-list-tab" data-bs-toggle="tab" href="#projectList" role="tab" aria-controls="projectList" aria-selected="false">Project List</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="team-list-tab" data-bs-toggle="tab" href="#teamList" role="tab" aria-controls="teamList" aria-selected="false">Team List</a>
            </li>
          </ul>
        </div>
        <div class="card-body">
          <div class="tab-content" id="myTabContent">
            <!-- User List Tab -->
            <div class="tab-pane fade show active" id="userList" role="tabpanel" aria-labelledby="user-list-tab">
              <div class="table-responsive">
                <table class="table table-hover datatable border">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Mobile</th>
                      <th>Role</th>
                   
                  </thead>
                  <tbody>
                    @forelse ($users as $us)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $us->name }}</td>
                      <td>{{ $us->email }}</td>
                      <td>{{ $us->mobile }}</td>
                      <td>
                        @if($us->role == 3)
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

            <!-- Project List Tab -->
            <div class="tab-pane fade" id="projectList" role="tabpanel" aria-labelledby="project-list-tab">
              <div class="table-responsive">
                <table class="table table-hover datatable border">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Project Name</th>
                      <th>Details</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($projects as $us)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $us->p_name }}</td>
                      <td>{{ $us->p_details }}</td>
                    </tr>
                    @empty
                      <p class="btn btn-outline-danger">No record found, Please enter valid input!</p>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Team List Tab -->
            <div class="tab-pane fade" id="teamList" role="tabpanel" aria-labelledby="team-list-tab">
              <div class="table-responsive">
                <table class="table table-hover datatable border">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Name</th>
                      <th>Description</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($teams as $us)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $us->name }}</td>
                      <td>{{ $us->description }}</td>
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
    </div>
  </div>
</section>

@endsection
