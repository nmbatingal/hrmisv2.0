@extends('layouts.optima.app')

@section('title')
Route Documents
@endsection

@section('styles')
<link href="{{ asset('assets/node_modules/datatables/media/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
<link href="{{ asset('assets/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<style type="text/css">
    #tableRoutedDocument tbody td:nth-child(1) {  
        vertical-align: top;
    }

    .btn-hidden {
        display: none;
    }
</style>
@endsection

@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Route Documents</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('optima.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Route Documents</li>
            </ol>
            <a id="btnCreateNewTracker" href="{{ route('optima.my-documents.create') }}" class="btn btn-rounded btn-primary d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New Tracker</a>
        </div>
    </div>
</div>

<!-- MODALS -->
<div>
    <!-- RECEIVE MODAL -->
    <div id="receiveModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="vcenter">Receive Document</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- FORM TO RECEIVE AND SUBMIT INCOMING DOCUMENTS WITH TRACKING CODE  -->
                                <form id="submitReceive" class="form-horizontal" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group row">
                                        <div class="col-md-12 p-0">
                                            <div class="input-group">
                                                <input id="codeInputReceive" type="text" class="form-control" name="code" onClick="this.setSelectionRange(0, this.value.length)" placeholder="Enter tracking code here" required autofocus>
                                                <div class="input-group-append">
                                                    <button class="btn btn-success" type="submit">Receive</button>
                                                </div>
                                            </div>
                                            <small class="form-control-feedback text-muted">&nbsp;</small> 
                                        </div>
                                    </div>
                                    <div id="submitReceiveSpinner" class="text-center" style="display: none;">
                                        <div class="spinner-border" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                    <div id="submitReceiveAlert" class="alert" style="display: none;"></div>
                                </form>
                                <!-- END OF FORM TO RECEIVE AND SUBMIT INCOMING DOCUMENTS WITH TRACKING CODE  -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END RECEIVE MODAL -->

    <!-- RELEASE MODAL -->
    <div id="releaseModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="vcenter">Release Document</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- FORM TO RECEIVE AND SUBMIT INCOMING DOCUMENTS WITH TRACKING CODE  -->
                                <form id="submitRelease" class="form-horizontal" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group row">
                                        <div class="col-md-12 p-0">
                                            <div class="input-group">
                                                <input id="codeInputRelease" type="text" class="form-control" name="code" onClick="this.setSelectionRange(0, this.value.length)" placeholder="Enter tracking code here" required autofocus>
                                                <div class="input-group-append">
                                                    <button class="btn btn-success" type="submit">Release</button>
                                                </div>
                                            </div>
                                            <small class="form-control-feedback text-muted">&nbsp;</small> 
                                        </div>
                                    </div>
                                    <div id="submitReleaseSpinner" class="text-center" style="display: none;">
                                        <div class="spinner-border" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                    <div id="submitReleaseAlert" class="alert" style="display: none;"></div>
                                </form>
                                <!-- END OF FORM TO RECEIVE AND SUBMIT INCOMING DOCUMENTS WITH TRACKING CODE  -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END RELEASE MODAL -->

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

    <!-- MODAL TRACKER REMARKS CONTENT -->
    <div id="modalRemarks" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalLogs" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- <div class="modal-header">
                    <h4 class="modal-title" id="modalRemarksTitle">Remarks</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div> -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-9">
                            <h4 class="modal-title font-weight-bold" id="modalRemarksTitle">Notes</h4>
                            <span id="modalRemarksDocuType"></span>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                    </div>
                    <div id="modalBodyRemarks"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL TRACKER LOGS CONTENT -->
</div>
<!-- MODALS -->

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

<div class="row">
    <div class="col-md-12">
        <div class="card m-b-0">
            <div class="card-header bg-dark">
                <h4 class="m-b-0 text-white">
                    Receive and Release Document
                    <div class="btn-group float-right">
                        <button type="button" class="btn waves-effect waves-light btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icon-settings"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a id="drpdown-export-log" class="dropdown-item" href="javascript:void(0)">Export Log</a>
                        </div>
                    </div>  
                </h4>
            </div>
            <div class="card-body p-b-10">
                <div class="row">
                    <div class="col-md-12">
                        <button id="btnReceive" class="btn waves-effect waves-light btn-primary" data-toggle="tooltip" data-placement="bottom" title="Receive Document (alt + 3)">
                            <span data-toggle="modal" data-target="#receiveModal">Receive Document</span>
                        </button>
                        <button id="btnRelease" class="btn waves-effect waves-light btn-primary" data-toggle="tooltip" data-placement="bottom" title="Release Document (alt + 4)">
                            <span data-toggle="modal" data-target="#releaseModal">Release Document</span>
                        </button>

                        <!-- SEARCH TOGGLE -->
                        <a class="get-code float-right" data-toggle="collapse" href="#tt1" aria-expanded="true"><i class="ti-search" title="Get Code" data-toggle="tooltip"></i> Search Tracker</a>
                        <!-- END SEARCH TOGGLE -->
                    </div>
                </div>
                <div class="collapse m-t-15" id="tt1" aria-expanded="true">
                    <form class="form-horizontal">
                        <div class="form-group m-b-0">
                            <div class="input-group p-0">
                                <input id="searchTracker" type="text" class="form-control" placeholder="Search document tracker">
                                <div class="input-group-append">
                                    <button class="btn btn-info" type="button">Search</button>
                                </div>
                            </div>
                            <small class="form-control-feedback text-muted">&nbsp;</small> 
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-t-0">
                <div class="table-responsive">
                    <table id="tableRoutedDocument" class="table table-hover table-bordered table-striped">
                        <colgroup>
                            <col width="15%">
                            <col width="40%">
                            <col width="20%">
                            <col width="25%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>Tracking Code</th>
                                <th>Subject</th>
                                <!-- <th>Notes</th> -->
                                <th>Status</th>
                                <th>Note</th>
                                <th>Keywords</th>
                                <!-- <th></th> -->
                            </tr>
                        </thead>
                        <tbody class="table-sm">
                            @forelse( $documentsLog as $log )
                                <tr id="row-{{ $log->id }}">
                                    <td class="text-center">
                                        <h4><a id="{{ $log->tracking_code }}" href="javascript:void(0)" class="show-code">{{ $log->tracking_code }}</a></h4>
                                    </td>
                                    <td>
                                        <h5 class="font-bold m-b-0">
                                            {{ $log->documentCode->subject }} 
                                            <small><span class="badge badge-info">{{ $log->documentCode->other_document }}</span></small>
                                        </h5>
                                            <h5 class="m-b-0">{{ $log->userEmployee->full_name }}</h5>
                                            <small>{{ $log->documentCode->tracking_date }}</small>
                                    </td>
                                    <!-- <td>{{ $log->notes }}</td> -->
                                    <td>
                                        <h5 class="font-bold m-b-0">
                                            {{ $log->action }}
                                        </h5>
                                        <small>{{ $log->date_action }}</small>
                                        @if ( $log->action == "Receive")
                                        @else
                                        <ul class="p-l-20 m-b-0">
                                            @if ( !is_null( $log->recipients ) )
                                                @foreach( $log->recipients as $recipient)
                                                    <li>{{ $recipient['name'] }}</li>
                                                @endforeach
                                            @else
                                                <li>All</li>
                                            @endif
                                        </ul>
                                        @endif
                                    </td>
                                    <td>
                                        <a data-id="log-{{ $log->id }}" href="javascript:void(0);" class="text-primary linkRemarks">
                                            {!! $log->forSignature ? 'For signature.&nbsp;' : '' !!}
                                            {!! $log->forCompliance ? 'For Compliance.&nbsp;' : '' !!}
                                            {!! $log->forInformation ? 'For Information.&nbsp;' : '' !!}
                                            {{ $log->notes ?: '' }}
                                            &nbsp;<small><i class="icon-note"></i></small>
                                        </a>
                                    </td>
                                    <td>
                                        @foreach( $log->documentCode->documentKeywords as $keyword )
                                            {{ $keyword->keywords }} &nbsp;
                                        @endforeach
                                    </td>
                                    <!-- <td class="text-center">
                                        <button type="button" class="btn btn-danger btn-sm btnCancelEvent" data-id="{{ $log->id }}" title="Cancel"><i class="ti-close"></i></button>
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
<script src="{{ asset('js/jquery.hotkeys.js') }}"></script>
<script src="{{ asset('assets/node_modules/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
<!-- Footable -->
<script src="{{ asset('assets/node_modules/moment/moment.js') }}"></script>
<!-- This is data table -->
<script src="{{ asset('assets/node_modules/datatables/datatables.min.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script>
    $(document).ready(function() { 

        // DataTable for Tracker
        var trackerTable = $('#tableRoutedDocument').DataTable({
            ordering: false,
            fixedHeader: true,
            columnDefs: [
                {
                    "targets": [ 4 ],
                    "visible": false,
                    "searchable": true
                },
            ],
            // order: [[ 0, "desc" ]],
            dom: '<"top"l<"float-right"i>>rt<"bottom"<"float-left"B><p>><"clear">',
            buttons: [
                {
                    text: 'Export Log',
                    className: 'btn btn-primary btn-hidden btn-export-log',
                    action: function ( e, dt, node, config ) {
                        window.open("{{ route('optima.route-documents.export') }}");
                    }
                }
            ]
        });

        $('#drpdown-export-log').on('click', function() {
            $('.btn-export-log').click();
        });

        // Custom Input Search for Table
        $('#searchTracker').keyup(function(){
            trackerTable.search($(this).val()).draw() ;
        })

        $(".select2").select2();

        // SHOW MODAL TRACKING LOGS OF A DOCUMENT
        $("#tableRoutedDocument").on("click", ".show-code", function() {
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

        // SHOW MODAL OF TRACKER REMARKS
        $("#tableRoutedDocument").on("click", ".linkRemarks", function() {
            var tracking_code = $(this).data("id");

            $('#modalRemarks').modal('show');
        });

        // MODAL RECEIVE INPUT FOCUS
        $('#receiveModal').on('shown.bs.modal', function() {
            $('#codeInputReceive').focus();
        });

        // FORM RECEIVE SHOW MODAL
        $('form#submitReceive').on('submit', function(e) {
            e.preventDefault();
            // var routing = $('input[name=routingType]:checked').val(),
            var form    = $(this),
                action  = "{{ route('optima.incoming.store') }}";

            $.ajax({
                method : 'POST',
                url    : action,
                data   : form.serialize(),
                xhr: function() {
                    //upload Progress
                    var xhr = $.ajaxSettings.xhr();
                    if (xhr.upload) {
                        xhr.upload.addEventListener('progress', function(event) {
                            var percent = 0;
                            var position = event.loaded || event.position;
                            var total = event.total;
                            if (event.lengthComputable) {
                                percent = Math.ceil(position / total * 100);
                            }
                            // update progressbar
                            // $("#upload-progress .progress-bar").css("width", + percent +"%");
                            $('#submitReceiveAlert').css('display', 'none');
                            $('#submitReceiveSpinner').css('display','block');
                        }, true);
                    }
                    return xhr;
                },
                success: function(data) {

                    if ( data.result ) {

                        var row = appendTableRowReceived(data);

                        $('tr.footable-empty').remove();
                        $('table#tableRoutedDocument tbody').prepend(row);
                        form.trigger("reset");

                        // ALERT
                        $('input#codeInputReceive').select();
                        $('#submitReceiveSpinner').css('display','none');
                        $('#submitReceiveAlert')
                            .removeClass('alert-danger')
                            .addClass('alert-success')
                            .css('display','block')
                            .html( '<b>'+ data.tracking_code +'</b> tracker successfully received.');
                        // HIDE ALERT
                        setTimeout(function() {
                            $('#submitReceiveAlert').css('display', 'none');;
                        }, 5000);

                    } else {

                        if ( data.status == "Receive")
                        {
                            // ALERT
                            $('#submitReceiveSpinner').css('display','none');
                            $('input#codeInputReceive').select();
                            $('#submitReceiveAlert')
                                .removeClass('alert-success')
                                .addClass('alert-danger')
                                .css('display','block').html( data.tracking_code + data.msg );
                            setTimeout(function() {
                                $('#submitReceiveAlert').css('display', 'none');;
                            }, 5000);

                        } else if ( data.status == "Not Recipient" ) {

                            var dialog = Swal.fire({
                                        text:  data.tracking_code + data.msg,
                                        type: "warning",
                                        showConfirmButton: true,
                                        showCancelButton: true,
                                        allowOutsideClick: false
                                });

                        } else {
                            // ALERT
                            $('#submitReceiveSpinner').css('display','none');
                            $('input#codeInputReceive').select();
                            $('#submitReceiveAlert')
                                .removeClass('alert-success')
                                .addClass('alert-danger')
                                .css('display','block').html("Tracking code undefined.");
                            setTimeout(function() {
                                $('#submitReceiveAlert').css('display', 'none');;
                            }, 5000);
                        }
                    }
                },
                error  : function(xhr, err) {
                    Swal.fire({
                        title: "Error!",
                        text:  "Could not retrieve the data.",
                        type: "error"
                    }).then( function() {
                        $('input#codeInputReceive').select();
                    });
                }
            });
            return false;
        });

        // MODAL RELEASE INPUT FOCUS
        $('#releaseModal').on('shown.bs.modal', function() {
            $('#codeInputRelease').focus();
        });

        // FORM RELEASE SHOW MODAL
        $('form#submitRelease').on('submit', function(e) {
            e.preventDefault();
            var form    = $(this),
                action  = "{{ route('optima.outgoing.store') }}";

            $.ajax({
                method : 'POST',
                url    : action,
                data   : form.serialize(),
                xhr: function() {
                    //upload Progress
                    var xhr = $.ajaxSettings.xhr();
                    if (xhr.upload) {
                        xhr.upload.addEventListener('progress', function(event) {
                            var percent = 0;
                            var position = event.loaded || event.position;
                            var total = event.total;
                            if (event.lengthComputable) {
                                percent = Math.ceil(position / total * 100);
                            }
                            // update progressbar
                            // $("#upload-progress .progress-bar").css("width", + percent +"%");
                            $('#submitReleaseAlert').css('display', 'none');
                            $('#submitReleaseSpinner').css('display','block');
                        }, true);
                    }
                    return xhr;
                },
                success: function(data) {

                    if ( data.result ) {

                        var row = appendTableRowReceived(data);

                        $('tr.footable-empty').remove();
                        $('table#tableRoutedDocument tbody').prepend(row);
                        form.trigger("reset");

                        // ALERT
                        $('input#codeInputReceive').select();
                        $('#submitReleaseSpinner').css('display','none');
                        $('#submitReleaseAlert')
                            .removeClass('alert-danger')
                            .addClass('alert-success')
                            .css('display','block')
                            .html( '<b>'+ data.tracking_code +'</b> tracker successfully released.');
                        // HIDE ALERT
                        setTimeout(function() {
                            $('#submitReceiveAlert').css('display', 'none');;
                        }, 5000);

                    } else {

                        // ALERT
                        $('#submitReleaseSpinner').css('display','none');
                        $('input#codeInputRelease').select();
                        $('#submitReleaseAlert')
                            .removeClass('alert-success')
                            .addClass('alert-danger')
                            .css('display','block').html( 'Tracking code undefined.');
                        setTimeout(function() {
                            $('#submitReceiveAlert').css('display', 'none');;
                        }, 5000);
                    }
                },
                error  : function(xhr, err) {
                    Swal.fire({
                        title: "Error!",
                        text:  "Could not retrieve the data.",
                        type: "error"
                    }).then( function() {
                        $('input#codeInputRelease').select();
                    });
                }
            });
            return false;
        });
    });
</script>
<script>

    $(document).on('keydown input click', function (key) {

        // console.log(key.which);

        if ( key.altKey && key.which == 51 ) {
            // alt + 3
            // $("#btnReceive").click();
            $('#receiveModal').modal('show');
            $('.modal').not($('#receiveModal')).each(function () {
                $(this).modal('hide');
            });

        } else if ( key.altKey && key.which == 52 ) {
            // alt + 4
            // $("#btnRelease").click();
            $('#releaseModal').modal('show');
            $('.modal').not($('#releaseModal')).each(function () {
                $(this).modal('hide');
            });
        } /*else if ( key.ctrlKey && key.altKey && key.which == 78 ) {
            // alt + 4
            $("#btnCreateNewTracker").click();
        }*/
    });
</script>
<script>
    // row to be added
    function appendTableRowReceived (item) {

        var remarks;
        if (item.remarks === '')
        {
            remarks = '<a data-id="log-'+item.track_id+'" href="javascript:void(0);" class="text-info linkRemarks"><small><i class="icon-note"></i></small></a>';
        } else {
            remarks = '<a data-id="log-'+item.track_id+'" href="javascript:void(0);" class="linkRemarks">'+item.remarks+'</a>';
        }

        var row = $('<tr>' +
                        '<td class="text-center"><a href="javascript:void(0)" target="_blank">' + item.tracking_code + '</a></td>' +
                        '<td>' + 
                            '<h5 class="font-weight-bold">' + item.subject + '</h5>' +
                                '<small>'+ item.document_type +' &#9679; '+ item.date_created +'</small><br>' +
                                item.date_created + 
                        '</td>' +
                        '<td>' + 
                            '<h5 class="font-weight-bold">' + item.action + '</h5>' +
                            item.date_action +  
                        '</td>' +
                        '<td>' + remarks +  '</td>' +
                    '</tr>');
        return row;
    }
    /*$(document).on("click", ".btnCancelEvent", function () {
        var btn = $(this),
            id  = btn.data("id"),
            token  = $('input[name=_token]').val(),
            $url = " route('optima.trackinglog.destroy', ':var') }}";

            $url = $url.replace(':var', id);

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
    });*/
</script>
@endsection