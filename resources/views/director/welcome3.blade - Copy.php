@php
    $profile = ['name' => $data['name'], 'role' => $data['role']];
@endphp
@extends('layouts1.themes', ['profile' => $profile])
@section('style')
@endsection

@section('content')
<div class="content-wrapper py-2 mb-3">
    <style>
        .received {
            background-color: #4CC552;
            height: 1.5em;
            width: 1.5em;
        }

        .not-received {
            background-color: #CB6D51;
            height: 1.5em;
            width: 1.5em;
        }

        path:hover {
            fill: blue;
        }

        path[id='received'] {
            fill: #4CC552;
        }

        path[id='not-received'] {
            fill: #CB6D51;
        }

        path[id='completed'] {
            fill: #4CC552;
            ;
        }

        path[id='not-completed'] {
            fill: #CB6D51;
        }

        path[id='not-targeted'] {
            fill: rgb(244, 241, 241);
        }
    </style>
    <div class="row">
        <div class="col-lg-8 mb-4 order-0">
            <div class="d-flex align-items-end row">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" 
                                    role="tab" aria-controls="details" aria-selected="true">Mission Shakti 6 Days Training</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="vendors-tab" data-bs-toggle="tab" data-bs-target="#vendors"
                                    type="button" role="tab" aria-controls="vendors" aria-selected="false">Geo Tagging</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="media-tab" data-bs-toggle="tab" data-bs-target="#media"
                                    type="button" role="tab" aria-controls="media" aria-selected="false">Mission Shakti E-rickshaw</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="teams-tab" data-bs-toggle="tab" data-bs-target="#teams"
                                    type="button" role="tab" aria-controls="teams" aria-selected="false">ODOP</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="teams-tab" data-bs-toggle="tab" data-bs-target="#obc"
                                    type="button" role="tab" aria-controls="teams" aria-selected="false">OBC</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
                                <div class="card">
                                    <div class="card-body" style="height: 500px; width:500px ">
                                        <h5 class="card-title">Mission Shakti District Wise Progress</h5>
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            viewBox="0 0 300 300" enable-background="new 0 0 0 0" xml:space="preserve" id="map-svg" class="card-img-top">
                                            <g id="matrix-group" transform="matrix(1 0 0 1 0 0) scale(0.45,0.45)" stroke="none">
                                                @foreach ($data['ms_data'] as $key => $value)
                                                <path data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    data-bs-title="{{ $key }}: Satisfactory letter {{ $value['ms_s_letter'] }}, {{ $value['ms_b_trained'] }} batches trained."
                                                    id="{{ $value['class'] }}" d="{{ $value['svg'] }}">
                                                </path>
                                                @endforeach
                                            </g>
                                        </svg>
                                        <!-- Add content specific to Mission Shakti here -->
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="vendors" role="tabpanel" aria-labelledby="vendors-tab">
                                <div class="card">
                                    <div class="card-body" style="height: 500px; width:500px ">
                                        <h5 class="card-title">Geo Tagging District Wise Progress</h5>
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" 
                                        viewBox="0 0 300 300" enable-background="new 0 0 0 0" xml:space="preserve" id="map-svg" class="card-img-top">
                                            <g id="matrix-group" transform="matrix(1 0 0 1 0 0) scale(0.45,0.45)" stroke="none">
                                                @foreach ($data['ms_data'] as $key => $value)
                                                    <path data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                        data-bs-title="{{ $key }}: {{ $value['geo_msg'] }}" id="{{ $value['geo_class'] }}" d="{{ $value['svg'] }}">
                                                    </path>
                                                @endforeach
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="media" role="tabpanel" aria-labelledby="media-tab">
                                <div class="card">
                                    <div class="card-body" style="height: 500px;">
                                        <img src="{{ asset('theme/public/assets/charts_image/Mission Shakti E Rickshaw.png') }}"
                                            class="d-block w-100" alt="Mission Shakti">
                                        <!-- Add content specific to STT 3 Month here -->
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="teams" role="tabpanel" aria-labelledby="teams-tab">
                                <div class="card">
                                    <div class="card-body" style="height: 500px; width:500px ">
                                        <h5 class="mb-3">ODOP Satisfactory Letter Status</h5>
                                        <!-- Add content specific to Agri Business here -->
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            viewBox="0 0 300 300" enable-background="new 0 0 0 0" xml:space="preserve" id="map-svg" class="card-img-top">
                                            <g id="matrix-group" transform="matrix(1 0 0 1 0 0) scale(0.45,0.45)" stroke="none">
                                                @foreach ($data['ms_data'] as $key => $value)
                                                    <path data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="{{ $key }}: {{ $value['odop_msg'] }}"
                                                        id="{{ $value['odop_class'] }}" d="{{ $value['svg'] }}">
                                                    </path>
                                                @endforeach
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="obc" role="tabpanel" aria-labelledby="teams-tab">
                                <div class="card">
                                    <div class="card-body" style="height: 500px; width:500px ">
                                    <h5 class="mb-3">OBC 4 Month Training Status</h5>
                                    <!-- Add content specific to Agri Business here -->
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                        viewBox="0 0 300 300" enable-background="new 0 0 0 0" xml:space="preserve" id="map-svg" class="card-img-top">
                                        <g id="matrix-group" transform="matrix(1 0 0 1 0 0) scale(0.45,0.45)" stroke="none">
                                        @foreach ($data['ms_data'] as $key => $value)
                                            <path data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="{{ $key }}: {{ $value['obc_msg'] }}"
                                                id="{{ $value['obc_class'] }}" d="{{ $value['svg'] }}">
                                            </path>
                                        @endforeach
                                        </g>
                                    </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 order-1">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <div class="card">
                        <a href="/director/vertical/1">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="theme/public/assets/img/icons/unicons/wallet-info.png" alt="Credit Card" class="rounded">
                                    </div>
                                </div>
                                <span>Training</span>
                                <h3 class="card-title text-nowrap mb-1">{{ $data['count']['Training'] }}</h3>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <div class="card">
                        <a href="/director/vertical/2">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="theme/public/assets/img/icons/unicons/chart-success.png" alt="chart success" class="rounded">
                                    </div>
                                </div>
                                <span>Consultancy</span>
                                <h3 class="card-title text-nowrap mb-1">{{ $data['count']['Consultancy'] }}</h3>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="cart-titile">
                        <h5>Vertical wise Projects</h5>
                        </div>
                        <canvas id="donutChart"></canvas>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const labels = ['Training', 'Consultancy', 'Retail'];
            const data = [{{ $data['count']['Training'] }}, {{ $data['count']['Consultancy'] }},
                {{ $data['count']['Retail'] }}
            ];
            const donutChart = document.getElementById('donutChart').getContext('2d');
            new Chart(donutChart, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Progress',
                        data: data,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(255, 206, 86, 0.5)',
                            'rgba(75, 192, 192, 0.5)',
                            'rgba(153, 102, 255, 0.5)',
                            'rgba(255, 159, 64, 0.5)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom'
                        }
                    }
                }
            });
        });
    </script>
@endsection