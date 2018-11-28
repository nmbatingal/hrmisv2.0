@extends('layouts.app')

@section('styles')
<link href="{{ asset('assets/node_modules/datatables/media/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
<link href="{{ asset('dist/css/pages/footable-page.css') }}" rel="stylesheet">
@endsection

@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-12">
        <h4 class="text-white">Document Tracker</h4>
    </div>
    <div class="col-md-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Document Tracker</li>
        </ol>
    </div>
</div>
<div class="m-t-40"></div>
<div class="row">
    <!-- Column -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Receive Incoming Documents
                    <a href="{{ route('doctracker.create.tracker') }}" class="btn btn-rounded btn-primary float-right">Create new tracker</a>
                </h4>
                <p class="card-text">Receive tracked documents.</p>
                
                <!-- FORM TO RECEIVE AND SUBMIT INCOMING DOCUMENTS WITH TRACKING CODE  -->
                <form id="submitCode" action="{{ route('doctracker.recieveForwardedDocument') }}" class="form-horizontal" method="POST">
                    {{ csrf_field() }}
                    <div class="row p-t-20">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <div class="input-group p-0">
                                    <input type="text" class="form-control" name="log_id" placeholder="Enter tracking code to receive" required autofocus>
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

                <!-- TABLE  -->
                <div class="table-responsive-md m-t-10">
                    <table id="document-tracker-received" class="table table-bordered table-hover table-striped" data-paging="true" data-paging-size="5">
                        <thead>
                            <tr>
                                <th>Tracking Code</th>
                                <th>Received by</th>
                                <th>From</th>
                                <th>Subject</th>
                                <th>Date & Time</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <!-- END TABLE -->

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

                    var row = appendTableRowReceived(data);

                    $('tr.footable-empty').remove();
                    $('table#document-tracker-received tbody').append(row);

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
                            '<td><a href="{!! route('doctracker.showReceivedDocument', "") !!}/'+ item.tracking_code +'" target="_blank">' + item.tracking_code + '</a></td>' +
                            '<td>' + item.received_by + '<br><small>' + item.received_office + '</small></td>' +
                            '<td>' + item.from + '<br><small>' + item.from_office + '</small></td>' +
                            '<td>' + item.subject + '</td>' +
                            '<td>' + item.datetime + '</td>' +
                        '</tr>');
            return row;
        }
    });
</script>
@endsection