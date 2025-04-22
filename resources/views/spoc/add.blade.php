@extends('layouts.app', ['name' => $authdata['name'], 'role' => $authdata['role']])

@section('content')
    <div class="pagetitle d-flex align-items-center justify-content-between">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="vertical">Home</a></li>
                <li class="breadcrumb-item active">Project</li>
            </ol>
        </nav>

    </div>

    @if (session('success'))
        <div class="alert alert-success col-12">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger col-12">{{ session('error') }}</div>
    @endif

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header   d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Vendor Details</h5>
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal"><i
                            class="bi bi-plus-circle"></i></a>
                </div>
                <div class="card-body">
                    <table class="table table-hover datatable border">
                        <thead class="bg-secondary text-light">
                            <tr>
                                <th>S.No</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>State</th>
                                <th>District</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vendordata as $vendor)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $vendor->name }}</td>
                                    <td>{{ $vendor->mobile }}</td>
                                    <td>{{ $vendor->email }}</td>
                                    <td>{{ $vendor->state }}</td>
                                    <td>{{ $vendor->district }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="basicModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Register Vendor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('spoc.save') }}" method="post" enctype="multipart/form-data"
                        class="needs-validation" novalidate>
                        @csrf
                        <input value="{{ $authId }}" name="added_by" hidden type="number">
                        <div class="row g-3"> <!-- Added g-3 for consistent spacing between fields -->

                            <!-- Firm/Company Name -->
                            <div class="col-12">
                                <label for="name" class="form-label">Firm/Company Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Firm/Company Name" required>
                                <div class="invalid-feedback">Please provide a Firm Name.</div>
                            </div>

                            <!-- Mobile -->
                            <div class="col-md-6">
                                <label for="mobile" class="form-label">Mobile</label>
                                <input type="text" class="form-control" id="mobile" name="mobile"
                                    placeholder="Enter Mobile Number" required pattern="[0-9]{10}">
                                <div class="invalid-feedback">Please provide a 10-digit Mobile number.</div>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter Email" required>
                                <div class="invalid-feedback">Please provide an Email.</div>
                            </div>

                            <!-- State -->
                            <div class="col-md-6">
                                <label for="state" class="form-label">State</label>
                                <select id="state" class="form-select" name="state"
                                    onchange="fetchDistricts(this.value)" required>
                                    <option selected hidden disabled>Select State</option>
                                    <option value="Andaman Nicobar">Andaman Nicobar</option>
                                    <!-- ... other options ... -->
                                </select>
                                <div class="invalid-feedback">Please select a state.</div>
                            </div>

                            <!-- District -->
                            <div class="col-md-6">
                                <label for="district" class="form-label">Select District</label>
                                <select id="district" class="form-select" name="district" aria-label="Select District"
                                    required>
                                    <!-- Options will be dynamically added here -->
                                </select>
                                <div class="invalid-feedback">Please select at least one district.</div>
                            </div>

                            <!-- Address -->
                            <div class="col-12">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="Enter Address" required>
                                <div class="invalid-feedback">Please provide an Address.</div>
                            </div>

                            <!-- Remark -->
                            <div class="col-12">
                                <label for="remark" class="form-label">Remark</label>
                                <input type="text" class="form-control" id="remark" name="remark"
                                    placeholder="Enter Remarks">
                            </div>

                            <!-- Submit Button -->
                            <div class="col-12 d-flex justify-content-center mt-5">
                                <button type="submit" class="btn btn-primary rounded-pill col-md-6">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            fetch("https://vcredil.com/eoffice-apis/root/listing.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Authorization": "d5baad86d889077e3d4d47e1d6169867"
                    },
                    body: JSON.stringify({
                        action: "state"
                    })
                })
                .then(response => response.json())
                .then(data => {
                    const stateSelect = document.getElementById('state');
                    stateSelect.innerHTML = '<option selected hidden disabled>Select State</option>';
                    if (data.code === 200 && data.data) {
                        data.data.forEach(state => {
                            const option = document.createElement('option');
                            option.value = `${state.s_code}_${state.s_name}`;
                            option.textContent = state.s_name;
                            stateSelect.appendChild(option);
                        });
                    } else {
                        console.error('Error:', data.message);
                    }
                })
                .catch(error => console.error(error));
        });

        async function fetchDistricts(state) {
            try {
                const statedata = state.split('_');
                const s_code = statedata[0];

                const response = await fetch("https://vcredil.com/eoffice-apis/root/listing.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Authorization": "d5baad86d889077e3d4d47e1d6169867"
                    },
                    body: JSON.stringify({
                        "action": "district",
                        "state_code": s_code
                    })
                });

                if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);

                const result = await response.json();
                const districtSelect = document.getElementById('district');
                districtSelect.innerHTML = ''; // Clear previous options

                if (result.data && Array.isArray(result.data)) {
                    result.data.forEach(district => {
                        const option = document.createElement('option');
                        option.value = district.d_name;
                        option.textContent = district.d_name;
                        districtSelect.appendChild(option);
                    });
                } else {
                    districtSelect.innerHTML = '<option disabled>No districts available</option>';
                }
            } catch (error) {
                console.error('Fetch error:', error);
            }
        }
    </script>
@endsection
