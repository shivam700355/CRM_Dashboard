@php
    $profile = ['name' => $authdata['name'], 'role' => $authdata['role']];
@endphp

@extends('layouts.app', $profile)
@section('style')
    <style>
        .dropdown-menu {
            max-height: 300px;
            min-width: ???px;
            overflow-x: visible;
            overflow-y: scroll;
        }

        .dropdown-item:hover {
            color: blue !important;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper p-2">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
            <div class="card-body">
            <form id="regForm" action="{{ route('vertical.saveProject') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="number" hidden id="added_by" name="added_by" value="{{ Auth::user()->id }}">
                <input type="number" hidden id="vertical_id" name="vertical_id" value="{{ Auth::user()->vertical }}">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="">Project Name:</label>
                        <input type="text" class="form-control " id='p_name' name="p_name" placeholder="Enter project name">
                        <font style="color:red">{{ $errors->has('p_name') ? $errors->first('p_name') : '' }} </font>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Financial Year:</label>
                        <input type="text" class="form-control " id='f_year' name="f_year" placeholder="Enter financial year">
                        <font style="color:red">{{ $errors->has('f_year') ? $errors->first('f_year') : '' }} </font>
                    </div>
                    <input type="hidden" name="n_spoc" value="" id="n_spoc">
                    <div class="dropdown col-md-6 mb-3">
                        <label for="district">Project Head:</label>
                        <a class="btn btn-secondary dropdown-toggle col-12" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false"> Select Head </a>
                        <ul class="dropdown-menu" id="district-list" data-bs-spy="scroll"
                            data-bs-target="#simple-list-example" data-bs-offset="0"
                            data-bs-smooth-scroll="true" class="scrollspy-example" tabindex="0">
                        @foreach ($users->sortBy('name') as $user)
                        <li class="dropdown-item">
                            <div class="form-check px-2">
                                <input class="form-check-input" type="checkbox"  value="{{ $user->id }}" onchange="addSpoc(this)"/>
                                <label class="form-check-label" for="">{{ $user->name }}</label>
                            </div>
                        </li>
                        @endforeach
                        </ul>
                        <font style="color:red">{{ $errors->has('n_spoc') ? $errors->first('n_spoc') : '' }} </font>
                    </div>
                    {{-- <div class="form-group col-md-6">
                        <label for="">Project Head:</label>
                        <!-- <input type="text" class="form-control" name="n_spoc" id="n_spoc" > -->
                        <select class="form-control dropdown-toggle p-3" id="n_spoc" name="n_spoc" multiple>
                            <option selected hidden disabled>Select here</option>
                            @foreach ($users->sortBy('name') as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <font style="color:red">{{ $errors->has('n_spoc') ? $errors->first('n_spoc') : '' }}
                        </font>
                    </div> --}}
                    <div class="form-group col-md-12">
                        <label for="">Project Details:</label>
                        <textarea type="text" class="form-control" row='6' id='p_details' name="p_details" placeholder="Enter project details"></textarea>
                    </div>
                </div>
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <button type="submit" class="btn btn-primary rounded-pill col-6">Submit</button>
                </div>
            </form>
            </div>
            </div>
            </div>
        </div>
    </div>
<script>
    const spocList = document.getElementById('n_spoc');
    function addSpoc(checkbox) {
        const value = checkbox.value;
        let temp = spocList.value.split(',');
        if (checkbox.checked) {
            if (!temp.includes(value)) {
                temp.push(value);
            }
        } else {
            temp = temp.filter(item => item !== value);
        }
        spocList.value = temp.join(',');
    }
</script>
@endsection