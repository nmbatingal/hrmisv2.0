@extends('layouts.app')

@section('styles')
<!-- Editable CSS -->
<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
<style type="text/css">
    .modal-wide {
        max-width: 1100px;
    }
</style>
@endsection

@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-12">
        <h4 class="text-white">Semestral Survey</h4>
    </div>
    <div class="col-md-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('moralesurvey.dashboard') }}">Morale Survey</a></li>
            <li class="breadcrumb-item active">Semestral Survey</li>
        </ol>
    </div>
</div>
<div class="m-t-40"></div>
<div class="row">
    <!-- Column -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Semestral Survey</h4>
                <h6 class="card-subtitle">Just click on word which you want to change and enter</h6>
                <div class="m-t-40"></div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="10%"></th>
                                <th>Semester</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse( $semesters as $sem)
                                <tr>
                                    <td class="text-center">
                                        <button type="button" class="btn waves-effect waves-light btn-outline-success">Rate now</button>
                                    </td>
                                    <td>
                                        <a class="modal-view text-mute" href="javascript:void(0)">
                                            {!! $sem->status ? '' : '<i class="fas fa-lock text-danger"></i>'!!}
                                            {{ $sem->semester }}
                                        </a>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- This is data table -->
<script src="{{ asset('assets/node_modules/datatables/datatables.min.js') }}"></script>
@endsection