@php
    $profile = ['name' => $data['name'], 'role' => $data['role']];
@endphp
@extends('layouts.theme', $profile)

@section('style')
@endsection
@section('content')
    <div class="pagetitle">

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('director.sadmin') }}">Home</a></li>
                <li class="breadcrumb-item active">All User</li>
            </ol>
        </nav>
    </div>
    <div class="content-wrapper py-2">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Users</h4>
                        <div class="table-responsive">
                            <table id="example2" class="table table-striped datatable bordered">
                                <thead class="bg-secondary text-light">
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Vertical</th>
                                        <th>Role</th>
                                        <th>Status</th>
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
                                            <td>{{ $user['status'] }}</td>
                                            {{-- <td><a href="/director/project/{{ $project['id'] }}"
                                            class="btn btn-primary">View</a>
                                    </td> --}}
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
@endsection
