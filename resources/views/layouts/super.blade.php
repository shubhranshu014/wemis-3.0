<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Wemis</title>
    <!-- base:css -->
    <link rel="stylesheet" href="{{ url('vendors/mdi/css/materialdesignicons.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ url('vendors/base/vendor.bundle.base.css') }}"> --}}
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ url('multiselect/css/chosen.css') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('multiselect/css/bootstrap.min.css') }}">

    <!-- Style -->
    <link rel="stylesheet" href="{{ url('multiselect/css/style.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ url('images/favicon.png') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    {{-- font-awsome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- data tables --}}
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.css">
    <style>
        .chosen-container {
            width: 100% !important;
        }

        .chosen-container-multi .chosen-choices {
            padding: 0 !important;
        }

        .chosen-container-multi .chosen-choices li.search-field input[type="text"] {
            padding-left: 10px !important;
        }

        .horizontal-menu .bottom-navbar .page-navigation>.nav-item.active>.nav-link:after {
            border-bottom: none;
        }

        .btn-theme {
            background-color: #260950;
            /* Dark purple background */
            color: #fff;
            /* White text */
            border: 1px solid #fff;
            /* White border */
            transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
            /* Smooth transition on background color and text color */
        }

        .btn-theme:hover {
            background-color: #fff;
            color: #260950;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <div class="horizontal-menu">
            <nav class="top-navbar p-0 navbar col-lg-12 col-12">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-center navbar-menu-wrapper">
                        <ul class="navbar-nav">
                            {{-- <li class="d-lg-flex ms-0 me-5 nav-item d-none">
                                <a href="#" class="horizontal-nav-left-menu nav-link"><i
                                        class="mdi-format-list-bulleted mdi"></i></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="d-flex align-items-center justify-content-center nav-link count-indicator dropdown-toggle"
                                    id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                                    <i class="mx-0 mdi mdi-bell"></i>
                                    <span class="bg-success count">2</span>
                                </a> --}}
                            {{-- <div class="dropdown-menu-right preview-list dropdown-menu navbar-dropdown"
                                    aria-labelledby="notificationDropdown">
                                    <p class="float-left mb-0 font-weight-normal dropdown-header">Notifications</p>
                                    <a class="preview-item dropdown-item">
                                        <div class="preview-thumbnail">
                                            <div class="bg-success preview-icon">
                                                <i class="mx-0 mdi mdi-information"></i>
                                            </div>
                                        </div>
                                        <div class="preview-item-content">
                                            <h6 class="preview-subject font-weight-normal">Application Error</h6>
                                            <p class="mb-0 font-weight-light text-muted small-text">
                                                Just now
                                            </p>
                                        </div>
                                    </a>
                                    <a class="preview-item dropdown-item">
                                        <div class="preview-thumbnail">
                                            <div class="bg-warning preview-icon">
                                                <i class="mx-0 mdi mdi-settings"></i>
                                            </div>
                                        </div>
                                        <div class="preview-item-content">
                                            <h6 class="preview-subject font-weight-normal">Settings</h6>
                                            <p class="mb-0 font-weight-light text-muted small-text">
                                                Private message
                                            </p>
                                        </div>
                                    </a>
                                    <a class="preview-item dropdown-item">
                                        <div class="preview-thumbnail">
                                            <div class="bg-info preview-icon">
                                                <i class="mx-0 mdi mdi-account-box"></i>
                                            </div>
                                        </div>
                                        <div class="preview-item-content">
                                            <h6 class="preview-subject font-weight-normal">New user registration</h6>
                                            <p class="mb-0 font-weight-light text-muted small-text">
                                                2 days ago
                                            </p>
                                        </div>
                                    </a>
                                </div> --}}
                            {{-- </li> --}}
                            {{-- <li class="nav-item dropdown">
                                <a class="d-flex align-items-center justify-content-center nav-link count-indicator dropdown-toggle"
                                    id="messageDropdown" href="#" data-bs-toggle="dropdown">
                                    <i class="mx-0 mdi mdi-email"></i>
                                    <span class="bg-primary count">4</span>
                                </a>
                                <div class="dropdown-menu-right preview-list dropdown-menu navbar-dropdown"
                                    aria-labelledby="messageDropdown">
                                    <p class="float-left mb-0 font-weight-normal dropdown-header">Messages</p>
                                    <a class="preview-item dropdown-item">
                                        <div class="preview-thumbnail">
                                            <img src="images/faces/face4.jpg" alt="image" class="profile-pic">
                                        </div>
                                        <div class="flex-grow preview-item-content">
                                            <h6 class="preview-subject font-weight-normal ellipsis">David Grey
                                            </h6>
                                            <p class="mb-0 font-weight-light text-muted small-text">
                                                The meeting is cancelled
                                            </p>
                                        </div>
                                    </a>
                                    <a class="preview-item dropdown-item">
                                        <div class="preview-thumbnail">
                                            <img src="images/faces/face2.jpg" alt="image" class="profile-pic">
                                        </div>
                                        <div class="flex-grow preview-item-content">
                                            <h6 class="preview-subject font-weight-normal ellipsis">Tim Cook
                                            </h6>
                                            <p class="mb-0 font-weight-light text-muted small-text">
                                                New product launch
                                            </p>
                                        </div>
                                    </a>
                                    <a class="preview-item dropdown-item">
                                        <div class="preview-thumbnail">
                                            <img src="images/faces/face3.jpg" alt="image" class="profile-pic">
                                        </div>
                                        <div class="flex-grow preview-item-content">
                                            <h6 class="preview-subject font-weight-normal ellipsis"> Johnson
                                            </h6>
                                            <p class="mb-0 font-weight-light text-muted small-text">
                                                Upcoming board meeting
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link count-indicator"><i
                                        class="mdi mdi-message-reply-text"></i></a>
                            </li>
                            <li class="d-lg-block ms-3 nav-item nav-search d-none">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="search">
                                            <i class="mdi mdi-magnify"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="search"
                                        aria-label="search" aria-describedby="search">
                                </div>
                            </li> --}}
                        </ul>
                        <div class="d-flex align-items-center justify-content-center text-center navbar-brand-wrapper">
                            <a class="navbar-brand brand-logo" href="index.html"><img
                                    src="{{ url('images/wemis.png') }}" alt="logo" /></a>
                            <a class="navbar-brand brand-logo-mini" href="index.html"><img
                                    src="{{ url('images/wemis.png') }}" alt="logo" /></a>
                        </div>
                        <ul class="navbar-nav-right navbar-nav">
                            {{-- <li class="d-lg-flex nav-item dropdown d-none">
                                <button type="button" class="btn btn-inverse-primary btn-sm">Product </button>
                            </li>
                            <li class="d-lg-flex nav-item dropdown d-none">
                                <a class="show-dropdown-arrow dropdown-toggle btn btn-inverse-primary btn-sm"
                                    id="nreportDropdown" href="#" data-bs-toggle="dropdown">
                                    Reports
                                </a>
                                <div class="dropdown-menu-right preview-list dropdown-menu navbar-dropdown"
                                    aria-labelledby="nreportDropdown">
                                    <p class="float-left mb-0 font-weight-medium dropdown-header">Reports</p>
                                    <a class="dropdown-item">
                                        <i class="text-primary mdi mdi-file-pdf"></i>
                                        Pdf
                                    </a>
                                    <a class="dropdown-item">
                                        <i class="text-primary mdi mdi-file-excel"></i>
                                        Exel
                                    </a>
                                </div>
                            </li> --}}

                            <li class="nav-item nav-profile dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                    id="profileDropdown">
                                    <span class="nav-profile-name">{{ auth()->user()->name }}</span>
                                    <span class="online-status"></span>
                                    <img src="{{ url('images/faces/face1.jpg') }}" alt="profile" />
                                </a>
                                <div class="dropdown-menu-right dropdown-menu navbar-dropdown"
                                    aria-labelledby="profileDropdown">
                                    <a class="dropdown-item">
                                        <i class="text-primary mdi mdi-settings"></i>
                                        Settings
                                    </a>
                                    <a class="dropdown-item" href="javascript:void(0);"
                                        onclick="document.getElementById('logout').submit();"> <i
                                            class="me-2 text-primary mdi mdi-logout"></i> Signout </a></a>


                                    <form id="logout" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                        <button class="navbar-toggler-right align-self-center navbar-toggler d-lg-none" type="button"
                            data-toggle="horizontal-menu-toggle">
                            <span class="mdi mdi-menu"></span>
                        </button>
                    </div>
                </div>
            </nav>
            <nav class="bottom-navbar">
                <div class="container">
                    <ul class="nav page-navigation">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('super.dashboard') }}">
                                <i class="fas fa-tachometer-alt" style="font-size: 20px"></i>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">
                                <i class="fas fa-cogs" style="font-size: 20px"></i>
                                <span class="menu-title">Elements</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="submenu">
                                <ul>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="elementsDropdown"
                                            role="button" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Manage Element
                                        </a>
                                        <div class="p-2 dropdown-menu" aria-labelledby="elementsDropdown">
                                            <a class="dropdown-item" href="{{ route('elements') }}"> Element</a>
                                            <a class="dropdown-item" href="{{route('elements.types')}}"> Element Types</a>
                                            <a class="dropdown-item" href="{{route('modelNo')}}"> Model Numbers</a>
                                            <a class="dropdown-item" href="{{route('parts')}}"> Part Numbers</a>
                                            <a class="dropdown-item" href="{{route('tacs')}}"> TAC Numbers</a>
                                            <a class="dropdown-item" href="{{route('cop')}}"> COP Numbers</a>
                                            <a class="dropdown-item" href="{{route('testingagency')}}"> Testing Agency</a>
                                        </div>
                                    </li>

                                    {{-- <li class="nav-item"><a class="nav-link" href="">Component List</a></li> --}}
                                    <li class="nav-item"><a class="nav-link" href="{{route('assignElement.admin')}}">Assign Element</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link">
                                <i class="fas fa-users" style="font-size: 20px"></i>
                                <span class="menu-title">Onboard Admin</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="submenu">
                                <ul class="submenu-item">
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('create.admin') }}">Create Admin</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.list') }}">Admin
                                            List</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="footer-wrap">
                        <div class="d-sm-flex justify-content-sm-between justify-content-center">
                            <span class="d-block d-sm-inline-block text-muted text-sm-left text-center">Copyright © <a
                                    href="" target="_blank">Wemis
                                </a> 2025</span>
                            {{-- <span class="d-block float-sm-right float-none mt-1 mt-sm-0 text-center">Only the best <a
                                    href="https://www.bootstrapdash.com/" target="_blank"> Bootstrap dashboard </a>
                                templates</span> --}}
                        </div>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
    </div>

    <script>
        new DataTable('.dataTable', {
            pageLength: 10,
            language: {
                search: "Search:",
                lengthMenu: "Display _MENU_ records per page",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                paginate: {
                    next: "Next",

                    previous: "Previous"
                }
            },
        });
    </script>
    <!-- js-->
    <script src="{{ url('vendors/base/vendor.bundle.base.js') }}"></script>
    <script src="{{ url('js/template.js') }}"></script>
    <script src="{{ url('vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ url('vendors/progressbar.js/progressbar.min.js') }}"></script>
    <script src="{{ url('vendors/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js') }}"></script>
    <script src="{{ url('vendors/justgage/raphael-2.1.4.min.js') }}"></script>
    <script src="{{ url('vendors/justgage/justgage.js') }}"></script> 
    <script src="{{ url('js/jquery.cookie.js" type="text/javascript') }}"></script>

    <script src="{{ url('js/dashboard.js') }}"></script>
    <script src="{{ url('/multiselect/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ url('/multiselect/js/popper.min.js') }}"></script>
    <script src="{{ url('/multiselect/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('/multiselect/js/chosen.jquery.min.js') }}"></script>
    <script src="{{ url('/multiselect/js/main.js') }}"></script>
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 4000); // 4 seconds
    </script>
    <!-- End  js -->
</body>

</html>
