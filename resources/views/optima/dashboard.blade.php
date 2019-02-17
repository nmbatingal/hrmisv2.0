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
    <div class="col-md-12">
        <h4 class="text-white">OPTIMA</h4>
    </div>
    <div class="col-md-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('optima.index') }}">Home</a></li>
            <li class="breadcrumb-item active">OPTIMA</li>
        </ol>
    </div>
</div>
<div class="m-t-40"></div>
@endsection

@section('scripts')
@endsection