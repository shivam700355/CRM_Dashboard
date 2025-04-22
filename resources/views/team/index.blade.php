@php
$profile = ['name' => $data['name'], 'role' => $data['role']];
@endphp
@extends('layouts.app', $profile)

@section('content')
<div class="pagetitle d-flex align-items-center justify-content-between">
    <div>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('team.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Team</li>
            </ol>
        </nav>
    </div>
    <!-- <div>
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTeamModal">Upload Report</a>
    </div> -->
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
<section class="section">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Project Overview</h5>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addTeamModal">
                            <i class="bi bi-plus"></i>
                        </button>
                    </div>
                    <!-- Added Card Header Title -->
                    <div class="table-responsive">
                        <table class="table datatable border table-striped" style="font-size: 15px">
                            <thead class="bg-secondary text-light">
                                <tr>
                                    <th>No</th>
                                    <th>Project Name</th>
                                    <th>Financial Year</th>
                                    <th>Target</th>
                                    <th>Completed</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($projects as $pro)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $pro->p_name }}</td>
                                    <td>{{ $pro->f_year }}</td>
                                    <td>{{ $pro->p_target }} </td>
                                    <td onclick="updateProjectStatus('{{ $pro->p_status}}', '{{ $pro->id}}')"
                                        data-bs-toggle="modal" data-bs-target="#statusModal">
                                        <a class="btn-sm btn-primary" style="cursor:pointer">{{ $pro->p_status
                                            }}<i class="bx bxs-edit"></i></a>
                                    </td>
                                    <td>
                                        <a href="/team/getProject/{{ $pro->id }}" class="btn btn-sm btn-primary">
                                            <i class="bx bxs-report"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center btn btn-outline-danger">No record found. Please
                                        enter valid input!</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="addTeamModal" tabindex="-1" aria-labelledby="addTeamModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTeamModalLabel">Upload Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('team.saveUpload') }}" method="post" enctype="multipart/form-data"
                        class="needs-validation" novalidate>
                        @csrf
                        <input type="hidden" value="{{ $authId }}" name="added_by">

                        <div class="row">
                            <!-- Project Name -->
                            <div class="col-md-12 mb-3">
                                <label for="project_id" class="form-label">Project Name</label>
                                <select class="form-select" name="project_id" id="project_id" required
                                    onchange="getVendors(this.value)">
                                    <option selected hidden disabled>Project Name</option>
                                    @foreach ($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->p_name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Please select a Project.
                                </div>
                            </div>

                            <!-- File Upload -->
                            <div class="col-md-12 mb-3">
                                <label for="upload" class="form-label">Upload</label>
                                <input type="file" class="form-control" id="upload" name="image_files[]" multiple
                                    required>
                                <div class="invalid-feedback">
                                    Please provide a file.
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="vass_id" id="vass_id" required value="0">
                        <input type="hidden" value="1" name="type" id="type" required>

                        <!-- Remark -->
                        <div class="mb-3">
                            <label for="remark" class="form-label">Remark</label>
                            <textarea id="remark" class="form-control" name="remark" rows="3"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary rounded-pill col-md-6"
                                id="submit">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">Update Project Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="statusForm" action="{{ route('team.updatedpstatus') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="p_status" class="form-label">Project Status</label>
                            <input type="text" class="form-control" id="p_status" name="p_status">
                            <input type="hidden" id="pid" name="pid">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


<script>
    function updateProjectStatus(p_status, project_id) {
        console.log(p_status, project_id);
        document.getElementById('p_status').value = p_status;
        document.getElementById('pid').value = project_id;
    }


</script>

@endsection