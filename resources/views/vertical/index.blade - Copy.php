@php
  $profile = ['name' => $authdata['name'], 'role' => $authdata['role']];
  $dataCollection = collect($data); // Convert the $data array to a collection
@endphp

@extends('layouts.theme', $profile)

@section('content')
<div class="hold-transition sidebar-mini">
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title">Projects</h3>
                <ul class="nav nav-tabs" role="tablist">
                  @forelse ($monthYear as $new)
                    <li class="nav-item" role="presentation">
                      <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab" href="#tab-{{ $loop->index }}">
                        {{ $new->f_year }}
                      </a>
                    </li>
                  @empty
                    <li class="nav-item">
                      <p class="btn btn-outline-danger">No record found, Please enter valid input!</p>
                    </li>
                  @endforelse
                </ul>

                <div class="tab-content">
                  @forelse ($monthYear as $new)
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tab-{{ $loop->index }}">
                      <div class="table-responsive">
                        <table id="table-{{ $loop->index }}" class="table table-hover table-striped table-bordered">
                          <thead class="bg-secondary text-light">
                            <tr>
                              <th>No</th>
                              <th>Name</th>
                              <th>FY</th>
                              <th>Project Spoc</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @forelse ($dataCollection->where('fyear', $new->f_year) as $project)
                              <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $project['name'] }}</td>
                                <td>{{ $project['fyear'] }}</td>
                                <td>{{ $project['head'] }}</td>
                                <td>
                                  <a href="/vertical/project/{{ $project['id'] }}" class="btn btn-sm btn-outline-primary">View</a>
                                  <a href="#" class="btn btn-sm btn-outline-secondary"
                                     onclick="setEditFormValues('{{ $project['id'] }}', '{{ $project['name'] }}', '{{ $project['fyear'] }}', '{{ $project['head'] }}')"
                                     data-bs-toggle="modal" data-bs-target="#editModal">Edit</a>
                                </td>
                              </tr>
                            @empty
                              <tr>
                                <td colspan="5" class="text-center text-danger">No record found, Please enter valid input!</td>
                              </tr>
                            @endforelse
                          </tbody>
                        </table>
                      </div>
                    </div>
                  @empty
                    <div class="tab-pane fade show active">
                      <p class="text-danger">No record found, Please enter valid input!</p>
                    </div>
                  @endforelse
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('project.updateproject') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Project</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="project-id">
          <div class="form-group">
            <label for="p_name">Project Name</label>
            <input type="text" class="form-control" id="p_name" name="p_name" required>
          </div>
          <div class="form-group">
            <label for="f_year">Fiscal Year</label>
            <input type="text" class="form-control" id="f_year" name="f_year" required>
          </div>
          <div class="form-group">
            <label for="n_spoc">Project Spoc</label>
            <input type="text" class="form-control" id="n_spoc" name="n_spoc" required>
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

<!-- Include Toastr CSS and JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
  function setEditFormValues(id, name, fyear, head) {
    document.getElementById('project-id').value = id;
    document.getElementById('p_name').value = name;
    document.getElementById('f_year').value = fyear;
    document.getElementById('n_spoc').value = head;
  }
</script>
@endsection
