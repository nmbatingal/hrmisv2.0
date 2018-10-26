@extends('layouts.app')

@section('styles')
<!-- Date picker plugins css -->
<link href="{{ asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Daterange picker plugins css -->
<link href="{{ asset('assets/node_modules/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/node_modules/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
@endsection

@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-12">
        <h4 class="text-white">Add New Applicant</h4>
    </div>
    <div class="col-md-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('applicants.dashboard') }}">HR-Applicants</a></li>
            <li class="breadcrumb-item active">Add New Applicant</li>
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
            <div class="card-header bg-inverse">
                <h4 class="m-b-0 text-white">Application Form</h4>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                    <h3 class="text-info"><i class="fa fa-exclamation-circle"></i> Information</h3> This is an example top alert. You can edit what u wish. Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.
                </div>

                <form action="{{ route('applicants.store') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-body">
                        <!-- PERSONAL INFORMATION ROW -->
                        <h3 class="m-t-20 box-title">Personal Info</h3>
                        <hr class="m-t-0 m-b-40">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">First Name</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="firstname" placeholder="first name" required autofocus>
                                                <small class="form-control-feedback">&nbsp;</small> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Middle Name</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="middlename" placeholder="middle name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Last Name</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="lastname" placeholder="last name" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Gender</label>
                                            <div class="col-md-9">
                                                <select class="form-control custom-select" name="sex">
                                                    <option value="1">Male</option>
                                                    <option value="2">Female</option>
                                                </select>
                                                <small class="form-control-feedback"> Select your gender. </small> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Date of Birth</label>
                                            <div class="col-md-9">
                                                <input type="date" class="form-control" name="birthday" placeholder="dd/mm/yyyy" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Age</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="age" placeholder="age">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- HOME ADDRESS INFORMATION -->
                        <h3 class="m-t-40 box-title">Contact Info</h3>
                        <hr class="m-t-0 m-b-40">
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Contact Number</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="contactNumber" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-3">Email Address</label>
                                    <div class="col-md-9">
                                        <input type="email" class="form-control" name="email" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="control-label text-right col-md-2">Home Address</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="homeAddress" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- FORMAL EDUCATION INFORMATION -->
                        <h3 class="m-t-40 box-title">Educational Background</h3>
                        <hr class="m-t-0 m-b-40">
                        <!--/row-->
                        <!-- DYNAMIC FORM FIELD -->
                        <div id="education_fields"></div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-sm-5 nopadding">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="program[]" value="" placeholder="Degree" required>
                                </div>
                            </div>
                            <div class="col-sm-4 nopadding">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="school[]" value="" placeholder="School name" required>
                                </div>
                            </div>
                            <div class="col-sm-3 nopadding">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="month" class="form-control" name="yearGraduated[]" value="{{ date('Y-m') }}">
                                        <div class="input-group-append">
                                            <button class="btn btn-success" type="button" onclick="education_fields();"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <small class="form-control-feedback">Select month and year</small> 
                                </div>
                            </div>
                        </div>
                        <!-- END OF DYNAMIC FORM FIELD -->

                        <!-- WORK EXPERIENCE INFORMATION -->
                        <h3 class="m-t-40 box-title">Working Experience</h3>
                        <hr class="m-t-0 m-b-40">
                        <!--/row-->
                        <!-- DYNAMIC FORM FIELD -->
                        <div id="experience_fields"></div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4 col-sm-12 nopadding">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="agency[]" value="" placeholder="Agency">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12 nopadding">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="position[]" value="" placeholder="Position">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12 nopadding">
                                        <div class="form-group">
                                            <input class="form-control input-daterange-datepicker" type="text" name="daterangeExperience[]" value="2015-01-01 - 2015-01-01" />
                                            <small class="form-control-feedback">Select starting and end dates</small> 
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12 nopadding">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="salaryGrade[]" value="0.00">
                                                <div class="input-group-append">
                                                    <button class="btn btn-success" type="button" onclick="experience_fields();"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                            <small class="form-control-feedback">Insert salary with decimal value</small> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END OF DYNAMIC FORM FIELD -->

                        <!-- ELIGIBILITY INFORMATION -->
                        <h3 class="m-t-40 box-title">Eligibility</h3>
                        <hr class="m-t-0 m-b-40">
                        <!--/row-->
                        <!-- DYNAMIC FORM FIELD -->
                        <div id="eligibility_fields"></div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4 col-sm-12 nopadding">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="licenseTitle[]" value="" placeholder="License Title">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12 nopadding">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="licenseNumber[]" value="" placeholder="License Number">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12 nopadding">
                                        <div class="form-group">
                                            <input type="month" class="form-control" name="exam_date[]" value="{{ date('Y-m') }}">
                                            <small class="form-control-feedback">Select month and year</small> 
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12 nopadding">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="rating[]" value="0.00">
                                                <div class="input-group-append">
                                                    <button class="btn btn-success" type="button" onclick="eligible_fields();"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                            <small class="form-control-feedback">Insert rating</small> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END OF DYNAMIC FORM FIELD -->
                        <!-- END OF ELIGIBILITY INFORMATION -->

                        <!-- OTHER INFORMATION -->
                        <h3 class="m-t-40 box-title">Other Info</h3>
                        <hr class="m-t-0 m-b-40">
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Attachments</label>
                                            <div class="col-md-9">
                                                <input type="file" class="form-control" name="attachment[]" accept=".pdf" multiple>
                                                <small class="form-control-feedback">Select pdf files only. </small> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Hire Status</label>
                                            <div class="col-md-9">
                                                <select class="form-control custom-select" name="hireStatus">
                                                    <option value="0">Not yet hired</option>
                                                    <option value="1">Hired</option>
                                                </select>
                                                <small class="form-control-feedback"> Select applicant hiring status. </small> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Interview Status</label>
                                            <div class="col-md-9">
                                                <select class="form-control custom-select" name="interviewStatus">
                                                    <option value="0">Not yet interviewed</option>
                                                    <option value="1">Interviewed</option>
                                                </select>
                                                <small class="form-control-feedback"> Select your gender. </small> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="control-label text-right col-md-3">Remarks</label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" rows="5" name="remarks"></textarea>
                                            </div>
                                        </div>
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
                                    <button type="submit" class="btn btn-lg btn-success">Submit</button>
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
<!-- Plugin JavaScript -->
<script src="{{ asset('assets/node_modules/moment/moment.js') }}"></script>
<script src="{{ asset('js/hrapplicants/create.blade.js') }}"></script>
<!-- Date Picker Plugin JavaScript -->
<script src="{{ asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<!-- Date range Plugin JavaScript -->
<script src="{{ asset('assets/node_modules/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- Custom JS Picker -->
<script>
    // Daterange picker
    $(document).ready(function() {
        $(document).on("focus", ".input-daterange-datepicker", function(){
            $(this).daterangepicker({
                showDropdowns: true,
                locale: {
                    separator: "   to   ",
                },
                buttonClasses: ['btn', 'btn-sm'],
                applyClass: 'btn-danger',
                cancelClass: 'btn-inverse'
            });
        });
    });
</script>
<script>
    // Daterange picker
    $('.input-daterange-datepicker').daterangepicker({
        showDropdowns: true,
        locale: {
            separator: "   to   ",
        },
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse'
    });

    jQuery('.datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true
    });

</script>
@endsection