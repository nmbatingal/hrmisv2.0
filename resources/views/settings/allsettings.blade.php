@extends('layouts.app')

@section('title')
| Settings
@endsection

@section('styles')
@endsection

@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-12">
        <h4 class="text-white">Settings</h4>
    </div>
    <div class="col-md-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item active">Settings</li>
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
<div class="m-t-40"></div>

<div class="row">
    <!-- Column -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">User Roles</h4>
                <p class="card-text">Assign </p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Column -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Account Permissions</h4>
                <p class="card-text">Add tracking codes to your documents.</p>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
@endsection