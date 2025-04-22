@php
    $profile = ['name' => $data['name'], 'role' => $data['role']];
@endphp
@extends('layouts.theme', $profile)

@section('content')
    <div class="pagetitle">
     
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('director.sadmin') }}">Home</a></li>
                <li class="breadcrumb-item active">All Projects</li>
            </ol>
        </nav>
    </div>
    <div class="content-wrapper py-2">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Projects</h4>
                        <div class="table-responsive">
                            <table id="example2" class="table table-hover table-striped text-center table-bordered ">
                                <thead class="bg-secondary text-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Head</th>
                                        <th scope="col">Vertical</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Details</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="p-0">
                                    @php
                                        $serialNumber = 1;
                                    @endphp
                                    @foreach ($data['projects'] as $project)
                                        <tr>
                                            <th scope="row">{{ $serialNumber++ }}</th>
                                            <td>{{ $project['name'] }}</td>
                                            <td>{{ $project['head'] }}</td>
                                            <td>{{ $project['vertical'] }}</td>
                                            <td>{{ $project['status'] }}</td>
                                            <td>{{ $project['details'] }}</td>
                                            <td>
                                                <a href="/director/project/{{ $project['id'] }}"
                                                    class="btn btn-sm btn-outline-primary">View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
