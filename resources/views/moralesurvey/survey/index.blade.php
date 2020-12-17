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
        <h4 class="text-white">Survey</h4>
    </div>
    <div class="col-md-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('moralesurvey.dashboard') }}">Morale Survey</a></li>
            <li class="breadcrumb-item active">Survey</li>
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
                <h6 class="card-subtitle">Click on a semester to rate.</h6>
                <div class="m-t-40"></div>
                <div class="table-responsive">
                    <table id="surveyTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="5%"></th>
                                <th>Semester</th>
                                <th width="10%">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse( $semesters as $id => $sem)
                                <tr id="{{ $sem->id }}">
                                    <td class="text-center">{{ ++$id }}</td>
                                    <td>
                                        <a class="modal-view text-mute" href="javascript:void(0)">
                                            {!! $sem->status ? '' : '<i class="fas fa-lock text-danger"></i>'!!}
                                            {{ $sem->semester }}
                                        </a>
                                    </td>
                                    <td>
                                        @if ( !is_null($user->moraleSurveys) )
                                            <a href="#" class="btn waves-effect waves-light btn-success">Done Survey</a>
                                        @else
                                            <a href="{{ route('survey.takesurvey', $sem->uuid) }}" class="btn waves-effect waves-light btn-info">Survey Now</a>
                                        @endif
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
<script>
    $('#surveyTable').DataTable({
        "columnDefs": [
            { "orderable": false, "targets": [0,1] }
        ],
        "lengthChange": false,
        "searching": false,
        "bPaginate": false
    });
</script>
@endsection