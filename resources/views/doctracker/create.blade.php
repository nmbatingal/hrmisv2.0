@extends('layouts.app')

@section('styles')
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
@endsection

@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-12">
        <h4 class="text-white">Create New Tracker</h4>
    </div>
    <div class="col-md-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('doctracker.index') }}">Document Tracker</a></li>
            <li class="breadcrumb-item active">Create New Tracker</li>
        </ol>
    </div>
    <!-- <div class="col-md-6 text-right">
        <form class="app-search d-none d-md-block d-lg-block">
            <input type="text" class="form-control" placeholder="Search &amp; enter">
        </form>
    </div> -->
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Over Visitor, Our income , slaes different and  sales prediction -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-lg-12">
        <div class="card ">
            <div class="card-body">
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                    <h3 class="text-info"><i class="fa fa-exclamation-circle"></i> Information</h3> This is an example top alert. You can edit what u wish. Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.
                </div>

                <form action="{{ route('doctracker.store') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-body">
                        <!-- PERSONAL INFORMATION ROW -->
                        <h3 class="m-t-20 box-title">Document Info</h3>
                        <hr class="m-t-0 m-b-40">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row m-b-0">
                                    <label class="control-label text-right col-md-2">Subject</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="subject" placeholder="enter subject" required autofocus>
                                        <small class="form-control-feedback">&nbsp;</small> 
                                    </div>
                                </div>
                                <div class="form-group row m-b-0">
                                    <label class="control-label text-right col-md-2">Document Type</label>
                                    <div class="col-md-4">
                                        <select class="select2 form-control custom-select" name="docType" required>
                                            <option value="">-- Select document type --</option>
                                            @forelse( $docTypes as $doctype )
                                                <option value="{{ $doctype->id }}">{{ $doctype->document_name }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                        <small class="form-control-feedback">&nbsp;</small> 
                                    </div>
                                    <label class="control-label text-right col-md-2">Document Date</label>
                                    <div class="col-md-4">
                                        <input type="date" class="form-control" name="document_date" required>
                                        <small class="form-control-feedback">&nbsp;</small> 
                                    </div>
                                </div>
                                <div class="form-group row m-b-20">
                                    <label class="control-label text-right col-md-2">Keywords</label>
                                    <div class="col-md-10">
                                        <input id="keywords" type="text" class="" data-role="tagsinput" name="keywords" placeholder="add keywords" required>
                                        <br><small class="form-control-feedback">Separate keywords using enter or comma key.</small> 
                                    </div>
                                </div>
                                <div class="form-group row m-b-0">
                                    <label class="control-label text-right col-md-2">Document Details</label>
                                    <div class="col-md-10">
                                        <textarea class="form-control" name="details" rows="4"></textarea>
                                        <small class="form-control-feedback">&nbsp;</small> 
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-2">Attachments</label>
                                    <div class="col-md-10">
                                        <input type="file" class="form-control" name="attachments[]" accept=".pdf" multiple>
                                        <small class="form-control-feedback">Select pdf files only. </small> 
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- OTHER INFORMATION -->
                        <h3 class="m-t-40 box-title">Routing Details</h3>
                        <hr class="m-t-0 m-b-40">
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-12">
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
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="float-right">
                                    <button type="submit" class="btn btn-lg btn-success"><i class="icon-share-alt"></i> Submit</button>
                                    <button type="button" class="btn btn-lg btn-inverse">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
<!-- CUSTOM JS CODES -->
<script type="text/javascript">
    $(document).ready(function() {
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
<script>
    $(function () {

        $('input#keywords').tagsinput({
            confirmKeys: [186]
        });

        $('select[name=action]').on('change', function(){
            if ( this.value == "Forward") {
                $('div#routeAction').css('display', 'block');
            } else {
                $('div#routeAction').css('display', 'none');
            }
        });

        $(".select2").select2();
    });
</script>
@endsection