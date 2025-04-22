@php
    $profile = ['name' => $authdata['name'], 'role' => $authdata['role']];
    $dataCollection = collect($data); // Convert the $data array to a collection
@endphp
@extends('layouts.app', $profile)
@section('content')
<div class="pagetitle d-flex align-items-center justify-content-between">
    <div>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('spoc') }}">Home</a></li>
                <li class="breadcrumb-item active">Project</li>
            </ol>
        </nav>
    </div>
</div>
<!-- End Page Title -->

@if (session('error'))
    <div class="alert alert-danger" id="danger-alert">{{ session('error') }}</div>
@elseif (session('success'))
    <div class="alert alert-success" id="success-alert">{{ session('success') }}</div>
@endif

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Project Status</h4>
                    <div class="table-responsive">
                        <table class="table table-hover datatable border">
                            <thead class="bg-secondary text-light">
                                <tr>
                                    <th>S.No</th>
                                    <th>Name</th>
                                    {{-- <th>Vertical Name</th> --}}
                                    <th>FY</th>
                                    <th>Target </th>
                                    <th>Completed</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['projects'] as $project)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $project['name'] }}</td>
                                        <td>{{ $project['f_year'] }}</td>
                                        <td>{{ $project['p_target'] }} </td>
                                        <td onclick="updateProjectStatus('{{ $project['p_status'] }}', '{{ $project['id'] }}')"
                                            data-bs-toggle="modal" data-bs-target="#statusModal">
                                            <a class="btn-sm btn-primary"
                                                style="cursor:pointer">{{ $project['p_status'] }}<i
                                                    class="bx bxs-edit"></i></a>
                                        </td>
                                        <td>
                                            <a href="{{ url('spoc/project/' . $project['id']) }}"
                                                class="btn btn-sm btn-primary"><i class="bi bi-eye"></i></a>
                                            <a href="#" class="btn btn-sm btn-success upload-btn" data-bs-toggle="modal"
                                                data-bs-target="#uploadModal" data-project-id="{{ $project['id'] }}"
                                                data-project-name="{{ $project['name'] }}"><i class="bi bi-upload"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Upload Files</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Modal Form -->
                <form action="{{ route('spoc.saveMedia') }}" method="post" enctype="multipart/form-data"
                    class="needs-validation" novalidate>
                    @csrf
                    <input type="hidden" value="{{ $authdata['id'] }}" name="added_by">
                    <input type="hidden" name="project_id" id="project_id" value="">

                    <div class="mb-3">
                        <label for="project_name" class="form-label">Project Name</label>
                        <input type="text" class="form-control" id="project_name" name="project_name" readonly disabled>
                        <div class="invalid-feedback">
                            Please select a Project.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="upload" class="form-label">Upload</label>
                        <input type="file" class="form-control" id="upload" name="image_files[]" multiple required>
                        <div class="invalid-feedback">
                            Please provide a file.
                        </div>
                    </div>

                    <input type="hidden" name="vass_id" id="vass_id" value="0">
                    <input type="hidden" value="1" name="type" id="type">

                    <div class="mb-3">
                        <label for="remark" class="form-label">Remark</label>
                        <textarea id="remark" class="form-control" name="remark" rows="3"></textarea>
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary rounded-pill">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel">Update Project Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="statusForm" action="{{ route('spoc.updatedpstatus') }}" method="POST">
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var uploadButtons = document.querySelectorAll('.upload-btn');

        uploadButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var projectId = this.getAttribute('data-project-id');
                var projectName = this.getAttribute('data-project-name');

                document.getElementById('project_id').value = projectId;
                document.getElementById('project_name').value = projectName;
            });
        });
    });
    setTimeout(function () {
        let successAlert = document.getElementById('success-alert');
        if (successAlert) {
            successAlert.style.display = 'none';
        }
        let dangerAlert = document.getElementById('danger-alert');
        if (dangerAlert) {
            dangerAlert.style.display = 'none';
        }
    }, 3000);
</script>



<script>
    function updateProjectStatus(p_status, project_id) {
        // Set the input field values
        console.log(p_status, project_id);
        document.getElementById('p_status').value = p_status;
        document.getElementById('pid').value = project_id;
    }
</script>
@endsection