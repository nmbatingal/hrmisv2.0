@extends('layouts.app')

@section('title')
-OPTIMA | Incoming Documents
@endsection

@section('styles')
<link href="{{ asset('dist/css/pages/footable-page.css') }}" rel="stylesheet">
@endsection

@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-12">
        <h4 class="text-white">Incoming Documents</h4>
    </div>
    <div class="col-md-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('doctracker.dashboard') }}">OPTIMA</a></li>
            <li class="breadcrumb-item active">Incoming Documents</li>
        </ol>
    </div>
    <div class="col-md-6 text-right">
        <a href="{{ route('doctracker.create.tracker') }}" class="btn btn-rounded btn-primary">Create new tracker</a>&nbsp;
        <a href="{{ route('doctracker.about') }}" class="btn btn-circle btn-info float-right" title="Help"><i class="mdi mdi-help"></i></a>
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
                <h3 class="card-title">Incoming Documents</h3>
                <p class="card-text">Receive incoming documents using tracker code.</p>

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="d-flex flex-row" style="border: 1px solid #01c0c8;">
                                <div class="p-10 bg-cyan">
                                    <h3 class="text-white box m-b-0"><i class="icon-docs"></i></h3></div>
                                <div class="align-self-center m-l-20">
                                    <h3 class="m-b-0 text-success"><span id="count-received">{{ $incomingLogs->count() }}</span></h3>
                                    <h6 class="text-muted m-b-0">Documents Received</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FORM TO RECEIVE AND SUBMIT INCOMING DOCUMENTS WITH TRACKING CODE  -->
                <form id="submitCode" action="{{ route('doctracker.incoming.receive') }}" class="form-horizontal" method="GET">
                    <div class="row m-t-40">
                        <div class="col-md-12">
                            <div class="form-group m-b-0">
                                <div class="input-group p-0">
                                    <input id="codeInput" type="text" class="form-control" name="code" onClick="this.setSelectionRange(0, this.value.length)" placeholder="Enter tracking code to receive" required autofocus>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><i class="ti-import"></i> Receive</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!-- progress bar -->
                    <div id="upload-progress" class="progress m-t-0 m-b-30">
                        <div class="progress-bar bg-success wow animated progress-animated" style="width: 0%; height:3px;" role="progressbar"></div>
                    </div>
                </form>
                <!-- END OF FORM TO RECEIVE AND SUBMIT INCOMING DOCUMENTS WITH TRACKING CODE  -->

                <!-- modal content -->
                <div id="modal-incoming" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalOutgoing" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="modalOutgoing">Receive Incoming</h4>
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

                <div class="table-responsive-md">
                    <table id="document-tracker-received" class="table table-hover table-striped" data-paging="true" data-paging-size="10">
                        <colgroup>
                            <col width="">
                            <col width="">
                            <col width="">
                            <col width="">
                            <col width="">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>Tracking Code</th>
                                <th>Subject</th>
                                <th>Notes</th>
                                <th>Remarks</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse( $incomingLogs as $incoming )
                                <tr data-id="row-{{ $incoming->id }}">
                                    <td><a class="incomingLink" href="#">{{ $incoming->tracking_code }}</a></td>
                                    <td>
                                        <h5 class="font-weight-bold">{{ $incoming->documentCode->subject }}</h5>
                                            <h5>{{ $incoming->userEmployee->full_name }}</h5>
                                            ({{ $incoming->documentCode->other_document }})<br>
                                            {{ $incoming->documentCode->tracking_date }}
                                    </td>
                                    <td>{{ $incoming->notes }}</td>
                                    <td class="remarks">
                                        {{ $incoming->remarks }}
                                    </td>
                                    <td>
                                        <h5 class="font-weight-bold">{{ $incoming->action }}</h5>
                                        {{ $incoming->date_action }}
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <a href="{{ route('doctracker.logs') }}" class="btn btn-outline-danger"> View tracking logs >>> </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- This is data table -->
<script src="{{ asset('assets/node_modules/datatables/datatables.min.js') }}"></script>
<!-- Footable -->
<script src="{{ asset('assets/node_modules/moment/moment.js') }}"></script>
<script src="{{ asset('assets/node_modules/footable/js/footable.min.js') }}"></script>
<script>
    $(document).ready(function() { 
        $('[data-page-size]').on('click', function(e){
            e.preventDefault();
            var newSize = $(this).data('pageSize');
            FooTable.get('#document-tracker-received').pageSize(newSize);
        });

        $('#document-tracker-received').footable({
            filtering: {
                enabled: false
            }
        });

        $('form#submitCode').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);

            $.ajax({
                method : form.attr('method'),
                url    : form.attr('action'),
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

            return false;
        });
    });
</script>
@endsection