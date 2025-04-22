@php
$profile = ['name' => $authdata['name'], 'role' => $authdata['role']];
@endphp
@extends('layouts.theme', $profile)
@section('content')

<body class="hold-transition sidebar-mini">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->


        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <!-- <li class="nav-item" role="presentation">
                                        <button class="nav-link " id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab" aria-controls="details" aria-selected="true">Details</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="vendors-tab" data-bs-toggle="tab" data-bs-target="#vendors" type="button" role="tab" aria-controls="vendors" aria-selected="false">Vendors</button>
                                    </li> -->
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="media-tab" data-bs-toggle="tab" data-bs-target="#media" type="button" role="tab" aria-controls="media" aria-selected="false">Report</button>
                                    </li>
                                    <!-- <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="teams-tab" data-bs-toggle="tab" data-bs-target="#teams" type="button" role="tab" aria-controls="teams" aria-selected="false">Teams</button>
                                    </li> -->
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    

                                    <div class="tab-pane fade show active" id="media" role="tabpanel" aria-labelledby="media-tab">
                                        <div class="card">
                                            <div class="card-body">
                                                
                                                <ul class="nav nav-tabs" id="mediaTab" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link active" id="pdf-tab" data-bs-toggle="tab" data-bs-target="#pdf" type="button" role="tab" aria-controls="pdf" aria-selected="true">PDF</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="excel-tab" data-bs-toggle="tab" data-bs-target="#excel" type="button" role="tab" aria-controls="excel" aria-selected="false">Excel</button>
                                                    </li>
                                                    <!-- <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="photo-tab" data-bs-toggle="tab" data-bs-target="#photo" type="button" role="tab" aria-controls="photo" aria-selected="false">Photo</button>
                                                    </li> -->
                                                </ul>
                                                <div class="tab-content" id="mediaTabContent">
                                                    <div class="tab-pane fade show active" id="pdf" role="tabpanel" aria-labelledby="pdf-tab">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover table-bordered table-striped" id="pdfTable">
                                                                <thead class="bg-secondary text-light">
                                                                    <tr>
                                                                        <th>S.No.</th>
                                                                        <th>Media Name</th>
                                                                        <th>Upload Date</th>
                                                                        <th>View</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php
                                                                    $serialNumber = 1;
                                                                    @endphp
                                                                    @foreach ($mediaData as $media)
                                                                    @if (in_array(pathinfo($media['name'], PATHINFO_EXTENSION), ['pdf']))
                                                                    <tr>
                                                                        <td>{{ $serialNumber }}</td>
                                                                        <td>{{ $media['original_name'] }}</td>
                                                                        <td>{{ $media['created_at'] }}</td>
                                                                        <td><a href="{{ '/show/' . $media['name'] }}" target="_blank" class="btn btn-sm btn-outline-primary">Download</a></td>
                                                                    </tr>
                                                                    @php
                                                                    $serialNumber++;
                                                                    @endphp
                                                                    @endif
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="excel" role="tabpanel" aria-labelledby="excel-tab">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover table-bordered table-striped" id="excelTable">
                                                                <thead class="bg-secondary text-light">
                                                                    <tr>
                                                                        <th>S.No.</th>
                                                                        <th>Media Name</th>
                                                                        <th>Upload Date</th>
                                                                        <th>View</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php
                                                                    $serialNumber = 1;
                                                                    @endphp
                                                                    @foreach ($mediaData as $media)
                                                                    @if (in_array(pathinfo($media['name'], PATHINFO_EXTENSION), ['xlsx', 'xls']))
                                                                    <tr>
                                                                        <td>{{ $serialNumber }}</td>
                                                                        <td>{{ $media['original_name'] }}</td>
                                                                        <td>{{ $media['created_at'] }}</td>
                                                                        <td><a href="{{ '/show/' . $media['name'] }}" target="_blank" class="btn btn-sm btn-outline-primary">Download</a></td>
                                                                    </tr>
                                                                    @php
                                                                    $serialNumber++;
                                                                    @endphp
                                                                    @endif
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="photo" role="tabpanel" aria-labelledby="photo-tab">
                                                        <div class="container">
                                                            <h1 class="text-center my-5">Image Gallery</h1>
                                                            <hr>

                                                            <div class="gallery card">
                                                                @foreach ($mediaData as $media)
                                                                @if (in_array(pathinfo($media['name'], PATHINFO_EXTENSION), ['png', 'jpg', 'jpeg']))
                                                                <div>
                                                                    <a href="{{ '/show/' . $media['name'] }}" target="_blank">
                                                                        <img src="{{ '/show/' . $media['name'] }}" alt="{{ $media['original_name'] }}" class="shadow bg-white rounded" style="height: 200px; width:400px;">
                                                                    </a>
                                                                </div>
                                                                @endif
                                                                @endforeach
                                                                <!-- Add more images as needed -->
                                                            </div>
                                                        </div>

                                                     
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                   
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
        </section>
    </div>



</body>
@endsection