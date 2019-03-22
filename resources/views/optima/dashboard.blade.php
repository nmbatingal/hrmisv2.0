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
<div class="row page-titles p-b-0 p-t-10">
    <div class="col-md-7 align-self-center">
        <div class="d-flex align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <div class="btn-group">
                        <h5 class="btn waves-effect waves-light btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="0,10">
                            <a href="#">Dashboard &nbsp;&nbsp;</a></h5>
                        <div class="dropdown-menu" x-placement="bottom-start">
                            <a class="dropdown-item" href="{{ route('optima.my-documents.create') }}">Create new tracker</a>
                        </div>
                    </div>
                </li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection