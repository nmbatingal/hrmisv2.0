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
        <h4 class="text-white">Tracking Logs</h4>
    </div>
    <div class="col-md-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('doctracker.dashboard') }}">Document Tracker</a></li>
            <li class="breadcrumb-item active">Logs</li>
        </ol>
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
                <h4 class="card-title">Tracking Logs</h4>
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

                <h5 class="card-subtitle">Showing <span id="code-result">{{ count($documents) }}</span> results for tracking code <u id="tracker-code">{{ request('code') }}</u></h5>
                <div class="table-responsive-md m-t-10">
                    <table id="search-tracker" class="table table-striped table-hover color-table dark-table" data-paging="true" data-paging-size="5">
                        <thead>
                            <tr>
                                <th>Tracking code</th>
                                <th>Action</th>
                                <th>Action by</th>
                                <th>Recipient</th>
                                <th>Date tracked</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ( $documents as $document )
                                <tr>
                                    <td>
                                        <a href="javascript:void(0)">
                                            {{ $document->tracking_code }}
                                        </a>
                                    </td>
                                    <td>
                                        <strong>{{ $document->action }}</strong>
                                    </td>
                                    <td>
                                        {{ $document->userEmployee->fullName }}
                                        <br><small>{{ $document->office->division_name }}</small>
                                    </td>
                                    <td>
                                        @if ( $document->recipient )
                                            {{ $document->recipient->fullName }}
                                            <br><small>{{ $document->office->division_name }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $document->dateAction }}
                                        <br>({{ $document->diffForHumans }})
                                    </td>
                                </tr>
                            @empty
                                <tr class="footable-empty"><td colspan="5">No results</td></tr>
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
                enabled: false
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

                    $('#code-result').html(data.result);
                    $('#tracker-code').html(data.code);

                    $('table#search-tracker tbody tr').remove();  
                    $.each(data.results, function(index, item){
                        var row = appendTableRowSearch(item);
                        $('table#search-tracker tbody').append(row);
                    });

                    $('#search-tracker').trigger('footable_initialize');
                },
                error  : function(xhr, err) {
                    alert("Error! Could not retrieve the data.");
                }
            });

            return false;
        });

        // row to be added
        function appendTableRowSearch (item) {
            var row = $('<tr>' +
                            '<td><a href="javascript:void(0)" target="_blank">' + item.tracking_code + '</a></td>' +
                            '<td>' + item.action + '</td>' +
                            '<td>' + item.from + '<br><small>' + item.from_office + '</small></td>' +
                            '<td>' + item.received_by + '<br><small>' + item.received_office + '</small></td>' +
                            '<td>' + item.dateTime + '</td>' +
                        '</tr>');
            return row;
        }
    });
</script>
@endsection