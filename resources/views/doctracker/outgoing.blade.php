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
                        <div class="card bg-cyan text-white">
                            <div class="card-body">
                                <h6 class="m-b-0">Total Documents</h6>
                                <h3 class="card-title">FORWARDED</h3>
                                <div class="d-flex no-block align-items-center m-t-20 m-b-0">
                                    <div class="ml-auto">
                                        <h1 class="text-white"><i class="icon-docs"></i> <span id="count-outgoing">{{ $outgoingLogs->count() }}</span></h1>
                                    </div>
                                </div>
                            </div>
                            <div id="sparkline8" class="sparkchart"></div>
                        </div>
                    </div>
                </div>

                <!-- FORM TO RECEIVE AND SUBMIT INCOMING DOCUMENTS WITH TRACKING CODE  -->
                <form id="submitCode" action="{{ route('doctracker.outgoing.receive') }}" class="form-horizontal" method="POST">
                    {{ csrf_field() }}
                    <div class="row m-t-40">
                        <div class="col-md-12">
                            <div class="form-group m-b-0">
                                <div class="input-group p-0">
                                    <input type="text" class="form-control" name="code" placeholder="Enter tracking code to receive" required autofocus>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><i class="icon-drawar"></i> Open</button>
                                    </div>
                                </div>
                                <small class="form-control-feedback">&nbsp; </small> 
                            </div>
                        </div>
                        <!--/span-->
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
                    <table id="document-tracker-received" class="table table-hover table-striped" data-paging="true" data-paging-size="5">
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
                            </tr>
                        </thead>
                        <tbody>
                            @forelse( $outgoingLogs as $outgoing )
                                <tr>
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
                method : 'POST',
                url    : form.attr('action'),
                data   : form.serialize(),
                success: function(data) {
                    if (data.success)
                    {
                        $('#outgoing-modal-body').html(data.html);
                        $('#modal-outgoing').modal('show');
                    }
                },
                error  : function(xhr, err) {
                    swal({
                        title: "Error!",
                        text:  "Could not retrieve the data.",
                        type: "error"
                    });
                }
            });

            return false;
        });
    });
</script>
@endsection