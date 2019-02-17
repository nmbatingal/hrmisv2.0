@extends('layouts.optima.app')

@section('title')
Create new tracker
@endsection

@section('styles')
<link href="{{ asset('assets/node_modules/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
<!-- <link href="{{ asset('assets/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" /> -->
<link rel="stylesheet" href="{{ asset('js/node_modules/materialize-tags/dist/css/materialize-tags.min.css') }}">
<link href="{{ asset('assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<style type="text/css">
    .bootstrap-tagsinput {
        width: 100% !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background: #fb9678;
        color: #fff;
        border-color: #fb9678;
    }
</style>
@endsection

@section('navbutton')
<!-- Help -->
<!-- ============================================================== -->
<li class="nav-item"> 
    <a class="nav-link  waves-effect waves-light" href="{{ route('optima.about') }}" title="Help"><i class="mdi mdi-help"></i></a>
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
        <h4 class="text-white">Create New Tracker</h4>
    </div>
    <div class="col-md-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('optima.index') }}">OPTIMA</a></li>
            <li class="breadcrumb-item active">Create New Tracker</li>
        </ol>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Over Visitor, Our income , slaes different and  sales prediction -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-info">
            <i class="mdi mdi-information p-r-10"></i> Please fill out the fields below completely before submitting the form. 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
        </div>
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle p-r-10"></i> Fields with asterisk (*) are required.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
        </div>

        <div class="card border-dark">
            <div class="card-header bg-dark">
                <h4 class="m-b-0 text-white">Document Information</h4>
            </div>
            <div class="card-body">
                <form class="form-material">
                    <div class="form-body">
                        <div class="row form-group">
                            <div class="col-md-12">
                                <input type="text" name="subject" class="form-control form-control-line" placeholder="Subject *" required autofocus>
                            </div> 
                            <div class="col-md-2" style="display: none;">
                                <input type="text" name="documentDate" class="form-control form-control-line mdate" placeholder="Document Date *" required>
                                <span class="help-block text-muted"><small>Document Date *</small></span>
                            </div> 
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <input type="text" id="keywords" name="keywords" data-role="materialtags" class="form-control form-control-line" placeholder="add keyword" required>
                                <span class="help-block text-muted"><small>Separate keywords using enter key.</small></span>
                            </div> 
                        </div>

                        <div class="form-group">
                            <label for="example-email">Email <span class="help"> e.g. "example@gmail.com"</span></label>
                            <input type="email" id="example-email2" name="example-email" class="form-control" placeholder="Email"> </div>
                        <div class="form-group">
                            <label>Placeholder</label>
                            <input type="text" class="form-control" placeholder="placeholder"> </div>
                        <div class="form-group">
                            <label>Text area</label>
                            <textarea class="form-control" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Input Select</label>
                            <select class="form-control">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Helping text</label>
                            <input type="text" class="form-control form-control-line"> <span class="help-block text-muted"><small>A block of help text that breaks onto a new line and may extend beyond one line.</small></span>
                        </div>
                    </div>
                </form>

                <form id="formCreate" action="{{ route('optima.my-documents.store') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <!-- PERSONAL INFORMATION ROW -->
                        <h3 class="box-title">Document Info</h3>
                        <hr class="m-t-0 m-b-40">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row m-b-0">
                                    <label class="control-label text-right col-md-2">Subject <span class="text-primary">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control"  placeholder="enter subject" required autofocus>
                                        <small class="form-control-feedback">&nbsp;</small> 
                                    </div>
                                </div>
                                <div class="form-group row m-b-0">
                                    <label class="control-label text-right col-md-2">Document Type <span class="text-primary">*</span></label>
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
                                    <div id="specifyDocument" class="col-md-6" style="display: none;">
                                        <input type="text" class="form-control" name="otherDocument" placeholder="Please specify" required>
                                        <small class="form-control-feedback">&nbsp;</small> 
                                    </div>

                                </div>
                                <div class="form-group row m-b-0">
                                    <label class="control-label text-right col-md-2">Document Date <span class="text-primary">*</span></label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control mdate" placeholder="Select date document created" required>
                                        <small class="form-control-feedback">&nbsp;</small> 
                                    </div>

                                </div>
                                <div class="form-group row m-b-20">
                                    <label class="control-label text-right col-md-2">Keywords <span class="text-primary">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="" data-role="tagsinput" placeholder="add keywords" required>
                                        <br><small class="form-control-feedback">Separate keywords using enter or comma key.</small> 
                                    </div>
                                </div>
                                <div class="form-group row m-b-0">
                                    <label class="control-label text-right col-md-2">Document Details <span class="text-primary">*</span></label>
                                    <div class="col-md-10">
                                        <textarea class="form-control" name="details" rows="3" required></textarea>
                                        <small class="form-control-feedback">&nbsp;</small> 
                                    </div>
                                </div>
                                <!-- <div class="form-group row">
                                    <label class="control-label text-right col-md-2">Attachments</label>
                                    <div class="col-md-10">
                                        <input type="file" class="form-control" name="attachments[]" accept=".pdf" multiple>
                                        <small class="form-control-feedback">Select pdf files only. </small> 
                                    </div>
                                </div> -->
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
                                    <div class="col-md-4">
                                        <select class="form-control custom-select" name="routedBy" disabled>
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

                                    <label class="control-label text-right col-md-2">Routing Division</label>
                                    <div class="col-md-4">
                                        <select class="form-control custom-select" name="routeDiv" disabled>
                                            <option value="">-- Select office --</option>
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

                                <!-- SHOW DIV ON ACTION CHANGE TO FORWARDED -->
                                <div class="form-group row m-b-0">
                                    <label class="control-label text-right col-md-2">Action</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="action" value="Forward" readonly>
                                        <small class="form-control-feedback">&nbsp;</small> 
                                    </div>
                                </div>

                                <div class="form-group row m-b-0">
                                    <label class="control-label text-right col-md-2">Route Mode <span class="text-primary">*</span></label>
                                    <div class="col-md-10">
                                        <select class="form-control custom-select" name="routeMode">
                                            <option value="all">All Employee</option>
                                            <option value="group">Group</option>
                                            <option value="individual">Individual</option>
                                        </select>
                                        <small class="form-control-feedback">&nbsp;</small> 
                                    </div>
                                </div>

                                <div id="sendRoute" style="display: none;">
                                    <div class="form-group row m-b-0">
                                        <label class="control-label text-right col-md-2">Route to</label>
                                        <div class="col-md-10">
                                            <select id="recipient" class="select2 form-control select2-multiple" name="recipients[]" multiple="multiple">
                                                <option value="">Select employee</option>
                                            </select>
                                            <small class="form-control-feedback">&nbsp;</small> 
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row m-b-0">
                                    <label class="control-label text-right col-md-2">Note</label>
                                    <div class="col-md-10">
                                        <textarea class="form-control" name="note" rows="1"></textarea>
                                        <small class="form-control-feedback">Additional notes on routing the document.</small> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="m-t-30 m-b-0">
                    <!-- progress bar -->
                    <div id="upload-progress" class="progress m-t-0 m-b-20">
                        <div class="progress-bar bg-success wow animated progress-animated" style="width: 0%; height:3px;" role="progressbar"></div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="float-right">
                                    <button id="submit-btn" type="submit" class="btn btn-lg btn-success"><i id="spinner" style="display: none;" class="fas fa-spinner fa-spin"></i> Submit</button>
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
<script src="{{ asset('assets/node_modules/moment/moment.js') }}"></script>
<script src="{{ asset('assets/node_modules/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
<!-- <script src="{{ asset('assets/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script> -->
<script src="{{ asset('js/node_modules/materialize-tags/dist/js/materialize-tags.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $('.mdate').bootstrapMaterialDatePicker({ weekStart: 0, time: false });
        $('input[name=documentDate]').bootstrapMaterialDatePicker('setDate', moment());

        $("select[name=routeMode]").change(function(){
            
            var $id = $(this).val();
            var token = $("input[name=_token]").val();

            if ( $id == 'all')
            {
                $('div#sendRoute').css('display', 'none');
                $("select#recipient").html('');

            } else {

                $('div#sendRoute').css('display', 'block');
                $.post( "{{ route('optima.recipients') }}", { office_id: $id, _token:token})
                    .done( function( data ) {
                        $("select#recipient").attr('disabled', false);
                        $("select#recipient").html('');
                        $("select#recipient").html(data.options);
                    });
            }
        });

        $("select[name=docType]").change(function(){
            
            var $document = $("select[name=docType] option:selected").text();
            console.log($document);

            if ( $document == 'Others')
            {
                $('div#specifyDocument').css('display', 'block');
                $("input[name=otherDocument]").val('');

            } else {
                $('div#specifyDocument').css('display', 'none');
                $("input[name=otherDocument]").val($document);
            }
        });

        // sweetalert
        $('form#formCreate').on('submit', function(e) {

            e.preventDefault();
            var form = $(this); 

            $('#spinner').css('display', 'inline-block');
            $('#submit-btn').attr('disabled', 'disabled');

            $.ajax({
                method : 'POST',
                url    : form.attr('action'),
                data   : form.serialize(),
                xhr: function() {
                    //upload Progress
                    var xhr = $.ajaxSettings.xhr();
                    if (xhr.upload) {
                        xhr.upload.addEventListener('progress', function(event) {
                            var percent = 0;
                            var position = event.loaded || event.position;
                            var total = event.total;
                            if (event.lengthComputable) {
                                percent = Math.ceil(position / total * 100);
                            }
                            //update progressbar
                            $("#upload-progress .progress-bar").css("width", + percent +"%");
                        }, true);
                    }
                    return xhr;
                },
                success: function(data) {
                    if (data.result) {

                        $('#spinner').css('display', 'none');

                        var url = "{{ route('print.barcode', ':var') }}";
                            url = url.replace(':var', data.tracker);

                        var dialog = Swal.fire({
                                        text:  "Document tracker successfully saved. Tracking Code " + data.tracker,
                                        type: "success",
                                        showConfirmButton: true,
                                        showCancelButton: true,
                                        onOpen: function(swal) {

                                            var swalCancel = $(swal).find('.swal2-cancel');

                                            swalCancel.removeClass('swal2-styled')
                                                        .addClass('btn btn-lg btn-danger')
                                                        .html('<i class="ti-printer"></i> Print Code');

                                            swalCancel.off().click(function(e) {
                                                window.open(url, "Print Barcode", "width=800,height=600");
                                            });
                                      }
                                });

                    } else {
                        Swal.fire({
                            title: "Error!",
                            text:  "Data unsuccessfully saved.",
                            type: "error"
                        }).then( function() {
                           $("#upload-progress .progress-bar").css("width", 0);
                        });
                    }
                },
                error  : function(xhr, err) {
                    Swal.fire({
                        title: "Error!",
                        text:  "Could not process data.",
                        type: "error"
                    }).then( function() {
                       $("#upload-progress .progress-bar").css("width", 0);
                    });
                }
            });

            return false;
        });
    });
</script>
<script>
    $(function () {

        // $('input#keywords').tagsinput({ confirmKeys: [186] });
        $("input#keywords").materialtags();

        $(".select2").select2({
            'width': '100%'
        });
    });
</script>
@endsection