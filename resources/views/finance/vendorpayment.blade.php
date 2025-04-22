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
            <!-- EPF Table -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Payment To Vendor Details</h5>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addpaymenttovendorModal">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                        <div class="table-responsive ">
                            <table class="table table-striped  bordered " id="example">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Date</th>
                                        <th>Vendor Name</th>
                                        {{-- <th>Voucher No</th> --}}
                                        <th>Amount</th>
                                        <th>Initiated By</th>
                                        <th>Checked By</th>
                                        <th>Approved By</th>


                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['Payment'] as $index => $Payment)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ \Carbon\Carbon::parse($Payment->pay_date)->format('d M Y') }}</td>
                                            <td>{{ $Payment->vendor_name }}</td>
                                            {{-- <td>{{ $Payment->initiated_by }} </td> --}}
                                            <td>{{ number_format((float) $Payment->pay_amount, 2) }} </td>
                                            <td>{{ $Payment->initiated_by == 'None' ? '---' : $Payment->initiated_by }}</td>

                                            <td>{{ $Payment->checked_by === 'None' ? '---' : $Payment->checked_by ?? '---' }}
                                            </td>
                                            <td>{{ $Payment->approved_by === 'None' ? '---' : $Payment->approved_by ?? '---' }}
                                            </td>




                                            <td>
                                                <button class="btn btn-success btn-sm"
                                                    onclick="openEditModal('{{ $Payment->id }}', '{{ $Payment->pay_date }}', '{{ $Payment->vendor_name }}', '{{ $Payment->pay_amount }}', '{{ $Payment->initiated_by }}', '{{ $Payment->checked_by }}', '{{ $Payment->approved_by }}', '{{ $Payment->remark }}')">
                                                    <i class="ri-edit-2-fill"></i>
                                                </button>

                                                <a href="#"
                                                    onclick="event.preventDefault(); if(confirm('Are you sure you want to delete Payment data ?')) { document.getElementById('delete-form-{{ $Payment->id }}').submit(); }"
                                                    class="btn btn-sm btn-danger">
                                                    <i class="ri-delete-bin-6-line"></i>
                                                </a>
                                                <form id="delete-form-{{ $Payment->id }}"
                                                    action="{{ route('finance.paymentdelete', $Payment->id) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                </form>

                                                <button class="btn btn-primary btn-sm"
                                                    onclick="showgstdatamodal('{{ $Payment->pay_date }}', '{{ $Payment->vendor_name }}', '{{ $Payment->voucher_no }}', '{{ $Payment->pay_amount }}', '{{ $Payment->initiated_by }}', '{{ $Payment->checked_by }}', '{{ $Payment->approved_by }}', '{{ $Payment->remark }}')">
                                                    <i class="ri-eye-line"></i>
                                                </button>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3"><strong>Total Payment Amount</strong></td>
                                        <td><strong>{{ number_format((float) $data['Payment']->sum('pay_amount'), 2) }}</strong>
                                        </td>
                                        <td colspan="4"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addpaymenttovendorModal" tabindex="-1" aria-labelledby="addPaymentVendorModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPaymentVendorModalLabel">Add Payment to Vendor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('finance.addpayment') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="vendor_name" class="form-label">Vendor Name</label>
                                    <input type="text" class="form-control" id="vendor_name" name="vendor_name"
                                        placeholder="Enter vendor name" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="pay_amount" class="form-label">Payment Amount</label>
                                    <input type="number" step="0.01" class="form-control" id="pay_amount"
                                        name="pay_amount" placeholder="Enter payment amount" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="pay_date" class="form-label">Payment Date</label>
                                    <input type="date" class="form-control" id="pay_date" name="pay_date" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="initiated_by" class="form-label">Initiated By</label>
                                    <select class="form-control" id="initiated_by" name="initiated_by" required>
                                        <option value="">Select Initiated By</option>
                                        <option value="ChandanKumar Singh">ChandanKumar Singh</option>
                                        <option value="Sandeep Dhakad">Sandeep Dhakad</option>
                                        <option value="Puhumi">Puhumi</option>
                                        <option value="Yashdeep Chaturvedi">Yashdeep Chaturvedi</option>
                                        <option value="Rajat Tripathi">Rajat Tripathi</option>
                                        <option value="Hari Shankar Pandey">Hari Shankar Pandey</option>
                                        <option value="None">None</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="checked_by" class="form-label">Checked By</label>
                                    <select class="form-control" id="checked_by" name="checked_by" required>
                                        <option value="">Select Checked By</option>
                                        <option value="Shailesh Singh">Shailesh Singh</option>
                                        <option value="Rajat Tripathi">Rajat Tripathi</option>
                                        <option value="Harshit Rastogi">Harshit Rastogi</option>
                                        <option value="None">None</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="approved_by" class="form-label">Approved By</label>
                                    <select class="form-control" id="approved_by" name="approved_by" required>
                                        <option value="">Select Approved By</option>

                                        <option value="MD Sir">MD Sir</option>
                                        <option value="Amit Tripathi">Amit Tripathi2</option>
                                        <option value="None">None</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="remark" class="form-label">Remarks</label>
                                    <textarea class="form-control" id="remark" name="remark" placeholder="Enter any remarks (optional)"></textarea>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save Payment</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Payment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editPaymentForm">
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label for="editVendorName" class="form-label">Vendor Name</label>
                                    <input type="text" class="form-control" id="editVendorName" name="vendor_name">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="editPayDate" class="form-label">Date</label>
                                    <input type="date" class="form-control" id="editPayDate" name="pay_date">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="editAmount" class="form-label">Amount</label>
                                    <input type="number" class="form-control" id="editAmount" name="amount"
                                        step="0.01">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="editInitiatedBy" class="form-label">Initiated By</label>

                                    <select class="form-control" id="editInitiatedBy" name="initiated_by" required>
                                        <option value="">Select Initiated By</option>
                                        <option value="ChandanKumar Singh">ChandanKumar Singh</option>
                                        <option value="Sandeep Dhakad">Sandeep Dhakad</option>
                                        <option value="Puhumi">Puhumi</option>
                                        <option value="Yashdeep Chaturvedi">Yashdeep Chaturvedi</option>
                                        <option value="Rajat Tripathi">Rajat Tripathi</option>
                                        <option value="Hari Shankar Pandey">Hari Shankar Pandey</option>
                                        <option value="None">None</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="editCheckedBy" class="form-label">Checked By</label>

                                    <select class="form-control" id="editCheckedBy" name="checked_by" required>
                                        <option value="">Select Checked By</option>
                                        <option value="Rajat Tripathi">Rajat Tripathi</option>
                                        <option value="Harshit Rastogi">Harshit Rastogi</option>
                                        <option value="Shailesh Singh">Shailesh Singh</option>

                                        <option value="None">None</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="editApprovedBy" class="form-label">Approved By</label>

                                    <select class="form-control" id="editApprovedBy" name="approved_by" required>
                                        <option value="">Select Approved By</option>

                                        <option value="MD Sir">MD Sir</option>
                                        <option value="Amit Tripathi">Amit Tripathi2</option>
                                        <option value="None">None</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="editRemark" class="form-label">Remark</label>
                                    <textarea class="form-control" id="editRemark" name="remark"></textarea>
                                </div>
                                <input type="hidden" id="paymentId" name="payment_id">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>




        <div class="modal fade" id="gstModal" tabindex="-1" aria-labelledby="gstModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="gstModalLabel">Payment to Vendor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <tbody id="modalGstDetails">
                                <!-- Dynamic content will be injected here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function showgstdatamodal(pay_date, vendor_name, voucher_no, pay_amount, initiated_by, checked_by, approved_by,
                remark) {
                // Create the modal content
                const modalContent = `
    <tr>
        <td><strong>Payment Date</strong></td>
        <td>${pay_date}</td>
    </tr>
    <tr>
        <td><strong>Vendor Name</strong></td>
        <td>${vendor_name}</td>
    </tr>
    <tr>
        <td><strong>Voucher No</strong></td>
        <td>${voucher_no} </td>
    </tr>
    <tr>
        <td><strong>Payment Amount</strong></td>
        <td>${pay_amount}₹</td>
    </tr>
     <tr>
        <td><strong>Initiated Date</strong></td>
        <td>${initiated_by} </td>
    </tr>
    <tr>
        <td><strong>Checked By</strong></td>
        <td>${checked_by}</td>
    </tr>
    <tr>
        <td><strong>Approved By</strong></td>
        <td>${approved_by} </td>
    </tr>
    <tr>
        <td><strong>Remark</strong></td>
        <td>${remark}</td>
    </tr>
    
`;

                // Insert the content into the modal
                document.getElementById('modalGstDetails').innerHTML = modalContent;

                // Show the modal
                var modal = new bootstrap.Modal(document.getElementById('gstModal'));
                modal.show();
            }
        </script>


        <script>
            function openEditModal(id, payDate, vendorName, amount, initiatedBy, checkedBy, approvedBy, remark) {
                // Set the values in the modal
                document.getElementById('paymentId').value = id;
                document.getElementById('editPayDate').value = payDate;
                document.getElementById('editVendorName').value = vendorName;
                document.getElementById('editAmount').value = amount;
                document.getElementById('editInitiatedBy').value = initiatedBy;
                document.getElementById('editCheckedBy').value = checkedBy;
                document.getElementById('editApprovedBy').value = approvedBy;
                document.getElementById('editRemark').value = remark;

                // Show the modal
                var editModal = new bootstrap.Modal(document.getElementById('editModal'));
                editModal.show();
            }
        </script>
        <script>
            // Get today's date
            const today = new Date().toISOString().split('T')[0];
            // Set the max attribute to today's date
            document.getElementById('editPayDate').setAttribute('max', today);
            document.getElementById('pay_date').setAttribute('max', today);

        </script>
    </section>
@endsection
