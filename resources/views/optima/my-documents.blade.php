@extends('layouts.optima.app')

@section('title')
My Documents
@endsection

@section('styles')
<link href="{{ asset('assets/node_modules/datatables/media/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
<style type="text/css">
    .btnOptionHover {
        opacity: 0.0;
    }

    .show-code:hover + .btnOptionHover, .btnOptionHover:hover {
        opacity: 1.0;
    }

    .btnOptionHover:hover > .btn {
        opacity: 0.1;
    }

    .btnOptionHover:hover > .btn:hover {
        opacity: 1.0;
    }
</style>
@endsection

@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles p-b-0 p-t-10">
    <div class="col-md-7 align-self-center">
        <div class="d-flex align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><h5 class="btn waves-effect waves-light btn-light"><a href="{{ route('optima.index') }}">Home</a></h5></li>
                <li class="breadcrumb-item active">
                    <div class="btn-group">
                        <h5 class="btn waves-effect waves-light btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="0,10">
                            <a href="#">My Documents &nbsp;&nbsp;</a></h5>
                        <div class="dropdown-menu" x-placement="bottom-start">
                          <a class="dropdown-item" href="{{ route('optima.my-documents.create') }}">Create new tracker</a>
                        </div>
                    </div>
                </li>
            </ol>
        </div>
    </div>
    <div class="col-md-5 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <a id="btnCreateNewTracker" href="{{ route('optima.my-documents.create') }}" class="btn btn-primary d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New Tracker</a>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->

<!-- MODAL TRACKER LOGS CONTENT -->
<div id="modalLogs" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalLogs" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-9">
                        <h4 class="modal-title font-bold" id="modalLogsTitle">Log Details</h4>
                        <h5 id="modalLogsDocuType">aaaa</h5>
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                </div>
                <div id="modalBodyLogs"></div>
            </div>
        </div>
    </div>
</div>
<!-- END ODAL TRACKER LOGS CONTENT -->

<div class="card-group">
    <!-- Column -->
    <div class="card">
        <div class="card-body text-center p-b-0">
            <h4 class="text-center">Documents Created</h4>
        </div>
        <div class="box b-t text-center p-t-0">
            <h3 class="font-medium m-b-0 text-success">
                <i class="icon-docs"></i> <span id="count-created">{{ $documentsCreated->count() }}</span>
            </h3>
        </div>
    </div>
    <!-- Column -->
    <div class="card">
        <div class="card-body text-center p-b-0">
            <h4 class="text-center">Documents Received</h4>
        </div>
        <div class="box b-t text-center p-t-0">
            <h3 class="font-medium m-b-0 text-info">
                <i class="ti-import"></i> <span id="count-receive">{{ $documentsReceived->count() }}</span>
            </h3>
        </div>
    </div>
    <!-- Column -->
    <div class="card">
        <div class="card-body text-center p-b-0">
            <h4 class="text-center">Documents Released</h4>
        </div>
        <div class="box b-t text-center p-t-0">
            <h3 class="font-medium m-b-0 text-primary">
                <i class="ti-export"></i> <span id="count-release">{{ $documentsReleased->count() }}</span>
            </h3>
        </div>
    </div>
</div>

<!-- Card table -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-light">
                <span class="align-middle">
                    <h4 class="m-b-0">
                        My Documents
                        <div class="btn-group float-right">
                            <button type="button" class="btn waves-effect waves-light btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-settings"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a id="drpdown-table-refresh" class="dropdown-item" href="javascript:void(0)">Refresh Table</a>
                                <div class="dropdown-divider"></div>
                                <a id="drpdown-export-log" class="dropdown-item" href="javascript:void(0)">Export Log</a>
                            </div>
                        </div>  
                    </h4>
                </span>
            </div>
            <div class="card-body p-b-0">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <form class="form-horizontal">
                                <div class="form-group m-b-0">
                                    <div class="input-group p-0">
                                        <input id="searchTracker" type="text" class="form-control" placeholder="Search tracking code">
                                        <div class="input-group-append">
                                            <button class="btn btn-info" type="submit">
                                                <i class="ti-search"></i>&nbsp;</button>
                                        </div>
                                    </div>
                                    <small class="form-control-feedback text-muted">&nbsp;</small> 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-t-0">
                <div class="table-responsive">
                    <table id="tableMyDocuments" class="table table-hover table-bordered table-striped">
                        <colgroup>
                            <col width="">
                            <col width="15%">
                            <col width="25%">
                            <col width="15%">
                            <col width="15%">
                            <col width="30%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th></th>
                                <th>Tracking Code</th>
                                <th>Subject</th>
                                <th>Document type</th>
                                <th>Status</th>
                                <th>Note</th>
                            </tr>
                        </thead>
                        <tbody class="table-sm">
                            @forelse( $myDocuments as $document )
                                <tr id="row-{{$document->id}}">
                                    <td class="text-right"></td>
                                    <td class="text-center">
                                        <h4 class="m-b-0 show-code">
                                            <a id="{{ $document->tracking_code }}" href="javascript:void(0)" class="show-code">{{ $document->tracking_code }}</a>
                                        </h4>
                                        <div class="btnOptionHover p-t-20">
                                            <a href="{{ route('optima.my-documents.edit',$document->id) }}" class="btn btn-sm btn-info btnOption" data-toggle="tooltip" data-placement="top" title="Edit"><i class="icon-note"></i></a>
                                            @foreach ( $document->trackLogs as $log )
                                                @if ( $log->user_id == auth()->user()->id )
                                                    <a href="" class="btn btn-sm btn-danger btnOption" data-toggle="tooltip" data-placement="top" title="Cancel Routing"><i class="icon-close"></i></a>
                                                    <a href="" class="btn btn-sm btn-success btnOption" data-toggle="tooltip" data-placement="top" title="Routing Complete"><i class="icon-check"></i></a>
                                                @endif
                                                @break
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>
                                        <h5 class="font-weight-bold">
                                            {{ $document->subject }}
                                            <br><small>{{ $document->tracking_date }}</small>
                                        </h5>
                                        @foreach ( explode(',', $document->keywords) as $keyword ) 
                                            <span class="badge badge-info">{{ $keyword }}</span>&nbsp;
                                        @endforeach

                                        @foreach ( $document->documentKeywords as $keyword )
                                            <span class="badge badge-info">{{ $keyword->keywords }}</span>&nbsp;
                                        @endforeach
                                    </td>
                                    <td>
                                        {{ $document->other_document }}
                                    </td>
                                    <td>
                                        @foreach ( $document->trackLogs as $log )
                                            <h5 class="font-weight-bold">
                                                {{ $log->action }}
                                                <br><small>{{ $log->date_action }}</small>
                                            </h5>
                                            @if ( $log->action == "Forward" )
                                                @if ( !is_null($log->recipients) )
                                                    @foreach ( $log->recipients as $recipient )
                                                        <li>{{ $recipient['name'] }}</li>
                                                    @endforeach
                                                @else
                                                    <li>All</li>
                                                @endif
                                            @else
                                                <strong>{{ $log->userEmployee->full_name }}</strong>
                                            @endif
                                            @break;
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ( $document->trackLogs as $log )
                                            {!! $log->forSignature ? 'For signature.&nbsp;' : '' !!}
                                            {!! $log->forCompliance ? 'For Compliance.&nbsp;' : '' !!}
                                            {!! $log->forInformation ? 'For Information.&nbsp;' : '' !!}
                                            {{ $log->notes ?: '' }}
                                            @break;
                                        @endforeach
                                    </td>
                                    <!-- <td>
                                        <button type="button" class="btn btn-danger btn-sm btnCancelEvent" data-id="{{ $document->id }}" title="Cancel"><i class="ti-close"></i></button>
                                    </td> -->
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
<!-- Footable -->
<script src="{{ asset('assets/node_modules/moment/moment.js') }}"></script>
<!-- This is data table -->
<script src="{{ asset('assets/node_modules/datatables/datatables.min.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script>
    $(document).ready(function() { 
        // DataTable for Tracker
        var trackerTable = $('#tableMyDocuments').DataTable({
            columnDefs: [{ 
                orderable: true
            }],
            columnDefs: [ {
                searchable: false,
                orderable: false,
                targets: 0
            } ],
            order: [
                [1, 'desc']
            ],
            dom: '<"top"l<"float-right"i>>rt<"bottom"p><"clear">'
        });

        trackerTable.on( 'order.dt search.dt', function () {
            trackerTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();

        $('#drpdown-table-refresh').on('click', function () {
            trackerTable.draw();
        });

        // Custom Input Search for Table
        $('#searchTracker').keyup(function(){
            trackerTable.search($(this).val()).draw() ;
        })

        $("#tableMyDocuments").on("click", ".show-code", function() {
            var tracking_code = $(this).attr("id"),
                url = "{{ route('optima.route-documents.search') }}";

            $.ajax({
                method : 'GET',
                url    : url,
                data   : {code: tracking_code},
                success: function(data) {
                    $('#modalBodyLogs').html(data.html);
                    $('#modalLogs').find('#modalLogsTitle').html(data.title + ' <span class="badge badge-info">' + data.docutype + '</span>');
                    $('#modalLogs').find('#modalLogsDocuType').html(data.subject);
                    $('#modalLogs').modal('show');
                },
                error  : function(xhr, err) {
                    Swal.fire({
                        title: "Error!",
                        text:  "Could not retrieve the data.",
                        type: "error"
                    })
                }
            });
        });
    });
</script>
<script>
    $(document).on("click", ".btnCancelEvent", function () {
        var btn = $(this),
            id  = btn.data("id"),
            token  = $('input[name=_token]').val(),
            $url = "{{ route('optima.my-documents.destroy', '') }}" + "/" + id;

        Swal.fire({
            title: "Are you sure?",
            text: "You will not be able to undo this action!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!"
        }).then((data) => {

            if (data.value) {
                $.ajax({
                    url: $url,
                    type: 'POST',
                    data: {
                        "id": id,
                        "_method": 'DELETE',
                        "_token": token,
                    },
                    success: function (data) {

                        var $row = 'tr#row-' + data.id;
                        // decrement tracker cards
                        var total = 1;
                        total -= +$('#count-outgoing').text();
                        $('#count-outgoing').text(total);


                        $($row).remove();
                        $('#documentTableOutgoing').trigger('footable_initialize');

                        Swal.fire(
                          'Deleted!',
                          'Action successfully deleted.',
                          'success'
                        );
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        Swal.fire("Error deleting!", "Please try again", "error");
                    }
                });
            }
        }); 
    });
</script>
@endsection