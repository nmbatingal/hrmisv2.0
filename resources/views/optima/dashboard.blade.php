@extends('layouts.optima.app')

@section('title')
Dashboard
@endsection

@section('styles')
@endsection

@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor font-weight-bold">Dashboard</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
	            <!-- <li class="breadcrumb-item"><a href="{{ route('optima.index') }}">Home</a></li>
	            <li class="breadcrumb-item active">Dashboard</li> -->
	        </ol>
            <a id="btnCreateNewTracker" href="{{ route('optima.my-documents.create') }}" class="btn btn-primary d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New Tracker</a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection