@php
    $profile = ['name' => $data['name'], 'role' => $data['role']];
@endphp
@extends('layouts.app', ['profile' => $profile])

@section('content')
    {{-- <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div> --}}

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Finance Data</h5>

                        <!-- Default Tabs -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="TotalTDSAmount-tab" data-bs-toggle="tab"
                                    data-bs-target="#TotalTDSAmount" type="button" role="tab"
                                    aria-controls="TotalTDSAmount" aria-selected="true">INCOME TAX
                                    TDS</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#GSTLiability" type="button" role="tab"
                                    aria-controls="GSTLiability" aria-selected="false" tabindex="-1">GST Liability
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="EPFESI-tab" data-bs-toggle="tab" data-bs-target="#EPFESI"
                                    type="button" role="tab" aria-controls="EPFESI" aria-selected="false"
                                    tabindex="-1">EPF/ESI</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="Bank-tab" data-bs-toggle="tab" data-bs-target="#Bank"
                                    type="button" role="tab" aria-controls="Bank" aria-selected="false"
                                    tabindex="-1">Bank</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="Payment-tab" data-bs-toggle="tab" data-bs-target="#Payment"
                                    type="button" role="tab" aria-controls="Payment" aria-selected="false"
                                    tabindex="-1">Payment To Vendor</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="Advance-tab" data-bs-toggle="tab" data-bs-target="#Advance"
                                    type="button" role="tab" aria-controls="Advance" aria-selected="false"
                                    tabindex="-1">Advance To Staff</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2" id="myTabContent">
                            <div class="tab-pane fade active show" id="TotalTDSAmount" role="tabpanel"
                                aria-labelledby="TotalTDSAmount-tab">
                                <div class="row">

                                    <div class="col-lg-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    {{-- <h5 class="card-title">Income Tax TDS</h5> --}}
                                                    <!-- <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#incometextds">
                                                                                                                                                                                                                    <i class="bi bi-plus"></i>
                                                                                                                                                                                                                </button> -->
                                                </div>

                                                <table class="table table-striped datatable bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>S.N</th>
                                                            <th>Type</th>
                                                            <th>TDS Amount</th>
                                                            <th>Challan No.</th>
                                                            <th>Challan Date</th>
                                                            <th>Due Date</th>
                                                            <!-- <th>Action</th> -->
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($data['Income'] as $index => $gsts)
                                                            <tr>
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>{{ $gsts->name_type }}</td>
                                                                <td>{{ $gsts->tds_amount }} ₹</td>
                                                                <td>{{ $gsts->challan_no }}</td>
                                                                <td>{{ \Carbon\Carbon::parse($gsts->challan_date)->format('d M Y') }}
                                                                </td>
                                                                <td>{{ \Carbon\Carbon::parse($gsts->due_date)->format('d M Y') }}
                                                                </td>
                                                                <!-- <td>
                                                                                                                                                                                                                                                    <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                                                                                                                                                                                                                        data-bs-target="#editIncomeTaxModal"
                                                                                                                                                                                                                                                        onclick="incometaxtds('{{ $gsts->id }}', '{{ $gsts->name_type }}', '{{ $gsts->tds_amount }}', '{{ $gsts->challan_no }}', '{{ $gsts->challan_date }}', '{{ $gsts->due_date }}', '{{ $gsts->remark }}')">
                                                                                                                                                                                                                                                        <i class="ri-edit-2-fill"></i>
                                                                                                                                                                                                                                                    </button>
                                                                                                                                                                                                                                                    <button class="btn btn-danger btn-sm">
                                                                                                                                                                                                                                                        <i class="ri-delete-bin-6-line"></i>
                                                                                                                                                                                                                                                    </button>
                                                                                                                                                                                                                                                </td> -->
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="2"><strong>Total TDS Amount</strong></td>
                                                            <td><strong>{{ $data['Income']->sum('tds_amount') }} ₹</strong>
                                                            </td>
                                                            <td colspan="4"></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">


                                        <div class="card ">
                                            <div class="card-header">
                                                <form action="" method="GET">
                                                    <div class="row d-flex align-items-center">
                                                        <div class="col-md-4">
                                                            <select id="yearFilter" name="incomeyearFilter"
                                                                class="form-control form-control-sm mx-2 ">
                                                                <option value="">Year</option>
                                                                @foreach (range(date('Y') - 10, date('Y')) as $year)
                                                                    <option value="{{ $year }}">
                                                                        {{ $year }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <select id="monthFilter" name="incomemonthFilter"
                                                                class="form-control form-control-sm mx-2 ">
                                                                <option value="">Month</option>
                                                                @foreach (range(1, 12) as $month)
                                                                    <option
                                                                        value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}">
                                                                        {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <button type="submit"
                                                                class="btn btn-primary btn-sm mx-2 ">Filter</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="card-body">

                                                <div id="pieChart" style="min-height: 400px;" class="echart"></div>
                                                <script>
                                                    document.addEventListener("DOMContentLoaded", () => {
                                                        echarts.init(document.querySelector("#pieChart")).setOption({
                                                            title: {
                                                                text: 'INCOME TAX TDS',
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

                                </div>
                            </div>
                            <div class="tab-pane fade" id="GSTLiability" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">

                                    <div class="col-lg-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    {{-- <h5 class="card-title">GST TDS/GST Liability</h5> --}}
                                                    <!-- <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#gstTdsModal">
                                                                                                                                                                                                                        <i class="bi bi-plus"></i>
                                                                                                                                                                                                                    </button> -->
                                                </div>

                                                <table class="table table-striped datatable bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>S.N</th>
                                                            <th>Type</th>
                                                            <th>Name</th>
                                                            <th>Tax Amount</th>
                                                            <th>Challan Date</th>
                                                            <th>Due Date</th>
                                                            <!-- <th>Action</th> -->
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($data['Gst'] as $index => $gsts)
                                                            <tr>
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>{{ $gsts->name_type }}</td>
                                                                <td>{{ $gsts->name }}</td>
                                                                <td>{{ $gsts->tax_amount }} ₹</td>
                                                                <td>{{ \Carbon\Carbon::parse($gsts->challan_date)->format('d M Y') }}
                                                                </td>
                                                                <td>{{ \Carbon\Carbon::parse($gsts->due_date)->format('d M Y') }}
                                                                </td>
                                                                <!-- <td>
                                                                                                                                                                                                                                                        <button class="btn btn-success btn-sm"><i class="ri-edit-2-fill"></i></button>
                                                                                                                                                                                                                                                        <button class="btn btn-danger btn-sm"><i class="ri-delete-bin-6-line"></i></button>
                                                                                                                                                                                                                                                    </td> -->
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="3"><strong>Total Amount</strong></td>
                                                            <td><strong>{{ $data['Gst']->sum('tax_amount') }} ₹</strong>
                                                            </td>
                                                            <td colspan="4"></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">

                                        <div class="card ">
                                            <div class="card-header">
                                                <form action="" method="GET">
                                                    <div class="row d-flex align-items-center">


                                                        <div class="col-md-4">
                                                            <select id="yearFilter" name="gstyearFilter"
                                                                class="form-control form-control-sm mx-2 ">
                                                                <option value="">Year</option>
                                                                @foreach (range(date('Y') - 10, date('Y')) as $year)
                                                                    <option value="{{ $year }}">
                                                                        {{ $year }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <select id="monthFilter" name="gstmonthFilter"
                                                                class="form-control form-control-sm mx-2 ">
                                                                <option value="">Month</option>
                                                                @foreach (range(1, 12) as $month)
                                                                    <option
                                                                        value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}">
                                                                        {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <button type="submit"
                                                                class="btn btn-primary btn-sm mx-2 ">Filter</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

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
                                </div>
                            </div>
                            <div class="tab-pane fade" id="EPFESI" role="tabpanel" aria-labelledby="EPFESI-tab">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h5 class="card-title">EPFs</h5>
                                                    {{-- <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#epfModal">
                                                        <i class="bi bi-plus"></i>
                                                    </button> --}}
                                                </div>

                                                <table class="table table-striped datatable bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>S.N</th>
                                                            <th>Type</th>
                                                            <th>EPF Amount</th>
                                                            <th>Challan No.</th>
                                                            <th>Challan Date</th>
                                                            <th>Due Date</th>
                                                            <!-- <th>Action</th> -->
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($data['Epf'] as $index => $epf)
                                                            <tr>
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>{{ $epf->name_type }}</td>
                                                                <td>{{ $epf->amount }} ₹</td>
                                                                <td>{{ $epf->challan_period }}</td>
                                                                <td>{{ \Carbon\Carbon::parse($epf->challan_date)->format('d M Y') }}
                                                                </td>
                                                                <td>{{ \Carbon\Carbon::parse($epf->due_date)->format('d M Y') }}
                                                                </td>
                                                                <!-- <td>
                                                                                                                                                                                                                                                        <button class="btn btn-success btn-sm"><i class="ri-edit-2-fill"></i></button>
                                                                                                                                                                                                                                                        <button class="btn btn-danger btn-sm"><i class="ri-delete-bin-6-line"></i></button>
                                                                                                                                                                                                                                                    </td> -->
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="2"><strong>Total EPF Amount</strong></td>
                                                            <td><strong>{{ $data['Epf']->sum('amount') }} ₹</strong></td>
                                                            <td colspan="4"></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">EPF/ESI</h5>

                                                <!-- Radial Bar Chart -->
                                                <div id="radialBarChart" style="min-height: 308.7px;"></div>

                                                <script>
                                                    document.addEventListener("DOMContentLoaded", () => {
                                                        const epfData = @json($data['Epf']->pluck('amount')); // Extract the amounts
                                                        const epfLabels = @json($data['Epf']->pluck('name_type')); // Extract the type/name labels
                                                        const epfChallan = @json($data['Epf']->pluck('challan_period')); // Extract the challan numbers

                                                        new ApexCharts(document.querySelector("#radialBarChart"), {
                                                            series: epfData,
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
                                                                        },
                                                                        value: {
                                                                            fontSize: '16px',
                                                                        },
                                                                        total: {
                                                                            show: true,
                                                                            label: 'Total',
                                                                            formatter: function(w) {
                                                                                // Calculate total EPF amount
                                                                                return epfData.reduce((total, amount) => total + amount, 0) + ' ₹';
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            },
                                                            labels: epfLabels, // EPF type names

                                                            tooltip: {
                                                                enabled: true,
                                                                y: {
                                                                    formatter: function(value, {
                                                                        seriesIndex
                                                                    }) {
                                                                        // Display the EPF amount along with the Challan No. in the tooltip
                                                                        return value + ' ₹' + ' (Challan Date.: ' + epfChallan[seriesIndex] + ')';
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

                            <div class="tab-pane fade" id="Bank" role="tabpanel" aria-labelledby="Bank-tab">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h5 class="card-title">Bank Information</h5>
                                                    {{-- <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#epfModal">
                                                        <i class="bi bi-plus"></i>
                                                    </button> --}}
                                                </div>

                                                <table class="table table-striped datatable bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>S.N</th>
                                                            <th>Bank Name</th>
                                                            <th>Account Number</th>
                                                            <th>Amount</th>
                                                            <th>Created At</th>
                                                            {{-- <th>Due Date</th> --}}
                                                            <!-- <th>Action</th> -->
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($data['Bank'] as $index => $banks)
                                                            <tr>
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>{{ $banks->bank_name }}</td>
                                                                <td>{{ $banks->account_detail }} </td>
                                                                <td>{{ number_format($banks->amount, 2) }} ₹</td>

                                                                <td>{{ \Carbon\Carbon::parse($banks->added_by)->format('d M Y') }}
                                                                </td>
                                                                {{-- <td>{{ \Carbon\Carbon::parse($epf->due_date)->format('d M Y') }}</td> --}}
                                                                <!-- <td>
                                                                                                                                                                                                                                                        <button class="btn btn-success btn-sm"><i class="ri-edit-2-fill"></i></button>
                                                                                                                                                                                                                                                        <button class="btn btn-danger btn-sm"><i class="ri-delete-bin-6-line"></i></button>
                                                                                                                                                                                                      </td> -->
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="3"><strong>Total EPF Amount</strong></td>
                                                            <td><strong>{{ number_format($data['Bank']->sum('amount'), 2) }}
                                                                    ₹</strong></td>
                                                            <td colspan="4"></td>
                                                        </tr>
                                                    </tfoot>

                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Bank Information</h5>

                                                <!-- Bar Chart -->
                                                <canvas id="barChart"
                                                    style="max-height: 400px; display: block; box-sizing: border-box; height: 331px; width: 663px;"
                                                    width="1326" height="663"></canvas>
                                                <script>
                                                    document.addEventListener("DOMContentLoaded", () => {
                                                        // Get bank names and amounts from Blade
                                                        const bankNames = @json($data['Bank']->pluck('bank_name'));
                                                        const bankAmounts = @json($data['Bank']->pluck('amount'));

                                                        // Create the bar chart using Chart.js
                                                        new Chart(document.querySelector('#barChart'), {
                                                            type: 'bar',
                                                            data: {
                                                                labels: bankNames, // Labels for the x-axis (bank names)
                                                                datasets: [{
                                                                    label: 'Amount (₹)',
                                                                    data: bankAmounts, // Data for the y-axis (amounts)
                                                                    backgroundColor: [
                                                                        'rgba(255, 99, 132, 0.2)',
                                                                        'rgba(255, 159, 64, 0.2)',
                                                                        'rgba(255, 205, 86, 0.2)',
                                                                        'rgba(75, 192, 192, 0.2)',
                                                                        'rgba(54, 162, 235, 0.2)',
                                                                        'rgba(153, 102, 255, 0.2)',
                                                                        'rgba(201, 203, 207, 0.2)'
                                                                    ],
                                                                    borderColor: [
                                                                        'rgb(255, 99, 132)',
                                                                        'rgb(255, 159, 64)',
                                                                        'rgb(255, 205, 86)',
                                                                        'rgb(75, 192, 192)',
                                                                        'rgb(54, 162, 235)',
                                                                        'rgb(153, 102, 255)',
                                                                        'rgb(201, 203, 207)'
                                                                    ],
                                                                    borderWidth: 1
                                                                }]
                                                            },
                                                            options: {
                                                                scales: {
                                                                    y: {
                                                                        beginAtZero: true
                                                                    }
                                                                }
                                                            }
                                                        });
                                                    });
                                                </script>
                                                <!-- End Bar Chart -->

                                            </div>
                                            <div class="card-footer">
                                                <h6><strong>Total Amount:
                                                        {{ number_format($data['Bank']->sum('amount'), 2) }} ₹</strong>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="Payment" role="tabpanel" aria-labelledby="Payment-tab">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h5 class="card-title">Payment to Vendor</h5>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-striped datatable bordered"
                                                        style="font-size: 12px">
                                                        <thead>
                                                            <tr>
                                                                <th>S.N</th>
                                                                <th>Date</th>
                                                                <th>Vendor Name</th>
                                                                <th>Amount</th>
                                                                <th>Initiated By</th>
                                                                <th>Checked By</th>
                                                                <th>Approved By</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($data['Payments'] as $index => $Payment)
                                                                <tr>
                                                                    <td>{{ $index + 1 }}</td>
                                                                    <td>{{ \Carbon\Carbon::parse($Payment->pay_date)->format('d M Y') }}
                                                                    </td>
                                                                    <td>{{ $Payment->vendor_name }}</td>
                                                                    <td>{{ number_format((float) $Payment->pay_amount, 2) }}
                                                                        ₹</td>
                                                                    <td>{{ $Payment->initiated_by }}</td>
                                                                    <td>{{ $Payment->checked_by }}</td>
                                                                    <td>{{ $Payment->approved_by }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td colspan="3"><strong>Total Payment Amount</strong>
                                                                </td>
                                                                <td><strong>{{ number_format((float) $data['Payments']->sum('pay_amount'), 2) }}
                                                                        ₹</strong></td>
                                                                <td colspan="3"></td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Column Chart</h5>

                                                <!-- Column Chart -->
                                                <div class="chart-container">
                                                    <canvas id="paymentsChart"></canvas>
                                                </div>

                                                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                                <script>
                                                    const paymentData = @json($data['Payments']);

                                                    // Prepare data for the chart
                                                    const labels = paymentData.map(payment => {
                                                        return new Date(payment.pay_date).toLocaleDateString('en-US', {
                                                            year: 'numeric',
                                                            month: 'short',
                                                            day: 'numeric'
                                                        });
                                                    });

                                                    const amounts = paymentData.map(payment => parseFloat(payment.pay_amount));

                                                    // Map additional data for tooltip
                                                    const initiatedBy = paymentData.map(payment => payment.initiated_by);
                                                    const checkedBy = paymentData.map(payment => payment.checked_by);
                                                    const approvedBy = paymentData.map(payment => payment.approved_by);

                                                    const ctx = document.getElementById('paymentsChart').getContext('2d');
                                                    const paymentsChart = new Chart(ctx, {
                                                        type: 'line',
                                                        data: {
                                                            labels: labels,
                                                            datasets: [{
                                                                label: 'Payment Amount (₹)',
                                                                data: amounts,
                                                                borderColor: 'rgba(75, 192, 192, 1)',
                                                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                                                borderWidth: 2,
                                                                fill: true,
                                                            }]
                                                        },
                                                        options: {
                                                            responsive: true,
                                                            plugins: {
                                                                tooltip: {
                                                                    callbacks: {
                                                                        label: function(context) {
                                                                            const index = context.dataIndex; // Get the index of the data point
                                                                            return [
                                                                                `Amount: ₹${context.raw.toFixed(2)}`,
                                                                                `Initiated By: ${initiatedBy[index]}`,
                                                                                `Checked By: ${checkedBy[index]}`,
                                                                                `Approved By: ${approvedBy[index]}`
                                                                            ];
                                                                        }
                                                                    }
                                                                }
                                                            },
                                                            scales: {
                                                                y: {
                                                                    beginAtZero: true
                                                                }
                                                            }
                                                        }
                                                    });
                                                </script>

                                                <!-- End Column Chart -->
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Bar Chart Section -->

                                </div>
                            </div>
                            <!-- End Default Tabs -->
                            <div class="tab-pane fade" id="Advance" role="tabpanel" aria-labelledby="Advance-tab">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h5 class="card-title">Advance To Staff</h5>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-striped datatable bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>S.N</th>
                                                                <th>Name</th>
                                                                <th>Advance Amount</th>
                                                                <th>Advance Date</th>
                                                                <th>Pending Date</th>
                                                                <th>User Status</th>
                                                                <th>Remark</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($data['Advances'] as $index => $Adv)
                                                                <tr>
                                                                    <td>{{ $index + 1 }}</td>
                                                                    <td>{{ $Adv->particulars }}</td>
                                                                    <td>{{ number_format($Adv->adv_amount, 2) }} ₹</td>
                                                                    <td>{{ \Carbon\Carbon::parse($Adv->adv_date)->format('d M Y') }}
                                                                    </td>
                                                                    <td>{{ \Carbon\Carbon::parse($Adv->pending_date)->format('d M Y') }}
                                                                    </td>
                                                                    <td>{{ $Adv->user_status }}</td>
                                                                    <td>{{ $Adv->remark }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td colspan="2"><strong>Total Amount</strong>
                                                                </td>
                                                                <td><strong>{{ number_format($data['Advances']->sum('adv_amount'), 2) }}
                                                                        ₹</strong></td>
                                                                <td colspan="4"></td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Advance Amounts </h5>

                                                <!-- Line Chart -->
                                                <canvas id="lineChart" style="max-height: 400px;"></canvas>

                                                <script>
                                                    document.addEventListener("DOMContentLoaded", () => {
                                                        // Prepare the data from PHP
                                                        const labels = @json($data['Advances']->pluck('adv_date')->map(fn($date) => \Carbon\Carbon::parse($date)->format('d M Y')));
                                                        const dataPoints = @json($data['Advances']->pluck('adv_amount'));

                                                        new Chart(document.querySelector('#lineChart'), {
                                                            type: 'line',
                                                            data: {
                                                                labels: labels,
                                                                datasets: [{
                                                                    label: 'Advance Amounts',
                                                                    data: dataPoints,
                                                                    fill: false,
                                                                    borderColor: 'rgb(75, 192, 192)',
                                                                    tension: 0.1
                                                                }]
                                                            },
                                                            options: {
                                                                scales: {
                                                                    y: {
                                                                        beginAtZero: true
                                                                    }
                                                                }
                                                            }
                                                        });
                                                    });
                                                </script>
                                                <!-- End Line Chart -->
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>
                    </div>



                </div>
                <!-- Pie Chart -->







                <!-- Line Chart -->

            </div>









    </section>
@endsection
