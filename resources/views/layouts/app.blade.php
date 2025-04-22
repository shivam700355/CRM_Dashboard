<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>UPICON - Dashboard</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <!-- =======================================================
    * Template Name: CKRai
    * Template URL: #
    * Updated: Apr 20 2024 with Bootstrap v5.3.3
    * Author: Chandan Kumar Rai
    ======================================================== -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.bootstrap5.css">

</head>
<style>
    table {
        font-size: 14px;
        width: 100%;
        /* Set the table to take the full width of its container */
        border-collapse: collapse;
        /* Merge table borders */
        margin: 20px 0;
        /* Add space above and below the table */
    }

    th,
    td {
        border: 1px solid #ddd;
        /* Add border to cells */
        padding: 8px;
        /* Add padding inside cells */
        text-align: left;
        /* Align text to the left */
    }

    th {
        background-color: #f2f2f2;
        /* Light gray background for header */
        font-weight: bold;
        /* Make header text bold */
    }

    tr:hover {
        background-color: #f1f1f1;
        /* Highlight row on hover */
    }

    ul li a {
        text-decoration: none;
    }
</style>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="#" class="logo d-flex align-items-center">
            <img src="{{ url('dist/img/upicon_logo.png') }}" alt="UPICON-Dashboard">
            <span>Dashboard</span>

        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

    {{-- <div class="search-bar">
        <form class="search-form d-flex align-items-center" method="POST" action="#">
            <input type="text" name="query" placeholder="Search" title="Enter search keyword">
            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
        </form>
    </div> --}}

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle" href="#"><i class="bi bi-search"></i></a>
            </li>

            <li class="nav-item dropdown pe-3">

                @if (Auth::user()->role == 1)
                    <a href="{{ route('director.sadmin') }}"
                        class="nav-link nav-profile d-flex align-items-center pe-0" data-bs-toggle="dropdown">
                        <img src="https://upicondashboard.in/newjjm/storage/app/profile_pic/{{ Auth::user()->profile_pic }}"
                            alt="Profile" class="rounded-circle">
                        <span class="brand-text font-weight-light">Director</span>
                    </a>
                @endif

                @if (Auth::user()->role == 2)
                    <a href="{{ route('admin.index') }}" class="nav-link nav-profile d-flex align-items-center pe-0"
                        data-bs-toggle="dropdown">
                        <img src="https://upicondashboard.in/newjjm/storage/app/profile_pic/{{ Auth::user()->profile_pic }}"
                            alt="Profile" class="rounded-circle">
                        <span class="brand-text font-weight-light">Admin</span>
                    </a>
                @endif

                @if (Auth::user()->role == 3)
                    <a href="{{ route('vertical.index') }}" class="nav-link nav-profile d-flex align-items-center pe-0"
                        data-bs-toggle="dropdown">
                        <img src="https://upicondashboard.in/newjjm/storage/app/profile_pic/{{ Auth::user()->profile_pic }}"
                            alt="Profile" class="rounded-circle">
                        <span class="brand-text font-weight-light">Vertical</span>
                    </a>
                @endif

                @if (Auth::user()->role == 4)
                    <a href="{{ route('spoc.index') }}" class="nav-link nav-profile d-flex align-items-center pe-0"
                        data-bs-toggle="dropdown">
                        <img src="https://upicondashboard.in/newjjm/storage/app/profile_pic/{{ Auth::user()->profile_pic }}"
                            alt="Profile" class="rounded-circle">

                        <span class="brand-text font-weight-light">Spoc</span>
                    </a>
                @endif


                @if (Auth::user()->role == 5)
                    <a href="{{ route('team.index') }}" class="nav-link nav-profile d-flex align-items-center pe-0"
                        data-bs-toggle="dropdown">
                        <img src="https://upicondashboard.in/newjjm/storage/app/profile_pic/{{ Auth::user()->profile_pic }}"
                            alt="Profile" class="rounded-circle">
                        <span class="brand-text font-weight-light">Team</span>
                    </a>
                @endif

                @if (Auth::user()->role == 8)
                    <a href="{{ route('finance.index') }}" class="nav-link nav-profile d-flex align-items-center pe-0"
                        data-bs-toggle="dropdown">
                        <img src="https://upicondashboard.in/newjjm/storage/app/profile_pic/{{ Auth::user()->profile_pic }}"
                            alt="Profile" class="rounded-circle">
                        <span class="brand-text font-weight-light">Finance</span>
                    </a>
                @endif
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">

                    @if (Auth::user()->role == 1)
                        <li class="dropdown-header">
                            <h6>{{ Auth::user()->name }}</h6><span>Director</span>
                        </li>
                    @endif
                    @if (Auth::user()->role == 2)
                        <li class="dropdown-header">
                            <h6>{{ Auth::user()->name }}</h6><span>Admin</span>
                        </li>
                    @endif
                    @if (Auth::user()->role == 3)
                        <li class="dropdown-header">
                            <h6>{{ Auth::user()->name }}</h6><span>Vertical</span>
                        </li>
                    @endif
                    @if (Auth::user()->role == 4)
                        <li class="dropdown-header">
                            <h6>{{ Auth::user()->name }}</h6><span>SPOC</span>
                        </li>
                    @endif
                    @if (Auth::user()->role == 5)
                        <li class="dropdown-header">
                            <h6>{{ Auth::user()->name }}</h6><span>Team</span>
                        </li>
                    @endif
                    @if (Auth::user()->role == 6)
                        <li class="dropdown-header">
                            <h6>{{ Auth::user()->name }}</h6><span>Vendor</span>
                        </li>
                    @endif
                    @if (Auth::user()->role == 7)
                        <li class="dropdown-header">
                            <h6>{{ Auth::user()->name }}</h6><span>Beneficiary</span>
                        </li>
                    @endif
                    @if (Auth::user()->role == 8)
                        <li class="dropdown-header">
                            <h6>{{ Auth::user()->name }}</h6><span>Finance</span>
                        </li>
                    @endif
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    @if (Auth::user()->role == 1)
                        <li>
                            <a class="dropdown-item d-flex align-items-center"
                                href="{{ route('director.profile') }}">

                                <i class="bi bi-person"></i><span>My Profile</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->role == 2)
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.profile') }}">

                                <i class="bi bi-person"></i><span>My Profile</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->role == 3)
                        <li>
                            <a class="dropdown-item d-flex align-items-center"
                                href="{{ route('vertical.profile') }}">

                                <i class="bi bi-person"></i><span>My Profile</span>
                            </a>
                        </li>
                    @endif
                    <li>
                        @if (Auth::user()->role == 4)
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('spoc.profile') }}">

                            <i class="bi bi-person"></i><span>My Profile</span>
                        </a>
                    </li>
                    @endif
                    @if (Auth::user()->role == 5)
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('team.profile') }}">

                                <i class="bi bi-person"></i><span>My Profile</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->role == 8)
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('finance.profile') }}">

                                <i class="bi bi-person"></i><span>My Profile</span>
                            </a>
                        </li>
                    @endif
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    {{-- <li>
                        <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                            <i class="bi bi-question-circle"></i>
                            <span>Need Help?</span>
                        </a>
                    </li> --}}
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif
                    @else
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
            </li>
        </ul>
    </nav><!-- End Icons Navigation -->
