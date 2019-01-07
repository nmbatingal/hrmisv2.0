@extends('layouts.app')

@section('title')
-OPTIMA | Outgoing Documents
@endsection

@section('styles')
<link href="{{ asset('dist/css/pages/footable-page.css') }}" rel="stylesheet">
<link href="{{ asset('assets/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-12">
        <h4 class="text-white">Outgoing Documents</h4>
    </div>
    <div class="col-md-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('doctracker.dashboard') }}">OPTIMA</a></li>
            <li class="breadcrumb-item active">Outgoing Documents</li>
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
                <h3 class="card-title">Outgoing Documents</h3>
                <p class="card-text">Forward outgoing documents using tracker code.</p>

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="d-flex flex-row" style="border: 1px solid #01c0c8;">
                                <div class="p-10 bg-cyan">
                                    <h3 class="text-white box m-b-0"><i class="icon-docs"></i></h3></div>
                                <div class="align-self-center m-l-20">
                                    <h3 class="m-b-0 text-success"><span id="count-outgoing">{{ $outgoingLogs->count() }}</span></h3>
                                    <h6 class="text-muted m-b-0">Documents Forwarded</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FORM TO RECEIVE AND SUBMIT INCOMING DOCUMENTS WITH TRACKING CODE  -->
                <form id="submitCode" action="{{ route('doctracker.outgoing.search') }}" class="form-horizontal" method="POST">
                    {{ csrf_field() }}
                    <div class="row m-t-40">
                        <div class="col-md-12">
                            <div class="form-group m-b-0">
                                <div class="input-group p-0">
                                    <input type="text" class="form-control" name="code" onClick="this.setSelectionRange(0, this.value.length)" placeholder="Enter tracking code to receive" required autofocus>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><i class="icon-drawar"></i> Open</button>
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

                <!-- sample modal content -->
                <div id="modal-outgoing" class="modal fade" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalOutgoing" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="modalOutgoing">Outgoing Document</h4>
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

                <div class="table-responsive-md">
                    <table id="documentTableOutgoing" class="table table-hover table-striped" data-paging="true" data-paging-size="5">
                        <colgroup>
                            <col width="20%">
                            <col width="30%">
                            <col width="30%">
                            <col width="20%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>Tracking Code</th>
                                <th>Subject</th>
                                <th>Notes</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse( $outgoingLogs as $outgoing )
                                <tr id="row-{{ $outgoing->id }}">
                                    <td><a href="javascript:void(0)" target="_blank">{{ $outgoing->tracking_code }}</a></td>
                                    <td>
                                        <h5 class="font-weight-bold">{{ $outgoing->documentCode->subject }}</h5>
                                            <h5>{{ $outgoing->userEmployee->full_name }}</h5>
                                            ({{ $outgoing->documentCode->other_document }})<br>
                                            {{ $outgoing->documentCode->tracking_date }}
                                    </td>
                                    <td>{{ $outgoing->notes }}</td>
                                    <td>
                                        <h5 class="font-weight-bold">{{ $outgoing->action }}</h5>
                                        <ul class="p-l-20 m-b-0">
                                            @if ( !is_null( $outgoing->recipients ) )
                                                @foreach( $outgoing->recipients as $recipient)
                                                    <li>{{ $recipient['name'] }}</li>
                                                @endforeach
                                            @else
                                                <li>All</li>
                                            @endif
                                        </ul>
                                        {{ $outgoing->date_action }}
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-danger btn-sm btnCancelEvent" data-id="{{ $outgoing->id }}" title="Cancel"><i class="ti-close"></i></button>
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
<script src="{{ asset('assets/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
<!-- Footable -->
<script src="{{ asset('assets/node_modules/moment/moment.js') }}"></script>
<script src="{{ asset('assets/node_modules/footable/js/footable.min.js') }}"></script>
<script>
    $(document).ready(function() { 

        $(".select2").select2();

        $('[data-page-size]').on('click', function(e){
            e.preventDefault();
            var newSize = $(this).data('pageSize');
            FooTable.get('#documentTableOutgoing').pageSize(newSize);
        });

        $('#documentTableOutgoing').footable({
            filtering: {
                enabled: false
            }
        });

        $('#modal-outgoing').on('hidden.bs.modal', function () {
            $("#upload-progress .progress-bar").css("width", 0);
        });

        $('form#submitCode').on('submit', function(e) {
            e.preventDefault();
            var form = $(this); 

            $.ajax({
                method : 'POST',
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
                    });
                }
            });

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
                        )
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