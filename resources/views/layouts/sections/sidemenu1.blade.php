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
            $url = '#';
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
<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar" style="color: purple;">
  <ul class="nav">
    <li class="nav-item nav-profile">
        <a href="{{ $url }}" class="nav-link">
        <div class="nav-profile-image">
            <img src="{{ asset('assets/theme/assets/images/faces-clipart/pic-1.png') }}" alt="profile">
            <span class="login-status online"></span>
        </div>
        <div class="nav-profile-text d-flex flex-column">
            <span class="font-weight-bold mb-2 fs-5">{{ $profile['name'] ?? (Auth::guard('web')->user()->name ?? Auth::guard('vendor')->user()->name) }}<i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i></span>
            <span class="text-secondary text-small">{{ $profile['role'] ?? 'Team Member' }}</span>
        </div>
        </a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="{{ $url }}">
        <span class="menu-title">Dashboard</span><i class="mdi mdi-home menu-icon"></i>
        </a>
    </li>
    @if ($role == 1)
        <li class="nav-item active">
            <a class="nav-link" href="/director/project">
                <span class="menu-title">Projects</span>
                <i class="mdi mdi-clipboard-outline menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                aria-controls="ui-basic">
                <span class="menu-title">Verticals</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-briefcase menu-icon"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    @php
                        $verticals = [['id' => 1, 'name' => 'Training'], ['id' => 2, 'name' => 'Consultancy'], ['id' => 3, 'name' => 'Finance'], ['id' => 4, 'name' => 'Retail'], ['id' => 5, 'name' => 'Human Resource']];
                    @endphp
                    @foreach ($verticals as $item)
                        <li class="nav-item">
                            <a class="nav-link" href="/director/vertical/{{ $item['id'] }}">{{ $item['name'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/director/vendor">
                <span class="menu-title">Vendors</span>
                <i class="mdi mdi-clipboard-account menu-icon"></i>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link" href="pages/forms/basic_elements.html">
                <span class="menu-title">Reports</span>
                <i class="mdi mdi-file-check menu-icon"></i>
            </a>
        </li> --}}
        <li class="nav-item">
            <a class="nav-link" href="/director/user">
                <span class="menu-title">Users</span>
                <i class="mdi mdi-account-circle menu-icon"></i>
            </a>
        </li>
    @endif
    @if ($role == 2)
        <li class="nav-item">
            <a class="nav-link" href="{{ $url }}/add">
                <span class="menu-title">Add User</span>
                <i class="mdi mdi-account-circle menu-icon"></i>
            </a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('admin.addProject') }}">
                <span class="menu-title">Add Project</span>
                <i class="mdi mdi-clipboard-outline menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.addTeam') }}">
                <span class="menu-title">Add Team</span>
                <i class="mdi mdi-account-circle menu-icon"></i>
            </a>
        </li>
    @endif
    @if ($role == 3)
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('vertical.addProject') }}">
                <span class="menu-title">Add Project</span>
                <i class="mdi mdi-clipboard-outline menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('vertical.addTeam') }}">
                <span class="menu-title">Add Team</span>
                <i class="mdi mdi-account-circle menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('vertical.addMember') }}">
                <span class="menu-title">Add Member</span>
                <i class="mdi mdi-account-circle menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('vertical.vendorReports') }}">
                <span class="menu-title">Vendor Reports</span>
                <i class="mdi mdi-account-check menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('vertical.internalReports') }}">
                <span class="menu-title">Internal Reports</span>
                <i class="mdi mdi-chart-bar menu-icon"></i>
            </a>
        </li>
    @endif
    @if ($role == 4)
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('spoc.add') }}">
                <span class="menu-title">Register Firm/Company</span>
                <i class="mdi mdi-account-circle menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('spoc.assignP') }}">
                <span class="menu-title">Assign Project</span>
                <i class="mdi mdi-account-check menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('spoc.vendorLogin') }}">
                <span class="menu-title">Vendor Login</span>
                <i class="mdi mdi-account-key menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('spoc.vendorReports') }}">
                <span class="menu-title">Vendor Reports</span>
                <i class="mdi mdi-account-check menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('spoc.internalReports') }}">
                <span class="menu-title">Internal Reports</span>
                <i class="mdi mdi-chart-bar menu-icon"></i>
            </a>
        </li>
    @endif
    @if ($role == 5)
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('team.upload') }}">
                <span class="menu-title">Upload Report</span>
                <i class="mdi mdi-clipboard-outline menu-icon"></i>
            </a>
        </li>
    @endif
  </ul>
</nav>