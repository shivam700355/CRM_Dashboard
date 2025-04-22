@php
    $profile = ['name' => $authdata['name'], 'role' => $authdata['role']];
@endphp
@extends('layouts.app', $profile)

@section('content')

    <body class="hold-transition sidebar-mini">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <!--<h3 class="m-0">Vendor Details</h3>-->
                            <!-- <a type="button" class="abc">Break</a> -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
                                    aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="../">Home</a></li>

                                        <li class="breadcrumb-item active" aria-current="page">Vendor</li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="card">
                                <!-- <div class="card-header">
                          <h3 class="card-title">DataTable</h3>
                        </div> -->
                                <!-- /.card-header -->
                                <div class="card-body">


                                    <h5 class="mb-3">Vendor Details</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <tbody>
                                                <tr>
                                                    <td class="fw-bold"><b>Name</b></td>
                                                    <td>{{ $data['name'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold"><b>Mobile</b></td>
                                                    <td>{{ $data['mobile'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold"><b>Email</b></td>
                                                    <td>{{ $data['email'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold"><b>Address</b></td>
                                                    <td>{{ $data['address'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold"><b>Status</b></td>
                                                    <td>{{ $data['status'] }}</td>
                                                </tr>
                                            <tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <h5 class="mb-3">Project Details</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="example3">
                                            <thead class="bg-secondary text-light">
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Project</th>
                                                    <th>State</th>
                                                    <th>District</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $serialNumber = 1;
                                                @endphp
                                                @foreach ($data['projects'] as $va)
                                                    <tr>
                                                        <td>{{ $serialNumber }}</td>
                                                        <td>{{ $va['name'] }}</td>
                                                        <td>{{ $va['state'] }}</td>
                                                        <td>{{ $va['district'] }}</td>
                                                        <td>{{ $va['start_date'] }}</td>
                                                        <td>{{ $va['end_date'] }}</td>
                                                        <td>{{ $va['status'] }}</td>
                                                        <td>
                                                            <a href="/vertical/project/{{ $va['id'] }}"
                                                                class="btn btn-primary btn-sm">
                                                                <i class="ri-eye-line"></i>
                                                            </a>
                                                            <a href="/vertical/report/{{ $va['id'] }}"
                                                                class="btn btn-primary btn-sm">
                                                                <i class="bi bi-file-earmark-break"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $serialNumber++;
                                                    @endphp
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
        </div>


    </body>
@endsection
