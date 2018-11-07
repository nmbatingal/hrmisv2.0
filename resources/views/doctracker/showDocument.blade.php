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
        <h4 class="text-white">My Documents</h4>
    </div>
    <div class="col-md-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('doctracker.dashboard') }}">Document Tracker</a></li>
            <li class="breadcrumb-item"><a href="{{ route('doctracker.mydocuments') }}">My Documents</a></li>
            <li class="breadcrumb-item active">{{ $myDocument->tracking_code }}</li>
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
                <h4 class="card-title">Tracking Code: {{ $myDocument->tracking_code }}
                    <a href="{{ route('doctracker.create') }}" class="btn btn-rounded btn-primary float-right">Create new tracker</a>
                </h4>
                <p class="card-text">List of documents with tracking codes. Search a document using tracking code or <a href="{{ route('doctracker.create') }}">create a new document</a> to be tracked.</p>



                <h4 class="card-title m-t-40">Tracking Log</h4>
                <div class="table-responsive-md">
                    <table id="demo-foo-pagination" class="table table-hover color-table dark-table" data-paging="true" data-paging-size="5">
                        <thead>
                            <tr class="footable-filtering">
                                <th>Routed by</th>
                                <th>Routing Division</th>
                                <th>Recipient</th>
                                <th>Action</th>
                                <th>Note</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse( $trackLogs as $log )
                                <tr>
                                    <td>
                                        {{ $log->tracking_code }}
                                    </td>
                                    <td>
                                        {{ $log->tracking_code }}
                                    </td>
                                    <td>
                                        {{ $log->tracking_code }}
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)">{{ $log->action }}</a>
                                    </td>
                                    <td>
                                        {{ $log->remarks }}
                                    </td>
                                    <td>
                                        {{ $log->created_at }}
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
    });

</script>
@endsection