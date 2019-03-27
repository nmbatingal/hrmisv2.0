<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
    <title>MyApp @yield('title')</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!--alerts CSS -->
    <link href="{{ asset('assets/node_modules/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css">
    <!-- toast CSS -->
    <link href="{{ asset('assets/node_modules/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('homedist/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('homedist/css/pages/progressbar-page.css') }}" rel="stylesheet">
    <link  href="{{ asset('js/node_modules/cropperjs/dist/cropper.css') }}" rel="stylesheet">
    @yield('styles')
    <style>
        .page-titles {
            background: none;
        }

        .topbar .top-navbar .navbar-header {
            background: rgba(0, 0, 0, 0);
        }

        .right-sidebar {
            top: 67px;
            z-index: 0;
        }

        .right-sidebar .rpanel-title{color: #000000;font-size:14px;background:#f8f9fa;margin:0;padding:12px 20px;text-transform:uppercase;font-weight:500;}.right-sidebar .r-panel-body{padding:20px}.right-sidebar .r-panel-body ul{margin:10px 0;padding:0px}.right-sidebar .r-panel-body ul li{list-style:none;padding:5px 0;border:0}.right-sidebar .r-panel-body .daydrop{border:0;background:0 0;padding:0;font-size:12px;font-weight:500;text-transform:uppercase}

        #my-image {
            max-width: 100%; /* This rule is very important, please do not ignore this! */
        }
    </style>
</head>
<body class="skin-default fixed-layout">
    <div id="app">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="loader">
                <div class="loader__figure"></div>
                <p class="loader__label">MyApp</p>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper">
            <!-- RELEASE MODAL -->
            <div id="changePhoto" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header p-b-0">
                            <h4 class="modal-title" id="vcenter">
                                Select Profile Photo
                                <br><br>
                                <div class="btn-group">
                                    <label class="btn btn-secondary btn-outline btn-upload" for="inputImage" title="Upload image file">
                                        <input type="file" class="sr-only" id="inputImage" name="file" accept="image/*">
                                        <input type="hidden" id="userId" name="userId" value="{{ $user->id }}">
                                        <span class="docs-tooltip" data-toggle="tooltip" title="Import image"><i class="fas fa-image"></i>&nbsp;&nbsp;&nbsp;Select a photo from your computer</span>
                                    </label>
                                </div>
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <center id="imgCanvass">
                                            <!-- <img id="my-image" src="@yield('setDefaultPhoto')" height="200" /> -->
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <form id="savePhotoForm" action="{{ route( 'myaccount.store.photo', $user->id ) }}" method="POST" enctype="multipart/form-data" style="display: none;">
                                @csrf
                                <input type="text" name="userId" value="{{ $user->id }}">
                            </form>
                            <button type="button" id="setProfilePhoto" class="btn btn-info waves-effect" disabled="">Set as profile photo</button>
                            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END RELEASE MODAL -->
            <!-- ============================================================== -->
            <!-- Topbar header - style you can find in pages.scss -->
            <!-- ============================================================== -->
            @include('layouts.home.topbar')
            <!-- ============================================================== -->
            <!-- End Topbar header -->
            <!-- ============================================================== -->
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
    <script src="{{ asset('assets/node_modules/jquery/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('assets/node_modules/popper/popper.min.js') }}"></script>
    <script src="{{ asset('assets/node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('homedist/js/perfect-scrollbar.jquery.min.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('homedist/js/waves.js') }}"></script>
    <!--stickey kit -->
    <script src="{{ asset('assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
    <script src="{{ asset('assets/node_modules/sparkline/jquery.sparkline.min.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('homedist/js/sidebarmenu.js') }}"></script>
    <!-- Sweet-Alert  -->
    <script src="{{ asset('assets/node_modules/sweetalert/sweetalert.min.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('homedist/js/custom.min.js') }}"></script>
    <script src="{{ asset('assets/node_modules/toast-master/js/jquery.toast.js') }}"></script>
    <script src="{{ asset('js/node_modules/cropperjs/dist/cropper.js') }}"></script>
    <script src="{{ asset('js/home/cropper.init.js') }}"></script>
    <script>
        // var $image            = document.getElementById('my-image'),
        //     URL               = window.URL || window.webkitURL,
        //     // originalImageURL  = $image.attr('src'),
        //     uploadedImageName = 'img/blank.png',
        //     uploadedImageType = 'image/jpeg',
        //     uploadedImageURL;

        // var cropper = new Cropper($image, {
        //     aspectRatio: 1 / 1,
        //     minContainerWidth: 600,
        //     minContainerHeight: 400,
        //     movable: false,
        //     zoomable: false,
        //     rotatable: false,
        //     scalable: false
        // });
    </script>
    @yield('scripts')
</body>
</html>
