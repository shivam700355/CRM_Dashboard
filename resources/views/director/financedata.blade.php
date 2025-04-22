@php
    $profile = ['name' => $data['name'], 'role' => $data['role']];
@endphp
@extends('layouts.app', ['profile' => $profile])

@section('content')


    <section class="section dashboard">
        @if ($data['key'] == 'income')
            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
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


            </div>
        @endif
        @if ($data['key'] == 'gst' )

            <div class="row">
                <!-- GST TDS/GST Liability Table -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">GST TDS/GST Liability</h5>

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
                                            <td colspan="2" class="text-end"><strong>Total</strong></td>
                                            <td><strong>₹{{ number_format($c_gst_total, 2) }} </strong></td>
                                            <td><strong>₹{{ number_format($s_gst_total, 2) }} </strong></td>
                                            <td><strong>₹{{ number_format($i_gst_total, 2) }} </strong></td>
                                            <td colspan="3"></td>
                                        </tr>
                                    </tfoot>
                                </table>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if ($data['key'] == 'epfesi')
            <div class="row">
                <div class="col-lg-12">
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
                </div>

            </div>
        @endif
        @if ($data['key'] == 'advance')
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
                                            <th>Total Days</th>
                                            <th>Remark</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['Advances'] as $index => $Adv)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $Adv->particulars }}</td>
                                                <td>₹{{ number_format($Adv->adv_amount, 2) }} </td>
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
                                            <td><strong>₹{{ number_format($data['Advances']->sum('adv_amount'), 2) }}
                                                </strong></td>
                                            <td colspan="4"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        @endif
        @if ($data['key'] == 'bank')
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

            </div>
        @endif
        @if ($data['key'] == 'pay')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Payment to Vendor</h5>
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



                <!-- Bar Chart Section -->

            </div>
        @endif
        


    </section>
@endsection
