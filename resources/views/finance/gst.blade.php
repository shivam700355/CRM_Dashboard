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
<script>
    // Check if success alert exists and set a timeout to hide it
    const successAlert = document.getElementById('success-alert');
    if (successAlert) {
        setTimeout(() => {
            successAlert.style.display = 'none';
        }, 2000); // 2000 milliseconds = 2 seconds
    }

    // Check if error alert exists and set a timeout to hide it
    const errorAlert = document.getElementById('error-alert');
    if (errorAlert) {
        setTimeout(() => {
            errorAlert.style.display = 'none';
        }, 2000); // 2000 milliseconds = 2 seconds
    }
</script>
<section class="section dashboard">

    <div class="row">
        <!-- GST TDS/GST Liability Table -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">GST TDS/GST Liability</h5>
                        <div class="d-flex">
                            <button class="btn btn-primary btn-sm mx-2" data-bs-toggle="modal"
                                data-bs-target="#filtermodal">
                                <i class="bi bi-filter-square"></i>
                            </button>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#gstTdsModal">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped bordered" id="example">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Type</th>
                                    <th>CGST</th>
                                    <th>SGST</th>
                                    <th>IGST</th>
                                    <th>Challan Date</th>
                                    <th>Due Date</th>
                                    <th>Action</th>
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
                                                                    <td>{{ number_format($gsts->c_gst, 2) }} ₹</td>
                                                                    <td>{{ number_format($gsts->s_gst, 2) }} ₹</td>
                                                                    <td>{{ number_format($gsts->i_gst, 2) }} ₹</td>
                                                                    <td>{{ \Carbon\Carbon::parse($gsts->challan_date)->format('d M Y') }}</td>
                                                                    <td>{{ \Carbon\Carbon::parse($gsts->due_date)->format('d M Y') }}</td>
                                                                    <td>
                                                                        <button class="btn btn-success btn-sm"
                                                                            onclick="openEditModal('{{ $gsts->id }}', '{{ $gsts->name_type }}',  '{{ $gsts->c_gst }}','{{ $gsts->s_gst }}','{{ $gsts->i_gst }}')">
                                                                            <i class="ri-edit-2-fill"></i>
                                                                        </button>
                                                                        <a href="#"
                                                                            onclick="event.preventDefault(); if(confirm('Are you sure you want to delete GST TDS/GST Liability?')) { document.getElementById('delete-form-{{ $gsts->id }}').submit(); }"
                                                                            class="btn btn-sm btn-danger">
                                                                            <i class="ri-delete-bin-6-line"></i>
                                                                        </a>
                                                                        <form id="delete-form-{{ $gsts->id }}"
                                                                            action="{{ route('finance.deletetds', $gsts->id) }}" method="POST"
                                                                            style="display: none;">
                                                                            @csrf
                                                                        </form>
                                                                        <button class="btn btn-primary btn-sm"
                                                                            onclick="showgstdatamodal('{{ $gsts->name_type }}', '{{ $gsts->c_gst }} ₹/{{ $gsts->s_gst }} ₹/{{ $gsts->i_gst }} ₹',  '{{ \Carbon\Carbon::parse($gsts->challan_date)->format('d M Y') }}', '{{ \Carbon\Carbon::parse($gsts->due_date)->format('d M Y') }}','{{ $gsts->remark }}')">
                                                                            <i class="ri-eye-line"></i>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="2" class="text-end"><strong>Total</strong></td>
                                    <td>{{ number_format($c_gst_total, 2) }} ₹</td>
                                    <td>{{ number_format($s_gst_total, 2) }} ₹</td>
                                    <td>{{ number_format($i_gst_total, 2) }} ₹</td>
                                    <td colspan="3"></td>
                                </tr>
                            </tfoot>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="filtermodal" tabindex="-1" aria-labelledby="filtermodalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filtermodalLabel">Filter by Date</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="filterForm">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="startDate" class="form-label">Start Date</label>
                                <input type="date" class="form-control" id="startDate" name="startDate" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="endDate" class="form-label">End Date</label>
                                <input type="date" class="form-control" id="endDate" name="endDate" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" form="filterForm" class="btn btn-primary">Apply Filter</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="gstTdsModal" tabindex="-1" aria-labelledby="gstModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="gstModalLabel">GST TDS/GST Liability</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="gstTdsForm" method="POST" action="{{ route('finance.gst_tds') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="name_type" class="form-label">Type</label>
                                <select class="form-select" id="name_type" name="name_type" required
                                    onchange="updateDueDate()">
                                    <option value="" disabled selected>Select </option>
                                    <option value="TDS">TDS</option>
                                    <option value="LIABILITY">LIABILITY</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="s_gst" class="form-label">SGST TDS Payable</label>
                                <input type="number" class="form-control" id="s_gst" name="s_gst">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="c_gst" class="form-label">CGST Tds Payable</label>
                                <input type="number" class="form-control" id="c_gst" name="c_gst">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="i_gst" class="form-label">IGST Tds Payable</label>
                                <input type="number" class="form-control" id="i_gst" name="i_gst">
                            </div>

                            {{-- <div class="col-md-3 mb-3">
                                <label for="tax_amount" class="form-label">Tax Amount</label>
                                <input type="number" class="form-control" id="tax_amount" name="tax_amount" required>
                            </div> --}}
                            <div class="col-md-4 mb-3">
                                <label for="month" class="form-label">Select Month</label>
                                <select class="form-select" id="month" name="month" required onchange="updateDueDate()">
                                    <option value="" disabled selected>Select a month</option>
                                    @foreach (range(1, 12) as $month)
                                        <option value="{{ $month }}">
                                            {{ \Carbon\Carbon::create()->month($month)->format('F') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="challan_date" class="form-label">Challan Date</label>
                                <input type="date" class="form-control" id="challan_date" name="challan_date" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="due_date" class="form-label">Due Date</label>
                                <input type="date" class="form-control" id="due_date" name="due_date" required readonly
                                    style="background-color: gray; color: white;">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="remark" class="form-label">Remarks</label>
                                <textarea class="form-control" id="remark" name="remark" rows="3"
                                    placeholder="Enter your remarks here..."
                                    style="background-color: gray; color: white;"></textarea>
                            </div>

                            <div id="payment_status" class="mb-3"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="gstModal" tabindex="-1" aria-labelledby="gstModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="gstModalLabel">GST Details</h5>
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

    <!-- Edit Modal -->
    <div class="modal fade" id="editGstModal" tabindex="-1" aria-labelledby="editGstModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editGstModalLabel">Edit GST TDS/GST Liability</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editGstForm" method="POST" action="{{ route('finance.updateGst') }}">
                        @csrf
                        <input type="hidden" id="id" name="id" value="{{ $gst->id ?? '' }}">
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="nameType" class="form-label">Type</label>
                                <input type="text" class="form-control" id="nameType" name="nameType"
                                    value="{{ $gst->name_type ?? '' }}" required readonly
                                    style="background-color: gray; color: white;">
                            </div>
                            <!-- <div class="col-md-6 mb-3">
                                <label for="gst_tax_amount" class="form-label">Tax Amount</label>
                                <input type="number" class="form-control" id="gst_tax_amount" name="tax_amount"
                                    value="{{ $gst->tax_amount ?? '' }}" required>
                            </div> -->
                            <div class="col-md-6 mb-3">
                                <label for="get_s_gst" class="form-label">SGST TDS Payable</label>
                                <input type="number" class="form-control" id="get_s_gst" name="s_gst"
                                    value="{{ $gst->s_gst ?? '' }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="get_c_gst" class="form-label">CGST Tds Payable</label>
                                <input type="number" class="form-control" id="get_c_gst" name="c_gst"
                                    value="{{ $gst->c_gst ?? '' }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="get_i_gst" class="form-label">IGST Tds Payable</label>
                                <input type="number" class="form-control" id="get_i_gst" name="i_gst"
                                    value="{{ $gst->i_gst ?? '' }}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        function showgstdatamodal(nameType, name, challanDate, dueDate, remark) {
            console.log(name);
            // Create the modal content
            const modalContent = `
        <tr>
            <td><strong>Name Type:</strong></td>
            <td>${nameType}</td>
        </tr>
        <tr>
            <td><strong>CGST/SGST/IGST:</strong></td>
            <td>${name}</td>
        </tr>
        
        <tr>
            <td><strong>Challan Date:</strong></td>
            <td>${challanDate}</td>
        </tr>
        <tr>
            <td><strong>Due Date:</strong></td>
            <td>${dueDate}</td>
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
        function openEditModal(id, nameType, c_gst, s_gst, i_gst) {
            // Set the values in the modal
            document.getElementById('id').value = id;
            document.getElementById('nameType').value = nameType;
            document.getElementById('get_s_gst').value = s_gst;
            document.getElementById('get_c_gst').value = c_gst;
            document.getElementById('get_i_gst').value = i_gst;
            // document.getElementById('gst_tax_amount').value = tax_amount;


            // Show the modal
            var editGstModal = new bootstrap.Modal(document.getElementById('editGstModal'));
            editGstModal.show();
        }
    </script>


</section>
<script>
    function updateDueDate() {
        const typeSelect = document.getElementById('name_type').value;
        const monthSelect = document.getElementById('month').value;

        if (!typeSelect || !monthSelect) return; // Exit if either type or month is not selected

        let today = new Date();
        let year = today.getFullYear();
        let selectedMonth = parseInt(monthSelect); // Get the selected month (1 to 12)

        // If selected month is December, adjust year and reset month
        if (selectedMonth === 12) {
            year++;
            selectedMonth = 0; // JavaScript's Date object uses 0-indexed months (0=January, 11=December)
        }

        let dueDay = 11; // Default due day for TDS
        if (typeSelect === 'LIABILITY') {
            dueDay = 21; // Set due day to 20th for LIABILITY
        }

        // Set the due date based on type and selected month
        const dueDate = new Date(year, selectedMonth, dueDay);

        // Format the due date to YYYY-MM-DD
        let formattedDate = dueDate.toISOString().split('T')[0];
        document.getElementById('due_date').value = formattedDate;
    }
</script>
<script>
    document.getElementById('challan_date').addEventListener('change', function () {
        const challanDateInput = document.getElementById('challan_date').value;
        const dueDateInput = document.getElementById('due_date').value; // Static due date
        const remarkElement = document.getElementById('remark');
        const paymentStatusElement = document.getElementById('payment_status');

        // Ensure both dates are selected
        if (challanDateInput && dueDateInput) {
            const challanDate = new Date(challanDateInput);
            const dueDate = new Date(dueDateInput);

            const timeDifference = challanDate.getTime() - dueDate.getTime();
            const dayDifference = Math.ceil(timeDifference / (1000 * 3600 * 24)); // Difference in days

            if (dayDifference <= 0) {
                paymentStatusElement.innerHTML = 'Paid within due date.';
                paymentStatusElement.className = 'text-success';
                remarkElement.value = "Payment made within the due date.";
            } else {
                paymentStatusElement.innerHTML = `Delayed by ${Math.abs(dayDifference)} days.`;
                paymentStatusElement.className = 'text-danger';
                remarkElement.value = `Payment delayed by ${Math.abs(dayDifference)} days.`;
            }
        }
    });
</script>
@endsection