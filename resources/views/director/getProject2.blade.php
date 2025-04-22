@php
    $profile = ['name' => $data['u_name'], 'role' => $data['u_role']];
@endphp
@extends('layouts.app', ['profile' => $profile])

@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <div class="pagetitle">

            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('director.sadmin') }}">Home</a></li>

                    <li class="breadcrumb-item active">Project</li>
                </ol>
            </nav>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation"><br>
                                        <button class="nav-link active" id="details-tab" data-bs-toggle="tab"
                                            data-bs-target="#details" type="button" role="tab" aria-controls="details"
                                            aria-selected="true">Details</button>
                                    </li>
                                    <li class="nav-item" role="presentation"><br>
                                        <button class="nav-link" id="vendors-tab" data-bs-toggle="tab"
                                            data-bs-target="#vendors" type="button" role="tab" aria-controls="vendors"
                                            aria-selected="false">Vendors</button>
                                    </li>
                                    <li class="nav-item" role="presentation"><br>
                                        <button class="nav-link" id="media-tab" data-bs-toggle="tab" data-bs-target="#media"
                                            type="button" role="tab" aria-controls="media"
                                            aria-selected="false">Media</button>
                                    </li>
                                    <li class="nav-item" role="presentation"><br>
                                        <button class="nav-link" id="teams-tab" data-bs-toggle="tab" data-bs-target="#teams"
                                            type="button" role="tab" aria-controls="teams"
                                            aria-selected="false">Teams</button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="details" role="tabpanel"
                                        aria-labelledby="details-tab" style="width: 100%; margin: 0 auto;">
                                        <div class="row">
                                            <div class="col-md-6 mt-5">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Project Details</h5>
                                                        <table class="table table-bordered table-striped">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="fw-bold"><b>Name</b></td>
                                                                    <td>{{ $data['name'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fw-bold"><b>Vertical</b></td>
                                                                    <td>{{ $data['vertical'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fw-bold"><b>Head</b></td>
                                                                    <td>{{ $data['head'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fw-bold"><b>Details</b></td>
                                                                    <td>{{ $data['details'] }}</td>
                                                                </tr>
                                                                {{-- <tr>
                                                                <td class="fw-bold"><b>Report</b></td>
                                                                <td>
                                                                    @if ($data['report'] !== 'NA')
                                                                    <a href="/reports/{{ $data['report'] }}"
                                                                        target="_blank">Report</a>
                                                                    @else
                                                                    <a href="#"
                                                                        onclick="showAlertModal(); return false;">Report</a>
                                                                    @endif
                                                                </td>
                                                            </tr> --}}

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-5">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <!-- Radial Bar Chart -->
                                                        <div id="radialBarChart"></div>
                                                        <script>
                                                            document.addEventListener("DOMContentLoaded", () => {
                                                                const financial_Year = @json($data['f_year']);
                                                                const project_target = @json($data['p_target']);
                                                                const completed = @json($data['p_status']);
                                                                const projectname = @json($data['name']);
                                            
                                                                // Calculate percentage of completion
                                                                const percentageCompleted = ((completed / project_target) * 100).toFixed(2);
                                            
                                                                // Create the chart
                                                                new ApexCharts(document.querySelector("#radialBarChart"), {
                                                                    series: [percentageCompleted], // Completion percentage
                                                                    chart: {
                                                                        height: 350,
                                                                        type: 'radialBar',
                                                                        toolbar: {
                                                                            show: true
                                                                        }
                                                                    },
                                                                    plotOptions: {
                                                                        radialBar: {
                                                                            dataLabels: {
                                                                                name: {
                                                                                    fontSize: '22px',
                                                                                    offsetY: 5,
                                                                                    color: '#000',
                                                                                    fontWeight: 'bold'
                                                                                },
                                                                                value: {
                                                                                    fontSize: '16px',
                                                                                    formatter: function(val) {
                                                                                        return val + '%'; // Show percentage
                                                                                    }
                                                                                },
                                                                                total: {
                                                                                    show: true,
                                                                                    label: 'Completed',
                                                                                    formatter: function() {
                                                                                        return completed + ' / ' + project_target ; // Show completed and target
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    },
                                                                    labels: [projectname], // Project name label
                                                                    tooltip: {
                                                                        enabled: true,
                                                                        y: {
                                                                            formatter: function(value) {
                                                                                return completed + ' units completed (' + value + '%)'; // Tooltip for completion percentage and completed units
                                                                            }
                                                                        }
                                                                    }
                                                                }).render();
                                                            });
                                                        </script>
                                                        <!-- End Radial Bar Chart -->
                                                    </div>
                                                </div>
                                            </div>
                                            


                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="vendors" role="tabpanel" aria-labelledby="vendors-tab">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Vendor Details</h5>
                                                <table class="table datatable">
                                                    <thead>
                                                        <tr>
                                                            <th>S.No.</th>
                                                            <th>Vendor Name</th>
                                                            <th>State</th>
                                                            <th>District</th>
                                                            <th>Start Date</th>
                                                            <th>End Date</th>
                                                            <th>Status</th>
                                                            <th>View</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $serialNumber = 1;
                                                        @endphp
                                                        @foreach ($data['vendors'] as $vendor)
                                                            <tr>
                                                                <td>{{ $serialNumber }}</td>
                                                                <td>{{ $vendor['name'] }}</td>
                                                                <td>{{ $vendor['state'] }}</td>
                                                                <td>{{ $vendor['district'] }}</td>
                                                                <td>{{ $vendor['start_date'] }}</td>
                                                                <td>{{ $vendor['end_date'] }}</td>
                                                                <td>{{ $vendor['status'] }}</td>
                                                                <td><a href="/director/vendor/{{ $vendor['id'] }}"
                                                                        class="btn btn-sm btn-primary"> <i
                                                                            class="ri-eye-line"></i></a></td>
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
                                    <div class="tab-pane fade" id="media" role="tabpanel" aria-labelledby="media-tab">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Media Details</h5>
                                                <table class="table datatable">
                                                    <thead>
                                                        <tr>
                                                            <th>S.No.</th>
                                                            <th>Media Name</th>
                                                            <th>Type</th>
                                                            {{-- <th>Vendor</th>
                                                            <th>State</th>
                                                            <th>District</th> --}}
                                                            <th>Upload Date</th>
                                                            <th>View</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $serialNumber = 1;
                                                        @endphp
                                                        @foreach ($data['media'] as $media)
                                                            <tr>
                                                                <td>{{ $serialNumber }}</td>
                                                                <td>{{ $media['original_name'] }}</td>
                                                                <td>{{ $media['type'] }}</td>
                                                                {{-- <td>{{ $media['vendor'] }}</td>
                                                                <td>{{ $media['state'] }}</td>
                                                                <td>{{ $media['district'] }}</td> --}}
                                                                <td>{{ $media['upload_date'] }}</td>
                                                                <td>
                                                                    @if (pathinfo($media['name'], PATHINFO_EXTENSION) === 'xlsx' || pathinfo($media['name'], PATHINFO_EXTENSION) === 'xls')
                                                                        <a href="https://docs.google.com/viewer?url={{ urlencode('https://upicondashboard.in/show/' . $media['name']) }}&embedded=true"
                                                                            target="_blank" class="btn btn-sm btn-primary">
                                                                            <i class="bi bi-eye"></i>
                                                                        </a>
                                                                        <a href="/show/{{ $media['name'] }}"
                                                                            target="_blank"
                                                                            class="btn btn-sm btn-primary">
                                                                            <i class="bi bi-download"></i>
                                                                        </a>
                                                                    @else
                                                                        <a href="/show/{{ $media['name'] }}"
                                                                            class="btn btn-sm btn-primary">
                                                                            <i class="bi bi-eye"></i>
                                                                        </a>
                                                                        <a href="/show/{{ $media['name'] }}"
                                                                            target="_blank"
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
                                    <div class="tab-pane fade" id="teams" role="tabpanel"
                                        aria-labelledby="teams-tab">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Team Details</h5>
                                                <table class="table datatable">
                                                    <thead>
                                                        <tr>
                                                            <th>S.No.</th>
                                                            <th>Name</th>
                                                            <th>Description</th>
                                                            <th>Status</th>
                                                            <th>View</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $serialNumber = 1;
                                                        @endphp
                                                        @foreach ($data['teams'] as $team)
                                                            <tr>
                                                                <td>{{ $serialNumber }}</td>
                                                                <td>{{ $team->name }}</td>
                                                                <td>{{ $team->description }}</td>
                                                                <td>{{ $team->status == 1 ? 'Active' : 'Inactive' }}</td>
                                                                <td><a href="/director/team/{{ $team->id }}"
                                                                        class="btn btn-sm btn-primary"> <i
                                                                            class="ri-eye-line"></i></a>
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="alertModalLabel">Alert</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Report not available.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function showAlertModal() {
                    var alertModal = new bootstrap.Modal(document.getElementById('alertModal'));
                    alertModal.show();
                }

                // Remove the inline style 'width: 0px;'
                table.style.width = '100%';
                table1.style.width = '100%';
                table2.style.width = '100%';
                table3.style.width = '100%';
            </script>

        </section>
    </div>
@endsection
