@php
    $profile = ['name' => $data['name'], 'role' => $data['role']];
@endphp
@extends('layouts.app', $profile)

@section('content')
    <div class="pagetitle d-flex align-items-center justify-content-between">
        <div>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('team.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">project</li>
                </ol>
            </nav>
        </div>
        <!-- <div>
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTeamModal">Upload Report</a>
                  </div> -->
    </div>
    @if (session('error'))
        <div class="alert alert-danger" id="danger-alert">
            {{ session('error') }}
        </div>
    @elseif (session('success'))
        <div class="alert alert-success" id="success-alert">
            {{ session('success') }}
        </div>
    @endif
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <h5 class="card-title">Media Details</h5>
                            <div class="table-responsive">
                                <table class="table table-striped datatable bordered" id="example2">
                                    <thead class="bg-secondary text-light">
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Media Name</th>
                                            <th>Upload Date</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $serialNumber = 1;
                                        @endphp
                                        @foreach ($mediaData as $media)
                                            <tr>
                                                <td>{{ $serialNumber }}</td>
                                                <td>{{ $media['original_name'] }}</td>
                                                <td>{{ $media['created_at'] }}</td>
                                                <td>
                                                    @if (pathinfo($media['name'], PATHINFO_EXTENSION) === 'xlsx' || pathinfo($media['name'], PATHINFO_EXTENSION) === 'xls')
                                                        <a href="https://docs.google.com/viewer?url={{ urlencode('https://upicondashboard.in/show/' . $media['name']) }}&embedded=true"
                                                            target="_blank" class="btn btn-sm btn-primary">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <a href="/show/{{ $media['name'] }}" target="_blank"
                                                            class="btn btn-sm btn-primary">
                                                            <i class="bi bi-download"></i>
                                                        </a>
                                                    @else
                                                        <a href="/show/{{ $media['name'] }}" class="btn btn-sm btn-primary">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <a href="/show/{{ $media['name'] }}" target="_blank"
                                                            class="btn btn-sm btn-primary">
                                                            <i class="bi bi-download"></i>
                                                        </a>
                                                    @endif
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

    </section>
@endsection

@section('script')
    <script>
        $(function() {

            $('#example3').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