</header><!-- End Header -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        @if (Auth::user()->role == 1)
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('director.sadmin') }}"
                    onclick="setActive(this, 'director.sadmin')">
                    <i class="ri-dashboard-3-line fs-6"></i><span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="/director/project" onclick="setActive(this, 'director.project')">
                    <i class="ri-folder-line fs-6"></i><span>All Projects</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="/director/vertical/1"
                    onclick="setActive(this, 'director.vertical')">
                    <i class="ri-book-line fs-6"></i><span>Training</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="/director/user" onclick="setActive(this, 'director.user')">
                    <i class="ri-user-3-line fs-6"></i><span>Employee</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('director.finance') }}" data-bs-target="#finance-nav"
                    data-bs-toggle="collapse" onclick="setActive(this, 'director.finance')">
                    <i class="ri-money-dollar-circle-line fs-6"></i><span>Finance</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="finance-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li><a href="{{ route('director.finance', ['key' => 'incometaxtds']) }}"
                            onclick="setActive(this, 'finance.incometaxtds')"><i
                                class="ri-calculator-line fs-6"></i><span>Income Tax TDS</span></a></li>
                    <li><a href="{{ route('director.finance', ['key' => 'gst']) }}"
                            onclick="setActive(this, 'finance.gst')"><i
                                class="ri-money-dollar-box-line fs-6"></i><span>GST</span></a></li>
                    <li><a href="{{ route('director.finance', ['key' => 'epfesi']) }}"
                            onclick="setActive(this, 'finance.epfesi')"><i
                                class="ri-medal-line fs-6"></i><span>EPF/ESI Report</span></a></li>
                    <li><a href="{{ route('director.finance', ['key' => 'advancetostaff']) }}"
                            onclick="setActive(this, 'finance.advancetostaff')"><i
                                class="ri-group-line fs-6"></i><span>Advance To Staff</span></a></li>
                    <li><a href="{{ route('director.finance', ['key' => 'Paymenttovendor']) }}"
                            onclick="setActive(this, 'finance.Paymenttovendor')"><i
                                class="ri-exchange-dollar-line fs-6"></i><span>Payment To Vendor</span></a></li>
                    <li><a href="{{ route('director.finance', ['key' => 'bank']) }}"
                            onclick="setActive(this, 'finance.bank')"><i class="ri-bank-line fs-6"></i><span>Bank
                                Information</span></a></li>
                </ul>
            </li>
        @endif

        @if (Auth::user()->role == 2)
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('admin.index') }}">
                    <i class="bi bi-grid"></i><span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('admin.add') }}">
                    <i class="bi bi-journal-text"></i><span>Add</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('admin.addTeam') }}">
                    <i class="bi bi-journal-text"></i><span>Add Team</span>
                </a>
            </li>
        @endif

        @if (Auth::user()->role == 3)
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('vertical.index') }}"  onclick="setActive(this, 'vertical.index')">
                    <i class="bi bi-grid"></i><span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('vertical.addTeam') }}" onclick="setActive(this, 'vertical.addTeam')">
                    <i class="bi bi-people"></i><span>Add Team</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('vertical.addMember') }}" onclick="setActive(this, 'vertical.addMember')">
                    <i class="bi bi-person-plus"></i><span>Add Member</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('vertical.vendorReports') }}" onclick="setActive(this, 'vertical.vendorReports')">
                    <i class="bi bi-file-earmark-bar-graph"></i><span>Vendor Reports</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('vertical.internalReports') }}" onclick="setActive(this, 'vertical.internalReports')">
                    <i class="bi bi-graph-up-arrow"></i><span>Internal Reports</span>
                </a>
            </li>
        @endif

        @if (Auth::user()->role == 4)
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('spoc.index') }}"  onclick="setActive(this, 'spoc.index')">
                    <i class="bi bi-grid"></i><span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('spoc.add') }}" onclick="setActive(this, 'spoc.add')">
                    <i class="bi bi-building"></i><span>Register Firm/Company</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('spoc.assignP') }}" onclick="setActive(this, 'spoc.assignP')">
                    <i class="bi bi-clipboard-plus"></i><span>Assign Project</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('spoc.vendorLogin') }}" onclick="setActive(this, 'spoc.vendorLogin')">
                    <i class="bi bi-person-badge"></i><span>Vendor Login</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('spoc.vendorReports') }}" onclick="setActive(this, 'spoc.vendorReports')">
                    <i class="bi bi-file-earmark-bar-graph"></i><span>Vendor Reports</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('spoc.internalReports') }}" onclick="setActive(this, 'spoc.internalReports')">
                    <i class="bi bi-graph-up"></i><span>Internal Reports</span>
                </a>
            </li>
        @endif

        @if (Auth::user()->role == 5)
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('team.index') }}"  onclick="setActive(this, 'team.index')">
                    <i class="bi bi-grid"></i><span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('team.internalreports') }}" onclick="setActive(this, 'team.internalreports')">
                    <i class="bi bi-grid"></i><span>Internal Report</span>
                </a>
            </li>
        @endif

        @if (Auth::user()->role == 6)
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('vendor.index') }}">
                    <i class="bi bi-grid"></i><span>My Dashboard</span>
                </a>
            </li>
        @endif

        @if (Auth::user()->role == 7)
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('beneficiary.index') }}">
                    <i class="bi bi-grid"></i><span>My Dashboard</span>
                </a>
            </li>
        @endif

        @if (Auth::user()->role == 8)
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('finance.index') }}" onclick="setActive(this, 'finance.index')">
                    <i class="bi bi-grid"></i><span>My Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('finance.incometaxtds') }}" onclick="setActive(this, 'finance.incometaxtds')">
                    <i class="ri-money-dollar-circle-line"></i><span>Income Tax-TDS</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('finance.gst') }}" onclick="setActive(this, 'finance.gst')">
                    <i class="ri-money-dollar-box-line"></i><span>GST TDS/Liability</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('finance.epfesi') }}" onclick="setActive(this, 'inance.epfesi')">
                    <i class="ri-money-dollar-box-line"></i><span>EPF / ESI</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('finance.advancetostaff') }}" onclick="setActive(this, 'finance.advancetostaff')">
                    <i class="bi bi-person-plus"></i><span>Advance To STAFF</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('finance.payment') }}"  onclick="setActive(this, 'finance.payment')">
                    <i class="ri-money-dollar-box-line"></i><span>Payment To VENDOR</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('finance.bank') }}" onclick="setActive(this, 'finance.bank')">
                    <i class="ri-money-dollar-box-line"></i><span>BANK INFO</span>
                </a>
            </li>
        @endif
    </ul>
