@extends('layouts.optima.app')

@section('title')
Create new tracker
@endsection

@section('styles')
<link href="{{ asset('assets/node_modules/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
<!-- <link href="{{ asset('assets/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" /> -->
<!-- <link rel="stylesheet" href="{{ asset('js/node_modules/materialize-tags/dist/css/materialize-tags.min.css') }}"> -->
<link href="{{ asset('assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('js/jQuery-tagEditor/jquery.tag-editor.css') }}" rel="stylesheet" type="text/css" />
<!-- <link href="{{ asset('js/node_modules/jquery-tags-input/dist/jquery.tagsinput.min.css') }}" rel="stylesheet" type="text/css" /> -->
<style type="text/css">
    /*.bootstrap-tagsinput {
        width: 100% !important;
        box-shadow: none;
        min-height: 38px;
        border: 1px solid #e9ecef;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background: #fb9678;
        color: #fff;
        border-color: #fb9678;
    }

    .select2-container--default .select2-selection--single {
        min-height: 38px;
        border: 1px solid #e9ecef;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 38px;
    }*/

    .form-control-line .form-group .form-control {
        padding: 0 10px;
    }

    .form-control-line .form-control:focus {
        border-bottom: none;
    }
</style>
@endsection

@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor font-weight-bold">Create New Tracker</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('optima.my-documents') }}">My Documents</a></li>
                <li class="breadcrumb-item active">Create New Tracker</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <!-- <div class="card-header bg-dark">
            <h4 class="m-b-0 text-white">Document Information</h4>
        </div> -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Document Routing Information</h4>
                    <h6 class="card-subtitle">Please fill out the fields below completely before submitting the form. </h6>
                    <hr>
                    <!-- <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle p-r-10"></i> Fields with asterisk (*) are required.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                    </div> -->
                    <div class="row p-40 p-b-0">
                        <div class="col-md-12">

                            <!-- DOCUMENT FIELD -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="select2 form-control custom-select" name="docType" required>
                                            <option value="">Document Type</option>
                                            @forelse( $docTypes as $doctype )
                                                <option value="{{ $doctype->id }}">{{ $doctype->document_name }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div id="specifyDocument" class="col-md-5" style="display: none;">
                                    <div class="form-group">
                                        <input id="otherDocument" type="text" class="form-control" name="otherDocument" placeholder="Please specify document type" required>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="form-group row">
                                <label class="control-label text-right col-md-2">Attachments</label>
                                <div class="col-md-10">
                                    <input type="file" class="form-control" name="attachments[]" accept=".pdf" multiple>
                                    <small class="form-control-feedback">Select pdf files only. </small> 
                                </div>
                            </div> -->
                            
                            <div id="routingInformation" style="display: none;">
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
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="float-right">
                                    <button id="submit-btn" type="submit" class="btn btn-lg btn-success"><i id="spinner" style="display: none;" class="fas fa-spinner fa-spin"></i> Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <div class="card border-dark">
            <div class="card-header bg-dark">
                <h4 class="m-b-0 text-white">Document Routing Form</h4>
            </div>
            <div class="card-body p-10">
                <!-- ALERT NOTIF -->
                <div class="alert alert-info alert-rounded"> 
                    <i class="mdi mdi-information-outline"></i> Please fill out the fields below completely before submitting the form.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                </div>

                <!-- FORM -->
                <form id="formCreate" action="{{ route('optima.my-documents.store') }}" method="POST" class="form-control-line" 
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row m-b-10" style="display: none;">
                        <div class="col-md-12 p-0">
                            <input type="text" name="documentDate" class="form-control mdate" placeholder="Document Date *">
                            <!-- <span class="help-block p-l-10 text-muted">
                                <small>A block of help text that breaks onto a new line and may extend beyond one line.</small>
                            </span> -->
                        </div>
                    </div>

                    <div class="form-group row m-b-10">
                        <div class="col-md-12 p-0">
                            <textarea class="form-control autosize" name="subject" rows="1" placeholder="Subject" required autofocus></textarea>
                            <!-- <span class="help-block p-l-10 text-muted">
                                <small>A block of help text that breaks onto a new line and may extend beyond one line.</small>
                            </span> -->
                        </div>
                    </div>

                    <div class="form-group row m-b-10">
                        <div class="col-md-12 p-0 form-control">
                            <input type="text" class="form-control form-control-line keywords" name="keywords" placeholder="add keywords" required>
                        </div>
                    </div>

                    <div class="form-group options">
                        <div class="custom-control custom-checkbox">
                            <input name="remarks[]" type="checkbox" class="custom-control-input" id="customCheck4" value="For signature." required>
                            <label class="custom-control-label" for="customCheck4">For signature. </label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input name="remarks[]" type="checkbox" class="custom-control-input" id="customCheck2" value="For action/compliance." required>
                            <label class="custom-control-label" for="customCheck2">For action/compliance. </label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input name="remarks[]" type="checkbox" class="custom-control-input" id="customCheck3" value="For information." required>
                            <label class="custom-control-label" for="customCheck3">For information. </label>
                        </div>
                    </div>

                    <div class="form-group row m-b-10">
                        <div class="col-md-12 p-0">
                            <textarea class="form-control autosize" name="note" rows="4" style="background-image: none;" placeholder="Enter notes here..."></textarea>
                            <!-- <span class="help-block p-l-10 text-muted">
                                <small>A block of help text that breaks onto a new line and may extend beyond one line.</small>
                            </span> -->
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="float-right">
                                    <button id="submit-btn" type="submit" class="btn btn-lg btn-success"><i id="spinner" style="display: none;" class="fas fa-spinner fa-spin"></i> Submit</button>
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
<script src="{{ asset('js/node_modules/jquery-validation/dist/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/node_modules/autosize/dist/autosize.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jQuery-tagEditor/jquery.caret.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jQuery-tagEditor/jquery.tag-editor.min.js') }}" type="text/javascript"></script>
<!-- <script src="{{ asset('js/node_modules/jquery-tags-input/dist/jquery.tagsinput.min.js') }}" type="text/javascript"></script> -->
<script type="text/javascript">
    $(document).ready(function() {

        // $("#keywords").tagsInput();
        $(".keywords").tagEditor({
            delimiter: ',;', /* space and semicolon */
            placeholder: 'Add keywords...',
            forceLowercase: true,
            removeDuplicates: true
        });

        $('.tag-editor').css({'border': 'none'});

        var formCreate = $('form#formCreate').show();

        $('.mdate').bootstrapMaterialDatePicker({ 
            weekStart: 0, 
            time: false,
            format: 'MMMM DD, YYYY'
        });

        autosize($('textarea.autosize'));

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
            // console.log($document);

            if ( $document == 'Others')
            {
                $('div#specifyDocument').css('display', 'block');
                // $('input#otherDocument').focus().select();
                $("input#otherDocument").val('');

            } else {
                $('div#specifyDocument').css('display', 'none');
                $("input[name=otherDocument]").val($document);
            }
        });



        // sweetalert
        // formCreate.validate({
        //     rules: {
        //         subject         : "required",
        //         documentDate    : "required",
        //         docType         : "required",
        //         keywords        : "required",
        //         /*"attachment[]" : {
        //             required  : true
        //         }*/
        //     },
        //     /*messages : {
        //         "attachment[]" : {
        //            required : "Please upload atleast 1 document",
        //            //extension: "Only document file is allowed!"
        //         }
        //     },*/
        //     highlight: function (element, errorClass, validClass) {
        //         // $(input).parents('.form-group').addClass('has-danger');
        //         // $(input).parent('.form-group').addClass(error);
        //         $( element ).parents( ".form-group" ).addClass( "has-danger" ).removeClass( "has-success" );
        //         // $( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
        //     },
        //     unhighlight: function (element, errorClass, validClass) {
        //         $( element ).parents( ".form-group" ).addClass( "has-success" ).removeClass( "has-danger" );
        //         // $( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
        //         // $(input).parents('.form-group').removeClass('has-danger');
        //         // $(input).parents('.form-group').removeClass(error);
        //     },
        //     errorElement: "small",
        //     errorPlacement: function (error, element) {
        //         // $(element).parents('.form-group').append(error);
        //         error.addClass( "form-control-feedback p-l-10" );
        //         // element.addClass( "form-control-danger" );
        //         element.parents( ".form-group" ).addClass( "has-danger" );
        //         element.addClass('form-control-danger').parent('div').append(error);

        //         // Add the span element, if doesn't exists, and apply the icon classes to it.
        //         // if ( !element.next( "span" )[ 0 ] ) {
        //         //     $( "<span class='icon-close form-control-feedback'></span>" ).insertAfter( element );
        //         // }
        //     },
        //     success: function ( label, element ) {
        //         // Add the span element, if doesn't exists, and apply the icon classes to it.
        //         // if ( !$(element).next( "span" )[ 0 ] ) {
        //         //     $( "<span class='icon-check form-control-feedback'></span>" ).insertAfter( $(element) );
        //         // }
        //     },
        // });

        /*formCreate.on('submit', function(e) {

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
        });*/
    });
</script>
<script>
    $(function () {

        // $('input#keywords').tagsinput({ confirmKeys: [186] });
        // $("input#keywords").materialtags();

        $(".select2").select2({
            'width': '100%'
        });

        var requiredCheckboxes = $('.options :checkbox[required]');
        
        requiredCheckboxes.change(function(){
            if(requiredCheckboxes.is(':checked')) {
                requiredCheckboxes.removeAttr('required');
            } else {
                requiredCheckboxes.attr('required', 'required');
            }
        });
    });
</script>
@endsection