@php
    $profile = ['name' => $authdata['name'], 'role' => $authdata['role']];
@endphp

@extends('layouts.app')

@section('content')
<div class="pagetitle d-flex align-items-center justify-content-between">
    <div>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('vertical') }}">Home</a></li>
                <li class="breadcrumb-item active">Project</li>
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 >Member Overview</h5>
                        <button class="btn btn-primary btn-sm"  data-bs-toggle="modal" data-bs-target="#addMemberModal">
                            <i class="bi bi-plus"></i>
                        </button>
                    </div>

                </div>
                <div class="card-body">
                    <table class="table datatable border">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Team Name</th>
                                <th>User Name</th>
                                <th>Role</th>
                                <th>Added By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($memberdata as $index => $datas)
                                <tr>
                                    <th>{{ $index + 1 }}</th>
                                    <td>{{ $datas['team_name'] }}</td>
                                    <td>{{ $datas['user_name'] }}</td>
                                    <td>{{ $datas['role'] }}</td>
                                    <td>{{ $datas['added_by'] }}</td>
                                    <td>
                                        <!-- Edit Button -->
                                        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#editMemberModal" data-id="{{ $datas['id'] }}"
                                            onclick="populateEditModal(this)"> <i class="ri-edit-2-fill"></i></a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('vertical.deleteMember', $datas['id']) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this member?');">
                                                <i class="ri-delete-bin-6-line"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-danger">No record found, please enter valid
                                        input!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Add Member Modal -->
<div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="addMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMemberModalLabel">Add Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="regForm" action="{{ route('vertical.saveMember') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="added_by" name="added_by" value="{{ Auth::user()->id }}">
                    <input type="hidden" id="role" name="role" value="{{ Auth::user()->role }}">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="t_id" class="form-label">Team:</label>
                            <select class="form-select" id="t_id" name="t_id">
                                <option selected hidden disabled>Select Team</option>
                                @foreach ($teams as $team)
                                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                                @endforeach
                            </select>
                            @error('t_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="user_id" class="form-label">Team Member:</label>
                            <select class="form-select" id="user_id" name="user_id">
                                <option selected hidden disabled>Select Team Member</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary rounded-pill col-6">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Member Modal -->
<div class="modal fade" id="editMemberModal" tabindex="-1" aria-labelledby="editMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMemberModalLabel">Edit Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="{{ route('vertical.editMember') }}" method="POST">
                    @csrf

                    <input type="hidden" id="edit_member_id" name="id">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_t_id" class="form-label">Team:</label>
                            <select class="form-select" id="edit_t_id" name="t_id">
                                <option selected hidden disabled>Select Team</option>
                                @foreach ($teams as $team)
                                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                                @endforeach
                            </select>
                            @error('t_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_user_id" class="form-label">Team Member:</label>
                            <select class="form-select" id="edit_user_id" name="user_id">
                                <option selected hidden disabled>Select Team Member</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary rounded-pill col-6">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Populate Edit Modal
    function populateEditModal(button) {
        var memberId = button.getAttribute('data-id');
        var teamId = button.getAttribute('data-team');
        var userId = button.getAttribute('data-user');
        console.log(memberId, teamId, userId);

        document.getElementById('edit_member_id').value = memberId;
        document.getElementById('edit_t_id').value = teamId;
        document.getElementById('edit_user_id').value = userId;
    }

    // Automatically hide alerts after 3 seconds
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
@endsection