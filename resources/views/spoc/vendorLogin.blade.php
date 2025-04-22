@php
    $profile = ['name' => $authdata['name'], 'role' => $authdata['role']];
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
    @if (session('error'))
        <div class="alert alert-danger" id="danger-alert">
            {{ session('error') }}
        </div>
    @elseif (session('success'))
        <div class="alert alert-success" id="success-alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header  d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Vendor Registration</h4>
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#vendorLoginModal"><i
                            class="bi bi-plus-circle"></i></a>
                </div>
                <div class="card-body">
                    <table class="table table-hover datatable border">
                        <thead class="bg-secondary text-light">
                            <tr>
                                <th>S.No</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Project Name</th>
                                <th>Vendor Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Vendoruserdatas as $vassociation)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $vassociation['name'] }}</td>
                                    <td>{{ $vassociation['mobile'] }}</td>
                                    <td>{{ $vassociation['email'] }}</td>
                                    <td>{{ $vassociation['project_name'] ? $vassociation['project_name'] : 'NA' }}</td>
                                    <td>{{ $vassociation['vendor_name'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="vendorLoginModal" tabindex="-1" aria-labelledby="vendorLoginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="vendorLoginModalLabel">Vendor Registration</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('spoc.saveVendor') }}" method="post" enctype="multipart/form-data"
                        class="needs-validation" novalidate>
                        @csrf
                        <input value="{{ $authIds }}" name="added_by" hidden type="number">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="p_id" class="form-label mb-2">Project</label>
                                <select id="p_id" class="form-select" name="p_id" required
                                    onchange="getVendors(this.value)">
                                    <option selected hidden disabled>Select Project</option>
                                    @forelse ($projectData as $bcuser)
                                        <option value="{{ $bcuser['id'] }}">{{ $bcuser['name'] }}</option>
                                    @empty
                                        <option value="">No projects available</option>
                                    @endforelse
                                </select>
                                <div class="invalid-feedback">Please select a project.</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="v_id" class="form-label mb-2">Vendor Name</label>
                                <select class="form-select" name="v_id" id="v_id">
                                    <option selected hidden disabled>Select Vendor</option>
                                    <option value="#"></option>
                                </select>
                                <div class="invalid-feedback">Please select a vendor.</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label mb-2">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Name" required pattern="[A-Za-z\s]{2,}">
                                <div class="invalid-feedback">Please provide a valid name (at least 2 characters, alphabets
                                    only).</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="mobile" class="form-label mb-2">Mobile</label>
                                <input type="text" class="form-control" id="mobile" name="mobile"
                                    placeholder="Enter Mobile Number" required pattern="[0-9]{10}">
                                <div class="invalid-feedback">Please provide a 10-digit mobile number.</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label mb-2">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter Email" required>
                                <div class="invalid-feedback">Please provide a valid email address.</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label mb-2">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Enter Password" required>
                                <div class="invalid-feedback">Please provide a password.</div>
                            </div>

                            <div class="col-12 d-flex align-items-center justify-content-center mt-4">
                                <button type="submit" class="btn btn-primary rounded-pill col-6"
                                    id="submit">Submit</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        // Enable Bootstrap validation
        (function() {
            'use strict';

            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
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

    <script>
        const vendor = document.getElementById('v_id');
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
@endsection
