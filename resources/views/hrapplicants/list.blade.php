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
        <h4 class="text-white">List of Applicants</h4>
    </div>
    <div class="col-md-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('applicants.dashboard') }}">HR-Applicants</a></li>
            <li class="breadcrumb-item active">Add Applicant</li>
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
    <!-- Column -->
    <div class="col-lg-12">
		<div class="card">
            <div class="card-body">
                <h4 class="card-title">List of Applicants
                    <a href="{{ route('applicants.create') }}" class="btn btn-rounded btn-primary float-right">Add new applicant</a>
                </h4>
                <h6 class="card-subtitle">Display information of applicants</h6>

                <div class="table-responsive m-t-40">
                    <table id="demo-foo-pagination" class="table table-bordered table-striped" data-sorting="true" data-paging="true" data-paging-size="5" data-toggle-column="first">
                        <thead>
                            <tr class="footable-filtering">
                                <th>Name</th>
                                <th>Contact Details</th>
                                <th data-breakpoints="xs sm">Eligibility</th>
                                <th data-breakpoints="xs sm">Hire Status</th>
                                <th data-breakpoints="xs sm">Interview Status</th>
                                <th data-breakpoints="all" data-title="Birthday">Birthday</th>
                                <th data-breakpoints="all" data-title="Education">Education</th>
                                <th data-breakpoints="all" data-title="Experience">Experience</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ( $applicants as $applicant )
                                <tr>
                                    <td>
                                        <a href="javascript:void(0)">{{ $applicant->full_name }}</a>
                                    </td>
                                    <td>
                                        <address>
                                            {{ $applicant->contactNumber }}
                                            <br><a href="mailto:#">{{ $applicant->email }}</a>
                                        </address>
                                    </td>
                                    <td>
                                        @forelse ( $applicant->applicantEligibilities as $eligible )
                                            {{ $eligible->licensed }} <br/>
                                        @empty
                                            Not provided
                                        @endforelse
                                    </td>
                                    <td>
                                        <span class="label label-table label-danger">Suspended</span>
                                    </td>
                                    <td>
                                        <span class="label label-table label-danger">Suspended</span>
                                    </td>
                                    <td>{{ $applicant->birth_date }}</td>
                                    <td>
                                        @forelse ( $applicant->applicantEducations as $education )
                                            {!! $education->education_background !!} <br/>
                                        @empty
                                            Not provided
                                        @endforelse
                                    </td>
                                    <td>
                                        @forelse ( $applicant->applicantExperiences as $experience )
                                            {!! $experience->work_experience !!} <br/>
                                        @empty
                                            Not provided
                                        @endforelse
                                    </td>
                                </tr>
                            @empty
                                <tr class="odd"><td valign="top" colspan="6" class="dataTables_empty">No data available in table</td></tr>
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
                enabled: true
            }
        });
    });

</script>
@endsection