</aside>

<script>
    function setActive(element, linkKey) {
        // Store the active link in localStorage
        localStorage.setItem('activeLink', linkKey);

        // Reset styles for all links
        document.querySelectorAll('.sidebar-nav .nav-link').forEach(link => {
            link.style.backgroundColor = ''; // Reset background color
            link.style.color = ''; // Reset text color
        });

        // Set active styles for the clicked link
        element.style.backgroundColor = 'blue'; // Set background color to blue
        element.style.color = 'white'; // Set text color to white
    }

    // Function to initialize the active link on page load
    function initActiveLink() {
        const activeLinkKey = localStorage.getItem('activeLink');
        if (activeLinkKey) {
            document.querySelectorAll('.sidebar-nav .nav-link').forEach(link => {
                if (link.onclick && link.getAttribute('onclick').includes(activeLinkKey)) {
                    link.style.backgroundColor = 'blue'; // Set background color to blue
                    link.style.color = 'white'; // Set text color to white
                }
            });
        }
    }

    // Initialize the active link when the page loads
    window.onload = initActiveLink;

    // Handle submenu toggle
    document.querySelectorAll('.nav-link[data-bs-toggle="collapse"]').forEach(link => {
        link.addEventListener('click', function() {
            const submenu = this.nextElementSibling;
            submenu.classList.toggle('collapse');
            submenu.classList.toggle('show');
        });
    });
</script>



<main id="main" class="main">

    @yield('content')

</main><!-- End #main -->



<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>UPICON</span></strong>. All Rights Reserved
    </div>
    <div class="credits">Designed by <a href="#">VAA</a>
    </div>
</footer>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('assets/vendor/quill/quill.js') }}"></script>
<script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.7/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.2/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.bootstrap5.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.colVis.min.js"></script>
</body>
<!-- Template Main JS File -->
<script src="{{ asset('assets/js/main.js') }}"></script>
<script>
    $(document).ready(function() {
        new DataTable('#example', {
            layout: {
                topStart: {
                    buttons: [{
                        extend: 'csv',
                        split: ['pdf', 'excel']
                    }]
                }
            },
            searching: true, // Enable searching/filtering
            paging: true, // Enable paging
            ordering: true, // Enable column ordering
            info: true, // Show information about the table
            pageLength: 10, // Set default number of entries per page
            lengthMenu: [5, 10, 25, 50], // Page length options
        });
    });
</script>
</body>

</html>
