@php
    $profile = ['name' => $data['name'], 'role' => $data['role']];
@endphp
@extends('layouts.app', ['profile' => $profile])

@section('content')
<div class="pagetitle">
     
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('director.sadmin') }}">Home</a></li>
            <li class="breadcrumb-item active">Employee
            </li>
        </ol>
    </nav>
</div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Users</h5>
                        <table class="table table-striped datatable bordered">
                            <thead>
                                <tr>
                                <th>S.No.</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Vertical</th>
                                <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $serialNumber = 1;
                                @endphp
                                @foreach ($data['users'] as $user)
                                    <tr id="{{ $user['id'] }}">
                                    <td>{{ $serialNumber }}</td>
                                    <td>{{ $user['name'] }}</td>
                                    <td>{{ $user['mobile'] }}</td>
                                    <td>{{ $user['email'] }}</td>
                                    <td>{{ $user['vertical'] }}</td>
                                    <td>{{ $user['role'] }}</td>
                                    {{-- <td><span class="badge bg-label-primary me-1">{{ $user['status'] }}</span></td> --}}
                                    {{-- <td><a href="/director/project/{{ $project['id'] }}" class="btn btn-primary">View</a> </td> --}}
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
@endsection