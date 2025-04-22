@php
    $profile = ['name' => $data['name'], 'role' => $data['role']];
@endphp
@extends('layouts.app', ['profile' => $profile])

@section('content')
    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href={{ route('spoc.index') }}>Home</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div>
    @if (session('success'))
        <div class="alert alert-success col-12">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger col-12">{{ session('error') }}</div>
    @endif


    <section class="section dashboard">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="https://upicondashboard.in/newjjm/storage/app/profile_pic/{{ $data['profile_pic'] }}"
                            alt="Profile" class="rounded-circle" style="height: 200px;width:200px">
                        <h2>{{ $data['name'] }}</h2>
                        <h3>{{ $data['role'] }}</h3>
                        <!-- <div class="social-links mt-2">
                                                        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                                                        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                                                        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                                                        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                                                    </div> -->
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#profile-overview">Overview</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                    Profile</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">



                                <h5 class="card-title">Profile Details</h5>

                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th class="label">Full Name</th>
                                            <td>{{ $data['name'] }}</td>
                                        </tr>
                                        <tr>
                                            <th class="label">Company</th>
                                            <td>UPICON</td>
                                        </tr>
                                        <tr>
                                            <th class="label">Job</th>
                                            <td>{{ $data['role'] }}</td>
                                        </tr>
                                        <tr>
                                            <th class="label">Phone</th>
                                            <td>{{ $data['mobile'] }}</td>
                                        </tr>
                                        <tr>
                                            <th class="label">Email</th>
                                            <td>{{ $data['email'] }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form method="POST" action="{{ route('spoc.updateprofile') }}"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="row mb-3">
                                        <label for="profile_pic" class="col-md-4 col-lg-3 col-form-label">Profile
                                            Image</label>
                                        <div class="col-md-8 col-lg-9">
                                            <img id="profileImagePreview"
                                                src="https://upicondashboard.in/newjjm/storage/app/profile_pic/{{ $data['profile_pic'] }}"
                                                alt="Profile" style="height: 150px;width:150px" class="rounded-circle">
                                            <div class="pt-2">
                                                <!-- Upload Image -->
                                                <input type="file" id="profile_pic" name="profile_pic" class="d-none"
                                                    onchange="previewImage(event)">
                                                <a href="#" class="btn btn-primary btn-sm"
                                                    title="Upload new profile image"
                                                    onclick="document.getElementById('profile_pic').click();">
                                                    <i class="bi bi-upload"></i> Upload
                                                </a>
                                                <!-- Remove Image (Optional: link to a route to delete the image) -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="fullName" type="text" class="form-control" id="fullName"
                                                value="{{ $data['name'] }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="job" class="col-md-4 col-lg-3 col-form-label">Job</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="job" type="text" class="form-control" id="job"
                                                value="{{ $data['role'] }}" disabled>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="phone" type="text" class="form-control" id="phone"
                                                value="{{ $data['mobile'] }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="email" class="form-control" id="email"
                                                value="{{ $data['email'] }}">
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>
                                <!-- End Profile Edit Form -->
                            </div>
                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>

    </section>
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('profileImagePreview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
