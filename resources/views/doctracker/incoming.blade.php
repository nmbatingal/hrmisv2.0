@extends('layouts.app')

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
            <li class="breadcrumb-item"><a href="{{ route('doctracker.dashboard') }}">Document Tracker</a></li>
            <li class="breadcrumb-item active">Incoming Documents</li>
        </ol>
    </div>
    <div class="col-md-6 text-right">
        <a href="{{ route('doctracker.create.tracker') }}" class="btn btn-rounded btn-primary float-right">Create new tracker</a>
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
                        <div class="card bg-cyan text-white">
                            <div class="card-body">
                                <h6 class="m-b-0">Total Documents</h6>
                                <h3 class="card-title">RECEIVED</h3>
                                <div class="d-flex no-block align-items-center m-t-20 m-b-0">
                                    <div class="ml-auto">
                                        <h1 class="text-white"><i class="icon-docs"></i> <span id="count-received">{{ $incomingLogs->count() }}</span></h1>
                                    </div>
                                </div>
                            </div>
                            <div id="sparkline8" class="sparkchart"></div>
                        </div>
                    </div>
                </div>

                <!-- FORM TO RECEIVE AND SUBMIT INCOMING DOCUMENTS WITH TRACKING CODE  -->
                <form id="submitCode" action="{{ route('doctracker.incoming.receive') }}" class="form-horizontal" method="POST">
                    {{ csrf_field() }}
                    <div class="row m-t-40">
                        <div class="col-md-12">
                            <div class="form-group m-b-0">
                                <div class="input-group p-0">
                                    <input type="text" class="form-control" name="code" placeholder="Enter tracking code to receive" required autofocus>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><i class="ti-import"></i> Receive</button>
                                    </div>
                                </div>
                                <small class="form-control-feedback">&nbsp; </small> 
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                </form>
                <!-- END OF FORM TO RECEIVE AND SUBMIT INCOMING DOCUMENTS WITH TRACKING CODE  -->

                <div class="table-responsive-md">
                    <table id="document-tracker-received" class="table table-bordered table-hover table-striped" data-paging="true" data-paging-size="10">
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
                            @forelse( $incomingLogs as $incoming )
                                <tr>
                                    <td><a href="{!! route('doctracker.incoming.show', $incoming->tracking_code) !!}" target="_blank">{{ $incoming->tracking_code }}</a></td>
                                    <td>
                                        <h5 class="font-weight-bold">{{ $incoming->documentCode->subject }}</h5>
                                            <h5>{{ $incoming->userEmployee->full_name }}</h5>
                                            ({{ $incoming->documentCode->other_document }})<br>
                                            {{ $incoming->documentCode->tracking_date }}
                                    </td>
                                    <td>{{ $incoming->notes }}</td>
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
                method : 'POST',
                url    : form.attr('action'),
                data   : form.serialize(),
                success: function(data) {

                    var sum = 1;
                    sum += +$('#count-received').text();

                    $('#count-received').text(sum);

                    console.log(sum);
                    var row = appendTableRowReceived(data);

                    $('tr.footable-empty').remove();
                    $('table#document-tracker-received tbody').prepend(row);

                    $('#document-tracker-received').trigger('footable_initialize');
                    form.trigger("reset");
                },
                error  : function(xhr, err) {
                    alert("Error! Could not retrieve the data.");
                }
            });

            return false;
        });

        // row to be added
        function appendTableRowReceived (item) {
            var row = $('<tr>' +
                            '<td><a href="{!! route('doctracker.incoming.show', "") !!}/'+ item.tracking_code +'" target="_blank">' + item.tracking_code + '</a></td>' +
                            '<td>' + 
                                '<h5 class="font-weight-bold">' + item.subject + '</h5>' +
                                    '<h5>' + item.created_by + '</h5>' +  
                                    '(' + item.document_type + ')<br>' +
                                    item.date_created + 
                            '</td>' +
                            '<td>' + item.note + '</td>' +
                            '<td>' + 
                                '<h5 class="font-weight-bold">' + item.action + '</h5>' +
                                item.date_action +  
                            '</td>' +
                        '</tr>');
            return row;
        }
    });
</script>
@endsection