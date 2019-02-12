@extends('layouts.home.app')

@section('styles')
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

<div class="row">
    <!-- Column -->
    <div class="offset-md-2 col-md-8">
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
                                <h5 class="card-text">Optical Tracking Information Management System</h5>
                                <p class="m-t-30 card-text">OPTIMA or Optical Tracking Information Management System is a web-based application that stores and manages transmitted documents attached with an auto-generated barcode for easier tracking of the processed documents.</p>
                                <a href="{{ route('optima.dashboard') }}" class="btn btn-info"><i class="icon-login"></i> Open Application</a>
                                <a href="{{ asset('storage/manuals/optima.pdf') }}" class="btn btn-link" target="_blank">Download user manual</a>
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