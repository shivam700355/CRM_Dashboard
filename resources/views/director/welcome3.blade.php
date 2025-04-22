@php
    $profile = ['name' => $data['name'], 'role' => $data['role']];
@endphp
@extends('layouts.app', ['profile' => $profile])

@section('content')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</div>

<section class="section dashboard">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-8">
            <div class="row">
                <!-- Customers Card -->
                {{-- <div class="col-xxl-4 col-xl-12">
                    <div class="card info-card customers-card">
                        <div class="card-body">
                            <h5 class="card-title">All Projects <span>| Current</span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-briefcase"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>24</h6>
                                    <span class="text-danger small pt-1 fw-bold">52%</span>
                                    <span class="text-muted small pt-2 ps-1">completed</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!-- End Customers Card -->

                <!-- Training Card -->
                <div class="col-xxl-6 col-md-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title"><a href="/director/vertical/1">Training</a> <span>| Current</span>
                            </h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-diagram-3"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $data['count']['Training'] }}</h6>
                                    <span class="text-success small pt-1 fw-bold">58%</span>
                                    <span class="text-muted small pt-2 ps-1">completed</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Training Card -->

                <!-- Consultancy Card -->
                <div class="col-xxl-6 col-md-6">
                    <div class="card info-card revenue-card">
                        <div class="card-body">
                            <h5 class="card-title"><a href="/director/vertical/2">Consultancy</a> <span>| Current</span>
                            </h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-dpad"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $data['count']['Consultancy'] }}</h6>
                                    <span class="text-success small pt-1 fw-bold">75%</span>
                                    <span class="text-muted small pt-2 ps-1">completed</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Consultancy Card -->

                <!-- Finance Card -->
                <div class="col-xxl-6 col-md-6">
                    <div class="card info-card revenue-card">
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{ route('director.finance', ['key' => 'incometaxtds']) }}">Financial Services</a> <span>|
                                    Current</span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-dpad"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $data['count']['Finance'] }}</h6>
                                    <span class="text-success small pt-1 fw-bold">82%</span>
                                    <span class="text-muted small pt-2 ps-1">completed</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Finance Card -->

                <!-- Retail Card -->
                <!--<div class="col-xxl-4 col-md-6">-->
                <!--    <div class="card info-card revenue-card">-->
                <!--        <div class="card-body">-->
                <!--            <h5 class="card-title"><a href="/director/vertical/4">Retail</a> <span>| Current</span></h5>-->
                <!--            <div class="d-flex align-items-center">-->
                <!--                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">-->
                <!--                    <i class="bi bi-dpad"></i>-->
                <!--                </div>-->
                <!--                <div class="ps-3">-->
                <!--                    <h6>{{ $data['count']['Retail'] }}</h6>-->
                <!--                    <span class="text-success small pt-1 fw-bold">61%</span>-->
                <!--                    <span class="text-muted small pt-2 ps-1">completed</span>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                <!-- End Retail Card -->

                <!-- Human Resource Card -->
                <div class="col-xxl-6 col-md-6">
                    <div class="card info-card revenue-card">
                        <div class="card-body">
                            <h5 class="card-title"><a href="/director/vertical/5">Human Resource</a> <span>|
                                    Current</span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-dpad"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $data['count']['Human Resource'] }}</h6>
                                    <span class="text-success small pt-1 fw-bold">91%</span>
                                    <span class="text-muted small pt-2 ps-1">completed</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Human Resource Card -->
            </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">
            <!-- Vertical wise Projects -->
            <div class="card">
                <div class="card-body pb-0">
                    <h5 class="card-title">Vertical wise Projects <span>| Today</span></h5>
                    <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

                    <script>
                        document.addEventListener("DOMContentLoaded", () => {
                            echarts.init(document.querySelector("#trafficChart")).setOption({
                                tooltip: {
                                    trigger: 'item'
                                },
                                legend: {
                                    top: '5%',
                                    left: 'center'
                                },
                                series: [{
                                    name: 'Project Count',
                                    type: 'pie',
                                    radius: ['40%', '70%'],
                                    avoidLabelOverlap: false,
                                    label: {
                                        show: false,
                                        position: 'center'
                                    },
                                    emphasis: {
                                        label: {
                                            show: true,
                                            fontSize: '18',
                                            fontWeight: 'bold'
                                        }
                                    },
                                    labelLine: {
                                        show: false
                                    },
                                    data: [{
                                        value: {{ $data['count']['Training'] }},
                                        name: 'Training'
                                    },
                                    {
                                        value: {{ $data['count']['Consultancy'] }},
                                        name: 'Consultancy'
                                    },
                                    {
                                        value: {{ $data['count']['Retail'] }},
                                        name: 'Retail'
                                    },
                                    {
                                        value: {{ $data['count']['Finance'] }},
                                        name: 'Finance'
                                    },
                                    {
                                        value: {{ $data['count']['Human Resource'] }},
                                        name: 'Human Resource'
                                    }
                                    ]
                                }]
                            });
                        });
                    </script>
                </div>
            </div><!-- End Vertical wise Projects -->
        </div>
        <!-- End Right side columns -->

        <!-- Training -->
        {{-- {{ json_encode($projectassocationdata, JSON_PRETTY_PRINT) }} --}}

        <!-- <div class="row">
            <div class="col-12">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <h5 class="card-title">Running Projects <span>| Today</span></h5>
                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th> 
                                    <th scope="col">State</th>
                                    <th scope="col">District</th>
                                    <th scope="col">Target</th>
                                    <th scope="col">Completed</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $serialNumber = 1; @endphp
                                @foreach ($projectassocationdata as $passocationdata)
                                    
                                        <tr>
                                            <th scope="row">{{ $serialNumber }}</th>
                                            <td>{{ $passocationdata['project_Name'] }}</td>
                                            <td>{{ $passocationdata['state'] }}</a></td>
                                            <td>{{ $passocationdata['district'] }}</a></td>
                                            <td>{{ $passocationdata['p_target'] }}</td>
                                            <td>{{ $passocationdata['p_complete']  }}</td>
                                            <td>
                                                <span class="badge bg-warning">
                                                    {{ $passocationdata['status'] == '0' ? 'Stop' : 'Running' }}
                                                </span>
                                            </td>
                                        </tr>
                                        @php        $serialNumber++; @endphp
                                   
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- End Training -->

    </div>
</section>
@endsection