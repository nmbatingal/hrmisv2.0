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
        <h4 class="text-white">{{ $myDocument->tracking_code }}</h4>
    </div>
    <div class="col-md-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('doctracker.dashboard') }}">Document Tracker</a></li>
            <li class="breadcrumb-item"><a href="{{ route('doctracker.mydocuments') }}">My Documents</a></li>
            <li class="breadcrumb-item active">{{ $myDocument->tracking_code }}</li>
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
            <div class="card-header bg-primary">
                <h4 class="m-b-0 text-white">Routing Details </h4>
            </div>
            <div class="card-body">
                <h4 class="card-title"></h4>
                <form class="form-horizontal" role="form">
                    <div class="form-body">
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-4 p-t-5">Code:</label>
                                    <div class="col-md-8">
                                        {!! $myDocument->barcodeLogo !!} 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="float-right">
                                            <a href="{{ route('print.barcode', $myDocument->id) }}" target="_blank" class="btn btn-outline-primary"><i class="ti-printer"></i> Print Code</a>
                                            <a href="javascript:void(0);" class="btn btn-outline-info"><i class="ti-pencil-alt"></i> Update Tracker</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="m-t-0 m-b-40">
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-4 p-t-5">Routed By:</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" value="{{ $myDocument->userEmployee->full_name }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3 p-t-5">Division:</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="{{ $myDocument->userEmployee->office->division_name }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-2 p-t-5">Subject:</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="{{ $myDocument->subject }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-4 p-t-5">Document Type:</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" value="{{ $myDocument->other_document }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3 p-t-5">Document Date:</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="{{ $myDocument->dateOfDocument }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-2 p-t-5">Details:</label>
                                    <div class="col-md-10">
                                        <textarea class="form-control" rows="4" disabled>{{ $myDocument->details }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-2">Attachments:</label>
                                    <div class="col-md-10">
                                        <p class="form-control-static">
                                            @forelse ( $myDocument->docAttachments as $file )
                                                <a href="{{ asset($file->filepath) }}" target="_blank" class="text-underlined p-r-20">
                                                    <i class="fas fa-file-pdf"></i> {{ $file->filename }}
                                                </a><br>
                                            @empty
                                                <small>no attachments available</small>
                                            @endforelse
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card border-primary">
            <div class="card-header bg-primary">
                <h4 class="m-b-0 text-white">Tracking History</h4>
            </div>
            <div class="card-body">
                <h4 class="card-title">Tracking code: {{ $myDocument->tracking_code }}</h4>
                <h6 class="card-subtitletitle">Order of log is from latest to oldest.</h6>
                <div class="table-responsive-md m-t-20">
                    <table id="demo-foo-pagination" class="table table-striped full-color-table full-dark-table hover-table" data-paging="true" data-paging-size="5">
                        <colgroup>
                            <col width="">
                            <col width="15%">
                            <col width="">
                            <col width="30%">
                            <col width="30%">
                            <col width="20%">
                        </colgroup>
                        <thead>
                            <tr class="footable-filtering">
                                <th></th>
                                <th>User</th>
                                <th>Action</th>
                                <th></th>
                                <th>Notes</th>
                                <th>Date & Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse( $trackLogs as $log )
                                <tr>
                                    <td></td>
                                    <td><h5>{{ $log->userEmployee->full_name }}</h5></td>
                                    <td>
                                        {!! $log->log_action !!}
                                    </td>
                                    <td>
                                        <ul>
                                        @if ( !is_null($log->recipients) )
                                            @forelse ($log->recipients as $recipient)
                                                <li> {!! $recipient['name'] !!}</li>
                                            @empty
                                            @endforelse
                                        @endif
                                        </ul>
                                    </td>
                                    <td>
                                        {{ $log->notes }}
                                    </td>
                                    <td>
                                        {{ $log->dateAction }}
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
                enabled: false
            }
        });
    });

</script>
@endsection