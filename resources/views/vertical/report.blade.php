@php
    $profile = ['name' => $authdata['name'], 'role' => $authdata['role']];
    $dataCollection = collect($data); // Convert the $data array to a collection
@endphp

@extends('layouts.app', $profile)

@section('content')

<body class="hold-transition sidebar-mini">
    <div class="content-wrapper">
        <section class="section">

            <div class="row">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Project</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- Card title for Project Details -->
                        <div class="card-header">
                            <h5 class="mb-0">Project Details</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <td class="fw-bold"><b>Name</b></td>
                                        <td>{{ $data['name'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold"><b>Vertical</b></td>
                                        <td>{{ $data['vertical'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold"><b>Head</b></td>
                                        <td>{{ $data['head'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold"><b>Details</b></td>
                                        <td>{{ $data['details'] }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                        <div class="card-header">
                            <h5 class="mb-0">Report Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table datatable  border " id="example2">
                                    <thead class="bg-secondary text-light">
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Name</th>
                                            <th>Submited Name</th>
                                            <th>Upload Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $serialNumber = 1;
                                        @endphp
                                        @foreach ($data['media'] as $medias)
                                                                                <tr>
                                                                                    <td>{{ $serialNumber }}</td>
                                                                                    <td>{{ $medias['original_name']}} </td>
                                                                                    <td>{{ $medias['user_name']}} </td>

                                                                                    <td>
                                                                                        @if (\Carbon\Carbon::parse($medias['created_at'])->isToday())
                                                                                            Today,
                                                                                            {{ \Carbon\Carbon::parse($medias['created_at'])->format('H:i') }}
                                                                                        @else
                                                                                            {{ \Carbon\Carbon::parse($medias['created_at'])->format('d M Y') }}
                                                                                        @endif
                                                                                    </td>

                                                                                    <td>
                                                                                        @if (pathinfo( $medias['name'] , PATHINFO_EXTENSION) === 'xlsx' || pathinfo( $medias['name'] , PATHINFO_EXTENSION) === 'xls')
                                                                                            <a href="https://docs.google.com/viewer?url={{ urlencode('https://upicondashboard.in/show/' .  $medias['name'] ) }}&embedded=true"
                                                                                                target="_blank" class="btn btn-sm btn-primary">
                                                                                                <i class="bi bi-eye"></i>
                                                                                            </a>
                                                                                            <a href="/show/{{  $medias['name']  }}" target="_blank"
                                                                                                class="btn btn-sm btn-primary">
                                                                                                <i class="bi bi-download"></i>
                                                                                            </a>
                                                                                        @else
                                                                                            <a href="/show/{{  $medias['name']  }}" class="btn btn-sm btn-primary">
                                                                                                <i class="bi bi-eye"></i>
                                                                                            </a>
                                                                                            <a href="/show/{{  $medias['name']  }}" target="_blank"
                                                                                                class="btn btn-sm btn-primary">
                                                                                                <i class="bi bi-download"></i>
                                                                                            </a>
                                                                                        @endif
                                                                                    </td>


                                                                                </tr>
                                                                                @php
                                                                                    $serialNumber++;
                                                                                @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
@endsection