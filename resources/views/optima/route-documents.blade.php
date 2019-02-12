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
</style>
@endsection

@section('navbutton')
<!-- Help -->
<!-- ============================================================== -->
<li class="nav-item"> 
    <a class="nav-link  waves-effect waves-light" href="{{ route('optima.about') }}" title="Help"><i class="mdi mdi-help"></i></a>
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
            <li class="breadcrumb-item"><a href="{{ route('optima.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Route Documents</li>
        </ol>
    </div>
    <div class="col-md-6 text-right">
        <a href="{{ route('optima.my-documents.create') }}" class="btn btn-rounded btn-primary">Create new tracker</a>&nbsp;
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
        <div class="card border-info m-t-10 m-b-10">
            <div class="card-header bg-dark">
                <h4 class="m-b-0 text-white">Receive and Release Document</h4>
            </div>
            <div class="card-body p-b-0" style="border: 1px solid #000000;">
                <!-- FORM TO RECEIVE AND SUBMIT INCOMING DOCUMENTS WITH TRACKING CODE  -->
                <form id="submitCode" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <div class="col-md-3">
                            <select name="routingType" class="form-control custom-select" style="width: 100%;" required>
                                <option value="">-- Select Action --</option>
                                <option value="Receive">Receive Document</option>
                                <option value="Release">Release Document</option>
                            </select>
                            <small class="form-control-feedback text-muted">*Select Receive/Release Document</small> 
                        </div>
                        <div class="col-md-9 p-0">
                            <div class="input-group">
                                <input id="codeInput" type="text" class="form-control" name="code" onClick="this.setSelectionRange(0, this.value.length)" placeholder="Enter tracking code here" required autofocus>
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="submit">
                                        <!-- <i class="icon-cursor"></i> --> Submit</button>
                                </div>
                            </div>
                            <small class="form-control-feedback text-muted">&nbsp;</small> 
                        </div>
                    </div>
                </form>
                <!-- END OF FORM TO RECEIVE AND SUBMIT INCOMING DOCUMENTS WITH TRACKING CODE  -->
            </div>
        </div>

        <!-- MODAL INCOMING CONTENT -->
        <div id="modal-incoming" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalOutgoing" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <!-- <div class="modal-header">
                        <h4 class="modal-title" id="modalOutgoing">Receive Incoming Document</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div> -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-9">
                                <h4 class="modal-title font-weight-bold" id="modalIncomingTitle">Receive Incoming Document</h4>
                                <span id="modalIncomingDocutype">aaaa</span>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                        </div>
                        <div id="incoming-modal-body"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL OUTGOING CONTENT -->
        <div id="modal-outgoing" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalOutgoing" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-9">
                                <h4 class="modal-title font-weight-bold" id="modalOutgoingTitle">Release Outgoing Document</h4>
                                <span id="modalOutgoingDocuType">aaaa</span>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                        </div>
                        <div id="outgoing-modal-body" class="modal-body"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL TRACKER LOGS CONTENT -->
        <div id="modalLogs" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalLogs" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-9">
                                <h4 class="modal-title font-weight-bold" id="modalLogsTitle">Log Details</h4>
                                <span id="modalLogsDocuType">aaaa</span>
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
                                <h4 class="modal-title font-weight-bold" id="modalRemarksTitle">Remarks</h4>
                                <span id="modalRemarksDocuType">aaaa</span>
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
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card m-b-0">
            <div class="card-body p-b-0">
                <h5 class="card-title"><a class="get-code" data-toggle="collapse" href="#tt1" aria-expanded="true"><i class="ti-search" title="Get Code" data-toggle="tooltip"></i> Search Tracker</a></h5>
                <div class="collapse m-t-15" id="tt1" aria-expanded="true"> 
                    <div class="panel">
                        <form class="form-horizontal">
                            <div class="form-group m-b-0">
                                <div class="input-group p-0">
                                    <input id="searchTracker" type="text" class="form-control" placeholder="Search document tracker">
                                    <div class="input-group-append">
                                        <button class="btn btn-info" type="submit">
                                            <!-- <i class="ti-search"></i> --> Search</button>
                                    </div>
                                </div>
                                <small class="form-control-feedback text-muted">&nbsp;</small> 
                            </div>
                        </form>
                    </div>
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
                                <th>Remarks</th>
                                <th>Keywords</th>
                                <!-- <th></th> -->
                            </tr>
                        </thead>
                        <tbody class="table-sm">
                            @forelse( $documentsLog as $log )
                                <tr id="row-{{ $log->id }}">
                                    <td class="text-center"><a id="{{ $log->tracking_code }}" href="javascript:void(0)" class="show-code">{{ $log->tracking_code }}</a></td>
                                    <td>
                                        <h5 class="font-weight-bold">
                                            {{ $log->documentCode->subject }}
                                            <br>
                                            <small>{{ $log->documentCode->other_document }} &#9679; {{ $log->documentCode->tracking_date }}</small>
                                        </h5>
                                            <h5 class="m-b-0">{{ $log->userEmployee->full_name }}</h5>
                                    </td>
                                    <!-- <td>{{ $log->notes }}</td> -->
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
                                    <td>
                                        @if ( empty($log->remarks) )
                                            <a data-id="log-{{ $log->id }}" href="javascript:void(0);" class="text-info linkRemarks"><small><i class="icon-note"></i></small></a>
                                        @else
                                            
                                            <a data-id="log-{{ $log->id }}" href="javascript:void(0);" class="linkRemarks">
                                                {{ $log->remarks }}
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $log->documentCode->keywords }}
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
                    className: 'btn btn-primary',
                    action: function ( e, dt, node, config ) {
                        window.open("{{ route('optima.route-documents.export') }}");
                    }
                }
            ]
        });

        // Custom Input Search for Table
        $('#searchTracker').keyup(function(){
            trackerTable.search($(this).val()).draw() ;
        })

        $(".select2").select2();

        // SHOW MODAL TRACKING LOGS OF A DOCUMENT
        $("#tableRoutedDocument").on("click", ".show-code", function() {
            var tracking_code = $(this).attr("id"),
                url = "{{ route('doctracker.search') }}";

            $.ajax({
                method : 'GET',
                url    : url,
                data   : {code: tracking_code},
                success: function(data) {
                    $('#modalBodyLogs').html(data.html);
                    $('#modalLogs').find('#modalLogsTitle').html(data.title);
                    $('#modalLogs').find('#modalLogsDocuType').html(data.docutype);
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

        $('form#submitCode').on('submit', function(e) {
            e.preventDefault();
            // var routing = $('input[name=routingType]:checked').val(),
            var routing = $('select[name=routingType]').val(),
                form    = $(this);

            if ( routing == "Receive" ) {
                var action  = "{{ route('optima.incoming.search') }}";

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
                                // update progressbar
                                // $("#upload-progress .progress-bar").css("width", + percent +"%");
                            }, true);
                        }
                        return xhr;
                    },
                    success: function(data) {

                        if ( data.success ) {

                            $('#incoming-modal-body').html(data.html);
                            $('#modal-incoming').find('#modalIncomingTitle').html( 'Receive Document '+ data.tracker);
                            $('#modal-incoming').find('#modalIncomingReceive').html( data.docutype );
                            $('#modal-incoming').modal('show');

                        } else {
                            Swal.fire({
                                title: "Error!",
                                text:  "Tracking code undefined.",
                                type: "error"
                            }).then( function() {
                                // $("#upload-progress .progress-bar").css("width", 0);
                                $("#codeInput").select();
                            });
                        }
                    },
                    error  : function(xhr, err) {
                        Swal.fire({
                            title: "Error!",
                            text:  "Could not retrieve the data.",
                            type: "error"
                        }).then( function() {
                            // $("#upload-progress .progress-bar").css("width", 0);
                            $("#codeInput").select();
                        });
                    }
                });

            } else if ( routing == "Release" ) {

                var action  = "{{ route('optima.outgoing.search') }}";
                
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
                                // $("#upload-progress .progress-bar").css("width", + percent +"%");
                            }, true);
                        }
                        return xhr;
                    },
                    success: function(data) {
                        if (data.success)
                        {
                            $('#outgoing-modal-body').html(data.html);
                            $('#modal-outgoing').find('#modalOutgoingTitle').html( 'Release Document '+ data.tracker);
                            $('#modal-outgoing').find('#modalOutgoingDocuType').html( data.docutype );
                            $('#modal-outgoing').modal('show');
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text:  "Tracking code undefined.",
                                type: "error"
                            }).then( function() {
                               // $("#upload-progress .progress-bar").css("width", 0);
                               $("#codeInput").select();
                            });
                        }
                    },
                    error  : function(xhr, err) {
                        Swal.fire({
                            title: "Error!",
                            text:  "Could not retrieve the data.",
                            type: "error"
                        }).then( function() {
                           // $("#upload-progress .progress-bar").css("width", 0);
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
            $url = "{{ route('doctracker.trackinglog.destroy', ':var') }}";

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
    });
</script>
@endsection