@extends('layouts.app')

@section('title')
-OPTIMA | About
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
            <li class="breadcrumb-item"><a href="{{ route('doctracker.dashboard') }}">OPTIMA</a></li>
            <li class="breadcrumb-item active">About</li>
        </ol>
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
                                <img class="card-img-top" src="{{ asset('img/document-tracking.jpg') }}" alt="Card image cap">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="card-title">OPTIMA</h2>
                                <h5 class="card-text">Optical Tracking Information Management System</h5>
                                <p class="m-t-30 card-text">OPTIMA or Optical Tracking Information Management System is a web-based application that stores and manages transmitted documents attached with an auto-generated barcode for easier tracking of the processed documents.</p>
                                <a href="{{ asset('storage/manuals/optima.pdf') }}" class="btn btn-info" target="_blank"><i class="mdi mdi-file-document"></i> Download user manual</a>
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