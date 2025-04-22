@extends('layouts.app')

@section('content')
<div class="pagetitle d-flex align-items-center justify-content-between">
    <div>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('vertical.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Team</li>
            </ol>
        </nav>
    </div>

</div>
<!-- End Page Title -->

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
        <div class="col-lg-12">
            <!-- Team Table -->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Team</h5>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addTeamModal">
                            <i class="bi bi-plus"></i>
                        </button>
                    </div>
                    <table class="table datatable border">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Project Name</th>
                                <th>Description</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($teamData as $index => $datas)
                                <tr>
                                    <th>{{ $index + 1 }}</th>
                                    <td>{{ $datas['tname'] }}</td>
                                    <td>{{ $datas['project_name'] }}</td>
                                    <td>{{ $datas['description'] }}</td>

                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#editTeamModal"
                                            onclick="populateEditModal('{{ $datas['id'] }}', '{{ $datas['tname'] }}', '{{ $datas['pro_id'] }}', '{{ $datas['description'] }}')">
                                            <i class="ri-edit-2-fill"></i>
                                        </a>
                                        <a href="#"
                                            onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this item?')) { document.getElementById('delete-form-{{ $datas['id'] }}').submit(); }"
                                            class="btn btn-sm btn-danger">
                                            <i class="ri-delete-bin-6-line"></i>
                                        </a>
                                        <form id="delete-form-{{ $datas['id'] }}"
                                            action="{{ route('vertical.deleteteam', $datas['id']) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-danger">No record found, please enter
                                        valid input!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal for Adding Team -->
<div class="modal fade" id="addTeamModal" tabindex="-1" aria-labelledby="addTeamModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTeamModalLabel">Add Team</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="regForm" action="{{ route('vertical.saveTeam') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="added_by" name="added_by" value="{{ Auth::user()->id }}">

                    <div class="mb-3">
                        <label for="name" class="form-label">Team Name:</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Example...Calling, Field, Back-office" value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <div class="text-danger">{{ $errors->first('name') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="pro_id" class="form-label">Project Name:</label>
                        <select class="form-select" id="pro_id" name="pro_id">
                            <option selected hidden disabled>Select here</option>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}" {{ old('pro_id') == $project->id ? 'selected' : '' }}>
                                    {{ $project->p_name }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('pro_id'))
                            <div class="text-danger">{{ $errors->first('pro_id') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description:</label>
                        <textarea class="form-control" rows="4" name="description" id="description"
                            placeholder="Enter team description">{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                            <div class="text-danger">{{ $errors->first('description') }}</div>
                        @endif
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of Modal -->

<!-- Modal for Editing Team -->
<div class="modal fade" id="editTeamModal" tabindex="-1" aria-labelledby="editTeamModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTeamModalLabel">Edit Team</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="{{ route('vertical.editTeam') }}" method="post">
                    @csrf
                    <input type="hidden" id="edit_team_id" name="id">

                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Team Name:</label>
                        <input type="text" class="form-control" id="edit_name" name="name"
                            placeholder="Example...Calling, Field, Back-office">
                        @if ($errors->has('name'))
                            <div class="text-danger">{{ $errors->first('name') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="edit_pro_id" class="form-label">Project Name:</label>
                        <select class="form-select" id="edit_pro_id" name="pro_id">
                            <option selected hidden disabled>Select here</option>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->p_name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('pro_id'))
                            <div class="text-danger">{{ $errors->first('pro_id') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Description:</label>
                        <textarea class="form-control" rows="4" name="description" id="edit_description"
                            placeholder="Enter team description"></textarea>
                        @if ($errors->has('description'))
                            <div class="text-danger">{{ $errors->first('description') }}</div>
                        @endif
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- End of Modal -->

<!-- Script for Auto-Dismissing Alerts -->
<script>
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

    function populateEditModal(id, name, pro_id, description) {
        document.getElementById('edit_team_id').value = id;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_description').value = description;

        // Set the selected project in the dropdown
        var projectSelect = document.getElementById('edit_pro_id');
        for (var i = 0; i < projectSelect.options.length; i++) {
            if (projectSelect.options[i].value == pro_id) {
                projectSelect.options[i].selected = true;
                break;
            }
        }
    }
</script>


@endsection