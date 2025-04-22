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
            <!-- Recent Transactions Table -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Income Tax TDS</h5>
                            <div class="d-flex">
                                <button class="btn btn-primary btn-sm mx-2" data-bs-toggle="modal"
                                    data-bs-target="#filtermodal">
                                    <i class="bi bi-filter-square"></i>
                                </button>
                                <button class="btn btn-primary btn-sm mx-2" data-bs-toggle="modal"
                                    data-bs-target="#incometextds">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-responsive  bordered" id="example">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Type</th>
                                        <th>TDS Amount</th>
                                        <th>Challan No.</th>
                                        <th>Challan Date</th>
                                        <th>Due Date</th>
                                        <th>Created_at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="income-table-body">
                                    @foreach ($data['Income'] as $index => $income)
                                        <tr data-month="{{ \Carbon\Carbon::parse($income->created_at)->format('m') }}"
                                            data-year="{{ \Carbon\Carbon::parse($income->created_at)->format('Y') }}">
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $income->name_type }}</td>
                                            <td>{{ number_format($income->tds_amount, 2) }} ₹</td>
                                            <td>{{ $income->challan_no }}</td>
                                            <td>{{ \Carbon\Carbon::parse($income->challan_date)->format('d M Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($income->due_date)->format('d M Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($income->created_at)->format('d M Y') }}</td>
                                            <td>
                                                <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#editIncomeTaxModal"
                                                    onclick="populateEditModal('{{ $income->id }}',  '{{ $income->tds_amount }}', '{{ $income->challan_no }}')">
                                                    <i class="ri-edit-2-fill"></i>
                                                </button>
                                                <a href="#"
                                                    onclick="event.preventDefault(); if(confirm('Are you sure you want to delete Income?')) { document.getElementById('delete-form-{{ $income->id }}').submit(); }"
                                                    class="btn btn-sm btn-danger">
                                                    <i class="ri-delete-bin-6-line"></i>
                                                </a>
                                                <form id="delete-form-{{ $income->id }}"
                                                    action="{{ route('finance.income', $income->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                </form>
                                                <button class="btn btn-primary btn-sm"
                                                    onclick="showgstdatamodal('{{ $income->name_type }}', '{{ $income->tds_amount }}', '{{ $income->challan_no }}', '{{ $income->challan_date }}', '{{ $income->due_date }}', '{{ $income->remark }}')">
                                                    <i class="ri-eye-line"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2"><strong>Total TDS Amount</strong></td>
                                        <td><strong>{{ $data['Income']->sum('tds_amount') }} ₹</strong></td>
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

        <!-- Add Income Tax TDS Modal -->
        <div class="modal fade" id="incometextds" tabindex="-1" aria-labelledby="incometextdsLabel" aria-hidden="true">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="incometextdsLabel">Income Tax TDS</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="tdsForm" method="POST" action="{{ route('finance.income_tds') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="name_type" class="form-label">Type</label>
                                    <select class="form-select" id="name_type" name="name_type" required>
                                        <option value="" disabled selected>Select an option</option>
                                        <option value="194-H">194-H</option>
                                        <option value="192-B">192-B</option>
                                        <option value="194-C">194-C</option>
                                        <option value="194-I">194-I</option>
                                        <option value="194-J">194-J</option>
                                        <option value="194-Q">194-Q</option>
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="tds_amount" class="form-label">TDS Amount</label>
                                    <input type="number" class="form-control" id="tds_amount" name="tds_amount"
                                        required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="challan_no" class="form-label">Challan No.</label>
                                    <input type="text" class="form-control" id="challan_no" name="challan_no"
                                        required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="month" class="form-label">Select Month</label>
                                    <select class="form-select" id="month" name="month" required
                                        onchange="updateDueDate()">
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
                                    <input type="date" class="form-control" id="challan_date" name="challan_date"
                                        required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="due_date" class="form-label">Due Date</label>
                                    <input type="date" class="form-control" id="due_date" name="due_date" required
                                        readonly style="background-color: gray; color: white;">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="remark" class="form-label">Remarks</label>
                                    <textarea class="form-control" id="remark" name="remark" rows="3"
                                        placeholder="Enter your remarks here..." required readonly style="background-color: gray;color:white"></textarea>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <p id="payment_status" class="text-success"></p>
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

        <!-- Edit Income Tax Modal -->
        <div class="modal fade" id="editIncomeTaxModal" tabindex="-1" aria-labelledby="editIncomeTaxModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editIncomeTaxModalLabel">Edit Income Tax TDS</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('finance.incometdsupdate') }}">
                        @csrf
                        <input type="hidden" id="edit_income_id" name="id">
                        <div class="modal-body">
                            <div class="row">
                               

                                <div class="col-md-6 mb-3">
                                    <label for="edit_tds_amount" class="form-label">TDS Amount</label>
                                    <input type="number" class="form-control" id="edit_tds_amount" name="tds_amount"
                                        required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="edit_challan_no" class="form-label">Challan No.</label>
                                    <input type="text" class="form-control" id="edit_challan_no" name="challan_no"
                                        required>
                                </div>
                                
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


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

    </section>

    <script>
        function handleMonthChange(selectedMonth) {
            if (selectedMonth) {
                console.log("Selected Month:", selectedMonth);
                window.location.href = `https://upicondashboard.in/finance/incometaxtds/${selectedMonth}`;
                // Add your logic here, such as sending an AJAX request or filtering data.
            } else {
                console.log("No month selected");
            }
        }
    </script>

    <script>
        function populateEditModal(id,tds_amount, challan_no) {
            document.getElementById('edit_income_id').value = id;
            document.getElementById('edit_tds_amount').value = tds_amount;
            document.getElementById('edit_challan_no').value = challan_no;
            
        }



        function showgstdatamodal(name_type, tds_amount, challan_no, challan_date, due_date, remark) {
            console.log(name_type, tds_amount, challan_no, challan_date, due_date, remark);
            // Create the modal content
            const modalContent = `
            <table class="table">
                <tr>
                    <td><strong>Name Type:</strong></td>
                    <td>${name_type}</td>
                </tr>
                <tr>
                    <td><strong>Tax Amount:</strong></td>
                    <td>${tds_amount} ₹</td>
                </tr>
                <tr>
                    <td><strong>Challan Number:</strong></td>
                    <td>${challan_no}</td>
                </tr>
                <tr>
                    <td><strong>Challan Date:</strong></td>
                    <td>${challan_date}</td>
                </tr>
                <tr>
                    <td><strong>Due Date:</strong></td>
                    <td>${due_date}</td>
                </tr>
                <tr>
                    <td><strong>Remark:</strong></td>
                    <td>${remark}</td>
                </tr>
            </table>
        `;

            // Insert the content into the modal
            document.getElementById('modalGstDetails').innerHTML = modalContent;

            // Show the modal
            var modal = new bootstrap.Modal(document.getElementById('gstModal'));
            modal.show();
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            updateDueDate();
        });

        function updateDueDate() {
            // Get today's date
            let today = new Date();
            let year = today.getFullYear();
            let monthSelect = document.getElementById('month');
            let selectedMonth = parseInt(monthSelect.value) + 1; // Get the selected month

            if (!selectedMonth) return; // If no month is selected, exit

            let dueDate;
            // Set due date based on the selected month
            dueDate = new Date(year, selectedMonth - 1, 8); // month - 1 since months are 0-indexed

            // Format the due date to YYYY-MM-DD
            let formattedDate = dueDate.toISOString().split('T')[0];
            document.getElementById('due_date').value = formattedDate;
        }
    </script>


    <script>
        document.getElementById('challan_date').addEventListener('change', function() {
            const challanDateInput = document.getElementById('challan_date').value;
            const dueDateInput = document.getElementById('due_date').value;
            const remarkElement = document.getElementById('remark');

            const challanDate = new Date(challanDateInput);
            const dueDate = new Date(dueDateInput);

            const paymentStatusElement = document.getElementById('payment_status');

            // Ensure both dates are selected
            if (challanDateInput && dueDateInput) {
                const timeDifference = challanDate.getTime() - dueDate.getTime();
                const dayDifference = Math.ceil(timeDifference / (1000 * 3600 * 24)); // Difference in days

                if (dayDifference <= 0) {
                    paymentStatusElement.innerHTML = 'Paid within due date.';
                    paymentStatusElement.className = 'text-success';
                    // Set remark message for timely payment
                    remarkElement.value = "Payment made within the due date.";
                } else {
                    paymentStatusElement.innerHTML = `Delayed by ${dayDifference} days.`;
                    paymentStatusElement.className = 'text-danger';
                    // Set remark message for delayed payment
                    remarkElement.value = `Payment delayed by ${dayDifference} days.`;
                }
            }
        });
    </script>
@endsection
