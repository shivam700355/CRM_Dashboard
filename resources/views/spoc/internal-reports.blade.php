@php
    $profile = ['name' => $authdata['name'], 'role' => $authdata['role']];
@endphp

@extends('layouts.app', $profile)

@section('content')
    <div class="pagetitle d-flex align-items-center justify-content-between">
        <div>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('spoc') }}">Home</a></li>
                    <li class="breadcrumb-item active">Project</li>
                </ol>
            </nav>
        </div>

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
    @php
        use Carbon\Carbon;
    @endphp
    <section class="content">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body ">
                            <h4 class="card-title">{{ $data['name'] }} <div id="loader" class="d-none">
                                    <div class="spinner-border" role="status">
                                        <span class="visually-hidden"> </span>
                                    </div>
                                </div>
                            </h4>
                            <div class="table-responsive">
                                <table class="table table-hover datatable border" id="example1">
                                    <thead class=" text-light">
                                        <tr>
                                            <th>S.No</th>
                                            <th>file Name</th>
                                            <th>Project Name</th>
                                            <th>Financial Year</th>
                                            <th>Upload Date</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data['media'] as $project)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $project['original_name'] }}</td>

                                                <td>{{ $project['project_name'] }}</td>

                                                <td>{{ $project['f_year'] }}</td>
                                                <td
                                                    class="{{ Carbon::parse($project['created_at'])->isToday() ? 'text-warning' : 'text-success' }}">
                                                    @if (Carbon::parse($project['created_at'])->isToday())
                                                        Today
                                                    @else
                                                        {{ $project['created_at']->format('Y-m-d') }}
                                                    @endif
                                                </td>

                                                <td>

                                                    @if (pathinfo($project['name'], PATHINFO_EXTENSION) === 'xlsx' ||
                                                            pathinfo($project['name'], PATHINFO_EXTENSION) === 'xls')
                                                        <a href="#" class="btn btn-sm btn-primary"
                                                            onclick="openFile('https://docs.google.com/viewer?url={{ urlencode('https://upicondashboard.in/show/' . $project['name']) }}&embedded=true')">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-sm btn-primary"
                                                            onclick="openFile('/show/{{ $project['name'] }}')">
                                                            <i class="bi bi-download"></i>
                                                        </a>
                                                    @else
                                                        <a href="#" class="btn btn-sm btn-primary"
                                                            onclick="openFile('/show/{{ $project['name'] }}')">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-sm btn-primary"
                                                            onclick="openFile('/show/{{ $project['name'] }}')">
                                                            <i class="bi bi-download"></i>
                                                        </a>
                                                    @endif
                                                    <a href="#"
                                                        onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this Report?')) { document.getElementById('delete-form-{{ $project['id'] }}').submit(); }"
                                                        class="btn btn-sm btn-danger">
                                                        <i class="ri-delete-bin-6-line"></i>
                                                    </a>
                                                    <form id="delete-form-{{ $project['id'] }}"
                                                        action="{{ route('spoc.deletereport', $project['id']) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                    </form>
                                                </td>

                                                <!-- Loader -->


                                                <script>
                                                    function showLoader() {
                                                        // Show the loader
                                                        document.getElementById('loader').classList.remove('d-none');
                                                    }

                                                    function openFile(url) {
                                                        showLoader(); // Show loader

                                                        // Set a timeout to open the file after 2 seconds
                                                        setTimeout(function() {
                                                            window.open(url, '_blank'); // Open the file in a new tab
                                                            document.getElementById('loader').classList.add('d-none'); // Hide the loader
                                                        }, 2000); // 2000 milliseconds = 2 seconds
                                                    }
                                                </script>






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
                        <!-- /.container-fluid -->
                    </div>
                </div>
            </div>
        </div>
        <script>
            function confirmDelete(projectId) {
                console.log(projectId);
                if (confirm('Are you sure you want to delete this report?')) {
                    // Using template literals for better readability
                    window.location.href = `/spoc/deletereport/${projectId}`;


                }
            }
        </script>

    </section>
@endsection
