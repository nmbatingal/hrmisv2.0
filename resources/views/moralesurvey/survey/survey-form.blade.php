@extends('layouts.app')

@section('styles')
@endsection

@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-12">
        <h4 class="text-white">Morale Survey</h4>
    </div>
    <div class="col-md-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Morale Survey</li>
        </ol>
    </div>
</div>
<div class="m-t-40"></div>
<div class="row">
    <!-- Column -->
    <div class="col-lg-12">
        <div class="text-center">
            <img src="{{ asset('img/site_construction.png') }}" alt="user">
            <h4 class="font-weight-bold p-t-40">This page is under development.</h4>
            <h5 class="">Come back some time here.</h5>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection