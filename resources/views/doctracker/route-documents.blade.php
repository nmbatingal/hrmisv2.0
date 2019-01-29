@extends('layouts.app')

@section('title')
-OPTIMA | Route Documents
@endsection

@section('styles')
<link href="{{ asset('assets/node_modules/datatables/media/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
<link href="{{ asset('assets/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('navbutton')
<!-- Help -->
<!-- ============================================================== -->
<li class="nav-item"> 
    <a class="nav-link  waves-effect waves-light" href="{{ route('doctracker.about') }}" title="Help"><i class="mdi mdi-help"></i></a>
</li>
<!-- ============================================================== -->
<!-- Help -->
<!-- ============================================================== -->
@endsection

@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-12">
        <h4 class="text-white">Routing Documents</h4>
    </div>
    <div class="col-md-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('doctracker.dashboard') }}">OPTIMA</a></li>
            <li class="breadcrumb-item active">Route Documents</li>
        </ol>
    </div>
    <div class="col-md-6 text-right">
        <a href="{{ route('doctracker.create.tracker') }}" class="btn btn-rounded btn-primary">Create new tracker</a>&nbsp;
    </div>
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
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Route Documents</h3>
                <p class="card-text">Receive and release routed documents using tracker code.</p>

                <!-- INFO CARDS -->
                <div class="row">
                    <!-- Document Created -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="d-flex flex-row" style="border: 1px solid #00c292;">
                                <div class="p-10 bg-success">
                                    <h3 class="text-white box m-b-0"><i class="icon-docs"></i></h3></div>
                                <div class="align-self-center m-l-20">
                                    <h3 class="m-b-0 text-success"><span id="count-created">{{ $documentsCreated->count() }}</span></h3>
                                    <h6 class="text-muted m-b-0">Documents Created</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Document Received -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="d-flex flex-row" style="border: 1px solid #01c0c8;">
                                <div class="p-10 bg-cyan">
                                    <h3 class="text-white box m-b-0"><i class="ti-import"></i></h3></div>
                                <div class="align-self-center m-l-20">
                                    <h3 class="m-b-0 text-cyan"><span id="count-receive">{{ $documentsReceived->count() }}</span></h3>
                                    <h6 class="text-muted m-b-0">Documents Received</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Document Released -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="d-flex flex-row" style="border: 1px solid #03a9f3;">
                                <div class="p-10 bg-info">
                                    <h3 class="text-white box m-b-0"><i class="icon-cursor"></i></h3></div>
                                <div class="align-self-center m-l-20">
                                    <h3 class="m-b-0 text-info"><span id="count-release">{{ $documentsReleased->count() }}</span></h3>
                                    <h6 class="text-muted m-b-0">Documents Released</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Document Released -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="d-flex flex-row" style="border: 1px solid #e46a76;">
                                <div class="p-10 bg-danger">
                                    <h3 class="text-white box m-b-0"><i class="icon-doc"></i></h3></div>
                                <div class="align-self-center m-l-20">
                                    <h3 class="m-b-0 text-danger"><span id="count-release">-</span></h3>
                                    <h6 class="text-muted m-b-0">Documents</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-info m-t-30 m-b-0">
                    <div class="card-header bg-dark">
                        <h4 class="m-b-0 text-white">Receive/Release Document</h4>
                    </div>
                    <div class="card-body p-b-0" style="border: 1px solid #000000;">
                        <!-- FORM TO RECEIVE AND SUBMIT INCOMING DOCUMENTS WITH TRACKING CODE  -->
                        <form id="submitCode" class="form-horizontal">
                            {{ csrf_field() }}

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row m-b-20">
                                        <div class="col-md-3 col-xs-12">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="radioReceive" name="routingType" value="Receive" required class="custom-control-input">
                                                <label class="custom-control-label" for="radioReceive">Receive Document</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-xs-12">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="radioRelease" name="routingType" value="Release" required class="custom-control-input">
                                                <label class="custom-control-label" for="radioRelease">Release Document</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <span class="text-danger">* Select from receiving/releasing of document</span>
                                        </div>
                                    </div>

                                    <div class="form-group m-b-0">
                                        <div class="input-group p-0">
                                            <input id="codeInput" type="text" class="form-control" name="code" onClick="this.setSelectionRange(0, this.value.length)" placeholder="Enter tracking code to receive" required autofocus>
                                            <div class="input-group-append">
                                                <button class="btn btn-success" type="submit">
                                                    <i class="icon-cursor"></i>&nbsp;</button>
                                            </div>
                                        </div>
                                        <div id="upload-progress" class="progress m-t-0">
                                            <div class="progress-bar bg-success wow animated progress-animated" style="width: 0%; height:3px;" role="progressbar"></div>
                                        </div>
                                        <small class="form-control-feedback text-muted">&nbsp;</small> 
                                    </div>
                                </div>
                                <!--/span-->
                                <!-- progress bar -->
                                
                            </div>
                        </form>
                        <!-- END OF FORM TO RECEIVE AND SUBMIT INCOMING DOCUMENTS WITH TRACKING CODE  -->
                    </div>
                </div>

                <!-- modal incoming content -->
                <div id="modal-incoming" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalOutgoing" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="modalOutgoing">Receive Incoming Document</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div id="incoming-modal-body" class="modal-body">
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

                <!-- modal outgoing content -->
                <div id="modal-outgoing" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalOutgoing" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="modalOutgoing">Release Outgoing Document</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div id="outgoing-modal-body" class="modal-body">
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

                <!-- modal tracker logs content -->
                <div id="modalLogs" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalLogs" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="modalLogsTitle">Log Details</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div id="modalBodyLogs" class="modal-body">
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body p-b-0">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <form class="form-horizontal">
                                <div class="form-group m-b-0">
                                    <div class="input-group p-0">
                                        <input id="searchTracker" type="text" class="form-control" placeholder="Search document tracker">
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
                    <table id="tableRoutedDocument" class="table table-hover table-bordered table-striped">
                        <colgroup>
                            <col width="15%">
                            <col width="30%">
                            <col width="15%">
                            <col width="15%">
                            <col width="20%">
                            <col width="5%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>Tracking Code</th>
                                <th>Subject</th>
                                <th>Notes</th>
                                <th>Remarks</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-sm">
                            @forelse( $documentsLog as $log )
                                <tr id="row-{{ $log->id }}">
                                    <td><a id="{{ $log->tracking_code }}" href="javascript:void(0)" class="show-code">{{ $log->tracking_code }}</a></td>
                                    <td>
                                        <h5 class="font-weight-bold">
                                            {{ $log->documentCode->subject }}
                                            <br><small>({{ $log->documentCode->other_document }})</small>
                                        </h5>
                                            <h5 class="m-b-0">{{ $log->userEmployee->full_name }}</h5>
                                            <small>{{ $log->documentCode->tracking_date }}</small>
                                    </td>
                                    <td>{{ $log->notes }}</td>
                                    <td>{{ $log->remarks }}</td>
                                    <td>
                                        <h5 class="font-weight-bold">
                                            {{ $log->action }}
                                            <br><small>{{ $log->date_action }}</small>
                                        </h5>
                                        <ul class="p-l-20 m-b-0">
                                            @if ( !is_null( $log->recipients ) )
                                                @foreach( $log->recipients as $recipient)
                                                    <li>{{ $recipient['name'] }}</li>
                                                @endforeach
                                            @else
                                                <li>All</li>
                                            @endif
                                        </ul>
                                    </td>
                                    <td class="text-center">
                                        <!-- <button type="button" class="btn btn-danger btn-sm btnCancelEvent" data-id="{{ $log->id }}" title="Cancel"><i class="ti-close"></i></button> -->
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
<script src="{{ asset('assets/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
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
            columnDefs: [{ 
                orderable: false, 
                targets: [2,3,4,5] 
            }],
            order: [[ 0, "desc" ]],
            dom: '<"top"l<"float-right"i>>rt<"bottom"<"float-left"B><p>><"clear">',
            buttons: [
                {
                    text: 'Export Log',
                    className: 'btn btn-primary',
                    action: function ( e, dt, node, config ) {
                        window.open("{{ route('doctracker.export.routing') }}");
                    }
                }
            ]
        });

        // Custom Input Search for Table
        $('#searchTracker').keyup(function(){
            trackerTable.search($(this).val()).draw() ;
        })

        $(".select2").select2();

        $('#modal-outgoing').on('hidden.bs.modal', function () {
            $("#upload-progress .progress-bar").css("width", 0);
        });

        // SHOW TRACKING LOGS OF A DOCUMENT
        $('a.show-code').on('click', function() {
            var tracking_code = $(this).attr("id"),
                url = "{{ route('doctracker.search') }}";

            $.ajax({
                method : 'GET',
                url    : url,
                data   : {code: tracking_code},
                success: function(data) {

                    // console.log(data);

                    //if ( data.success ) {

                        // $('#modalLogsTitle').html( tracking_code + ' Log Details');
                        $('#modalBodyLogs').html(data.html);
                        $('#modalLogs').modal('show');

                    // } else {
                    //     swal({
                    //         title: "Error!",
                    //         text:  "Tracking code undefined.",
                    //         type: "error"
                    //     }).then( function() {
                    //         // $("#upload-progress .progress-bar").css("width", 0);
                    //         // $("#codeInput").select();
                    //     });
                    // }

                    // $('#results-bar').css('display', 'block'); 
                    // $('table#search-tracker tbody tr').remove();  

                    // $('#code-result').html(data.result);
                    // $('#tracker-code').html(data.code);

                    // if ( data.result > 0 )
                    // {
                    //     $('input[name=tracking_code]').val(data.tracker.tracking_code);
                    //     $('input[name=date_created]').val(data.tracker.date_created);
                    //     $('input[name=created_by]').val(data.tracker.created_by);
                    //     $('input[name=document_type]').val(data.tracker.document_type);
                    //     $('input[name=subject]').val(data.tracker.subject);
                    //     $('input[name=details]').val(data.tracker.details);

                    //     $.each(data.results, function(index, item){
                    //         var row = appendTableRowSearch(item);
                    //         $('table#search-tracker tbody').append(row);
                    //     });

                    //     $('#search-tracker').trigger('footable_initialize');
                    // } else {
                    //     $('table#search-tracker tbody').append('<tr class="footable-empty"><td colspan="4">No results</td></tr>');
                    // }
                },
                error  : function(xhr, err) {
                    swal({
                        title: "Error!",
                        text:  "Could not retrieve the data.",
                        type: "error"
                    })
                }
            });
        });

        $('form#submitCode').on('submit', function(e) {
            e.preventDefault();
            var routing = $('input[name=routingType]:checked').val(),
                form    = $(this);

            if ( routing == "Receive" ) {
                var action  = "{{ route('doctracker.incoming.search') }}";

                $.ajax({
                    method : 'GET',
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
                                //update progressbar
                                $("#upload-progress .progress-bar").css("width", + percent +"%");
                            }, true);
                        }
                        return xhr;
                    },
                    success: function(data) {

                        if ( data.success ) {

                            $('#incoming-modal-body').html(data.html);
                            $('#modal-incoming').modal('show');

                        } else {
                            swal({
                                title: "Error!",
                                text:  "Tracking code undefined.",
                                type: "error"
                            }).then( function() {
                                $("#upload-progress .progress-bar").css("width", 0);
                                $("#codeInput").select();
                            });
                        }
                    },
                    error  : function(xhr, err) {
                        swal({
                            title: "Error!",
                            text:  "Could not retrieve the data.",
                            type: "error"
                        }).then( function() {
                            $("#upload-progress .progress-bar").css("width", 0);
                            $("#codeInput").select();
                        });
                    }
                });

            } else if ( routing == "Release" ) {

                var action  = "{{ route('doctracker.outgoing.search') }}";
                
                $.ajax({
                    method : 'GET',
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
                                //update progressbar
                                $("#upload-progress .progress-bar").css("width", + percent +"%");
                            }, true);
                        }
                        return xhr;
                    },
                    success: function(data) {
                        if (data.success)
                        {
                            $('#outgoing-modal-body').html(data.html);
                            $('#modal-outgoing').modal('show');
                        } else {
                            swal({
                                title: "Error!",
                                text:  "Tracking code undefined.",
                                type: "error"
                            }).then( function() {
                               $("#upload-progress .progress-bar").css("width", 0);
                               $("#codeInput").select();
                            });
                        }
                    },
                    error  : function(xhr, err) {
                        swal({
                            title: "Error!",
                            text:  "Could not retrieve the data.",
                            type: "error"
                        }).then( function() {
                           $("#upload-progress .progress-bar").css("width", 0);
                           $("#codeInput").select();
                        });
                    }
                });
            }

            return false;
        });
    });
</script>
<script>
    $(document).on("click", ".btnCancelEvent", function () {
        var btn = $(this),
            id  = btn.data("id"),
            token  = $('input[name=_token]').val(),
            $url = "{{ route('doctracker.trackinglog.destroy', '') }}" + "/" + id;

        swal({
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

                        Swal(
                          'Deleted!',
                          'Action successfully deleted.',
                          'success'
                        );
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        swal("Error deleting!", "Please try again", "error");
                    }
                });
            }
        }); 
    });
</script>
@endsection