@extends('layouts.home.app')

@section('title')
Profile Setting -
@endsection

@section('styles')
@endsection

@section('content')
<!-- ============================================================== -->
<!-- Over Visitor, Our income , slaes different and  sales prediction -->
<!-- ============================================================== -->
<!-- Row -->
<div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card">
            <div class="card-body">
                <div class="row float-right">
                    <a href="{{ route('user.setting.edit', $user->id) }}" class="text-info" title="Edit"><i class="icon-pencil"></i> Edit Profile</a>
                </div>
                <center class="m-t-30"> 
                    <img src="{{ asset($user->userProfilPic) }}" class="img-circle" width="150" />
                    <h3 class="card-title m-t-10">{{ $user->fullName }}</h3>
                    <h5 class="card-title m-t-10">&#64;{{ $user->username }}</h5>
                    <h6 class="card-subtitle">{{ $user->position }}</h6>
                    <h6 class="card-subtitle">{{ $user->office->division_name }}</h6>
                </center>
            </div>
            <div>
                <hr> </div>
            <div class="card-body"> 
                <small class="text-muted">Email address </small>
                <h6>{{ $user->email }}</h6> 
                <small class="text-muted p-t-30 db">Phone</small>
                <h6>{{ $user->mobile }}</h6> 
                <small class="text-muted p-t-30 db">Address</small>
                <h6>{{ $user->address }}</h6>
                <div class="map-box">
                    
                </div>
                <br/>
            </div>
        </div>
    </div>
    <!-- Column -->
</div>
<!-- Row -->
@endsection

@section('scripts')
<script type="text/javascript">

    $(document).ready(function() {
        var session = {!! json_encode(session('cart')) !!};

        $.each(session, function(key, value) {
            toastrFunction(value);     
        });

        function toastrFunction (data) {
            var toastr = $.toast({
                loader: false,
                heading: data.heading,
                text: data.text,
                position: 'bottom-left',
                hideAfter: 7000, 
                stack: 4,
                showHideTransition: 'slide'
            });

            return toastr;
        }
    });


</script>
@endsection