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
            <li class="breadcrumb-item"><a href="#">Survey Setting</a></li>
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
                <h4 class="card-title">Semestral Survey
                    <button class="btn btn-rounded btn-primary float-right" id="btn-create">Add new semester</button>
                </h4>
                <h6 class="card-subtitle">Just click on word which you want to change and enter</h6>
                <div class="m-t-40"></div>
                <div class="table-responsive">
                    <table id="semTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="5%"></th>
                                <th>Semester</th>
                                <th width="5%">Ratee</th>
                                <th width="10%">Status</th>
                                <th width="10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse( $semesters as $id => $sem)
                                <tr data-id="{{ $sem->id }}">
                                    <td class="text-right">{{ ++$id }}</td>
                                    <td>
                                        <a class="modal-view text-mute" href="javascript:void(0)">
                                            {!! $sem->status ? '' : '<i class="fas fa-lock text-danger"></i>'!!}
                                            {{ $sem->semester }}
                                        </a> (hash: {{ $sem->uuid }})
                                    </td>
                                    <td class="text-center"></td>
                                    <td class="text-center">
                                        @if ( $sem->status )
                                            <button type="button" class="btn waves-effect waves-light btn-outline-success">Open</button>
                                        @else
                                            <button type="button" class="btn waves-effect waves-light btn-outline-danger">Close</button>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" title="update" class="btn btn-info btn-outline btn-sm"><i class="ti-pencil"></i></a>
                                        <a href="javascript:void(0)" title="delete" class="btn btn-secondary btn-danger btn-sm"><i class="ti-trash"></i></a>
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

    <!-- MODAL -->
    <!-- sample modal content -->
    <div id="modal-semester" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalSemester" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-wide">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalSemester">Add New Semester</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div id="modal-body-semester" class="modal-body">
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- sample modal content -->
    <div id="modalView" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalview" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-wide">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalview">Semester</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->



</div>
@endsection

@section('scripts')
<!-- This is data table -->
<script src="{{ asset('assets/node_modules/datatables/datatables.min.js') }}"></script>
<!-- Editable -->
<script src="{{ asset('assets/node_modules/jsgrid/db.js') }}"></script>
<script>

    $('#semTable').DataTable({
        "columnDefs": [
            { "orderable": false, "targets": [0,2,4] }
        ],
        "lengthChange": true,
        "searching": true,
        "bPaginate": true
    });

    $('.modal-view').on('click', function(e) {
        var id = $(this).closest('tr').data('id');
        $('.modal-body').load( '{{ route('semester.show', '') }}/'+id , function(){
            $('#modalView').modal({show:true});
        });
    });

    $('#btn-create').on('click', function(e) {
        $('#modal-body-semester').load( '{{ route('semester.create') }}' , function(){
            $('#modal-semester').modal({show:true});
        });
    });
</script>
@endsection