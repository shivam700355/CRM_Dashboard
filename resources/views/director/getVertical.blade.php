@php
    $profile = ['name' => $data['u_name'], 'role' => $data['u_role']];
@endphp
@extends('layouts.app', $profile)

@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="mb-3">Vertical Details</h5>
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                            <td class="fw-bold"><b>Name</b></td>
                                            <td>{{ $data['name'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold"><b>Head</b></td>
                                            <td>{{ $data['head'] }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-body">
                                <h5 class="mb-3">Projects Under Vertical</h5>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped text-center table-bordered "
                                        id="example2">
                                        <thead class="bg-secondary text-light">
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Head</th>
                                                <th>Status</th>
                                                <th>Report</th>
                                                <th>View</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $serialNumber = 1;
                                            @endphp
                                            @foreach ($data['projects'] as $project)
                                                <tr>
                                                    <th scope="row">{{ $serialNumber }}</th>
                                                    <td>{{ $project['name'] }}</td>
                                                    <td>{{ $project['details'] }}</td>
                                                    <td>{{ $project['head'] }}</td>
                                                    <td>{{ $project['status'] }}</td>
                                                    <td><a href="/reports/{{ $project['report'] }}"
                                                            target="_blank">report</a></td>
                                                    <td><a href="/director/project/{{ $project['id'] }}"
                                                            class="btn btn-sm btn-outline-primary py-0">View</a>
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
        </section>
    </div>
@endsection
