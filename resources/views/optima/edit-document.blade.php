@extends('layouts.optima.app')

@section('title')
Edit tracker
@endsection

@section('styles')
<link href="{{ asset('assets/node_modules/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
<!-- <link href="{{ asset('assets/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" /> -->
<!-- <link rel="stylesheet" href="{{ asset('js/node_modules/materialize-tags/dist/css/materialize-tags.min.css') }}"> -->
<link href="{{ asset('assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('js/jQuery-tagEditor/jquery.tag-editor.css') }}" rel="stylesheet" type="text/css" />
<!-- <link href="{{ asset('js/node_modules/jquery-tags-input/dist/jquery.tagsinput.min.css') }}" rel="stylesheet" type="text/css" /> -->
<style type="text/css">
    .form-control-line .form-control {
        border-bottom: none;
    }


    .form-control-line .form-group .form-control {
        padding: 0 10px;
    }

    .form-control-line .form-control:focus {
        /*border-bottom: 1px solid #e9ecef;*/
        border-bottom: none;
    }

    .tag-editor {
        border: none;
    }

    .select2-container--default .select2-selection--single {
        border: none;
    }

    .select2-container--default .select2-selection--multiple {
        border: none;
    }

    .select2-container--default.select2-container--focus .select2-selection--multiple {
        border: none;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        color: black;
        margin-top: none;
    }
</style>
@endsection

@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Edit Tracker {{ $editDoc->tracking_code }}</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('optima.my-documents') }}">My Documents</a></li>
                <li class="breadcrumb-item active">Edit Tracker</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">

        <div class="card border-dark">
            <div class="card-body p-10">
                <!-- ALERT NOTIF -->
                <div class="alert alert-info alert-rounded"> 
                    <i class="mdi mdi-information-outline"></i> Please fill out the fields below completely before submitting the form.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                </div>

                <!-- FORM -->
                <form id="formCreate" action="{{ route('optima.my-documents.update', $editDoc->id) }}" method="POST" class="form-control-line" 
                      enctype="multipart/form-data">
                    @csrf {{ method_field('PATCH') }}
                    <div class="form-group row m-b-10" style="display: none;">
                        <div class="col-md-12 p-0">
                            <input type="text" name="documentDate" class="form-control mdate" placeholder="Document Date *">
                            <!-- <span class="help-block p-l-10 text-muted">
                                <small>A block of help text that breaks onto a new line and may extend beyond one line.</small>
                            </span> -->
                        </div>
                    </div>

                    <div class="form-group row m-b-20">
                        <div class="col-md-12 p-0">
                            <textarea class="form-control autosize" name="subject" rows="1" placeholder="Subject" required autofocus>{{ $editDoc->subject }}</textarea>
                            <!-- <span class="help-block p-l-10 text-muted">
                                <small>A block of help text that breaks onto a new line and may extend beyond one line.</small>
                            </span> -->
                        </div>
                        <div class="col-md-12 p-0">
                            <hr class="m-0">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12 p-0">
                            <input type="text" name="keywords" class="form-control keywords" required>
                        </div>
                        <div class="col-md-12 p-l-0 p-t-10 p-r-0">
                            <hr class="m-0">
                        </div>
                    </div>

                    <div class="form-group row m-b-10">
                        <div class="col-md-6">
                            <select id="documentType" class="form-control" name="docType" required>
                                <option></option>
                                @forelse( $docTypes as $doctype )
                                    <option value="{{ $doctype->id }}">{{ $doctype->document_name }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div id="specifyDocument" class="col-md-6 p-0" style="display: none;">
                            <input id="otherDocument" type="text" class="form-control" name="otherDocument" placeholder="Please specify document type" value="{{ $editDoc->other_document }}" required>
                        </div>
                        <div class="col-md-12 p-0">
                            <hr class="m-0">
                        </div>
                    </div>

                    <div class="form-group row m-b-20">
                        <div class="col-md-12 p-10">
                            <select id="recipient" class="select2 form-control select2-multiple" name="recipients[]" multiple="multiple"
                                    required>
                            </select>
                        </div>
                        <div class="col-md-12 p-0">
                            <hr class="m-0">
                        </div>
                    </div>

                    <div class="form-group options">
                        <div class="custom-control custom-checkbox">
                            <input name="forSignature" type="checkbox" class="custom-control-input" id="customCheck4" value="For signature."
                                   {{ $editDoc->trackLogs->first()->forSignature ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customCheck4">For signature </label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input name="forCompliance" type="checkbox" class="custom-control-input" id="customCheck2" value="For action/compliance." 
                                   {{ $editDoc->trackLogs->first()->forCompliance ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customCheck2">For action/compliance </label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input name="forInformation" type="checkbox" class="custom-control-input" id="customCheck3" value="For information."
                                   {{ $editDoc->trackLogs->first()->forInformation ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customCheck3">For information </label>
                        </div>
                    </div>

                    <div class="form-group row m-b-10">
                        <div class="col-md-12 p-0">
                            <textarea class="form-control autosize" name="note" rows="4" style="background-image: none;" placeholder="Additional notes">{{ $editDoc->trackLogs->first()->notes }}</textarea>
                            <!-- <span class="help-block p-l-10 text-muted">
                                <small>A block of help text that breaks onto a new line and may extend beyond one line.</small>
                            </span> -->
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="float-right">
                                    <button id="btnSubmit" type="submit"  class="btn btn-md btn-success">
                                        <span class="spinner-border spinner-border-sm" style="display: none;" role="status" aria-hidden="true"></span>
                                        Submit
                                    </button>
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

        // var formCreate = $('form#formCreate').show();

        $('.mdate').bootstrapMaterialDatePicker({ 
            weekStart: 0, 
            time: false,
            // format: 'MMMM DD, YYYY'
        });

        autosize($('textarea.autosize'));

        $('input[name=documentDate]').bootstrapMaterialDatePicker('setDate', moment());

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

        // formCreate.on('submit', function(e) {

        //     e.preventDefault();
        //     var form = $(this); 

        //     $.ajax({
        //         method : 'POST',
        //         url    : form.attr('action'),
        //         data   : form.serialize(),
        //         xhr: function() {
        //             //upload Progress
        //             var xhr = $.ajaxSettings.xhr();
        //             if (xhr.upload) {
        //                 xhr.upload.addEventListener('progress', function(event) {
        //                     var percent = 0;
        //                     var position = event.loaded || event.position;
        //                     var total = event.total;
        //                     if (event.lengthComputable) {
        //                         percent = Math.ceil(position / total * 100);
        //                     }
        //                     // update progressbar
        //                     // $("#upload-progress .progress-bar").css("width", + percent +"%");
        //                     // console.log(percent);

        //                     $('#btnSubmit .spinner-border').css('display', 'inline-block');
        //                     // $('#btnSubmit').attr('disabled', 'disabled');

        //                 }, true);
        //             }
        //             return xhr;
        //         },
        //         success: function(data) {
        //             if (data.result) {

        //                 var url = "{{ route('optima.print.barcode', ':var') }}",
        //                     urlCancel = "{{ route('optima.my-documents.destroy', ':var') }}";
                        
        //                 // CHANGE
        //                 url = url.replace(':var', data.tracker);
        //                 urlCancel = urlCancel.replace(':var', data.id);

        //                 $('.spinner-border').css('display', 'none');
        //                 $('#btnSubmit').css('display', 'none');
        //                 $('#btnCancelEvent').attr('href', urlCancel)
        //                               .css('display', 'inline-block');
        //                 $('#btnPrint').attr('href', url)
        //                               .data('id', data.id)
        //                               .css('display', 'inline-block');

        //                 var dialog = Swal.fire({
        //                                 text:  "Document tracker successfully saved. Tracking Code " + data.tracker,
        //                                 type: "success",
        //                                 showConfirmButton: true,
        //                                 showCancelButton: true,
        //                                 allowOutsideClick: false,
        //                                 onOpen: function(swal) {

        //                                     var swalCancel = $(swal).find('.swal2-cancel');

        //                                     swalCancel.removeClass('swal2-styled')
        //                                                 .addClass('btn btn-lg btn-danger')
        //                                                 .html('<i class="ti-printer"></i> Print Code');

        //                                     swalCancel.off().click(function(e) {
        //                                         window.open(url, "Print Barcode", "width=800,height=600");
        //                                     });
        //                               }
        //                         });

        //             } else {

        //                 $('.spinner-border').css('display', 'none');
        //                 $('#btnSubmit').attr('disabled', false);

        //                 Swal.fire({
        //                     title: "Error!",
        //                     text:  "Data unsuccessfully saved.",
        //                     type: "error"
        //                 }).then( function() {
        //                    // $("#upload-progress .progress-bar").css("width", 0);
        //                 });
        //             }
        //         },
        //         error  : function(xhr, err) {

        //             $('.spinner-border').css('display', 'none');
        //             $('#btnSubmit').attr('disabled', false);

        //             Swal.fire({
        //                 title: "Error!",
        //                 text:  "Could not process data.",
        //                 type: "error"
        //             }).then( function() {
        //                $("#upload-progress .progress-bar").css("width", 0);
        //             });
        //         }
        //     });

        //     return false;
        // });
    });
</script>
<script>
    $(function () {

        //------------ auto fill keyword field ----------------//
        var editDocs = {!! $editDoc->documentKeywords !!},
            tagsArray = [];
        $.each (editDocs, function(index, value) {
            tagsArray.push(value.keywords);
        });
        $(".keywords").tagEditor({
            autocomplete: {
                delay: 0, // show suggestions immediately
                position: { collision: 'flip' }, 
                source: "{{ route('optima.keywords') }}"
            },
            initialTags: tagsArray,
            delimiter: ',', /* space and semicolon */
            placeholder: 'Add keywords',
            forceLowercase: true
        });
        //------------ end auto fill keyword field ----------------//

        //------------ auto select document type field ----------------//
        $("#documentType").select2({
            width: '100%',
            placeholder: "Select document type",
            allowClear: true
        });
        $('#documentType').val('{{ $editDoc->doc_type_id }}'); // Select the option with a value of '1'
        $('#documentType').trigger('change');
        $('#otherDocument').val('{{ $editDoc->other_document }}')
        //------------ end auto select document type field ----------------//

        //------------ auto select recipients type field ----------------//
        var dataList = {!! json_encode($dataList) !!},
            recipientList = {!! $editDoc->trackLogs->first() !!},
            recipientArray = [];
            
        $.each (recipientList['recipients'], function(index, value) {
            recipientArray.push(value.id+','+value.type);
        });

        $("#recipient").select2({
            width: '100%',
            data: dataList,
            placeholder: "Select recipients",
            allowClear: true,
            templateSelection: function (data, container) {
                // Add custom attributes to the <option> tag for the selected option
                // $(data.element).attr('data-img', data.img);

                var imgUrl = "{{ asset('/') }}",
                    $recipient = $(
                        '<span><img src="' + imgUrl + data.img + '" class="img-circle" width="30" /> ' + data.text + '</span>'
                    );
                return $recipient;
            }
        });
        $('#recipient').val(recipientArray);
        $('#recipient').trigger('change');

        $("#recipient").on("select2:select", function (evt) {
            var element = evt.params.data.element;
            var $element = $(element);
          
            $element.detach();
            $(this).append($element);
            $(this).trigger("change");
        });

        // var option = new Option(recipientArray);
        // $("#recipient").append(option).trigger('change');
        // console.log(recipientArray);
        //------------ end auto select recipients type field ----------------//


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