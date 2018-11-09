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
        <h4 class="text-white">Received Documents</h4>
    </div>
    <div class="col-md-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('doctracker.dashboard') }}">Document Tracker</a></li>
            <li class="breadcrumb-item active">Received Documents</li>
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
                <h4 class="card-title">Received Documents</h4>
                <p class="card-text">List of forwarded documents with tracking codes. Please receive the document first before proceeding.</p>

                <div class="table-responsive-md m-t-20">
                    <table id="demo-foo-pagination" class="table table-bordered table-hover table-striped" data-paging="true" data-paging-size="5">
                        <thead>
                            <tr>
                                <th>Tracking Code</th>
                                <th>Action</th>
                                <th>Action by</th>
                                <th>Recipient</th>
                                <th>Received</th>
                                <th>Subject</th>
                                <th>Date & Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse( $receivedDocuments as $document )
                                <tr>
                                    <td>
                                        @if ( $document->action == 'Forward' )
                                            @if ( $document->recipient_id == Auth::user()->id )
                                                @if (  !$document->recipient_received )
                                                    {{ $document->tracking_code }}
                                                @else
                                                    <a href="{{ route('doctracker.showReceivedDocument', $document->tracking_code)}}" target="_blank">{{ $document->tracking_code }}</a>
                                                @endif
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <strong>{{ $document->action }}</strong>
                                    </td>
                                    <td>
                                        {{ $document->userEmployee->fullName }}
                                        <br><small>{{ $document->office->division_name }}</small>
                                    </td>
                                    <td>
                                        {{ $document->recipient->fullName }}
                                        <br><small>{{ $document->office->division_name }}</small>
                                    </td>
                                    <td class="text-center">
                                        @if ( $document->action == 'Forward' )
                                            @if ( $document->recipient_id == Auth::user()->id )
                                                @if (  !$document->recipient_received )
                                                    <br>
                                                    <button class="btn btn-sm btn-primary" 
                                                            onclick="receiveDocument(this)"
                                                            data-log-id="{{ $document->id }}" >
                                                        <i class="mdi mdi-file-check"></i> Receive
                                                    </button>
                                                @else
                                                    Yes
                                                @endif
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        {{ $document->documentCode->subject }}
                                        @if ( !is_null($document->documentCode->attachment) )
                                            <span class="float-right"><i class="fas fa-file-pdf"></i></span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $document->dateAction }}
                                        <br>({{ $document->diffForHumans }})
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
                enabled: true
            }
        });
    });
</script>
<script>
    function receiveDocument(document) {

        var log_id = document.getAttribute("data-log-id");
        var token = $("input[name=_token]").val();

        $.ajax({
            method: 'POST',
            url: "{{ route('doctracker.recieveForwaredDocument') }}",
            data: { log_id:log_id, _token:token},
            success: function(data) {
                if ( data.result )
                {
                    window.location = data.url;
                }
            }
        });
    }
</script>
@endsection