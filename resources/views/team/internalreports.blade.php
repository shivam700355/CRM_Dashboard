@php
    $profile = ['name' => $authdata['name'], 'role' => $authdata['role']];
@endphp

@extends('layouts.app', $profile)

@section('content')
    <div class="pagetitle d-flex align-items-center justify-content-between">
        <div>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('team') }}">Home</a></li>
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
                            <h4 class="card-title">{{ $data['name'] }} </h4>
                            <div class="table-responsive">
                                <table class="table table-striped datatable bordered " id="example1"
                                    style="font-size: 12px">
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
                                                    @if (in_array(pathinfo($project['name'], PATHINFO_EXTENSION), ['xlsx', 'xls', 'pdf']))
                                                        <a href="https://docs.google.com/viewer?url={{ urlencode('https://upicondashboard.in/show/' . $project['name']) }}&embedded=true"
                                                            target="_blank" class="btn btn-sm btn-primary">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <a href="/show/{{ $project['name'] }}" target="_blank"
                                                            class="btn btn-sm btn-primary">
                                                            <i class="bi bi-download"></i>
                                                        </a>
                                                        <a href="#"
                                                            onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this Report?')) { document.getElementById('delete-form-{{ $project['id'] }}').submit(); }"
                                                            class="btn btn-sm btn-danger">
                                                            <i class="bi bi-trash"></i>
                                                        </a>
                                                        <form id="delete-form-{{ $project['id'] }}"
                                                            action="{{ route('team.deletereport', $project['id']) }}"
                                                            method="POST" style="display: none;">
                                                            @csrf
                                                        </form>
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
