@php
    $profile = ['name' => $data['u_name'], 'role' => $data['u_role']];
@endphp
@extends('layouts.theme', $profile)


@section('content')
    <div class="pagetitle">

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('director.sadmin') }}">Home</a></li>

                <li class="breadcrumb-item active">Project</li>
            </ol>
        </nav>
    </div>
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="details-tab" data-bs-toggle="tab"
                                            data-bs-target="#details" type="button" role="tab" aria-controls="details"
                                            aria-selected="true">Details</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="vendors-tab" data-bs-toggle="tab"
                                            data-bs-target="#vendors" type="button" role="tab" aria-controls="vendors"
                                            aria-selected="false">Vendors</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="media-tab" data-bs-toggle="tab" data-bs-target="#media"
                                            type="button" role="tab" aria-controls="media"
                                            aria-selected="false">Media</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="teams-tab" data-bs-toggle="tab" data-bs-target="#teams"
                                            type="button" role="tab" aria-controls="teams"
                                            aria-selected="false">Teams</button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="details" role="tabpanel"
                                        aria-labelledby="details-tab">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="mb-3">Project Details</h5>
                                                <table class="table table-bordered table-striped">
                                                    <tbody>
                                                        <tr>
                                                            <td class="fw-bold"><b>Name</b></td>
                                                            <td>{{ $data['name'] }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold"><b>Vertical</b></td>
                                                            <td>{{ $data['vertical'] }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold"><b>Head</b></td>
                                                            <td>{{ $data['head'] }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold"><b>Details</b></td>
                                                            <td>{{ $data['details'] }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-bold"><b>Report</b></td>
                                                            <td><a href="/reports/{{ $data['report'] }}"
                                                                    target="_blank">Report</a></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="vendors" role="tabpanel" aria-labelledby="vendors-tab">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="mb-3">Vendor Details</h5>
                                                <table class="table table-bordered table-striped" id="example2">
                                                    <thead class="bg-secondary text-light">
                                                        <tr>
                                                            <th>S.No.</th>
                                                            <th>Vendor Name</th>
                                                            <th>State</th>
                                                            <th>District</th>
                                                            <th>Start Date</th>
                                                            <th>End Date</th>
                                                            <th>Status</th>
                                                            <th>View</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $serialNumber = 1;
                                                        @endphp
                                                        @foreach ($data['vendors'] as $vendor)
                                                            <tr>
                                                                <td>{{ $serialNumber }}</td>
                                                                <td>{{ $vendor['name'] }}</td>
                                                                <td>{{ $vendor['state'] }}</td>
                                                                <td>{{ $vendor['district'] }}</td>
                                                                <td>{{ $vendor['start_date'] }}</td>
                                                                <td>{{ $vendor['end_date'] }}</td>
                                                                <td>{{ $vendor['status'] }}</td>
                                                                <td><a href="/director/vendor/{{ $vendor['id'] }}"
                                                                        class="btn btn-sm btn-outline-primary">View</a>
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
                                    <div class="tab-pane fade" id="media" role="tabpanel" aria-labelledby="media-tab">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="">Media Details</h5>
                                                <table class="table table-bordered table-striped table-responsive"
                                                    id="example3">
                                                    <thead class="bg-secondary text-light">
                                                        <tr>
                                                            <th>S.No.</th>
                                                            <th>Media Name</th>
                                                            <th>Type</th>
                                                            <th>Vendor</th>
                                                            <th>State</th>
                                                            <th>District</th>
                                                            <th>Upload Date</th>
                                                            <th>View</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $serialNumber = 1;
                                                        @endphp
                                                        @foreach ($data['media'] as $media)
                                                            <tr>
                                                                <td>{{ $serialNumber }}</td>
                                                                <td>{{ $media['original_name'] }}</td>
                                                                <td>{{ $media['type'] }}</td>
                                                                <td>{{ $media['vendor'] }}</td>
                                                                <td>{{ $media['state'] }}</td>
                                                                <td>{{ $media['district'] }}</td>
                                                                <td>{{ $media['upload_date'] }}</td>
                                                                <td><a href="{{ '/show/' . $media['name'] }}"
                                                                        target="_blank"
                                                                        class="btn btn-sm btn-outline-primary">View</a>
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
                                    <div class="tab-pane fade" id="teams" role="tabpanel" aria-labelledby="teams-tab">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="mb-3">Team Details</h5>
                                                <table class="table table-bordered table-striped" id="example2">
                                                    <thead class="bg-secondary text-light">
                                                        <tr>
                                                            <th>S.No.</th>
                                                            <th>Name</th>
                                                            <th>Description</th>
                                                            <th>Status</th>
                                                            <th>View</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $serialNumber = 1;
                                                        @endphp
                                                        @foreach ($data['teams'] as $team)
                                                            <tr>
                                                                <td>{{ $serialNumber }}</td>
                                                                <td>{{ $team->name }}</td>
                                                                <td>{{ $team->description }}</td>
                                                                <td>{{ $team->status == 1 ? 'Active' : 'Inactive' }}</td>
                                                                <td><a href="/director/team/{{ $team->id }}"
                                                                        class="btn btn-sm btn-outline-primary">View</a>
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
@endsection
