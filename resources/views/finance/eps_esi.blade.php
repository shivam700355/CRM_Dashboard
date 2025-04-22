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
                            <h5 class="card-title">EPFs</h5>
                            <div class="d-flex">
                                <button class="btn btn-primary btn-sm mx-2" data-bs-toggle="modal"
                                    data-bs-target="#filtermodal">
                                    <i class="bi bi-filter-square"></i>
                                </button>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#epfModal">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>

                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped  bordered" id="example">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Type</th>
                                        <th>Name</th>
                                        <th>EPF Amount</th>
                                        <th>Challan Period</th>
                                        <th>Challan Date</th>
                                        <th>Due Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['Epf'] as $index => $epf)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $epf->name_type }}</td>
                                            <td>{{ $epf->name }}</td>

                                            <td>{{ number_format($epf->amount, 2) }} ₹</td>
                                            <td>{{ $epf->challan_period }}</td>
                                            <td>{{ \Carbon\Carbon::parse($epf->challan_date)->format('d M Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($epf->due_date)->format('d M Y') }}</td>
                                            <td>
                                                <button class="btn btn-success btn-sm"
                                                    onclick="editEpf('{{ $epf->id }}', '{{ $epf->amount }}', '{{ $epf->challan_period }}', '{{ $epf->remark }}')">
                                                    <i class="ri-edit-2-fill"></i>
                                                </button>

                                                <a href="#"
                                                    onclick="event.preventDefault(); if(confirm('Are you sure you want to delete EPS TDS/ESI Liability?')) { document.getElementById('delete-form-{{ $epf->id }}').submit(); }"
                                                    class="btn btn-sm btn-danger">
                                                    <i class="ri-delete-bin-6-line"></i>
                                                </a>
                                                <form id="delete-form-{{ $epf->id }}"
                                                    action="{{ route('finance.delepfesi', $epf->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                </form>
                                                <button class="btn btn-primary btn-sm"
                                                    onclick="showgstdatamodal('{{ $epf->name_type }}', '{{ $epf->name }}', '{{ $epf->amount }}', '{{ $epf->challan_period }}', '{{ $epf->due_date }}','{{ $epf->remark }}')">
                                                    <i class="ri-eye-line"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3"><strong>Total EPF Amount</strong></td>
                                        <td><strong>{{ $data['Epf']->sum('amount') }} ₹</strong></td>
                                        <td colspan="4"></td>
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
        <div class="modal fade" id="epfModal" tabindex="-1" aria-labelledby="epfModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="epfModalLabel">EPFs</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="epfForm" method="POST" action="{{ route('finance.epf') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4 mb-3" id="nameset">
                                    <label for="epf_name_type" class="form-label">Select EPF/ESI</label>
                                    <select class="form-select" id="epf_name_type" name="name_type" required>
                                        <option value="" disabled selected>Select an option</option>
                                        <option value="EPF">EPF</option>
                                        <option value="ESI">ESI</option>
                                    </select>

                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="name" class="form-label">Select Name</label>
                                    <select class="form-select" id="name" name="name" required disabled>
                                        <option value="" disabled selected>Select an option</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3 mt-4 " id="nameselct">

                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="epf_amount" class="form-label">EPF Amount</label>
                                    <input type="number" class="form-control" id="epf_amount" name="amount" required>
                                </div>
                                {{-- create year select. --}}
                                <div class="col-md-4 mb-3">
                                    <label for="year" class="form-label">Select Year</label>
                                    <select class="form-select" id="year" name="year" required
                                        onchange="updateDueDate()">
                                        <option value="" disabled selected>Select a year</option>
                                        @foreach (range(2000, 2030) as $year)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="month" class="form-label">Select Month</label>
                                    <select class="form-select" id="month" name="challan_period" required
                                        onchange="updateDueDate()">
                                        <option value="" disabled selected>Select a month</option>
                                        @foreach (range(1, 12) as $month)
                                            <option value="{{ $month }}">
                                                {{ \Carbon\Carbon::create()->month($month)->format('F') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="epf_challan_date" class="form-label">Challan Date</label>
                                    <input type="date" class="form-control" id="epf_challan_date" name="challan_date"
                                        required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="epf_due_date" class="form-label">Due Date</label>
                                    <input type="date" class="form-control" id="epf_due_date" name="epf_due_date"
                                        readonly style="background-color: gray; color: white;">
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="epf_remark" class="form-label">Remarks</label>
                                    <textarea class="form-control" id="epf_remark" name="remark" rows="3"
                                        placeholder="Enter your remarks here..."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="gstModal" tabindex="-1" aria-labelledby="gstModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="gstModalLabel">EPF/ESI Details</h5>
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
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit EPF</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Edit Form -->
                        <form id="editForm" action="{{ route('finance.updateepf') }}" method="POST">
                            @csrf
                            <div class="row">



                                <input type="hidden" name="id" id="epfId">

                                <div class="mb-3 col-md-6">
                                    <label for="amount" class="form-label">EPF Amount</label>
                                    <input type="text" class="form-control" id="amount" name="amount" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="challan_period" class="form-label">Challan Period</label>
                                    <input type="text" class="form-control" id="eidtchallan_period"
                                        name="challan_period" required>
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label for="remark" class="form-label">Remark</label>
                                    <textarea class="form-control" id="remark" name="remark"></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <script>
            // Get today's date in YYYY-MM-DD format
            const today = new Date().toISOString().split('T')[0];
            // Set the max attribute for the date input
            document.getElementById('epf_challan_date').setAttribute('max', today);
        </script>
        <script>
            document.getElementById('epf_name_type').addEventListener('change', function() {
                const selectedValue = this.value;
                const nameSelect = document.getElementById('name');

                // Clear existing options
                nameSelect.innerHTML = '';
                nameSelect.disabled = false; // Enable the name select box

                // Create default option
                let defaultOptionText = selectedValue === 'EPF' ? "Select an EPF" : "Select an ESI";
                nameSelect.appendChild(new Option(defaultOptionText, "", true, true)); // Add default option

                if (selectedValue === 'EPF') {
                    // Add options for EPF
                    const epfOptions = [{
                            value: "229230623000468",
                            text: "229230623000468"
                        },
                        {
                            value: "229140723015644",
                            text: "229140723015644"
                        },
                        {
                            value: "Custom",
                            text: "Custom"
                        },
                    ];
                    epfOptions.forEach(option => {
                        nameSelect.appendChild(new Option(option.text, option.value));
                    });

                } else if (selectedValue === 'ESI') {
                    // Add options for ESI
                    nameSelect.appendChild(new Option("Respective Employee code", "Respective Employee code"));
                    nameSelect.appendChild(new Option("Custom", "Custom"));
                }
            });

            document.getElementById('name').addEventListener('change', function() {
                // Clear previous custom input if any
                const nameselctDiv = document.getElementById('nameselct');
                nameselctDiv.innerHTML = '';

                // Only append the input if "Custom" is selected
                if (this.value === "Custom") {
                    // Create a new input element
                    const newInput = document.createElement('input');
                    newInput.type = 'text'; // Set input type
                    newInput.className = 'form-control'; // Bootstrap class for styling
                    newInput.placeholder = 'Enter Name '; // Placeholder text
                    newInput.name = 'customname'; // Assign name for the input
                    // Append the new input to the nameselct div
                    nameselctDiv.appendChild(newInput);
                }
            });
        </script>


        <script>
            function showgstdatamodal(nameType, name, taxAmount, challanDate, dueDate, remark) {
                // Create the modal content
                const modalContent = `
        <tr>
            <td><strong>Name Type:</strong></td>
            <td>${nameType}</td>
        </tr>
        <tr>
            <td><strong>Name:</strong></td>
            <td>${name}</td>
        </tr>
        <tr>
            <td><strong>Tax Amount:</strong></td>
            <td>${taxAmount} ₹</td>
        </tr>
        <tr>
            <td><strong>Challan Period:</strong></td>
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
            function updateDueDate() {
                // Get the selected year and month from the dropdown
                let selectedYear = parseInt(document.getElementById('year').value);
                let selectedMonth = parseInt(document.getElementById('month').value);

                // If both the year and month are selected, proceed to calculate the due date
                if (!isNaN(selectedYear) && !isNaN(selectedMonth)) {
                    // Move to the next month
                    selectedMonth += 1;

                    // Adjust if the month is December (12), move to January of the next year
                    if (selectedMonth > 12) {
                        selectedMonth = 1;
                        selectedYear += 1;
                    }

                    // Set the due date to the 16th of the next month
                    let dueDate = new Date(selectedYear, selectedMonth - 1, 16);
                    let formattedDate = dueDate.toISOString().split('T')[0];

                    // Set the due date input field
                    document.getElementById('epf_due_date').value = formattedDate;
                }
            }
        </script>





        <script>
            function editEpf(id, amount, challan_period, remark) {
                // Populate form fields
                document.getElementById('epfId').value = id;

                document.getElementById('amount').value = amount;
                document.getElementById('eidtchallan_period').value = challan_period;

                document.getElementById('remark').value = remark;
                // Show the modal
                var myModal = new bootstrap.Modal(document.getElementById('editModal'), {
                    keyboard: false
                });
                myModal.show();
            }
        </script>
    </section>
@endsection
