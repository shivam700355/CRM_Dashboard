@php
    $profile = ['name' => $authdata['name'], 'role' => $authdata['role']];
    // Convert the $data array to a collection
@endphp

@extends('layouts.app', $profile)
@section('content')
    <div class="content-wrapper p-2">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Upload Report</h4>
                        <form action="{{ route('spoc.saveMedia') }}" method="post" enctype="multipart/form-data"
                            class="needs-validation" novalidate>
                            @csrf
                            <input type="hidden" value="{{ $authId }}" name="added_by">

                            <div class="row">
                                @if (session('success'))
                                    <div class="alert alert-success col-12">{{ session('success') }}</div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger col-12">{{ session('error') }}</div>
                                @endif

                                <div class="col-md-6">
                                    <!-- Project Name -->
                                    <div class="mb-3">
                                        <label for="project_id" class="form-label">Project Name</label>
                                        <select class="form-select" name="project_id" id="project_id" required
                                            onchange="getVendors(this.value)">
                                            
                                            @foreach ($projects as $pro)
                                                <option value="{{ $pro->id }}" selected>{{ $pro->p_name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a Project.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <!-- File Upload -->
                                    <div class="mb-3">
                                        <label for="upload" class="form-label">Upload</label>
                                        <input type="file" class="form-control" id="upload" name="image_files[]"
                                            accept=".jpg, .jpeg, .png, .pdf" multiple required>
                                        <div class="invalid-feedback">
                                            Please provide a file.
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="vass_id" id="vass_id" value="0">
                                <input type="hidden" value="1" name="type" id="type">

                                <div class="col-12">
                                    <!-- Remark -->
                                    <div class="mb-3">
                                        <label for="remark" class="form-label">Remark</label>
                                        <textarea id="remark" class="form-control" name="remark" rows="3"></textarea>
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary rounded-pill col-md-6"
                                        id="submit">Submit</button>
                                </div>
                            </div>
                        </form>


                        <!-- Display Uploaded Details -->
                        <div id="filePreviews"></div>
                        <!-- JavaScript for validation and client-side slideshow -->
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Enable Bootstrap validation
            (function() {
                'use strict';

                window.addEventListener('load', function() {
                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                    var forms = document.getElementsByClassName('needs-validation');

                    // Loop over them and prevent submission
                    var validation = Array.prototype.filter.call(forms, function(form) {
                        form.addEventListener('submit', function(event) {
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


    </div>
@endsection
