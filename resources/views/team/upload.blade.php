@php
    $profile = ['name' => $data['name'], 'role' => $data['role']];
@endphp

@extends('layouts.app', ['profile' => $profile])

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
</div>

<div class="row align-items-center justify-content-between">
    <div class="col-md-8 grid-margin stretch-card ">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Upload Report</h4>
                <form action="{{ route('team.saveUpload') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    <input type="hidden" value="{{ $authId }}" name="added_by">

                    <div class="row">
                        <!-- Project Name -->
                        <div class="col-md-6 mb-3">
                            <label for="project_id" class="form-label">Project Name</label>
                            <select class="form-select" name="project_id" id="project_id" required onchange="getVendors(this.value)">
                                <option selected hidden disabled>Project Name</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->p_name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select a project.
                            </div>
                        </div>

                        <!-- File Upload -->
                        <div class="col-md-6 mb-3">
                            <label for="upload" class="form-label">Upload</label>
                            <input type="file" class="form-control" id="upload" name="image_files[]" accept=".jpg, .jpeg, .png, .pdf" multiple required>
                            <div class="invalid-feedback">
                                Please provide a file.
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="vass_id" id="vass_id" value="0">
                    <input type="hidden" name="type" id="type" value="1">

                    <!-- Remark -->
                    <div class="mb-3">
                        <label for="remark" class="form-label">Remark</label>
                        <textarea id="remark" class="form-control" name="remark" rows="3"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary rounded-pill col-md-6" id="submit">Submit</button>
                    </div>
                </form>

                <!-- Display Uploaded Details -->
                <div id="filePreviews"></div>
            </div>
        </div>
    </div>
</div>

<script>
    // Enable Bootstrap validation
    (function () {
        'use strict';

        window.addEventListener('load', function () {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');

            // Loop over them and prevent submission
            Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>

@endsection
