@extends('layouts.home.app')

@section('title')
Account
@endsection

@section('styles')
<!-- This Page CSS -->
<link href="{{ asset('assets/node_modules/Magnific-Popup-master/dist/magnific-popup.css') }}" rel="stylesheet">
<link href="{{ asset('dist/css/pages/user-card.css') }}" rel="stylesheet">
@endsection

@section('setDefaultPhoto')
{{ asset($user->user_image) }}
@endsection

@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- <div class="row page-titles">
    <div class="col-md-12">
        <h4 class="text-white">Home</h4>
    </div>
    <div class="col-md-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>
</div> -->
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-md-3">
        <div class="card stickyside">
            <div class="card-body">
                <center class=""> 
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#changePhoto" data-toggle="tooltip" data-placement="bottom" title="Change photo">
                        <img src="{{ asset($user->user_image) }}" alt="user" class="img-circle" width="100" />
                    </a>

                    <h5 class="card-title m-t-20 m-b-0">{{ $user->fullName }}</h5> <small>&#64;{{ $user->username }}</small>
                    <address>
                        {{ $user->position }}<br>
                        <small>{{ $user->office->division_name }}</small>
                    </address>
                </center>
                <div class="row text-center">
                    <div class="col-md-12 col-sm-12">
                        <address>
                            {{ $user->mobile ? '<abbr title="Phone"><i class="icon-phone"></i></abbr>'.$user->mobile.'<br>' : '' }}<br>
                            <abbr title="Email"><i class="ti-email"></i></abbr> {{ $user->email }}<br>
                            {{ $user->address ? '<abbr title="Address"><i class="icon-location-pin"></i></abbr>'.$user->address : '' }}
                        </address>
                    </div>
                </div>
            </div>
            <div class="list-group" id="top-menu">
                <a href="{{ route('home') }}" class="list-group-item active"><i class="ti-home"></i>&nbsp;&nbsp;&nbsp;Home</a>
                <a href="{{ route('home') }}" class="list-group-item"><i class="icon-user"></i>&nbsp;&nbsp;&nbsp;Personal info</a>
            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body p-t-0 p-r-30 p-l-0">
                        <div class="row">
                            <div class="col-md-6">
                                <img class="card-img-top" src="{{ asset('img/optima.jpg') }}" alt="Card image cap">
                            </div>
                            <div class="col-md-6">
                                <h2 class="card-title m-t-40 m-b-0">OPTIMA</h2>
                                <h5 class="card-text">Optical Tracking Information Management System</h5>
                                <p class="m-t-30 card-text">Attach documents with an auto-generated barcode for easier tracking of the processed documents.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <a href="{{ route('optima.route-documents') }}" class="btn btn-secondary btn-block text-info font-bold text-left p-20">Open Application</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // This is for the sticky sidebar    
    $(".stickyside").stick_in_parent({
        offset_top: 50
    });


    // $('.stickyside a').click(function() {
    //     $('html, body').animate({
    //         scrollTop: $($(this).attr('href')).offset().top - 80
    //     }, 500);
    //     return false;
    // });
    // This is auto select left sidebar
    // Cache selectors
    // Cache selectors
    // var lastId,
    //     topMenu = $(".stickyside"),
    //     topMenuHeight = topMenu.outerHeight(),
    //     // All list items
    //     menuItems = topMenu.find("a"),
    //     // Anchors corresponding to menu items
    //     scrollItems = menuItems.map(function() {
    //         var item = $($(this).attr("href"));
    //         if (item.length) {
    //             return item;
    //         }
    //     });

    // Bind click handler to menu items


    // Bind to scroll
    // $(window).scroll(function() {
    //     // Get container scroll position
    //     var fromTop = $(this).scrollTop() + topMenuHeight - 250;

    //     // Get id of current scroll item
    //     var cur = scrollItems.map(function() {
    //         if ($(this).offset().top < fromTop)
    //             return this;
    //     });
    //     // Get the id of the current element
    //     cur = cur[cur.length - 1];
    //     var id = cur && cur.length ? cur[0].id : "";

    //     if (lastId !== id) {
    //         lastId = id;
    //         // Set/remove active class
    //         menuItems
    //             .removeClass("active")
    //             .filter("[href='#" + id + "']").addClass("active");
    //     }
    // });
    </script>
@endsection