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
        <h4 class="text-white">My Documents</h4>
    </div>
    <div class="col-md-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('doctracker.dashboard') }}">Document Tracker</a></li>
            <li class="breadcrumb-item active">My Documents</li>
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
                <p class="card-text">List of created documents with tracking codes. Search a document using tracking code or <a href="{{ route('doctracker.create') }}">create a new document</a> to track.</p>

                <div class="table-responsive-md m-t-20">
                    <table id="demo-foo-pagination" class="table table-hover table-striped" data-paging="true" data-paging-size="5">
                        <thead>
                            <tr class="footable-filtering">
                                <th>Tracking Code</th>
                                <th>Subject</th>
                                <th>Document type</th>
                                <th>Tracking status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse( $myDocuments as $document )
                                <tr>
                                    <td>
                                        <h5>
                                            <a href="{{ route('doctracker.showDocument', $document->tracking_code)}}" target="_blank">{{ $document->tracking_code }}</a>
                                        </h5>
                                    </td>
                                    <td>
                                        <h5 class="font-weight-bold">{{ $document->subject }}</h5>
                                        {{ $document->tracking_date }} 
                                    </td>
                                    <td>
                                        {{ $document->other_document }}
                                    </td>
                                    <td>
                                        <h5 class="font-weight-bold">{!! $document->action !!}</h5>
                                        
                                        @if ( $document->action == "Forward")
                                            <ul class="p-l-20 m-b-0">
                                                @if ( !is_null( $document->recipients ) )
                                                    @foreach( json_decode($document->recipients) as $recipient)
                                                        <li>{{ $recipient->name }}</li>
                                                    @endforeach
                                                @else
                                                    <li>All</li>
                                                @endif
                                            </ul>
                                        @else
                                            <strong>{{ $document->userEmployee->full_name }}</strong><br>
                                        @endif
                                        {!! $document->lastTracked() !!}
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
    });

</script>
@endsection