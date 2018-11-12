@extends('layouts.app')

@section('styles')
<link href="{{ asset('assets/node_modules/datatables/media/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
<link href="{{ asset('dist/css/pages/footable-page.css') }}" rel="stylesheet">
<link href="{{ asset('assets/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<style type="text/css">
    .select2 {
        width: 100% !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background: #fb9678;
        color: #fff;
        border-color: #fb9678;
    }
</style>

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
            <li class="breadcrumb-item"><a href="{{ route('doctracker.mydocuments') }}">Incoming Documents</a></li>
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
                <!-- COLLAPSIBLE FORM -->
                <div class="accordion" id="accordionExample">
                    <div class="card m-b-0">
                        <!-- COLLAPSIBLE TRACKING CODE -->
                        <div class="card-header bg-white p-0" id="headingOne">
                            <h3 class="box-title" 
                                data-toggle="collapse" 
                                data-target="#collapseOne" 
                                aria-expanded="true" 
                                aria-controls="collapseOne">
                                Tracking Code <strong>{{ $myDocument->tracking_code }}</strong>
                            </h3>
                            <hr class="m-t-0">
                        </div>
                        <!-- COLLAPSIBLE TRACKING CODE FORM -->
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body p-0">
                                <form class="form-horizontal m-t-30" role="form">
                                    <div class="form-body">
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
                            </div>
                        </div>
                        <!-- END OF COLLAPSIBLE TRACKING CODE-->
                        <!-- COLLAPSIBLE ROUTING DETAILS -->
                        <div class="card-header bg-white p-0" id="headingTwo">
                            <h3 class="box-title" 
                                data-toggle="collapse" 
                                data-target="#collapseTwo" 
                                aria-expanded="true" 
                                aria-controls="collapseTwo">
                                Routing Details
                            </h3>
                            <hr class="m-t-0">
                        </div>
                        <!-- COLLAPSIBLE ROUTING DETAILS FORM-->
                        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body p-0">
                                <form action="{{ route('doctracker.forwardDocument') }}" method="POST" class="form-horizontal m-t-30" role="form">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="code" value="{{ $myDocument->code }}">
                                    <input type="hidden" name="tracking_code" value="{{ $myDocument->tracking_code }}">
                                    <div class="form-body">
                                        <!--/row-->
                                        <div class="form-group row m-b-0">
                                            <label class="control-label text-right col-md-2">Routed by</label>
                                            <div class="col-md-10">
                                                <select class="form-control custom-select" name="routedBy" disabled>
                                                    <option value="">-- Select action --</option>
                                                    @forelse( $userSelf as $user )
                                                        @if ( $user->id == Auth::user()->id )
                                                            <option value="{{ $user->id }}" selected>{{ $user->full_name }}</option>
                                                        @else
                                                            <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                                        @endif
                                                    @empty
                                                    @endforelse
                                                </select>
                                                <input type="hidden" name="routedBy" value="{{ Auth::user()->id }}">
                                                <small class="form-control-feedback">&nbsp;</small> 
                                            </div>
                                        </div>

                                        <div class="form-group row m-b-0">
                                            <label class="control-label text-right col-md-2">Routing Division</label>
                                            <div class="col-md-10">
                                                <select class="form-control custom-select" name="routeDiv" disabled>
                                                    <option value="">-- Select action --</option>
                                                    @forelse( $offices as $office )
                                                        @if ( $office->id == Auth::user()->office_id )
                                                            <option value="{{ $office->id }}" selected>{{ $office->division_name }}</option>
                                                        @else
                                                            <option value="{{ $office->id }}">{{ $office->division_name }}</option>
                                                        @endif
                                                    @empty
                                                    @endforelse
                                                </select>
                                                <input type="hidden" name="routeDiv" value="{{ Auth::user()->office_id }}">
                                                <small class="form-control-feedback">&nbsp;</small> 
                                            </div>
                                        </div>
                                        <!--/row-->
                                        <div class="form-group row m-b-0">
                                            <label class="control-label text-right col-md-2">Action</label>
                                            <div class="col-md-10">
                                                <select class="form-control custom-select" name="action" required>
                                                    <option value="">-- Select action --</option>
                                                    <option value="Forward">Forward</option>
                                                    <option value="Receive">Receive</option>
                                                    <option value="Close">Close</option>
                                                    <option value="Cancel">Cancel</option>
                                                </select>
                                                <small class="form-control-feedback">&nbsp;</small> 
                                            </div>
                                        </div>

                                        <!-- SHOW DIV ON ACTION CHANGE TO FORWARDED -->
                                        <div id="routeAction" style="display: none;">
                                            <div class="form-group row m-b-0">
                                                <label class="control-label text-right col-md-2">Route To</label>
                                                <div class="col-md-10">
                                                    <select class="select2 form-control custom-select" name="routeToOffice">
                                                        @forelse( $offices as $office )
                                                            <option value="{{ $office->id }}">{{ $office->division_name }}</option>
                                                        @empty
                                                        @endforelse
                                                    </select>
                                                    <small class="form-control-feedback">&nbsp;</small> 
                                                </div>
                                            </div>
                                            <div class="form-group row m-b-20">
                                                <label class="control-label text-right col-md-2"></label>
                                                <div class="col-md-10">
                                                    <select id="recipient" class="select2 form-control select2-multiple" name="recipient[]" multiple="multiple">
                                                        <option value="">Select office</option>
                                                    </select>
                                                    <br><small class="form-control-feedback">Leave blank if document will be routed to whole division.</small> 
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row m-b-0">
                                            <label class="control-label text-right col-md-2">Note</label>
                                            <div class="col-md-10">
                                                <textarea class="form-control" name="note" rows="4"></textarea>
                                                <small class="form-control-feedback">Additional notes on routing the document.</small> 
                                            </div>
                                        </div>

                                        <hr>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="float-right">
                                                        <button type="submit" class="btn btn-md btn-success"><i class="icon-share-alt"></i> Submit</button>
                                                        <button type="button" class="btn btn-md btn-inverse">Cancel</button>
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
                <!-- END OF COLLAPSIBLE FORM -->

                <h4 class="card-title m-t-40">Tracking Log: <i>{{ $myDocument->tracking_code }}</i></h4>
                <div class="table-responsive-md">
                    <table id="demo-foo-pagination" class="table table-striped table-hover color-table dark-table" data-paging="true" data-paging-size="5">
                        <thead>
                            <tr class="footable-filtering">
                                <th>Action</th>
                                <th>Action by</th>
                                <th>Recipient</th>
                                <th>Note</th>
                                <th>Date & Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse( $trackLogs as $log )
                                <tr>
                                    <td>
                                        <strong>{{ $log->action }}</strong>
                                    </td>
                                    <td>
                                        {{ $log->userEmployee->fullName }}
                                        <br><small>{{ $log->office->division_name }}</small>
                                    </td>
                                    <td>
                                        @if ( $log->recipient )
                                            {{ $log->recipient->fullName }}
                                            <br><small>{{ $log->recipient->office->division_name }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $log->notes }}
                                    </td>
                                    <td>
                                        {{ $log->dateAction }}
                                        <br>({{ $log->diffForHumans }})
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
<script src="{{ asset('assets/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
<!-- This is data table -->
<script src="{{ asset('assets/node_modules/datatables/datatables.min.js') }}"></script>
<!-- Footable -->
<script src="{{ asset('assets/node_modules/moment/moment.js') }}"></script>
<script src="{{ asset('assets/node_modules/footable/js/footable.min.js') }}"></script>
<!-- CUSTOM JS CODES -->
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

        $('select[name=action]').on('change', function(){
            if ( this.value == "Forward") {
                $('div#routeAction').css('display', 'block');
            } else {
                $('div#routeAction').css('display', 'none');
            }
        });

        $(".select2").select2();

        $("select[name=routeToOffice]").change(function(){
            
            var office_id = $(this).val();
            var token = $("input[name=_token]").val();

            $.ajax({
                method: 'POST',
                url: "{{ route('doctracker.recipientlist') }}",
                data: { office_id:office_id, _token:token},
                success: function(data) {
                    $("select#recipient").attr('disabled', false);
                    $("select#recipient").html('');
                    $("select#recipient").html(data.options);
                }
            });
        });
    });
</script>
@endsection