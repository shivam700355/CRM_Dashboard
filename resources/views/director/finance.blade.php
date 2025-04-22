@php
    $profile = ['name' => $data['name'], 'role' => $data['role']];
@endphp
@extends('layouts.app', ['profile' => $profile])

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/director">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard">
        <div class="row">
            @if ($data['key'] == 'incometaxtds')
                <div class="col-lg-8 col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <form action="" method="GET">
                                <div class="row d-flex align-items-center">
                                    <div class="col-md-4">
                                        <select id="yearFilter" name="incomeyearFilter"
                                            class="form-control form-control-sm mx-2" required>
                                            <option value="">Year</option>
                                            @foreach (range(date('Y') - 10, date('Y')) as $year)
                                                <option value="{{ $year }}">{{ $year }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select id="monthFilter" name="incomemonthFilter"
                                            class="form-control form-control-sm mx-2" required>
                                            <option value="">Month</option>
                                            @foreach (range(1, 12) as $month)
                                                <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}">
                                                    {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-1 d-flex">
                                        <button type="submit" class="btn btn-primary btn-sm mx-2">Filter</button>
                                        <a href="{{ route('director.financedata', ['key' => 'income']) }}"
                                            class="btn btn-primary btn-sm" target="_blank">
                                            <i class="ri-eye-line"></i>
                                        </a>

                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Income Tax TDS</h5>
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
                                            <td>₹{{ $gsts->tds_amount }} </td>
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
                                        <td><strong>₹{{ $data['Income']->sum('tds_amount') }} </strong>
                                        </td>
                                        <td colspan="4"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="card">
                        <!-- Card Header -->
                        <div class="card-header">
                            <form action="" method="GET">
                                <div class="row d-flex align-items-center">
                                    <div class="col-md-4">
                                        <select id="yearFilter" name="incomeyearFilter"
                                            class="form-control form-control-sm mx-2" required>
                                            <option value="">Year</option>
                                            @foreach (range(date('Y') - 10, date('Y')) as $year)
                                                <option value="{{ $year }}">{{ $year }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select id="monthFilter" name="incomemonthFilter"
                                            class="form-control form-control-sm mx-2" required>
                                            <option value="">Month</option>
                                            @foreach (range(1, 12) as $month)
                                                <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}">
                                                    {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-1 d-flex">
                                        <button type="submit" class="btn btn-primary btn-sm mx-2">Filter</button>
                                        <a href="{{ route('director.financedata', ['key' => 'income']) }}"
                                            class="btn btn-primary btn-sm" target="_blank">
                                            <i class="ri-eye-line"></i>
                                        </a>

                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Card Body -->
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
                                            trigger: 'item',
                                            formatter: function(params) {
                                                return `
                                    <strong>${params.data.name}</strong><br/>
                                    TDS Amount: ₹${params.data.value} <br/>
                                    Challan Date: ${params.data.challan_date}<br/>
                                    Due Date: ${params.data.due_date}
                                `;
                                            }
                                        },
                                        legend: {
                                            orient: 'vertical',
                                            left: 'left'
                                        },
                                        series: [{
                                            name: 'TDS Amount',
                                            type: 'pie',
                                            radius: '50%',
                                            label: {
                                                formatter: '{b}: ₹{c} ',
                                                color: '#000'
                                            },
                                            data: [
                                                @foreach ($data['Income'] as $item)
                                                    {
                                                        value: {{ $item->tds_amount }},
                                                        name: '{{ $item->name_type }}',
                                                        challan_date: '{{ $item->challan_date }}',
                                                        due_date: '{{ $item->due_date }}'
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

                        <!-- Card Footer -->
                        <div class="card-footer">
                            <h6><strong>Total TDS Amount:
                                    ₹ {{ number_format($data['Income']->sum('tds_amount'), 2) }} </strong>
                            </h6>
                        </div>
                    </div>
                </div>
            @endif
            @if ($data['key'] == 'gst')
                <div class="col-log-8 col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <form action="" method="GET">
                                <div class="row d-flex align-items-center">
                                    <div class="col-md-4">
                                        <select id="yearFilter" name="gstyearFilter"
                                            class="form-control form-control-sm mx-2" required>
                                            <option value="">Year</option>
                                            @foreach (range(date('Y') - 10, date('Y')) as $year)
                                                <option value="{{ $year }}">
                                                    {{ $year }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select id="monthFilter" name="gstmonthFilter"
                                            class="form-control form-control-sm mx-2" required>
                                            <option value="">Month</option>
                                            @foreach (range(1, 12) as $month)
                                                <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}">
                                                    {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 d-flex">
                                        <button type="submit" class="btn btn-primary btn-sm mx-2">Filter</button>
                                        <a href="{{ route('director.financedata', ['key' => 'gst']) }}"
                                            class="btn btn-primary btn-sm" target="_blank">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-striped datatable bordered">
                                    <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>Type</th>
                                            <th>CGST</th>
                                            <th>SGST</th>
                                            <th>IGST</th>
                                            <th>Challan Date</th>
                                            <th>Due Date</th>
                                            {{-- <th>Remark</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $c_gst_total = 0; // Initialize total CGST
                                            $s_gst_total = 0; // Initialize total SGST
                                            $i_gst_total = 0; // Initialize total IGST
                                        @endphp

                                        @foreach ($data['Gst'] as $index => $gsts)
                                            @php
                                                // Accumulate totals
                                                $c_gst_total += $gsts->c_gst;
                                                $s_gst_total += $gsts->s_gst;
                                                $i_gst_total += $gsts->i_gst;
                                            @endphp
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $gsts->name_type }}</td>
                                                <td>₹{{ number_format($gsts->c_gst, 2) }} </td>
                                                <td>₹{{ number_format($gsts->s_gst, 2) }} </td>
                                                <td>₹{{ number_format($gsts->i_gst, 2) }} </td>
                                                <td>{{ \Carbon\Carbon::parse($gsts->challan_date)->format('d M Y') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($gsts->due_date)->format('d M Y') }}
                                                </td>
                                                {{-- <td>
                                                                    {{ isset($gsts->remark) ? $gsts->remark : 'NULL' }}

                                                                </td> --}}
                                            </tr>
                                        @endforeach
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <td colspan="2" class="text-end"><strong>Total</strong></td>
                                            <td><strong>₹{{ number_format($c_gst_total, 2) }} </strong>
                                            </td>
                                            <td><strong>₹{{ number_format($s_gst_total, 2) }} </strong>
                                            </td>
                                            <td><strong>₹{{ number_format($i_gst_total, 2) }} </strong>
                                            </td>
                                            <td colspan="3"></td>
                                        </tr>
                                    </tfoot>
                                </table>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="card">
                        <!-- Card Header -->
                        <div class="card-header">
                            <form action="" method="GET">
                                <div class="row d-flex align-items-center">
                                    <div class="col-md-4">
                                        <select id="yearFilter" name="gstyearFilter"
                                            class="form-control form-control-sm mx-2" required>
                                            <option value="">Year</option>
                                            @foreach (range(date('Y') - 10, date('Y')) as $year)
                                                <option value="{{ $year }}">
                                                    {{ $year }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select id="monthFilter" name="gstmonthFilter"
                                            class="form-control form-control-sm mx-2" required>
                                            <option value="">Month</option>
                                            @foreach (range(1, 12) as $month)
                                                <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}">
                                                    {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 d-flex">
                                        <button type="submit" class="btn btn-primary btn-sm mx-2">Filter</button>
                                        <a href="{{ route('director.financedata', ['key' => 'gst']) }}"
                                            class="btn btn-primary btn-sm" target="_blank">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body">
                            <div id="donutChart" style="height: 400px;" class="echart"></div>
                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    echarts.init(document.querySelector("#donutChart")).setOption({
                                        title: {
                                            text: 'GST Liability Distribution',

                                            left: 'center'
                                        },
                                        tooltip: {
                                            trigger: 'item',
                                            formatter: function(params) {
                                                // Show only SGST, CGST, and IGST in the tooltip
                                                return `CGST: ₹${params.data.cgst} <br/>
                            SGST: ₹${params.data.sgst} <br/>
                            IGST: ₹${params.data.igst} `;
                                            }
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
                                                show: true,
                                                position: 'outer',
                                                formatter: function(params) {
                                                    // Show the date in the label
                                                    return `Date: ${params.data.date}`;
                                                }
                                            },
                                            emphasis: {
                                                label: {
                                                    show: true,
                                                    fontSize: '18',
                                                    fontWeight: 'bold'
                                                }
                                            },
                                            labelLine: {
                                                show: true
                                            },
                                            data: [
                                                @foreach ($data['Gst'] as $gst)
                                                    {
                                                        value: {{ $gst->tax_amount }},
                                                        name: '{{ $gst->name }}',
                                                        date: '{{ \Carbon\Carbon::parse($gst->challan_date)->format('d M Y') }}',
                                                        cgst: {{ $gst->c_gst }},
                                                        sgst: {{ $gst->s_gst }},
                                                        igst: {{ $gst->i_gst }}
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

                        <!-- Card Footer: Display Total GST Amount -->
                        <div class="card-footer">
                            <h6><strong>Total GST Amount:
                                    ₹ {{ number_format($data['Gst']->sum('tax_amount'), 2) }} </strong>
                            </h6>
                        </div>
                    </div>
                </div>
            @endif
            @if ($data['key'] == 'epfesi')
                <div class="col-lg-8 col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <form action="" method="GET">
                                <div class="row d-flex align-items-center">
                                    <div class="col-md-4">
                                        <select id="yearFilter" name="epfesiyearFilter"
                                            class="form-control form-control-sm mx-2" required>
                                            <option value="">Year</option>
                                            @foreach (range(date('Y') - 10, date('Y')) as $year)
                                                <option value="{{ $year }}">
                                                    {{ $year }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select id="monthFilter" name="epfesimonthFilter"
                                            class="form-control form-control-sm mx-2" required>
                                            <option value="">Month</option>
                                            @foreach (range(1, 12) as $month)
                                                <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}">
                                                    {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 d-flex">
                                        <button type="submit" class="btn btn-primary btn-sm mx-2">Filter</button>
                                        <a href="{{ route('director.financedata', ['key' => 'gst']) }}"
                                            class="btn btn-primary btn-sm" target="_blank">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>

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
                                        <td>₹{{ $epf->amount }} </td>
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
                                    <td><strong>₹{{ $data['Epf']->sum('amount') }} </strong></td>
                                    <td colspan="4"></td>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="card">
                        <!-- Card Header -->
                        <div class="card-header justify-content-between d-flex align-items-center">
                            <h5>EPF/ESI Report</h5>

                            <a href="{{ route('director.financedata', ['key' => 'epfesi']) }}"
                                class="btn btn-primary btn-sm" target="_blank">
                                <i class="ri-eye-line"></i>
                            </a>

                        </div>

                        <!-- Card Body -->
                        <div class="card-body">


                            <!-- Radial Bar Chart -->
                            <div id="radialBarChart"></div>
                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    const epfData = @json($data['Epf']->pluck('amount')); // Extract the amounts
                                    const epfLabels = @json($data['Epf']->pluck('name_type')); // Extract the type/name labels
                                    const epfChallan = @json($data['Epf']->pluck('challan_period')); // Extract the challan numbers
                                    const epfChallanDate = @json($data['Epf']->pluck('challan_date')); // Extract the challan dates
                                    const epfDueDate = @json($data['Epf']->pluck('due_date')); // Extract the due dates

                                    // Calculate total EPF amount for percentage calculation
                                    const totalAmount = epfData.reduce((total, amount) => total + amount, 0);

                                    // Calculate percentages based on the total amount
                                    const percentageData = epfData.map(amount => ((amount / totalAmount) * 100).toFixed(2));

                                    // Formatter function to convert numbers to K or Cr format
                                    function formatNumber(num) {
                                        if (num >= 10000000) {
                                            return (num / 10000000).toFixed(2) + ' Cr'; // Convert to Crores
                                        } else if (num >= 1000) {
                                            return (num / 1000).toFixed(2) + ' K'; // Convert to Thousands
                                        }
                                        return num.toFixed(2); // Return the number as is if it's less than 1000
                                    }

                                    new ApexCharts(document.querySelector("#radialBarChart"), {
                                        series: percentageData, // Use percentage data for the chart
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
                                                        offsetY: 5, // Adjust the position of the label
                                                        color: '#fff', // Set label color
                                                        fontWeight: 'bold' // Bold the label
                                                    },
                                                    value: {
                                                        fontSize: '16px',
                                                        formatter: function(val) {
                                                            return val + '%'; // Display percentage in the chart
                                                        }
                                                    },
                                                    total: {
                                                        show: true,
                                                        label: 'Total',
                                                        formatter: function() {
                                                            return ' ₹' + formatNumber(
                                                                totalAmount); // Display the total amount in K/Cr format
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
                                                    // Display the EPF amount with Challan Date and Due Date in the tooltip
                                                    const amount = epfData[seriesIndex]; // Get the actual amount
                                                    const challanDate = new Date(epfChallanDate[seriesIndex])
                                                        .toLocaleDateString('en-GB', {
                                                            day: '2-digit',
                                                            month: 'short',
                                                            year: 'numeric'
                                                        });
                                                    const dueDate = new Date(epfDueDate[seriesIndex]).toLocaleDateString(
                                                        'en-GB', {
                                                            day: '2-digit',
                                                            month: 'short',
                                                            year: 'numeric'
                                                        });
                                                    return ` ₹${formatNumber(amount)}  (Challan Date: ${challanDate}, Due Date: ${dueDate})`;
                                                }
                                            }
                                        }
                                    }).render();
                                });
                            </script>


                            <!-- End Radial Bar Chart -->
                        </div>

                        <!-- Card Footer: Display Total EPF Amount -->
                        <div class="card-footer">
                            <h6><strong>Total EPF Amount:
                                    ₹{{ number_format($data['Epf']->sum('amount'), 2) }}
                                </strong></h6>
                        </div>
                    </div>
                </div>
            @endif
            @if ($data['key'] == 'advancetostaff')
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header justify-content-between d-flex align-items-center">
                                <h5>Advance To Staff</h5>

                                <a href="{{ route('director.financedata', ['key' => 'advance']) }}"
                                    class="btn btn-primary btn-sm" target="_blank">
                                    <i class="ri-eye-line"></i>
                                </a>

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
                                            <th>Total Days</th>
                                            <th>Remark</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['Advances'] as $index => $Adv)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $Adv->particulars }}</td>
                                                <td>₹{{ number_format($Adv->adv_amount, 2) }}</td>
                                                <td>{{ \Carbon\Carbon::parse($Adv->adv_date)->format('d M Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($Adv->pending_date)->format('d M Y') }}</td>
                                                <td>{{ $Adv->user_status }}</td>
                                                <td>
                                                    <span id="short-text-{{ $index }}">
                                                        {{ implode(' ', array_slice(explode(' ', $Adv->remark), 0, 5)) }}
                                                        @if (str_word_count($Adv->remark) > 5)
                                                            ... <a href="#"
                                                                onclick="toggleText(event, {{ $index }})">Show
                                                                More</a>
                                                        @endif
                                                    </span>

                                                    <span id="full-text-{{ $index }}" style="display: none;">
                                                        {{ $Adv->remark }}
                                                        <a href="#"
                                                            onclick="toggleText(event, {{ $index }})">Show Less</a>
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2"><strong>Total Amount</strong></td>
                                            <td><strong>₹{{ number_format($data['Advances']->sum('adv_amount'), 2) }}</strong>
                                            </td>
                                            <td colspan="4"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    function toggleText(event, index) {
                        event.preventDefault();

                        // Get the elements for the specified row
                        var shortText = document.getElementById(`short-text-${index}`);
                        var fullText = document.getElementById(`full-text-${index}`);

                        // Toggle visibility
                        if (shortText.style.display === 'none') {
                            shortText.style.display = 'inline';
                            fullText.style.display = 'none';
                        } else {
                            shortText.style.display = 'none';
                            fullText.style.display = 'inline';
                        }
                    }
                </script>
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <!-- Card Header -->
                        <div class="card-header justify-content-between d-flex align-items-center">
                            <h5>Advance To Staff</h5> <!-- Changed Title -->

                            <a href="{{ route('director.financedata', ['key' => 'advance']) }}"
                                class="btn btn-primary btn-sm" target="_blank">
                                <i class="ri-eye-line"></i>
                            </a>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body">
                            <!-- Bar Chart (originally was a line chart) -->
                            <canvas id="barChart" style="max-height: 400px;"></canvas>
                            <!-- Changed canvas ID -->
                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    // Prepare the data from PHP for Advance To Staff
                                    const particulars = @json($data['Advances']->pluck('particulars'));
                                    const dates = @json($data['Advances']->pluck('adv_date')->map(fn($date) => \Carbon\Carbon::parse($date)->format('d M Y')));
                                    const dataPoints = @json($data['Advances']->pluck('adv_amount'));

                                    // Combine the name and date into a single label
                                    const labels = particulars.map((particulars, index) => `${particulars} - ${dates[index]}`);

                                    // Create the bar chart using Chart.js for Advance To Staff
                                    new Chart(document.querySelector('#barChart'), {
                                        type: 'bar',
                                        data: {
                                            labels: labels,
                                            datasets: [{
                                                label: 'Advance To Staff',
                                                data: dataPoints,
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

                        <!-- Card Footer -->
                        <div class="card-footer">
                            <h6>Total Advance:
                                ₹{{ number_format($data['Advances']->sum('adv_amount'), 2) }}
                            </h6>
                        </div>
                    </div>
                </div>
            @endif
            @if ($data['key'] == 'Paymenttovendor')
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header justify-content-between d-flex align-items-center">
                                <h5>Payment To Vendor</h5>

                                <a href="{{ route('director.financedata', ['key' => 'pay']) }}"
                                    class="btn btn-primary btn-sm" target="_blank">
                                    <i class="ri-eye-line"></i>
                                </a>

                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped datatable bordered">
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
                                                <td>₹{{ number_format((float) $Payment->pay_amount, 2) }}
                                                </td>
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
                                            <td><strong>₹{{ number_format((float) $data['Payments']->sum('pay_amount'), 2) }}
                                                </strong></td>
                                            <td colspan="3"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <!-- Card Header -->

                        <div class="card-header justify-content-between d-flex align-items-center">
                            <h5>Payment To Vendor</h5>

                            <a href="{{ route('director.financedata', ['key' => 'pay']) }}"
                                class="btn btn-primary btn-sm" target="_blank">
                                <i class="ri-eye-line"></i>
                            </a>

                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
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
                                const name = paymentData.map(payment => payment.vendor_name)

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
                                                            `Vendor Name : ${name[index]}`,
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

                        <!-- Card Footer -->
                        <div class="card-footer">
                            <h6>Total Payments:
                                ₹{{ number_format($data['Payments']->sum('pay_amount'), 2) }}
                            </h6>
                        </div>
                    </div>
                </div>
            @endif
            @if ($data['key'] == 'bank')
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header justify-content-between d-flex align-items-center">
                                <h5>Bank Information</h5> <!-- Changed Title -->

                                <a href="{{ route('director.financedata', ['key' => 'bank']) }}"
                                    class="btn btn-primary btn-sm" target="_blank">
                                    <i class="ri-eye-line"></i>
                                </a>
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
                                            <td>₹{{ number_format($banks->amount, 2) }} </td>

                                            <td>{{ \Carbon\Carbon::parse($banks->added_by)->format('d M Y') }}
                                            </td>
                                            {{-- <td>{{ \Carbon\Carbon::parse($epf->due_date)->format('d M Y') }}
                                                        </td> --}}
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
                                        <td><strong>₹{{ number_format($data['Bank']->sum('amount'), 2) }}
                                            </strong></td>
                                        <td colspan="4"></td>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>
                    </div>

                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <!-- Card Header -->
                        <div class="card-header justify-content-between d-flex align-items-center">
                            <h5>Bank Information</h5> <!-- Changed Title -->

                            <a href="{{ route('director.financedata', ['key' => 'bank']) }}"
                                class="btn btn-primary btn-sm" target="_blank">
                                <i class="ri-eye-line"></i>
                            </a>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body">
                            <!-- Line Chart (originally was a bar chart) -->
                            <canvas id="lineChart"></canvas> <!-- Changed canvas ID -->

                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    // Get bank names and amounts from Blade for Bank Information
                                    const bankNames = @json($data['Bank']->pluck('bank_name'));
                                    const bankAmounts = @json($data['Bank']->pluck('amount'));

                                    new Chart(document.querySelector('#lineChart'), {
                                        type: 'line',
                                        data: {
                                            labels: bankNames, // Changed to bank names for the line chart
                                            datasets: [{
                                                label: 'Amount (₹)',
                                                data: bankAmounts, // Changed to bank amounts for the line chart
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

                        <!-- Card Footer -->
                        <div class="card-footer">
                            <h6><strong>Total Amount: ₹{{ number_format($data['Bank']->sum('amount'), 2) }}
                                </strong></h6>
                        </div>
                    </div>
                </div>
            @endif
            @if ($data['incomeyearFilter'] && $data['incomemonthFilter'])
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <form action="" method="GET">
                                <div class="row justify-content-between d-flex align-items-center">

                                    <div class="col-md-5">
                                        <select id="yearFilter" name="incomeyearFilter"
                                            class="form-control form-control-sm mx-2" required>
                                            <option value="">Year</option>
                                            @foreach (range(date('Y') - 10, date('Y')) as $year)
                                                <option value="{{ $year }}">{{ $year }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <select id="monthFilter" name="incomemonthFilter"
                                            class="form-control form-control-sm mx-2" required>
                                            <option value="">Month</option>
                                            @foreach (range(1, 12) as $month)
                                                <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}">
                                                    {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 d-flex">
                                        <button type="submit" class="btn btn-primary btn-sm mx-2">Filter</button>
                                        <a href="{{ route('director.financedata', ['key' => 'income']) }}"
                                            class="btn btn-primary btn-sm" target="_blank">
                                            <i class="ri-eye-line"></i>
                                        </a>

                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Income Tax TDS {{ $data['incomeyearFilter'] }} &&
                                    {{ $data['incomemonthFilter'] }}</h5>
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
                                        <th>Remark</th>
                                        <!-- <th>Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['Income'] as $index => $gsts)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $gsts->name_type }}</td>
                                            <td>₹{{ $gsts->tds_amount }} </td>
                                            <td>{{ $gsts->challan_no }}</td>
                                            <td>{{ \Carbon\Carbon::parse($gsts->challan_date)->format('d M Y') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($gsts->due_date)->format('d M Y') }}
                                            </td>
                                            <td>{{ $gsts->remark }}</td>
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
                                        <td><strong>₹{{ $data['Income']->sum('tds_amount') }} </strong>
                                        </td>
                                        <td colspan="4"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <!-- Card Header -->
                        <div class="card-header">
                            <form action="" method="GET">
                                <div class="row justify-content-between d-flex align-items-center">
                                    <div class="col-md-5">
                                        <select id="yearFilter" name="incomeyearFilter"
                                            class="form-control form-control-sm mx-2" required>
                                            <option value="">Year</option>
                                            @foreach (range(date('Y') - 10, date('Y')) as $year)
                                                <option value="{{ $year }}">{{ $year }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <select id="monthFilter" name="incomemonthFilter"
                                            class="form-control form-control-sm mx-2" required>
                                            <option value="">Month</option>
                                            @foreach (range(1, 12) as $month)
                                                <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}">
                                                    {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 d-flex">
                                        <button type="submit" class="btn btn-primary btn-sm mx-2">Filter</button>
                                        <a href="{{ route('director.financedata', ['key' => 'income']) }}"
                                            class="btn btn-primary btn-sm" target="_blank">
                                            <i class="ri-eye-line"></i>
                                        </a>

                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Card Body -->
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
                                            trigger: 'item',
                                            formatter: function(params) {
                                                return `
                                <strong>${params.data.name}</strong><br/>
                                TDS Amount: ₹${params.data.value} <br/>
                                Challan Date: ${params.data.challan_date}<br/>
                                Due Date: ${params.data.due_date}
                            `;
                                            }
                                        },
                                        legend: {
                                            orient: 'vertical',
                                            left: 'left'
                                        },
                                        series: [{
                                            name: 'TDS Amount',
                                            type: 'pie',
                                            radius: '50%',
                                            label: {
                                                formatter: '{b}: ₹{c} ',
                                                color: '#000'
                                            },
                                            data: [
                                                @foreach ($data['Income'] as $item)
                                                    {
                                                        value: {{ $item->tds_amount }},
                                                        name: '{{ $item->name_type }}',
                                                        challan_date: '{{ $item->challan_date }}',
                                                        due_date: '{{ $item->due_date }}'
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

                        <!-- Card Footer -->
                        <div class="card-footer">
                            <h6><strong>Total TDS Amount:
                                    ₹ {{ number_format($data['Income']->sum('tds_amount'), 2) }} </strong>
                            </h6>
                        </div>
                    </div>
                </div>
            @endif
            @if ($data['gstyearFilter'] && $data['gstmonthFilter'])
                <div class="col-log-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <form action="" method="GET">
                                <div class="row d-flex align-items-center">
                                    <div class="col-md-5">
                                        <select id="yearFilter" name="gstyearFilter"
                                            class="form-control form-control-sm mx-2" required>
                                            <option value="">Year</option>
                                            @foreach (range(date('Y') - 10, date('Y')) as $year)
                                                <option value="{{ $year }}">
                                                    {{ $year }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <select id="monthFilter" name="gstmonthFilter"
                                            class="form-control form-control-sm mx-2" required>
                                            <option value="">Month</option>
                                            @foreach (range(1, 12) as $month)
                                                <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}">
                                                    {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 d-flex">
                                        <button type="submit" class="btn btn-primary btn-sm mx-2">Filter</button>
                                        <a href="{{ route('director.financedata', ['key' => 'gst']) }}"
                                            class="btn btn-primary btn-sm" target="_blank">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">GST TDS/GST Liability
                                    {{ $data['gstyearFilter'] }}/{{ $data['gstmonthFilter'] }}</h5>

                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped datatable bordered">
                                    <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>Type</th>
                                            <th>CGST</th>
                                            <th>SGST</th>
                                            <th>IGST</th>
                                            <th>Challan Date</th>
                                            <th>Due Date</th>
                                            <th>Remark</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $c_gst_total = 0; // Initialize total CGST
                                            $s_gst_total = 0; // Initialize total SGST
                                            $i_gst_total = 0; // Initialize total IGST
                                        @endphp

                                        @foreach ($data['Gst'] as $index => $gsts)
                                            @php
                                                // Accumulate totals
                                                $c_gst_total += $gsts->c_gst;
                                                $s_gst_total += $gsts->s_gst;
                                                $i_gst_total += $gsts->i_gst;
                                            @endphp
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $gsts->name_type }}</td>
                                                <td>₹{{ number_format($gsts->c_gst, 2) }} </td>
                                                <td>₹{{ number_format($gsts->s_gst, 2) }} </td>
                                                <td>₹{{ number_format($gsts->i_gst, 2) }} </td>
                                                <td>{{ \Carbon\Carbon::parse($gsts->challan_date)->format('d M Y') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($gsts->due_date)->format('d M Y') }}
                                                </td>
                                                <td>
                                                    {{ isset($gsts->remark) ? $gsts->remark : 'NULL' }}

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <td colspan="2" class="text-end"><strong>Total</strong>
                                            </td>
                                            <td><strong>₹{{ number_format($c_gst_total, 2) }} </strong>
                                            </td>
                                            <td><strong>₹{{ number_format($s_gst_total, 2) }} </strong>
                                            </td>
                                            <td><strong>₹{{ number_format($i_gst_total, 2) }} </strong>
                                            </td>
                                            <td colspan="3"></td>
                                        </tr>
                                    </tfoot>
                                </table>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <!-- Card Header -->
                        <div class="card-header">
                            <form action="" method="GET">
                                <div class="row d-flex align-items-center">
                                    <div class="col-md-4">
                                        <select id="yearFilter" name="gstyearFilter"
                                            class="form-control form-control-sm mx-2" required>
                                            <option value="">Year</option>
                                            @foreach (range(date('Y') - 10, date('Y')) as $year)
                                                <option value="{{ $year }}">
                                                    {{ $year }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select id="monthFilter" name="gstmonthFilter"
                                            class="form-control form-control-sm mx-2" required>
                                            <option value="">Month</option>
                                            @foreach (range(1, 12) as $month)
                                                <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}">
                                                    {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 d-flex">
                                        <button type="submit" class="btn btn-primary btn-sm mx-2">Filter</button>
                                        <a href="{{ route('director.financedata', ['key' => 'gst']) }}"
                                            class="btn btn-primary btn-sm" target="_blank">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body">
                            <div id="donutChart" style="height: 400px;" class="echart"></div>
                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    echarts.init(document.querySelector("#donutChart")).setOption({
                                        title: {
                                            text: 'GST Liability Distribution',

                                            left: 'center'
                                        },
                                        tooltip: {
                                            trigger: 'item',
                                            formatter: function(params) {
                                                // Show only SGST, CGST, and IGST in the tooltip
                                                return `CGST: ₹${params.data.cgst} <br/>
                            SGST: ₹${params.data.sgst} <br/>
                            IGST: ₹${params.data.igst} `;
                                            }
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
                                                show: true,
                                                position: 'outer',
                                                formatter: function(params) {
                                                    // Show the date in the label
                                                    return `Date: ${params.data.date}`;
                                                }
                                            },
                                            emphasis: {
                                                label: {
                                                    show: true,
                                                    fontSize: '18',
                                                    fontWeight: 'bold'
                                                }
                                            },
                                            labelLine: {
                                                show: true
                                            },
                                            data: [
                                                @foreach ($data['Gst'] as $gst)
                                                    {
                                                        value: {{ $gst->tax_amount }},
                                                        name: '{{ $gst->name }}',
                                                        date: '{{ \Carbon\Carbon::parse($gst->challan_date)->format('d M Y') }}',
                                                        cgst: {{ $gst->c_gst }},
                                                        sgst: {{ $gst->s_gst }},
                                                        igst: {{ $gst->i_gst }}
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

                        <!-- Card Footer: Display Total GST Amount -->
                        <div class="card-footer">
                            <h6><strong>Total GST Amount:
                                    ₹ {{ number_format($data['Gst']->sum('tax_amount'), 2) }} </strong>
                            </h6>
                        </div>
                    </div>
                </div>
            @endif
            @if ($data['epfesiyearFilter'] && $data['epfesimonthFilter'])
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <form action="" method="GET">
                                <div class="row d-flex align-items-center">
                                    <div class="col-md-4">
                                        <select id="yearFilter" name="epfesiyearFilter"
                                            class="form-control form-control-sm mx-2" required>
                                            <option value="">Year</option>
                                            @foreach (range(date('Y') - 10, date('Y')) as $year)
                                                <option value="{{ $year }}">
                                                    {{ $year }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select id="monthFilter" name="epfesimonthFilter"
                                            class="form-control form-control-sm mx-2" required>
                                            <option value="">Month</option>
                                            @foreach (range(1, 12) as $month)
                                                <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}">
                                                    {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 d-flex">
                                        <button type="submit" class="btn btn-primary btn-sm mx-2">Filter</button>
                                        <a href="{{ route('director.financedata', ['key' => 'gst']) }}"
                                            class="btn btn-primary btn-sm" target="_blank">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title mx-2">EPFs {{ $data['epfesimonthFilter'] }}/
                                {{ $data['epfesiyearFilter'] }}</h5>
                            </h5>
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
                                    <th>Remark</th>

                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['Epf'] as $index => $epf)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $epf->name_type }}</td>
                                        <td>₹{{ $epf->amount }} </td>
                                        <td>{{ $epf->challan_period }}</td>
                                        <td>{{ \Carbon\Carbon::parse($epf->challan_date)->format('d M Y') }}
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($epf->due_date)->format('d M Y') }}
                                        </td>
                                        <td>{{ $epf->remark }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2"><strong>Total EPF Amount</strong></td>
                                    <td><strong>₹{{ $data['Epf']->sum('amount') }} </strong></td>
                                    <td colspan="4"></td>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <!-- Card Header -->
                        <div class="card-header justify-content-between d-flex align-items-center">
                            <h5>EPF/ESI Report</h5>

                            <a href="{{ route('director.financedata', ['key' => 'epfesi']) }}"
                                class="btn btn-primary btn-sm" target="_blank">
                                <i class="ri-eye-line"></i>
                            </a>

                        </div>

                        <!-- Card Body -->
                        <div class="card-body">


                            <!-- Radial Bar Chart -->
                            <div id="radialBarChart"></div>
                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    const epfData = @json($data['Epf']->pluck('amount')); // Extract the amounts
                                    const epfLabels = @json($data['Epf']->pluck('name_type')); // Extract the type/name labels
                                    const epfChallan = @json($data['Epf']->pluck('challan_period')); // Extract the challan numbers
                                    const epfChallanDate = @json($data['Epf']->pluck('challan_date')); // Extract the challan dates
                                    const epfDueDate = @json($data['Epf']->pluck('due_date')); // Extract the due dates

                                    // Calculate total EPF amount for percentage calculation
                                    const totalAmount = epfData.reduce((total, amount) => total + amount, 0);

                                    // Calculate percentages based on the total amount
                                    const percentageData = epfData.map(amount => ((amount / totalAmount) * 100).toFixed(2));

                                    // Formatter function to convert numbers to K or Cr format
                                    function formatNumber(num) {
                                        if (num >= 10000000) {
                                            return (num / 10000000).toFixed(2) + ' Cr'; // Convert to Crores
                                        } else if (num >= 1000) {
                                            return (num / 1000).toFixed(2) + ' K'; // Convert to Thousands
                                        }
                                        return num.toFixed(2); // Return the number as is if it's less than 1000
                                    }

                                    new ApexCharts(document.querySelector("#radialBarChart"), {
                                        series: percentageData, // Use percentage data for the chart
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
                                                        offsetY: 5, // Adjust the position of the label
                                                        color: '#fff', // Set label color
                                                        fontWeight: 'bold' // Bold the label
                                                    },
                                                    value: {
                                                        fontSize: '16px',
                                                        formatter: function(val) {
                                                            return val + '%'; // Display percentage in the chart
                                                        }
                                                    },
                                                    total: {
                                                        show: true,
                                                        label: 'Total',
                                                        formatter: function() {
                                                            return ' ₹' + formatNumber(
                                                                totalAmount); // Display the total amount in K/Cr format
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
                                                    // Display the EPF amount with Challan Date and Due Date in the tooltip
                                                    const amount = epfData[seriesIndex]; // Get the actual amount
                                                    const challanDate = new Date(epfChallanDate[seriesIndex])
                                                        .toLocaleDateString('en-GB', {
                                                            day: '2-digit',
                                                            month: 'short',
                                                            year: 'numeric'
                                                        });
                                                    const dueDate = new Date(epfDueDate[seriesIndex]).toLocaleDateString(
                                                        'en-GB', {
                                                            day: '2-digit',
                                                            month: 'short',
                                                            year: 'numeric'
                                                        });
                                                    return ` ₹${formatNumber(amount)}  (Challan Date: ${challanDate}, Due Date: ${dueDate})`;
                                                }
                                            }
                                        }
                                    }).render();
                                });
                            </script>


                            <!-- End Radial Bar Chart -->
                        </div>

                        <!-- Card Footer: Display Total EPF Amount -->
                        <div class="card-footer">
                            <h6><strong>Total EPF Amount:
                                    ₹{{ number_format($data['Epf']->sum('amount'), 2) }}
                                </strong></h6>
                        </div>
                    </div>
                </div>
            @endif
    </section>
@endsection
