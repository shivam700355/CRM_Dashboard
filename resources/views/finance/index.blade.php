@php
    $profile = ['name' => $data['name'], 'role' => $data['role']];
@endphp

@extends('layouts.app')

@section('content')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('finance.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Index</li>
        </ol>
    </nav>
</div>

@if (session('success'))
    <div class="alert alert-success col-12">{{ session('success') }}</div>
@endif
@if (session('error'))
    <div class="alert alert-danger col-12">{{ session('error') }}</div>
@endif

<section class="section dashboard">
    <div class="row">
        <!-- Pie Chart -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                    <div id="pieChart" style="min-height: 400px;" class="echart"></div>
                    <script>
                        document.addEventListener("DOMContentLoaded", () => {
                            echarts.init(document.querySelector("#pieChart")).setOption({
                                title: {
                                    text: 'TDS Distribution',
                                    subtext: 'Income TDS Data',
                                    left: 'center'
                                },
                                tooltip: {
                                    trigger: 'item'
                                },
                                legend: {
                                    orient: 'vertical',
                                    left: 'left'
                                },
                                series: [{
                                    name: 'TDS Amount',
                                    type: 'pie',
                                    radius: '50%',
                                    data: [
                                        @foreach ($data['Income'] as $item)
                                                    {
                                                value: {{ $item->tds_amount }},
                                                name: '{{ $item->name_type }}'
                                            },
                                        @endforeach
                                    ],
                                    itemStyle: {
                                        color: (params) => {
                                            const colors = ['#ff6384', '#36a2eb', '#cc65fe', '#ffce56'];
                                            return colors[params.dataIndex % colors.length];
                                        }
                                    },
                                    emphasis: {
                                        itemStyle: {
                                            shadowBlur: 10,
                                            shadowOffsetX: 0,
                                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                                        }
                                    }
                                }]
                            });
                        });
                    </script>
                </div>
            </div>
        </div>


        <!-- Donut Chart -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                    <div id="donutChart" style="height: 400px;" class="echart"></div>
                    <script>
                        document.addEventListener("DOMContentLoaded", () => {
                            echarts.init(document.querySelector("#donutChart")).setOption({
                                title: {
                                    text: 'GST Liability Distribution',
                                    subtext: 'GST Data',
                                    left: 'center'
                                },
                                tooltip: {
                                    trigger: 'item'
                                },
                                legend: {
                                    top: 'bottom'
                                },
                                series: [{
                                    name: 'Tax Amount',
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
                                    data: [
                                        @foreach ($data['Gst'] as $gst)
                                                    {
                                                value: {{ $gst->tax_amount }},
                                                name: '{{ $gst->name }}'
                                            },
                                        @endforeach
                                    ],
                                    itemStyle: {
                                        color: (params) => {
                                            const colors = ['#ff6384', '#36a2eb', '#cc65fe', '#ffce56'];
                                            return colors[params.dataIndex % colors.length];
                                        }
                                    }
                                }]
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                    <canvas id="lineChart" style="height: 400px;"></canvas>
                    <script>
                        document.addEventListener("DOMContentLoaded", () => {
                            const incomeData = @json($data['Income']->pluck('tds_amount'));
                            const labels = @json($data['Income']->pluck('challan_date'));
                            const ctx = document.getElementById('lineChart').getContext('2d');
                            new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: 'TDS Amount',
                                        data: incomeData,
                                        borderColor: 'rgba(75, 192, 192, 1)', // Change this color as needed
                                        backgroundColor: 'rgba(75, 192, 192, 0.2)', // Optional: Add a background color
                                        borderWidth: 2,
                                        fill: false
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
        <!-- Line Chart -->

    </div>
   


   




</section>
@endsection