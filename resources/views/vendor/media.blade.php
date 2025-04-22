@extends('layouts.theme')

@section('content')
    <div class="content-wrapper p-2">
        <!-- Content Header (Page header) -->


        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-md-8 grid-margin stretch-card">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-3">Upload Media</h4>
                            @if (session('success'))
                                <span class="alert alert-info col-12">{{ session('success') }}</span>
                            @endif
                            @if (session('error'))
                                <span class="alert alert-danger col-12">{{ session('error') }}</span>
                            @endif
                            <form action="{{ route('vendor-login.saveMedia') }}" method="post" enctype="multipart/form-data"
                                class="needs-validation" novalidate>
                                @csrf
                                <input type="number" value="{{ $data['added_by'] }}" name="added_by" hidden>
                                <input type="number" value="{{ $data['project_id'] }}" name="project_id" id="project_id"
                                    hidden>
                                <input type="number" hidden value={{ $data['vass_id'] }} name="vass_id">
                                <div class="row">
        
                                    <div class="form-group col-12">
                                        <label for="upload">Upload</label>
                                        <input type="file" class="form-control" id="upload" name="image_files[]"
                                            accept=".jpg, .jpeg, .png, .pdf" multiple required>
                                        <div class="invalid-feedback">
                                            Please provide file .
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <!-- Remark -->
                                        <label for="remark">Remark</label>
                                        <div class="form-group">
                                            <textarea id="remark" class="form-control" name="remark" rows="3" cols="100"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex align-items-center justify-content-center">
                                        <button type="submit" class="btn btn-primary rounded-pill col-6"
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
        </div>


        <script>
            const vendor = document.getElementById('vass_id');
            async function getVendors(project) {
                const response = await fetch(`/api/projectVendors/${project}`);
                const data = await response.json();
                let temp = '<option selected hidden disabled>Select Vendor</option>';
                if (data.length > 0) {
                    data.forEach(vendor => {
                        temp += `<option value=${vendor.id}>${vendor.name}</option>`;
                    });
                    vendor.innerHTML = temp;
                } else {
                    vendor.innerHTML = '<option selected hidden disabled>No Vendor Found</option>';
                }

            }
        </script>


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
