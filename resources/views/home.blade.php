@extends('layouts.app')

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
    <div class="col-lg-3">
        <div class="card">
            <img class="card-img-top" src="{{ asset('img/document-tracking.jpg') }}" alt="Card image cap">
            <div class="card-header">
                <h4 class="card-title m-0">OPTIMA <a href="{{ route('doctracker.dashboard') }}" class="btn btn-sm btn-info"><i class="icon-login"></i> Open</a></h4>
            </div>
            <div class="card-body">
                <p class="card-text">Optical Tracking Information Management System</p>
            </div>
        </div>
    </div>
    
    @hasrole('System Administrator')
        <div class="col-lg-3">
            <div class="card">
                <img class="card-img-top" src="{{ asset('img/morale-survey.jpg') }}" alt="Card image cap">
                <div class="card-body">
                    <h4 class="card-title">Morale Survey <a href="{{ route('moralesurvey.dashboard') }}" class="btn btn-sm btn-info"><i class="icon-login"></i> Open</a></h4>
                    <p class="card-text">Rate office performance.</p>
                </div>
            </div>
        </div>
    @endhasrole

</div>
@endsection

@section('scripts')
@endsection