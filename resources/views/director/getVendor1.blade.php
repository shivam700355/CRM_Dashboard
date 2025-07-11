@php
    $profile = ['name' => $data['u_name'], 'role' => $data['u_role']];
@endphp
@extends('layouts.app', ['profile' => $profile])

@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab" aria-controls="details" aria-selected="true">Details</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="vendors-tab" data-bs-toggle="tab" data-bs-target="#vendors" type="button" role="tab" aria-controls="vendors" aria-selected="false">Project</button>
                    </li>
                </ul>

                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab" style="width: 100%; margin: 0 auto;">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered table-striped"  >
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
                    <div class="tab-pane fade" id="vendors" role="tabpanel" aria-labelledby="vendors-tab">
                        <div class="card">
                            <div class="card-body table-responsive">
                                <table class="table datatable" id="example">
                                    <thead>
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
                                            <td><span class="badge bg-label-success me-1">{{ $va['status'] }}</span></td>
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