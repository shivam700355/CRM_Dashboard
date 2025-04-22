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
                            <h5 class="card-title">Bank Details</h5>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addBankModal">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped  bordered" id="example">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Name</th>
                                        <th>Account Number</th>
                                        <th>Amount</th>
                                        <th>Updated Date</th>

                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['Bank'] as $index => $bank)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $bank->bank_name }}</td>
                                            <td>{{ $bank->account_detail }}</td>
                                            <td>{{ $bank->amount }} ₹</td>

                                            <td>{{ \Carbon\Carbon::parse($bank->updated_at)->format('d M Y') }}</td>

                                            <td>
                                                <button class="btn btn-success btn-sm"
                                                    onclick="populateEditModal('{{ $bank->id }}', '{{ $bank->bank_name }}', '{{ $bank->account_detail }}', '{{ $bank->amount }}')"
                                                    data-bs-toggle="modal" data-bs-target="#editBankModal">
                                                    <i class="ri-edit-2-fill"></i>
                                                </button>
                                                <a href="#"
                                                    onclick="event.preventDefault(); if(confirm('Are you sure you want to delete Bank data ?')) { document.getElementById('delete-form-{{ $bank->id }}').submit(); }"
                                                    class="btn btn-sm btn-danger">
                                                    <i class="ri-delete-bin-6-line"></i>
                                                </a>
                                                <form id="delete-form-{{ $bank->id }}"
                                                    action="{{ route('finance.deletebank', $bank->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                </form>
                                                <button class="btn btn-primary btn-sm"
                                                    onclick="showgstdatamodal('{{ $bank->bank_name }}', '{{ $bank->account_detail }}','{{ \Carbon\Carbon::parse($bank->updated_at)->format('d M Y') }}', '{{ $bank->amount }}')">
                                                    <i class="ri-eye-line"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3"><strong>Total EPF Amount</strong></td>
                                        <td><strong>{{ $data['Bank']->sum('amount') }} ₹</strong></td>
                                        <td colspan="4"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal for Adding Bank Data -->
        <div class="modal fade" id="addBankModal" tabindex="-1" aria-labelledby="addBankModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addBankModalLabel">Add Bank Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('finance.bankstore') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="bankName" class="form-label">Bank Name</label>
                                <input type="text" class="form-control" id="bankName" name="bank_name" required>
                            </div>

                            <div class="mb-3">
                                <label for="accountDetail" class="form-label">Account Number</label>
                                <input type="text" class="form-control" id="accountDetail" name="account_detail"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="number" class="form-control" id="amount" name="amount" step="0.01"
                                    min="0" required>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add Bank</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editBankModal" tabindex="-1" aria-labelledby="editBankModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editBankModalLabel">Edit Bank Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editBankForm" action="{{ route('finance.bankupdate') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="editBankId">

                            <div class="mb-3">
                                <label for="editBankName" class="form-label">Bank Name</label>
                                <input type="text" class="form-control" id="editBankName" name="bank_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="editAccountDetail" class="form-label">Account Number</label>
                                <input type="text" class="form-control" id="editAccountDetail" name="account_detail"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="editAmount" class="form-label">Amount</label>
                                <input type="number" class="form-control" id="editAmount" name="amount"
                                    step="0.01" min="0" required>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
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

        <script>
            function showgstdatamodal(bank_name, account_detail, updated_at, amount) {
                // Create the modal content
                const modalContent = `
    <tr>
        <td><strong>Bank Name</strong></td>
        <td>${bank_name}</td>
    </tr>
    <tr>
        <td><strong>Account Number</strong></td>
        <td>${account_detail}</td>
    </tr>
    <tr>
        <td><strong>Updated Date</strong></td>
        <td>${updated_at} </td>
    </tr>
    <tr>
        <td><strong>Amount</strong></td>
        <td>${amount}₹</td>
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
            function populateEditModal(id, bank_name, account_detail, amount) {
                document.getElementById('editBankId').value = id;
                document.getElementById('editBankName').value = bank_name;
                document.getElementById('editAccountDetail').value = account_detail;
                document.getElementById('editAmount').value = amount;
            }
        </script>



    </section>
@endsection
