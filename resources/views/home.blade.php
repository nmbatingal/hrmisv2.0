@extends('layouts.home.app')

@section('styles')
<!-- This Page CSS -->
<link href="{{ asset('assets/node_modules/Magnific-Popup-master/dist/magnific-popup.css') }}" rel="stylesheet">
<link href="{{ asset('dist/css/pages/user-card.css') }}" rel="stylesheet">
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
<!-- ============================================================== -->
<!-- Over Visitor, Our income , slaes different and  sales prediction -->
<!-- ============================================================== -->
<div class="m-t-40"></div>

<div class="row el-element-overlay">
    <div class="col-lg-3 col-md-6 col-sm-4">
        <div class="card">
            <div class="el-card-item">
                <div class="el-card-avatar el-overlay-1"> 
                    <img class="card-img-top" src="{{ asset('img/optima.jpg') }}" alt="Card image cap">
                    <div class="el-overlay">
                        <ul class="el-info">
                            <li><a class="btn default btn-outline" href="{{ route('optima.route-documents') }}"><i class="icon-link"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="el-card-content">
                    <a href="{{ route('optima.route-documents') }}">
                        <h2 class="box-title m-b-0">O P T I M A</h2> 
                        <small>Optical Tracking of Information and Management System</small>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection