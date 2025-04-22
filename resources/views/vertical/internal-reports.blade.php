@php
    $profile = ['name' => $authdata['name'], 'role' => $authdata['role']];

@endphp

@extends('layouts.app', $profile)

@section('content')

<div class="pagetitle d-flex align-items-center justify-content-between">
    <div>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="vertical">Home</a></li>
                <li class="breadcrumb-item active">Internal report</li>
            </ol>
        </nav>
    </div>
    <div>
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">Add Project</a>
    </div>
</div>
<!-- End Page Title -->
@if (session('success'))
    <div class="alert alert-success" id="success-alert">
        {{ session('success') }}
    </div>
@endif
@section('content')

<div class="row ">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body ">
                <h4 class="card-title">{{ $data['name'] }} </h4>
                <div class="table-responsive">
                    <table class="table table-hover datatable border" style="font-size:14px">
                        <thead class="bg-secondary text-light">
                            <tr>
                                <th>S.No</th>
                                <th>file Name</th>
                                <th>Project Name</th>
                                <th>Financial Year</th>
                                <!-- <th>State </th>
                                <th>District </th> -->
                                <th>Upload Date</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data['media'] as $project)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $project['mediaName'] }}</td>
                                    <td>{{ $project['projectName'] }}</td>
                                    <td>{{ $project['f_year'] }}</td>
                                    <!-- <td>{{ $project['stateName'] }}</td>
                                        <td>{{ $project['districtName'] }}</td> -->
                                    <td>{{ $project['uploadDate'] }}</td>
                                    <td>
                                        @if (pathinfo($project['view'], PATHINFO_EXTENSION) === 'xlsx' || pathinfo($project['view'], PATHINFO_EXTENSION) === 'xls')
                                            <a href="https://docs.google.com/viewer?url={{ urlencode('https://upicondashboard.in/show/' . $project['view']) }}&embedded=true"
                                                target="_blank" class="btn btn-sm btn-primary">
                                                <i class="bi bi-eye"></i> 
                                            </a>
                                            <a href="/show/{{ $project['view'] }}"
                                                target="_blank" class="btn btn-sm btn-primary">
                                                <i class="bi bi-download"></i> 
                                            </a>
                                        @else
                                            <a href="/show/{{ $project['view'] }}" class="btn btn-sm btn-primary">
                                                <i class="bi bi-eye"></i> 
                                            </a>
                                            <a href="/show/{{ $project['view'] }}"
                                                target="_blank" class="btn btn-sm btn-primary">
                                                <i class="bi bi-download"></i> 
                                            </a>
                                        @endif
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No record found, Please enter
                                        valid input!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection