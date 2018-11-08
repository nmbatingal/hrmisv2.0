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
                <h4 class="card-title">
                    <a href="{{ route('doctracker.create') }}" class="btn btn-rounded btn-primary float-right">Create new tracker</a>
                </h4>

                <form class="form-horizontal m-t-30" role="form">
                    <div class="form-body">
                        <h3 class="box-title">Routing Details <strong>{{ $myDocument->tracking_code }}</strong></h3>
                                        
                        <hr class="m-t-0 m-b-40">
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-2 p-t-5">Code:</label>
                                    <div class="col-md-10">
                                        {!! $myDocument->barcodeLogo !!} 
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
                                        <input type="text" class="form-control" value="{{ $myDocument->documentType->document_name }}" disabled>
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
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-4 p-t-5">Routed By:</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" value="{{ $myDocument->userEmployee->fullName }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3 p-t-5">Division:</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="{{ $myDocument->userDivision->officeFullTitle }}" disabled>
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
                                            <a href="javascript:void(0)" class="text-underlined p-r-20">
                                                <i class="fas fa-file-pdf"></i> {{ $myDocument->subject }}
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="row m-t-10 m-b-40">
                    <div class="offset-md-2 col-md-10">
                        <a href="javascript:void(0);" class="btn btn-outline-primary"><i class="ti-printer"></i> Print Code</a>
                        <a href="javascript:void(0);" class="btn btn-outline-info"><i class="ti-pencil-alt"></i> Update Tracker</a>
                        <a href="javascript:void(0);" class="btn btn-outline-danger"><i class="icon-lock"></i> Close Tracker</a>
                    </div>
                </div>

                <h4 class="card-title m-t-40">Tracking Log: <i>{{ $myDocument->tracking_code }}</i></h4>
                <div class="table-responsive-md">
                    <table id="demo-foo-pagination" class="table table-hover color-table dark-table" data-paging="true" data-paging-size="5">
                        <thead>
                            <tr class="footable-filtering">
                                <th>Routed by</th>
                                <th>Routing Division</th>
                                <th>Recipient</th>
                                <th>Action</th>
                                <th>Note</th>
                                <th>Date & Time</th>
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