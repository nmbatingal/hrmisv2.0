@extends('layouts.home.app')

@section('title')
Update Account Settings -
@endsection

@section('styles')
<link href="{{ asset('assets/node_modules/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
<link href="{{ asset('assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<style type="text/css">
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
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor font-weight-bold"><a href="{{ URL::previous() }}"><i class="ti-arrow-circle-left"></i> Back</a></h3>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.setting.index') }}">Profile</a></li>
                <li class="breadcrumb-item active">Update</li>
            </ol>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Over Visitor, Our income , slaes different and  sales prediction -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-md-7">
        <div class="card ">
            <div class="card-body">
                <form id="formUpdate" action="{{ route('user.setting.update', $user->id) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-body">
                        <!-- PERSONAL INFORMATION ROW -->
                        <h3 class="box-title">Personal Info</h3>
                        <hr class="m-t-0 m-b-40">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row m-b-0">
                                    <label class="control-label text-right col-md-2">Firstname</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="firstname" placeholder="enter firstname" value="{{ $user->firstname }}" required autofocus>
                                        <small class="form-control-feedback">&nbsp;</small> 
                                    </div>
                                </div>
                                <div class="form-group row m-b-0">
                                    <label class="control-label text-right col-md-2">Middlename</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="middlename" placeholder="enter middlename" value="{{ $user->middlename }}">
                                        <small class="form-control-feedback">&nbsp;</small> 
                                    </div>
                                </div>
                                <div class="form-group row m-b-0">
                                    <label class="control-label text-right col-md-2">Lastname</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="lastname" placeholder="enter lastname" value="{{ $user->lastname }}" required>
                                        <small class="form-control-feedback">&nbsp;</small> 
                                    </div>
                                </div>
                                <div class="form-group row m-b-0">
                                    <label class="control-label text-right col-md-2">Sex</label>
                                    <div class="col-md-4">
                                        <select class="select2 form-control custom-select" name="sex" required>
                                            <option value="">-- Select sex --</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        <small class="form-control-feedback">&nbsp;</small> 
                                    </div>
                                </div>
                                <div class="form-group row m-b-0">
                                    <label class="control-label text-right col-md-2">Birthday</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control mdate" name="birthday" placeholder="Select date" value="{{ $user->birthday }}" required>
                                        <small class="form-control-feedback">&nbsp;</small> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- CONTACT INFORMATION ROW -->
                        <h3 class="m-t-20 box-title">Contact Info</h3>
                        <hr class="m-t-0 m-b-40">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row m-b-0">
                                    <label class="control-label text-right col-md-2">Address</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="address" placeholder="enter address" value="{{ $user->address }}" required>
                                        <small class="form-control-feedback">&nbsp;</small> 
                                    </div>
                                </div>
                                <div class="form-group row m-b-0">
                                    <label class="control-label text-right col-md-2">Email</label>
                                    <div class="col-md-10">
                                        <input type="email" class="form-control" name="email" placeholder="enter email" value="{{ $user->email }}" required>
                                        <small class="form-control-feedback">&nbsp;</small> 
                                    </div>
                                </div>
                                <div class="form-group row m-b-0">
                                    <label class="control-label text-right col-md-2">Mobile Number</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="mobile" placeholder="enter mobile number" value="{{ $user->mobile }}" required>
                                        <small class="form-control-feedback">&nbsp;</small> 
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- OFFICE INFORMATION ROW -->
                        <h3 class="m-t-20 box-title">Office Info</h3>
                        <hr class="m-t-0 m-b-40">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row m-b-0">
                                    <label class="control-label text-right col-md-2">Office</label>
                                    <div class="col-md-10">
                                        <select class="select2 form-control custom-select" name="office" required>
                                            <option value="">-- Select office --</option>
                                            @foreach($offices as $office)
                                                @if ( $office->id == $user->office_id )
                                                    <option value="{{ $office->id }}" selected>{{ $office->division_name }}</option>
                                                @else
                                                    <option value="{{ $office->id }}">{{ $office->division_name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <small class="form-control-feedback">&nbsp;</small>  
                                    </div>
                                </div>
                                <div class="form-group row m-b-0">
                                    <label class="control-label text-right col-md-2">Position</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="position" placeholder="enter position" value="{{ $user->position }}" required>
                                        <small class="form-control-feedback">&nbsp;</small> 
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
                                    <button type="submit" class="btn btn-md btn-info">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card ">
            <div class="card-body">
                <form id="formUpdatePassword" action="{{ route('user.setting.update.password', $user->id) }}" method="POST" class="form-horizontal">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row m-b-0">
                                    <label class="control-label text-right col-md-2">Username</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="username" placeholder="enter username" value="{{ $user->username }}" readonly required>
                                        <small class="form-control-feedback">&nbsp;</small> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row m-b-0">
                                    <label class="control-label text-right col-md-2">Password</label>
                                    <div class="col-md-10">
                                        <input type="password" class="form-control" name="password" placeholder="enter password" required>
                                        <small class="form-control-feedback">&nbsp;</small> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row m-b-0">
                                    <label class="control-label text-right col-md-2">Confirm Password</label>
                                    <div class="col-md-10">
                                        <input type="password" class="form-control" name="password_confirmation" placeholder="confirm password" required>
                                        <small class="form-control-feedback">&nbsp;</small> 
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
                                    <button type="submit" class="btn btn-md btn-danger">Change Password</button>
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
<script src="{{ asset('assets/node_modules/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.mdate').bootstrapMaterialDatePicker({ weekStart: 0, time: false });
    });
</script>
<script>
    $(function () {
        $(".select2").select2({
            'width': '100%'
        });
    });
</script>
@endsection