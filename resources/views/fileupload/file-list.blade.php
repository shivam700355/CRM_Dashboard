<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Listing</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- DataTables JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
</head>
<style>
    
    body {
        background-color: #fafbfb;
    }
</style>

<body>
   
    <div class="container-fluied">
        <div class="row justify-content-center mt-5">
            <div class="col-12 col-md-8 col-lg-10">
                <div class="card shadow-sm  bg-body rounded">
                    <div class="card-header d-flex justify-content-center">
                        <img src="{{ asset('assets/img/upicon.png') }}" class="d-inline-block align-top upicon-logo" style="height: 100px; ">
                    </div>

                    <div class="card-body table-responsive px-2">
                        <table class="table table-hover table-striped table-bordered ">
                            <thead class="table-primary">
                                <tr>
                                    <th>Sr.No</th>
                                    <th>AOE Name</th>
                                    <th>Mobile</th>
                                    <th>Source</th>
                                    
                                    <th>File Name</th>
                                    <th>Upload Date</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $index = 1;
                                @endphp
                                @foreach ($filedata as $file)
                                <tr>
                                    <th>{{ $index }}</th>
                                    <td>{{ $file->aoe_name }}</td>
                                    <td>{{ $file->mobile }}</td>
                                    <td>{{ $file->source }}</td>
                                    <td>{{ $file->original_name }}</td>
                                    <td>{{ $file->created_at->format('Y-m-d') }}</td>
                                    <td><a href="fileshow/{{ $file->storage_name }}" target="_blank"><button class="btn btn-primary btn-sm"><i class="fa fa-file" aria-hidden="true"></i>&nbsp;&nbsp;view</button></a></td>
                                </tr>
                                @php
                                $index++;
                                @endphp
                                @endforEach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Initialize DataTable -->
    <script>
        $(document).ready(function() {
            $('.table').DataTable();

        });
    </script>
</body>

</html>