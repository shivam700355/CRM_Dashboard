@extends('layouts.app')

@section('content')



<body class="hold-transition sidebar-mini">
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h5 class="m-0">Dashboard</h5>
            <!-- <a type="button" class="abc">Break</a> -->
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('vendor.index') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ route('vendor.index') }}">Back</a></li>
              <!-- <li class="breadcrumb-item active">Dashboard</li> -->
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- <div class="card-header">
                <h3 class="card-title">DataTable</h3>
              </div> -->
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Name</th>

                      <th>Email</th>
                      <th>Project</th>

                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($users as $user)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      {{-- <td><a href="{{ route('vendor.view', $user->id) }}">{{ $user->name }}</a></td> --}}

                      <td>{{ $user->email }}</td>
                      <td>{{ $user->project }}</td>

                      <td>{{ $user->status }}</td>

                    </tr>
                    @empty
                    <p class="btn btn-outline-danger">No record found, Please enter valid input!</p>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
  </div>


</body>
@endsection

@section('script')

@endsection