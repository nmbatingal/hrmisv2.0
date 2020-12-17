<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/optima-favicon.png') }}">
    <title>@yield('title') - OPTIMA</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!--alerts CSS -->
    <link href="{{ asset('js/jquery-ui-1.12.1.custom/jquery-ui.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('js/node_modules/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
    <!-- toast CSS -->
    <link href="{{ asset('assets/node_modules/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/pages/progressbar-page.css') }}" rel="stylesheet">
    <!-- page css -->
    <link href="{{ asset('dist/css/pages/other-pages.css') }}" rel="stylesheet">
    @yield('styles')
    <style>
        /*.topbar .top-navbar .navbar-header {
            background: rgba(0, 0, 0, 0);
        }*/

        @media (min-width: 768px) {
            .user-profile .user-pro-body img {
                width: 50px;
            }
            .mini-sidebar .user-profile .user-pro-body img {
                width: 50px;
            }
        }

        @media (min-width: 1200px) {
            .user-profile .user-pro-body img {
                width: 100px;
            }
        }

        .app-search .form-control:focus {
            width: 500px;
        }

        .footer {
            /*position: absolute;*/
            bottom: 0;
            color: #212529;
            left: 0px;
            padding: 17px 15px;
            right: 0;
            border-top: none;
            background: none;
        }
    </style>
</head>
<body class="fixed-layout skin-default">
    <div id="app">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="loader">
                <div class="loader__figure"></div>
                <p class="loader__label">OPTIMA</p>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper">
            <!-- ============================================================== -->
            <!-- Topbar header - style you can find in pages.scss -->
            <!-- ============================================================== -->
            @include('layouts.optima.topbar')
            <!-- ============================================================== -->
            <!-- End Topbar header -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Left Sidebar - style you can find in sidebar.scss  -->
            <!-- ============================================================== -->
            @auth
                @include('layouts.optima.sidepanel')
            @endauth
            <!-- ============================================================== -->
            <!-- End Left Sidebar - style you can find in sidebar.scss  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Page wrapper  -->
            <!-- ============================================================== -->
            <div class="page-wrapper">
                <!-- ============================================================== -->
                <!-- Container fluid  -->
                <!-- ============================================================== -->
                <div class="container-fluid">
                    @yield('content')
                    <!-- ============================================================== -->
                    <!-- Right sidebar -->
                    <!-- ============================================================== -->
                    <!-- .right-sidebar -->
                    @auth
                        @include('layouts.optima.rightsidebar')
                    @endauth
                    <!-- ============================================================== -->
                    <!-- End Right sidebar -->
                    <!-- ============================================================== -->
                </div>
                <!-- ============================================================== -->
                <!-- End Container fluid  -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Page wrapper  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer">
                © {{ date("Y") }} DOST Caraga MyApp by <a href="http://caraga.dost.gov.ph/" target="_blank">DOST Caraga</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Wrapper -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <!-- <script src="{{ asset('assets/node_modules/jquery/jquery-3.2.1.min.js') }}"></script> -->
    <script src="{{ asset('js/node_modules/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}" type="text/javascript"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('assets/node_modules/popper/popper.min.js') }}"></script>
    <script src="{{ asset('assets/node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('dist_material/js/perfect-scrollbar.jquery.min.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('dist_material/js/waves.js') }}"></script>
    <!--stickey kit -->
    <script src="{{ asset('assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
    <script src="{{ asset('assets/node_modules/sparkline/jquery.sparkline.min.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('dist_material/js/sidebarmenu.js') }}"></script>
    <!-- Sweet-Alert  -->
    <script src="{{ asset('js/node_modules/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('dist_material/js/custom.min.js') }}"></script>
    <script src="{{ asset('assets/node_modules/toast-master/js/jquery.toast.js') }}"></script>
    @yield('scripts')
</body>
</html>
