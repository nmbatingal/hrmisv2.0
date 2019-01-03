@extends('layouts.app')

@section('title')
-OPTIMA | Logs
@endsection

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
                <h3 class="card-title">Tracking Logs</h3>
                <p class="card-text">Search for a document using tracking code.</p>
                
                <form id="submitCode" action="{{ route('doctracker.search') }}" class="form-horizontal" method="GET">
                    <div class="row p-t-20">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <div class="input-group p-0">
                                    <input type="text" class="form-control" name="code" placeholder="Enter tracking code" value="{{ request('code') }}" required autofocus>
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
                                    <label class="control-label text-right col-md-2">Keywords</label>
                                    <div id="keywords" class="col-md-10">

                                    </div>
                                </div>
                            </div>
                        </div>
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
                                <th>User</th>
                                <th>Action</th>
                                <th>Notes</th>
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
<!-- This is data table -->
<script src="{{ asset('assets/node_modules/datatables/datatables.min.js') }}"></script>
<!-- Footable -->
<script src="{{ asset('assets/node_modules/moment/moment.js') }}"></script>
<script src="{{ asset('assets/node_modules/footable/js/footable.min.js') }}"></script>
<script>
    $(document).ready(function() { 

        //
        $('[data-page-size]').on('click', function(e){
            e.preventDefault();
            var newSize = $(this).data('pageSize');
            FooTable.get('#demo-foo-pagination').pageSize(newSize);
        });
        $('#demo-foo-pagination').footable({
            filtering: {
                enabled: true
            }
        });

        $('form#submitCode').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);

            $.ajax({
                method : 'GET',
                url    : form.attr('action'),
                data   : form.serialize(),
                success: function(data) {

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
            var row = $('<tr>' +
                            '<td>' + item.created_by + '</td>' +
                            '<td>' + 
                                '<h5 class="font-weight-bold">' + item.action + '</h5>' +
                                item.recipients +
                            '</td>' +
                            '<td>' + item.notes + '</td>' +
                            '<td>' + item.date_time + '</td>' +
                        '</tr>');
            return row;
        }
    });
</script>
@endsection