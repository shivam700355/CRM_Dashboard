@php
    $profile = ['name' => $data['u_name'], 'role' => $data['u_role']];
@endphp
@extends('layouts.theme', $profile)


@section('style')
    <style type="text/css">

    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3">Vendor</h5>
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-detail-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-detail" type="button" role="tab" aria-controls="nav-detail"
                                    aria-selected="true">Details</button>
                                <button class="nav-link" id="nav-project-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-project" type="button" role="tab" aria-controls="nav-project"
                                    aria-selected="false">Projects</button>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-detail" role="tabpanel"
                                aria-labelledby="nav-home-tab">
                                <div class="card">
                                    <div class="card-body">
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
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-project" role="tabpanel" aria-labelledby="nav-project-tab">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        <table class="table table-bordered table-striped" >
                                            <thead class="bg-secondary text-light">
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Project</th>
                                                    <th>State</th>
                                                    <th>District</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Status</th>
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
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
