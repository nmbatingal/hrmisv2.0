@extends('layouts.app')

@section('title')
-OPTIMA | Dashboard
@endsection

@section('styles')
@endsection

@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-12">
        <h4 class="text-white">OPTIMA</h4>
    </div>
    <div class="col-md-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">OPTIMA</li>
        </ol>
    </div>
    <div class="col-md-6 text-right">
        <a href="{{ route('doctracker.about') }}" class="btn btn-circle btn-info float-right" title="Help"><i class="mdi mdi-help"></i></a>
    </div>
</div>
<div class="m-t-40"></div>
<div class="row">
    <!-- Column -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <img class="card-img-top" src="{{ asset('img/optima.jpg') }}" alt="Card image cap">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="card-title">OPTIMA</h2>
                                <p class="card-text">Optical Tracking Information Management System</p>
                                <a href="#" class="btn btn-info"><i class="ti-help-alt"></i> About the app</a>
                            </div>
                        </div>    
                    </div>

                </div>
            </div>
        </div>    
    </div>
</div>
@endsection

@section('scripts')
@endsection