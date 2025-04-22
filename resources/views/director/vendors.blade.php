@php
    $profile = ['name' => $data['name'], 'role' => $data['role']];
@endphp
@extends('layouts.theme', $profile)

@section('content')
    <div class="content-wrapper py-2">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body table-responsive">
                        <h4 class="card-title">Vendors</h4>
                        <table id="example2" class="table table-bordered table-striped">
                            <thead class="bg-secondary text-light">
                                <tr>
                                    <th>S.No.</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>State</th>
                                    <th>District</th>
                                    {{-- <th>Address</th> --}}
                                    <th>Projects</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $serialNumber = 1;
                                @endphp
                                @foreach ($data['vendors'] as $vendor)
                                    <tr>
                                        <td>{{ $serialNumber }}</td>
                                        <td>{{ $vendor->name }}</td>
                                        <td>{{ $vendor->mobile }}</td>
                                        <td>{{ $vendor->email }}</td>
                                        <td>{{ $vendor->state }}</td>
                                        <td>{{ $vendor->district }}</td>
                                        {{-- <td>{{ $vendor->address }}</td> --}}
                                        <td><a href="/director/vendor/{{ $vendor->id }}"
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
@endsection
