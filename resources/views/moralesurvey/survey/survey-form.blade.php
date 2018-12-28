@extends('layouts.app')

@section('styles')
@endsection

@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-12">
        <h4 class="text-white">Survey Form</h4>
    </div>
    <div class="col-md-6">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('moralesurvey.dashboard') }}">Morale Survey</a></li>
            <li class="breadcrumb-item active">Survey Form</li>
        </ol>
    </div>
</div>
<div class="m-t-40"></div>
<div class="row">
    <!-- Column -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Morale Survey Form</h4>
                <h6 class="card-subtitle mb-2 text-muted">{{ $survey->semester }}</h6>

                <div class="m-t-40"></div>
                <p class="card-text">Answer the form. Thank you.</p>
                
                <div class="alert alert-info w-50">
                    Legend:

                    <div class="row">
                        <div class="col-md-3"><span class="font-weight-bold">DN</span></div>
                        <div class="col-md-9">Definitely No</div>
                        <div class="col-md-3"><span class="font-weight-bold">N</span></div>
                        <div class="col-md-9">No</div>
                        <div class="col-md-3"><span class="font-weight-bold">NS</span></div>
                        <div class="col-md-9">Not Sure</div>
                        <div class="col-md-3"><span class="font-weight-bold">Yes</span></div>
                        <div class="col-md-9">Yes</div>
                        <div class="col-md-3"><span class="font-weight-bold">DY</span></div>
                        <div class="col-md-9">Definitely Yes</div>
                    </div>
                </div>

                <form action="{{ route('survey.store') }}" class="form-horizontal" method="POST">
                    @csrf
                    <div class="table-responsive">
                        <table id="surveyTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Semester</th>
                                    <th>DN</th>
                                    <th>N</th>
                                    <th>NS</th>
                                    <th>Y</th>
                                    <th>DY</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ( $questions as $i => $qn )
                                    <input type="hidden" name="sem_id" value="{{ $survey->id }}">
                                    <input type="hidden" name="question_id[]" value="{{ $qn->id }}">
                                    <tr>
                                        <td class="text-center">{{ ++$i }}</td>
                                        <td>{{ $qn->question }}</td>
                                        <td> <!-- Radio DN -->
                                            <div class="custom-control custom-radio">
                                                <input required type="radio" id="radioDN{{ $qn->id }}" name="qn_{{ $qn->id }}" class="custom-control-input" value="1">
                                                <label class="custom-control-label" for="radioDN{{ $qn->id }}">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td> <!-- Radio N -->
                                            <div class="custom-control custom-radio">
                                                <input required type="radio" id="radioN{{ $qn->id }}" name="qn_{{ $qn->id }}" class="custom-control-input" value="2">
                                                <label class="custom-control-label" for="radioN{{ $qn->id }}">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td> <!-- Radio NS -->
                                            <div class="custom-control custom-radio">
                                                <input required type="radio" id="radioNS{{ $qn->id }}" name="qn_{{ $qn->id }}" class="custom-control-input" value="3">
                                                <label class="custom-control-label" for="radioNS{{ $qn->id }}">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td> <!-- Radio Y -->
                                            <div class="custom-control custom-radio">
                                                <input required type="radio" id="radioY{{ $qn->id }}" name="qn_{{ $qn->id }}" class="custom-control-input" value="4">
                                                <label class="custom-control-label" for="radioY{{ $qn->id }}">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td> <!-- Radio DY -->
                                            <div class="custom-control custom-radio">
                                                <input required type="radio" id="radioDY{{ $qn->id }}" name="qn_{{ $qn->id }}" class="custom-control-input" value="5">
                                                <label class="custom-control-label" for="radioDY{{ $qn->id }}">&nbsp;</label>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="form-group p-15 p-0">
                        <label class="">Remarks*</label>
                        <textarea class="form-control auto-growth" rows="3" name="remarks" required></textarea>
                        <span class="help-block text-muted"><small>This field is required. Remarks remain anonymous.</small></span>
                    </div>

                    <div class="float-right">
                        <button type="submit" class="btn btn-success waves-effect waves-light">Submit</button>
                    </div>  
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- This is data table -->
<script src="{{ asset('assets/node_modules/datatables/datatables.min.js') }}"></script>
@endsection