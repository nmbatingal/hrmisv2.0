@extends('layouts.app')

@section('styles')
<link href="{{ asset('assets/node_modules/datatables/media/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endsection

@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-12">
        <h4 class="text-white">Morale Survey Question</h4>
    </div>
    <div class="col-md-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('moralesurvey.dashboard') }}">Morale Survey</a></li>
            <li class="breadcrumb-item"><a href="#">Survey Setting</a></li>
            <li class="breadcrumb-item active">Survey Question</li>
        </ol>
    </div>
</div>
<div class="m-t-40"></div>
<div class="row">
    <!-- Column -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Morale Survey Question
                    <button class="btn btn-rounded btn-primary float-right" id="btn-create">Add new question</button>
                </h4>
                <h6 class="card-subtitle">Just click on word which you want to change and enter</h6>
                <div class="m-t-40"></div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="5%"></th>
                                <th>Question</th>
                                <th width="15%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse( $questions as $question)
                                <tr id="{{ $question->id }}">
                                    <td></td>
                                    <td>{{ $question->question }}</td>
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
    <div id="modal-question" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalQuestion" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalQuestion">Add New Question</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div id="modal-body-question" class="modal-body">
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
<script>
    $(document).ready(function() { 
        $('#myTable').DataTable({
            dom: 'Bfrtip',
            "columnDefs": [ {
                "searchable": false,
                "orderable": false,
                "targets": [0,2]
            } ],
            "lengthChange": false,
            "searching": false,
            "bPaginate": false
        });

        $('#btn-create').on('click', function(e) {

            $('#modal-body-question').load( '{{ route('question.create') }}' , function(){
                $('#modal-question').modal({show:true});
            });

        });
    });
</script>
@endsection