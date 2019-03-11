@extends('layouts.home.app')

@section('title')
User Activity Log -
@endsection

@section('styles')
@endsection

@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor font-weight-bold"><a href="{{ URL::previous() }}"><i class="ti-arrow-circle-left"></i> Back</a></h3>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.setting.index') }}">Profile</a></li>
                <li class="breadcrumb-item active">Log</li>
            </ol>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Over Visitor, Our income , slaes different and  sales prediction -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-md-8">
        <div class="card ">
            <div class="card-body">
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <div class="card ">
            <div class="card-body">
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection