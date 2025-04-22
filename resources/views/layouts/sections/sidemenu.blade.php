<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar" style="color: purple;">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="/director" class="nav-link">
                <div class="nav-profile-image">
                    <img src="{{ asset('assets/theme/assets/images/faces-clipart/pic-1.png') }}" alt="profile">
                    <span class="login-status online"></span>
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2 fs-5">{{ $profile['name'] }}
                        <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i></span>
                    <span class="text-secondary text-small">{{ $profile['role'] }}</span>
                </div>
            </a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="/director">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
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
        <li class="nav-item">
            <a class="nav-link" href="pages/forms/basic_elements.html">
                <span class="menu-title">Reports</span>
                <i class="mdi mdi-file-check menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/director/user">
                <span class="menu-title">Users</span>
                <i class="mdi mdi-account-circle menu-icon"></i>
            </a>
        </li>
    </ul>
</nav>
