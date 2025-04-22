@extends('layouts.app', ['name' => $authdata['name'], 'role' => $authdata['role']])
>
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

    <section class="content">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <!-- Card Header -->
                    <div class="card-header  d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Project Details</h5>
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#assignProjectModal"><i class="bi bi-plus-circle"></i></a>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <table class="table table-hover datatable border" style="font-size: 15px">
                            <thead class="bg-secondary text-light">
                                <tr>
                                    <th>S.No</th>
                                    <th>Project Name</th>
                                    <th>Vendor Mobile</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>State</th>
                                    <th>District</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vassociations as $vassociation)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $vassociation['name'] }}</td>
                                        <td>{{ $vassociation['project'] }}</td>
                                        <td>{{ $vassociation['start_date'] }}</td>
                                        <td>{{ $vassociation['end_date'] ? $vassociation['end_date'] : 'NA' }}</td>
                                        <td>{{ $vassociation['state'] }}</td>
                                        <td>{{ $vassociation['district'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Assign Project Modal -->
                        <div class="modal fade" id="assignProjectModal" tabindex="-1"
                            aria-labelledby="assignProjectModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="assignProjectModalLabel">Assign Project</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('spoc.saveAssign') }}" method="post"
                                            class="needs-validation" novalidate>
                                            @csrf
                                            <input value="{{ $authId }}" name="added_by" hidden type="number">
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label for="p_id" class="mb-2">Project</label>
                                                    <select id="p_id" class="form-control" name="p_id" required>
                                                        <option selected hidden disabled>Select Project</option>
                                                        @forelse ($projectData as $bcuser)
                                                            <option value="{{ $bcuser['id'] }}">{{ $bcuser['name'] }}
                                                            </option>
                                                        @empty
                                                            <option disabled>No projects available</option>
                                                        @endforelse
                                                    </select>
                                                    <div class="invalid-feedback">Please select a project.</div>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="v_id" class="mb-2">Firm/Company Name</label>
                                                    <select id="v_id" class="form-control" name="v_id" required>
                                                        <option selected hidden disabled>Firm/Company Name</option>
                                                        @foreach ($vendors as $vendor)
                                                            <option value="{{ $vendor->id }}">{{ $vendor->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback">Please select Firm name.</div>
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label for="status" class="mb-2">Status</label>
                                                    <select id="status" class="form-control" name="status" required>
                                                        <option selected hidden disabled>Select Status</option>
                                                        @foreach ($Status as $statuse)
                                                            <option value="{{ $statuse->id }}">{{ $statuse->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback">Please select Status.</div>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="start_date" class="mb-2">Start Date</label>
                                                    <input type="date" class="form-control" id="start_date"
                                                        name="start_date" required>
                                                    <div class="invalid-feedback">Please provide start date.</div>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="end_date" class="mb-2">End Date</label>
                                                    <input type="date" class="form-control" id="end_date"
                                                        name="end_date">
                                                    <div class="invalid-feedback">Please provide end date.</div>
                                                </div>
                                                <div class="col-6 form-group">
                                                    <label for="state" class="mb-2">State</label>
                                                    <select id="state" class="form-control" name="state"
                                                        onchange="fetchDistricts(this.value)" required>
                                                        <option selected hidden disabled>Select State</option>
                                                        <option value="Andaman Nicobar">Andaman Nicobar</option>
                                                        <!-- ... other options ... -->
                                                    </select>
                                                    <div class="invalid-feedback">Please select state.</div>
                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label for="district" class="mb-2">Select Districts</label>
                                                    <div class="custom-multiselect">
                                                        <select id="district" class="form-select" name="district[]"
                                                            multiple aria-label="Select Districts">
                                                            <!-- Options will be dynamically added here -->
                                                        </select>
                                                    </div>
                                                    <div class="invalid-feedback">Please select at least one district.
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="remark" class="mb-2">Remark</label>
                                                    <div class="form-group">
                                                        <textarea id="remark" class="form-control" name="remark" rows="3" cols="100"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex align-items-center justify-content-center mt-5">
                                                    <button type="submit" class="btn btn-primary rounded-pill col-6"
                                                        id="submit">Submit</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of Modal -->
                    </div>
                </div>
            </div>
        </div>

    </section>
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
                    if (data.code === 200 && data.data) {
                        const stateSelect = document.getElementById('state');
                        stateSelect.innerHTML =
                            '<option selected hidden disabled>Select State</option>'; // Reset options

                        data.data.forEach(state => {
                            const option = document.createElement('option');
                            option.value = `${state.s_code}_${state.s_name}`; // Corrected concatenation
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
                const s_name = statedata[1];
                console.log(s_code, s_name);

                const myHeaders = new Headers({
                    "Content-Type": "application/json",
                    "Authorization": "d5baad86d889077e3d4d47e1d6169867"
                });

                const raw = JSON.stringify({
                    "action": "district",
                    "state_code": s_code
                });

                const requestOptions = {
                    method: "POST",
                    headers: myHeaders,
                    body: raw,
                    redirect: "follow"
                };

                const response = await fetch("https://vcredil.com/eoffice-apis/root/listing.php", requestOptions);

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                const result = await response.json(); // Use .json() if expecting JSON response
                console.log(result);

                // Get the select element
                const districtSelect = document.getElementById('district');
                districtSelect.innerHTML = ''; // Clear any existing options

                // Check if the response contains data
                if (result && result.data && Array.isArray(result.data)) {
                    result.data.forEach(district => {
                        // Create a new option element
                        const option = document.createElement('option');
                        option.value = district.d_name; // Use district code as the value
                        option.textContent = district.d_name; // Display district name

                        // Append the option to the select element
                        districtSelect.appendChild(option);
                    });
                } else {
                    // Handle cases where no data is available
                    const noDataOption = document.createElement('option');
                    noDataOption.textContent = 'No districts available';
                    noDataOption.disabled = true; // Make it unselectable
                    districtSelect.appendChild(noDataOption);
                }

            } catch (error) {
                console.error('Fetch error:', error);
            }
        }
    </script>




    {{-- <script>
        const district = document.getElementById('district');
        const districtList = document.getElementById('district-list');
        async function getDistricts(state) {
            districtList.innerHTML = "<li>Loading...</li>";
            try {
                const response = await fetch(`https://vcredil.com/get-district.php?state=${state}`);
                if (response.ok) {
                    const data = await response.json();
                    let temp = '';
                    data.forEach(element => {
                        temp += `<li class="dropdown-item">
                            <div class="form-check px-2">
                                <input class="form-check-input" type="checkbox" value="${element}" id="" onchange="addDistrict(this)" />
                                <label class="form-check-label" for="">${element}</label>
                            </div>
                        </li>`;
                    });
                    districtList.innerHTML = temp;
                } else {
                    console.error('Failed to fetch data.');
                    districtList.innerHTML = "<li>Failed to fetch districts</li>";
                }
            } catch (error) {
                console.error('An error occurred:', error);
                districtList.innerHTML = "<li>An error occurred</li>";
            }
        }

        function addDistrict(checkbox) {
            const value = checkbox.value;
            let temp = district.value.split(',');
            if (checkbox.checked) {
                if (!temp.includes(value)) {
                    temp.push(value);
                }
            } else {
                temp = temp.filter(item => item !== value);
            }
            district.value = temp.join(',');
        }

        function toggleStyle(element) {
            if (element.classList.contains('bg-primary')) {
                element.classList.remove('bg-primary');
                element.classList.add('bg-light');
            } else {
                element.classList.remove('bg-light');
                element.classList.add('bg-primary');
            }
        }
    </script> --}}

    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
@endsection
