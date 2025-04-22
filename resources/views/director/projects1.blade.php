@php
    $profile = ['name' => $data['name'], 'role' => $data['role']];
@endphp
@extends('layouts.app', ['profile' => $profile])

@section('content')
    <div class="pagetitle">

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('director.sadmin') }}">Home</a></li>
                <li class="breadcrumb-item active">All Projects</li>
            </ol>
        </nav>
    </div>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <div class="layout-page">
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="card">
                            <h3 class="card-header">Projects</h3>
                            <div class="card-body">
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-striped datatable bordered">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Name</th>
                                                <th>Finance year</th>
                                                <th>Head</th>
                                                <th>Vertical</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $serialNumber = 1;
                                            @endphp
                                            @foreach ($data['projects'] as $project)
                                                <tr>
                                                    <th>{{ $serialNumber++ }}</th>
                                                    <td>{{ $project['name'] }}</td>
                                                    <td>{{ $project['f_year'] }}</td>
                                                    <td>{{ $project['head'] }}</td>
                                                    <td>{{ $project['vertical'] }}</td>
                                                    <td>
                                                        <a href="/director/project/{{ $project['id'] }}" class="btn btn-sm btn-primary">
                                                            <i class="ri-eye-line"></i>
                                                        </a>
                                                        @if (pathinfo($project['report'], PATHINFO_EXTENSION) === 'xlsx' || pathinfo($project['report'], PATHINFO_EXTENSION) === 'xls')
                                                            <a href="https://docs.google.com/viewer?url={{ urlencode('https://upicondashboard.in/show/' . $project['report']) }}&embedded=true"
                                                               target="_blank" class="btn btn-sm btn-success">
                                                               <i class="bi bi-newspaper"></i>
                                                               
                                                            </a>
                                                            
                                                        @else
                                                             <!-- You can add an alternative action or message for non-Excel reports here -->
                                                             <a href="#"  class="btn btn-sm btn-danger">
                                                                <i class="bi bi-file-earmark-excel"></i>
                                                            </a>
                                                           
                                                        @endif
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
        </div>
    </div>
@endsection
