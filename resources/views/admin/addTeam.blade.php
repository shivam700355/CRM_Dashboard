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
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h5>Team List</h5>
                            <!-- Button to Open the Modal -->
                            <a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">
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
                    
                    <!-- Modal -->
                    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addUserModalLabel">Team List</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="regForm" action="{{ route('admin.saveTeam') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-12 mb-3">
                                                <label for="pro_id">Project Name:</label>
                                                <input type="hidden" id="added_by" name="added_by" value="{{ Auth::user()->id }}">
                                                <select class="form-control" id="pro_id" name="pro_id">
                                                    <option selected hidden disabled>Select here</option>
                                                    @foreach ($projects as $project)
                                                        <option value="{{ $project->id }}">{{ $project->p_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="name">Team Member Name:</label>
                                                <select class="form-control" id="named" name="name">
                                                    <option selected hidden disabled>Select here</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->name }}">{{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                                <font style="color:red">{{ $errors->has('name') ? $errors->first('name') : '' }} </font>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="description">Description:</label>
                                                <textarea class="form-control" rows="4" name="description" id="description" placeholder="Enter description"></textarea>
                                                <font style="color:red">
                                                    {{ $errors->has('description') ? $errors->first('description') : '' }} </font>
                                            </div>
                                        </div>
                                        <div class="form-group text-right">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->

                </div>
            </div>
        </section>
    </div>
@endsection
