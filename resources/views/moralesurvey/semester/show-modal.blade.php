<form class="form-horizontal">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group row m-b-0">
                <label class="control-label text-right col-md-2">Semester</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" value="{{ $semester->semester }}" disabled>
                    <small class="form-control-feedback">&nbsp;</small> 
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group row m-b-0">
                <label class="control-label text-right col-md-2">Status</label>
                <div class="col-md-10">
                    <select class="form-control custom-select" disabled>
                        <option value="0" {{ $semester->status ? 'selected' : ''}}>Inactive</option>
                        <option value="1" {{ $semester->status ? 'selected' : ''}}>Active</option>
                    </select>
                    <small class="form-control-feedback">&nbsp;</small> 
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table id="example" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Survey Questions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ( $questions as $question )
                                <tr>
                                    <td>{{ $question->question }}</td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <hr>
    <div class="form-actions">
        <div class="row">
            <div class="col-md-12">
                <div class="float-right">
                    <button type="button" class="btn btn-lg btn-inverse" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>