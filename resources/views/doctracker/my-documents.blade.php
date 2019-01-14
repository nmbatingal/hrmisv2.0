@extends('layouts.app')

@section('title')
-OPTIMA | My Documents
@endsection

@section('styles')
<link href="{{ asset('assets/node_modules/datatables/media/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
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
            <li class="breadcrumb-item"><a href="{{ route('doctracker.dashboard') }}">OPTIMA</a></li>
            <li class="breadcrumb-item active">My Documents</li>
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
            <div class="card-body">
                <h3 class="card-title">My Documents</h3>
                <p class="card-text">List of created documents with tracking codes. Search a document using tracking code or <a href="{{ route('doctracker.create') }}">create a new document</a> to track.</p>

                <!-- INFO CARDS -->
                <div class="row">
                    <!-- Document Created -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="d-flex flex-row" style="border: 1px solid #00c292;">
                                <div class="p-10 bg-success">
                                    <h3 class="text-white box m-b-0"><i class="icon-docs"></i></h3></div>
                                <div class="align-self-center m-l-20">
                                    <h3 class="m-b-0 text-success"><span id="count-outgoing">{{ $documentsCreated->count() }}</span></h3>
                                    <h6 class="text-muted m-b-0">Documents Created</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Document Received -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="d-flex flex-row" style="border: 1px solid #01c0c8;">
                                <div class="p-10 bg-cyan">
                                    <h3 class="text-white box m-b-0"><i class="ti-import"></i></h3></div>
                                <div class="align-self-center m-l-20">
                                    <h3 class="m-b-0 text-success"><span id="count-outgoing">{{ $documentsReceived->count() }}</span></h3>
                                    <h6 class="text-muted m-b-0">Documents Received</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Document Released -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="d-flex flex-row" style="border: 1px solid #03a9f3;">
                                <div class="p-10 bg-info">
                                    <h3 class="text-white box m-b-0"><i class="icon-cursor"></i></h3></div>
                                <div class="align-self-center m-l-20">
                                    <h3 class="m-b-0 text-success"><span id="count-outgoing">{{ $documentsReleased->count() }}</span></h3>
                                    <h6 class="text-muted m-b-0">Documents Released</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Document Released -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="d-flex flex-row" style="border: 1px solid #e46a76;">
                                <div class="p-10 bg-danger">
                                    <h3 class="text-white box m-b-0"><i class="icon-doc"></i></h3></div>
                                <div class="align-self-center m-l-20">
                                    <h3 class="m-b-0 text-danger"><span id="count-release">-</span></h3>
                                    <h6 class="text-muted m-b-0">Documents</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Card table -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body p-b-0">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <form class="form-horizontal">
                                <div class="form-group m-b-0">
                                    <div class="input-group p-0">
                                        <input id="searchTracker" type="text" class="form-control" placeholder="Search document tracker">
                                        <div class="input-group-append">
                                            <button class="btn btn-info" type="submit">
                                                <i class="ti-search"></i>&nbsp;</button>
                                        </div>
                                    </div>
                                    <small class="form-control-feedback text-muted">&nbsp;</small> 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-t-0">
                <div class="table-responsive">
                    <table id="tableMyDocuments" class="table table-hover table-bordered table-striped">
                        <thead>
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
<!-- This is data table -->
<script src="{{ asset('assets/node_modules/datatables/datatables.min.js') }}"></script>
<script>
    $(document).ready(function() { 
        // DataTable for Tracker
        var trackerTable = $('#tableMyDocuments').DataTable({
            columnDefs: [{ 
                orderable: true 
            }],
            order: [
                [0, 'desc']
            ],
            dom: '<"top"l<"float-right"i>>rt<"bottom"p><"clear">'
        });

        // Custom Input Search for Table
        $('#searchTracker').keyup(function(){
            trackerTable.search($(this).val()).draw() ;
        })
    });

</script>
@endsection