@extends('layouts.app')

@section('title')
-OPTIMA | Tracking Logs
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

@section('styles')
<link href="{{ asset('assets/node_modules/datatables/media/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
<link href="{{ asset('dist/css/pages/footable-page.css') }}" rel="stylesheet">
<style type="text/css">
    .hidden {
        display: none;
    }
</style>
@endsection

@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-12">
        <h4 class="text-white">Tracking Logs</h4>
    </div>
    <div class="col-md-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('doctracker.dashboard') }}">OPTIMA</a></li>
            <li class="breadcrumb-item active">Logs</li>
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
            <div class="card-header text-white bg-dark">
                <h4>Tracking Log Details
                    <div class="card-actions">
                        <a class="text-white" data-action="collapse"><i class="ti-minus"></i></a>
                    </div>
                </h4>
            </div>
            <div class="card-body collapse show">
                <div class="table-responsive m-t-40">
                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Action</th>
                                <th>Office</th>
                                <th>Age</th>
                                <th>Start date</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ( $trackingLogs as $log )
                                <tr>
                                    <td>{{ $log->userEmployee->fullName }}</td>
                                    <td>{{ $log->action }}</td>
                                    <td>Edinburgh</td>
                                    <td>61</td>
                                    <td>2011/04/25</td>
                                    <td>{{ $log->dateAction}}</td>
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

<div class="row">
    <!-- Column -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Tracking Logs</h3>
                <p class="card-text">Search for a document using tracking code.</p>
                
                <form id="submitCode" action="{{ route('doctracker.search') }}" class="form-horizontal" method="GET">
                    <div class="row p-t-20">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <div class="input-group p-0">
                                    <input type="text" class="form-control" name="code" onClick="this.setSelectionRange(0, this.value.length)" placeholder="Enter tracking code" value="{{ request('code') }}" required autofocus>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><i class="icon-magnifier"></i></button>
                                    </div>
                                </div>
                                <small class="form-control-feedback">&nbsp; </small> 
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                </form>

                <div class="card">
                    <div class="card-header text-white bg-dark">
                        <h4>
                            Tracking Details
                            <div class="card-actions">
                                <a class="text-white" data-action="collapse"><i class="ti-minus"></i></a>
                            </div>
                        </h4>
                    </div>
                    <div class="card-body collapse show">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-4">Tracking Code</label>
                                    <div class="col-md-8">
                                        <input name="tracking_code" type="text" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Document Created</label>
                                    <div class="col-md-9">
                                        <input name="date_created" type="text" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-4">Created by</label>
                                    <div class="col-md-8">
                                        <input name="created_by" type="text" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Document Type</label>
                                    <div class="col-md-9">
                                        <input name="document_type" type="text" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-2">Subject</label>
                                    <div class="col-md-10">
                                        <input name="subject" type="text" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-2">Details</label>
                                    <div class="col-md-10">
                                        <input name="details" type="text" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-2">Keywords</label>
                                    <div id="keywords" class="col-md-10">

                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>

                <h5 id="results-bar" class="card-subtitle" style="display: none;">Showing <span id="code-result">{{ count($documents) }}</span> results for tracking code <u id="tracker-code" class="text-primary">{{ request('code') }}</u></h5>
                <div class="table-responsive-md m-t-10">
                    <table id="search-tracker" class="table table-striped full-color-table full-dark-table hover-table" data-paging="true" data-paging-size="5">
                        <colgroup>
                            <col width="20%">
                            <col width="30%">
                            <col width="30%">
                            <col width="20%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Notes</th>
                                <th>Remarks</th>
                                <th>Date tracked</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="footable-empty"><td colspan="4">No results</td></tr>
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
<script src="{{ asset('assets/node_modules/footable/js/footable.min.js') }}"></script>
<!-- This is data table -->
<script src="{{ asset('assets/node_modules/datatables/datatables.min.js') }}"></script>
<!-- start - This is for export functionality only -->
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
<!-- end - This is for export functionality only -->

<script>
    $(document).ready(function() { 
        $('form#submitCode').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);

            $.ajax({
                method : 'GET',
                url    : form.attr('action'),
                data   : form.serialize(),
                success: function(data) {

                    console.log(data);

                    $('#results-bar').css('display', 'block'); 
                    $('table#search-tracker tbody tr').remove();  

                    $('#code-result').html(data.result);
                    $('#tracker-code').html(data.code);

                    if ( data.result > 0 )
                    {
                        $('input[name=tracking_code]').val(data.tracker.tracking_code);
                        $('input[name=date_created]').val(data.tracker.date_created);
                        $('input[name=created_by]').val(data.tracker.created_by);
                        $('input[name=document_type]').val(data.tracker.document_type);
                        $('input[name=subject]').val(data.tracker.subject);
                        $('input[name=details]').val(data.tracker.details);

                        $.each(data.results, function(index, item){
                            var row = appendTableRowSearch(item);
                            $('table#search-tracker tbody').append(row);
                        });

                        $('#search-tracker').trigger('footable_initialize');
                    } else {
                        $('table#search-tracker tbody').append('<tr class="footable-empty"><td colspan="4">No results</td></tr>');
                    }
                },
                error  : function(xhr, err) {
                    swal({
                        title: "Error!",
                        text:  "Could not retrieve the data.",
                        type: "error"
                    })
                }
            });

            return false;
        });

        // row to be added
        function appendTableRowSearch (item) {

            if (item.deleted) {
                $tr = '<tr class="table-danger">';
            } else {
                $tr = '<tr>';
            }

            var row = $( $tr +
                            '<td>' + 
                                '<h5 class="font-weight-bold">' + item.action + '</h5>' +
                                item.recipients +
                            '</td>' +
                            '<td>' + item.notes + '</td>' +
                            '<td>' + item.remarks + '</td>' +
                            '<td>' + item.date_time + '</td>' +
                        '</tr>');
            return row;
        }
    });
</script>
<script>
    $('#example23').DataTable({
        dom: '<<"export">B>frt<"bottom"l<"float-right"i>p>',
        buttons: [
            'excel',
            'csv',
            'print',
            {
                extend: 'colvis'
            }
        ],
        initComplete: function(){
            $("div.export")
                .html('<div class="btn-group">'+
                        '<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Show column </button>' +
                        '<div class="dropdown-menu">' +
                            '<a class="dropdown-item" href="javascript:void(0)">Action</a>' +
                            '<a class="dropdown-item" href="javascript:void(0)">Another action</a>' +
                            '<a class="dropdown-item" href="javascript:void(0)">Something else here</a>' +
                            '<div class="dropdown-divider"></div>' +
                            '<a class="dropdown-item" href="javascript:void(0)">Separated link</a>' +
                        '</div>' +
                    '</div>');
        }   
    });
</script>
@endsection