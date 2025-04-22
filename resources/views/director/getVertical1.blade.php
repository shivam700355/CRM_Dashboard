@php
    // Check for user profile data
    $profile = ['name' => $data['u_name'] ?? 'N/A', 'role' => $data['u_role'] ?? 'N/A'];
@endphp
@extends('layouts.app', ['profile' => $profile])

@section('content')
    <div class="pagetitle">
        
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('director.sadmin') }}">Home</a></li>

                <li class="breadcrumb-item active">Vertical</li>
            </ol>
        </nav>
    </div>
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Vertical Details</h5>
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                            <td class="fw-bold"><b>Name</b></td>
                                            <td>{{ $data['name'] ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold"><b>Head</b></td>
                                            <td>{{ $data['head'] ?? 'N/A' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Projects Under Vertical</h5>
                                @if (!empty($data['projects']) && is_array($data['projects']))
                                    <div class="table-responsive">
                                        <table class="table datatable">
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Project Name</th>
                                                    <th>FY</th>
                                                    <th>Head</th>
                                                    <th>Target</th>
                                                    <th>Completed</th>
                                                    <th>View</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php    $serialNumber = 1; @endphp
                                                @foreach ($data['projects'] as $project)
                                                    <tr>
                                                        <th scope="row">{{ $serialNumber }}</th>
                                                        <td>{{ $project['name'] ?? 'N/A' }}</td>
                                                        <td>{{ $project['f_year'] }}</td>
                                                        <td>{{ $project['head'] ?? 'N/A' }}</td>
                                                        <td>{{ $project['target'] ?? 0 }}</td>
                                                        <td>{{ $project['complete'] ?? 0 }}</td>
                                                        <td>
                                                            <a href="/director/project/{{ $project['id'] }}"
                                                                class="btn btn-sm btn-primary py-0"><i class="ri-eye-line"></i></a>
                                                        </td>
                                                    </tr>
                                                    @php        $serialNumber++; @endphp
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p>No projects found under this vertical.</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Project Bar Chart</h5>
                                <!-- Bar Chart -->
                                <canvas id="barChart" style="max-height: 400px;"></canvas>

                                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        const projectNames = @json(array_column($data['projects'], 'name') ?? []);
                                        const projectTargets = @json(array_column($data['projects'], 'target') ?? []);
                                        const projectCompleted = @json(array_column($data['projects'], 'complete') ?? []);

                                        // Ensure the chart renders only if data is available
                                        if (projectNames.length > 0 && projectTargets.length > 0 && projectCompleted.length > 0) {
                                            new Chart(document.querySelector('#barChart'), {
                                                type: 'bar',
                                                data: {
                                                    labels: projectNames, // Set project names as labels
                                                    datasets: [{
                                                            label: 'Target',
                                                            data: projectTargets,
                                                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                                            borderColor: 'rgba(75, 192, 192, 1)',
                                                            borderWidth: 1
                                                        },
                                                        {
                                                            label: 'Completed',
                                                            data: projectCompleted,
                                                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                                            borderColor: 'rgba(255, 99, 132, 1)',
                                                            borderWidth: 1
                                                        }
                                                    ]
                                                },
                                                options: {
                                                    responsive: true,
                                                    scales: {
                                                        y: {
                                                            beginAtZero: true
                                                        }
                                                    },
                                                    plugins: {
                                                        tooltip: {
                                                            enabled: true
                                                        }
                                                    }
                                                }
                                            });
                                        } else {
                                            console.log("No project data available for the chart.");
                                        }
                                    });
                                </script>
                                <!-- End Bar Chart -->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection
