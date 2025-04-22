@extends('layouts.theme-base')

@section('layoutStyle')
    @yield('style')
@endsection


@section('layoutContent')
    @include('layouts.sections.navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        @if (isset($profile))
            @include('layouts.sections.sidemenu1', $profile)
        @else
            @include('layouts.sections.sidemenu1')
        @endif
        <!-- partial -->
        <div class="main-panel">
            @yield('content')
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
@endsection

@section('layoutScript')
    @yield('script')
@endsection
