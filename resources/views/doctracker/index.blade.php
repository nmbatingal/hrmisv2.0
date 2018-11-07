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
        <h4 class="text-white">Document Tracker</h4>
    </div>
    <div class="col-md-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Document Tracker</li>
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
                <h4 class="card-title">Document Tracker
                    <a href="javascript:void(0)" class="btn btn-rounded btn-primary float-right">Create new tracker</a>
                </h4>
                <p class="card-text">Search for a document using tracking code or <a href="javascript:void(0)">add a new document</a> to track.</p>
                <form class="form-horizontal" method="GET">
                    <div class="row p-t-20">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <div class="input-group p-0">
                                    <input type="text" class="form-control" name="code" placeholder="Enter tracking code" autofocus>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><i class="icon-magnifier"></i></button>
                                    </div>
                                </div>
                                <small class="form-control-feedback">&nbsp; </small> 
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                </form>

                {!! $img !!}

                <div class="table-responsive-md m-t-20">
                    <table id="demo-foo-pagination" class="table table-bordered table-hover table-striped" data-paging="true" data-paging-size="5">
                        <thead>
                            <tr>
                                <th>Tracking Code</th>
                                <th>Action</th>
                                <th>Action by</th>
                                <th>Addressed to</th>
                                <th>Remarks</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td class="text-center">
                                        <a href="javascript:void(0)">aaaaaaa</a>
                                    </td>
                                    <td class="text-center">
                                        aaaaaaaaaaaaaa
                                    </td>
                                    <td>
                                        aaaaaaaaaaaaaa
                                    </td>
                                    <td>
                                        aaaaaaaaaaaaaa
                                    </td>
                                    <td>
                                        aaaaaaaaaaaaaa
                                    </td>
                                    <td>
                                        aaaa ()
                                    </td>
                                </tr>
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