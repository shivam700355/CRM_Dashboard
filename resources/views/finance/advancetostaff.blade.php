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
                            <h5 class="card-title">Advance To Staff</h5>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#advancetostaff">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped  bordered " id="example">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Name</th>
                                        <th>Advance Amount</th>
                                        <th>Advance Date</th>
                                        <th>Pending Date</th>
                                        <th>Total Days</th>
                                        <th>Remark</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['Advance'] as $index => $Adv)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $Adv->particulars }}</td>
                                            <td>{{ number_format($Adv->adv_amount, 2) }} ₹</td>


                                            <td>{{ \Carbon\Carbon::parse($Adv->adv_date)->format('d M Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($Adv->pending_date)->format('d M Y') }}</td>
                                            <td>{{ $Adv->user_status }}</td>
                                            <td>
                                                {{ implode(' ', array_slice(explode(' ', $Adv->remark), 0, 3)) }}...
                                            </td>

                                            <td>
                                                <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#editAdvanceModal"
                                                    onclick="populateEditModal('{{ $Adv->id }}', '{{ $Adv->particulars }}', '{{ $Adv->adv_amount }}', '{{ \Carbon\Carbon::parse($Adv->adv_date)->format('Y-m-d') }}', '{{ \Carbon\Carbon::parse($Adv->pending_date)->format('Y-m-d') }}', '{{ $Adv->user_status }}', '{{ $Adv->remark }}')">
                                                    <i class="ri-edit-2-fill"></i>
                                                </button>
                                                <a href="#"
                                                    onclick="event.preventDefault(); if(confirm('Are you sure you want to delete Advance data ?')) { document.getElementById('delete-form-{{ $Adv->id }}').submit(); }"
                                                    class="btn btn-sm btn-danger">
                                                    <i class="ri-delete-bin-6-line"></i>
                                                </a>
                                                <form id="delete-form-{{ $Adv->id }}"
                                                    action="{{ route('finance.advtostaff', $Adv->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                </form>
                                                <button class="btn btn-primary btn-sm"
                                                    onclick="showgstdatamodal('{{ $Adv->particulars }}', '{{ $Adv->adv_amount }}', '{{ \Carbon\Carbon::parse($Adv->pending_date)->format('d M Y') }}', '{{ \Carbon\Carbon::parse($Adv->adv_date)->format('d M Y') }}','{{ $Adv->user_status }}', '{{ $Adv->remark }}')">
                                                    <i class="ri-eye-line"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2"><strong>Total EPF Amount</strong></td>
                                        <td><strong>{{ number_format($data['Advance']->sum('adv_amount'), 2) }} ₹</strong>
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

        <!-- Add Advance Modal -->
        <div class="modal fade" id="advancetostaff" tabindex="-1" aria-labelledby="advancetostaffLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="advancetostaffLabel">Add Advance to Staff</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('advance.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="staffName" class="form-label">Staff Name</label>
                                    <input type="text" class="form-control" id="staffName" name="particulars" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="advanceAmount" class="form-label">Advance Amount</label>
                                    <input type="number" class="form-control" id="advanceAmount" name="adv_amount"
                                        required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="advanceDate" class="form-label">Advance Date</label>
                                    <input type="date" class="form-control" id="advanceDate" name="adv_date" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="pendingDate" class="form-label">Pending Date</label>
                                    <input type="date" class="form-control" id="pendingDate" name="pending_date"
                                        required readonly style="background-color: gray; color: white;">
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="totalDay" class="form-label">Total Day</label>
                                    <input type="text" class="form-control" id="totalDay" name="user_status"
                                        required readonly style="background-color: gray; color: white;">
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="remark" class="form-label">Remark</label>
                                    <textarea class="form-control" id="remark" name="remark"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Edit Advance Modal -->
        <div class="modal fade" id="editAdvanceModal" tabindex="-1" aria-labelledby="editAdvanceModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editAdvanceModalLabel">Edit Advance to Staff</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('advance.update') }}" method="POST" id="editAdvanceForm">
                        @csrf

                        <input type="hidden" name="id" id="advanceid" value="">
                        <div class="modal-body">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="editStaffName" class="form-label">Staff Name</label>
                                    <input type="text" class="form-control" id="editStaffName" name="particulars"
                                        required readonly style="background-color: gray; color: white;">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="editAdvanceAmount" class="form-label">Advance Amount</label>
                                    <input type="number" class="form-control" id="editAdvanceAmount" name="adv_amount"
                                        required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="editAdvanceDate" class="form-label">Advance Date</label>
                                    <input type="date" class="form-control" id="editAdvanceDate" name="adv_date"
                                        required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="editPendingDate" class="form-label">Pending Date</label>
                                    <input type="date" class="form-control" id="editPendingDate" name="pending_date"
                                        required readonly style="background-color: gray; color: white;">
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="editUserStatus" class="form-label">User Status</label>
                                    <input type="text" class="form-control" id="editUserStatus" name="user_status"
                                        required readonly style="background-color: gray; color: white;">
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="editRemark" class="form-label">Remark</label>
                                    <textarea class="form-control" id="editRemark" name="remark"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <script>
            window.onload = function() {
                const today = new Date().toISOString().split('T')[0]; // Get today's date in YYYY-MM-DD format
                document.getElementById('pendingDate').value = today; // Set the value of the date input
            };
        </script>
        <script>
            function showgstdatamodal(particulars, adv_amount, pending_date, adv_date, user_status, remark) {
                // Create the modal content
                const modalContent = `
        <tr>
            <td><strong>Particulars:</strong></td>
            <td>${particulars}</td>
        </tr>
        <tr>
            <td><strong>Advance Amount</strong></td>
            <td>${adv_amount}₹</td>
        </tr>
        <tr>
            <td><strong>Pending Date:</strong></td>
            <td>${pending_date} </td>
        </tr>
        <tr>
            <td><strong>Advance Date</strong></td>
            <td>${adv_date}</td>
        </tr>
        <tr>
            <td><strong>User Status</strong></td>
            <td>${user_status}</td>
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
            function populateEditModal(id, particulars, adv_amount, adv_date, pending_date, user_status, remark) {
                document.getElementById('advanceid').value = id
                document.getElementById('editStaffName').value = particulars;
                document.getElementById('editAdvanceAmount').value = adv_amount;
                document.getElementById('editAdvanceDate').value = adv_date;
                document.getElementById('editPendingDate').value = pending_date;
                document.getElementById('editUserStatus').value = user_status;
                document.getElementById('editRemark').value = remark;



            }
        </script>
        <script>
            document.getElementById('advanceDate').addEventListener('change', calculateTotalDays);
            document.getElementById('pendingDate').addEventListener('change', calculateTotalDays);

            function calculateTotalDays() {
                const advanceDate = document.getElementById('advanceDate').value;
                const pendingDate = document.getElementById('pendingDate').value;

                if (advanceDate && pendingDate) {
                    const date1 = new Date(advanceDate);
                    const date2 = new Date(pendingDate);

                    const timeDifference = date2.getTime() - date1.getTime();
                    const totalDays = timeDifference / (1000 * 3600 * 24); // Convert milliseconds to days

                    document.getElementById('totalDay').value = totalDays;
                }
            }
        </script>
    </section>
@endsection
