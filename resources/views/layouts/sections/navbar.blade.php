<!-- partial:partials/_navbar.html -->
@php
    $role = Auth::guard('web')->user()->role ?? 6;

    $url = '';
    switch ($role) {
        case 1:
            # code...
            $url = '/director';
            break;
        case 2:
            # code...
            $url = '/admin';
            break;
        case 3:
            # code...
            $url = '/vertical';
            break;
        case 4:
            # code...
            $url = '/spoc';
            break;
        case 5:
            # code...
            $url = '/team';
            break;
        case 6:
            # code...
            $url = '/vendor-login';
            break;
        case 7:
            # code...
            $url = '/beneficiary';
            break;

        default:
            # code...
            $url = '/';
            break;
    }
@endphp
<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center pt-0 mt-0">
        <a class="navbar-brand brand-logo" href="{{ $url }}"><img
                src="{{ asset('assets/theme/assets/images/upicon.png') }}" alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="{{ $url }}"><img
                src="{{ asset('assets/theme/assets/images/site_icon.png') }}" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize"
            data-toggle="tooltip" data-placement="bottom" title="Collapse Menu">
            <span class="mdi mdi-menu"></span>
        </button>
        <!--<div class="search-field d-none d-md-block">-->
        <!--    <form class="d-flex align-items-center h-100" action="#">-->
        <!--        <div class="input-group">-->
        <!--            <div class="input-group-prepend bg-transparent">-->
        <!--                <i class="input-group-text border-0 mdi mdi-magnify"></i>-->
        <!--            </div>-->
        <!--            <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">-->
        <!--        </div>-->
        <!--    </form>-->
        <!--</div>-->
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-logout d-none d-lg-block">
                @if (Auth::guard('web')->check())
                    <a class="nav-link text-danger" data-toggle="tooltip" data-placement="bottom" title="Logout"
                        href="{{ route('logout') }}">
                    @else
                        <a class="nav-link text-danger" data-toggle="tooltip" data-placement="bottom" title="Logout"
                            href="{{ route('vendor-login.logout') }}">
                @endif
                <i class="mdi mdi-power"></i>
                </a>
            </li>
            <li class="nav-item d-none d-lg-block full-screen-link">
                <a class="nav-link" data-toggle="tooltip" data-placement="bottom" title="Fullscreen">
                    <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                </a>
            </li>

        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
