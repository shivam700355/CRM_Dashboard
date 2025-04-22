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
                <li class="breadcrumb-item"><a href="vertical">Home</a></li>
                <li class="breadcrumb-item active">Project</li>
            </ol>
        </nav>
    </div>
    <!-- <div>
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">Add Project</a>
    </div> -->
</div>
<!-- End Page Title -->
@if (session('success'))
<div class="alert alert-success" id="success-alert">
    {{ session('success') }}
</div>
@endif

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <!-- Card title -->
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Project Overview</h5>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#basicModal">
                            <i class="bi bi-plus"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <ul class="nav nav-tabs" role="tablist">
                        @forelse ($monthYear as $new)
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab"
                                href="#tab-{{ $loop->index }}">
                                {{ $new->f_year }}
                            </a>
                        </li>
                        @empty
                        <li class="nav-item">
                            <p class="btn btn-outline-danger">No record found, Please enter valid input!</p>
                        </li>
                        @endforelse
                    </ul>

                    <div class="tab-content">
                        @forelse ($monthYear as $new)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tab-{{ $loop->index }}">
                            <div class="table-responsive">
                                <table id="table-{{ $loop->index }}" class="table datatable border">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>FY</th>
                                            <th>Target </th>
                                            <th>Completed</th>
                                            <th>Project Spoc</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($dataCollection->where('fyear', $new->f_year) as $project)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ \Illuminate\Support\Str::words($project['name'], 3, '...') }}</td>

                                            <td>{{ $project['fyear'] }}</td>
                                            <td>{{ $project['p_target'] }}</td>
                                            <td>{{ $project['p_status'] }}</td>


                                            <td>{{ $project['head'] }}</td>

                                            <td>
                                                <a href="#" class="btn btn-success btn-sm"
                                                    onclick="setEditFormValues('{{ $project['id'] }}', '{{ $project['name'] }}', '{{ $project['fyear'] }}', '{{ $project['head'] }}')"
                                                    data-bs-toggle="modal" data-bs-target="#editModal">
                                                    <i class="ri-edit-2-fill"></i>
                                                </a>
                                                <a href="/vertical/project/{{ $project['id'] }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <a href="/vertical/report/{{ $project['id'] }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="bi bi-file-earmark-break"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-danger">No record found,
                                                Please enter valid input!</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @empty
                        <div class="tab-pane fade show active">
                            <p class="text-danger">No record found, Please enter valid input!</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('project.updateproject') }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit Project</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" id="project-id">
                                <div class="form-group">
                                    <label for="p_name">Project Name</label>
                                    <input type="text" class="form-control" id="p_name" name="p_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="f_year">Fiscal Year</label>
                                    <input type="text" class="form-control" id="f_year" name="f_year" required>
                                </div>
                                <div class="form-group">
                                    {{-- <label for="n_spoc">Project Spoc</label> --}}
                                    <input type="text" class="form-control" id="n_spoc" name="n_spoc" required hidden>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Basic Modal -->
            <div class="modal fade" id="basicModal" tabindex="-1" aria-labelledby="basicModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="basicModalLabel">Add Project</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="regForm" action="{{ route('vertical.saveProject') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="added_by" name="added_by" value="{{ Auth::user()->id }}">
                                <input type="hidden" id="vertical_id" name="vertical_id"
                                    value="{{ Auth::user()->vertical }}">

                                <div class="container">
                                    <div class="row">
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="p_name">Project Name:</label>
                                            <input type="text" class="form-control" id="p_name" name="p_name"
                                                placeholder="Enter project name" value="{{ old('p_name') }}">
                                            @error('p_name')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="p_target">Target Project:</label>
                                            <input type="text" class="form-control" id="p_target" name="p_target"
                                                placeholder="Enter target project" value="{{ old('p_target') }}">
                                            @error('p_target')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="f_year">Financial Year:</label>
                                            <input type="text" class="form-control" id="f_year" name="f_year"
                                                placeholder="Enter financial year" value="{{ old('f_year') }}">
                                            @error('f_year')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <input type="hidden" name="n_spoc" value="" id="n_spoc1">
                                        <div class="col-md-6 mb-3">
                                            <label for="district">Project Head:</label>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle w-100" type="button"
                                                    id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    Select Head
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    @foreach ($users->sortBy('name') as $user)
                                                    <li>
                                                        <div class="form-check px-2">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="{{ $user->id }}" onchange="addSpoc(this)">
                                                            <label class="form-check-label">{{ $user->name }}</label>
                                                        </div>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @error('n_spoc')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12 mb-3">
                                            <label for="p_details">Project Details:</label>
                                            <textarea class="form-control" id="p_details" name="p_details" rows="6"
                                                placeholder="Enter project details">{{ old('p_details') }}</textarea>
                                            @error('p_details')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary rounded-pill col-6">Submit</button>
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<script>
    const spocList = document.getElementById('n_spoc1');

    function addSpoc(checkbox) {
        const value = checkbox.value;
        let temp = spocList.value.split(',');
        if (checkbox.checked) {
            if (!temp.includes(value)) {
                temp.push(value);
            }
        } else {
            temp = temp.filter(item => item !== value);
        }
        spocList.value = temp.join(',');
    }
</script>
<script>
    function setEditFormValues(id, name, fyear, head) {
        document.getElementById('project-id').value = id;
        document.getElementById('p_name').value = name;
        document.getElementById('f_year').value = fyear;
        document.getElementById('n_spoc').value = head;
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const alertElement = document.getElementById('success-alert');
        if (alertElement) {
            // Set the delay in milliseconds (e.g., 3000ms = 3 seconds)
            setTimeout(function () {
                alertElement.style.display = 'none';
            }, 3000); // Adjust the delay as needed
        }
    });

    @endsection