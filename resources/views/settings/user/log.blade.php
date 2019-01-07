@extends('layouts.app')

@section('title')
 | User Activity Log
@endsection

@section('styles')
@endsection

@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-12">
        <h4 class="text-white">User Activity Log</h4>
    </div>
    <div class="col-md-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('all.setting.index') }}">Settings</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user.setting.index') }}">Profile Setting</a></li>
            <li class="breadcrumb-item active">Logs</li>
        </ol>
    </div>
    <!-- <div class="col-md-6 text-right">
        <form class="app-search d-none d-md-block d-lg-block">
            <input type="text" class="form-control" placeholder="Search &amp; enter">
        </form>
    </div> -->
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