<form  class="form-horizontal" method="POST">
<div class="row">
    <div class="col-md-12">
        <!-- SHOW DIV ON ACTION CHANGE TO FORWARDED -->
        <div class="form-group row m-b-0">
            <label class="control-label text-right col-md-2">Tracking Code</label>
            <div class="col-md-10">
                <input type="text" class="form-control" value="{{ $tracker->tracking_code }}" readonly>
                <small class="form-control-feedback">&nbsp;</small> 
            </div>
        </div>
        <div class="form-group row m-b-0">
            <label class="control-label text-right col-md-2">Subject</label>
            <div class="col-md-10">
                <input type="text" class="form-control" value="{{ $tracker->subject }}" readonly>
                <small class="form-control-feedback">&nbsp;</small> 
            </div>
        </div>
        <div class="form-group row m-b-0">
            <label class="control-label text-right col-md-2">Type</label>
            <div class="col-md-10">
                <input type="text" class="form-control" value="{{ $tracker->other_document }}" readonly>
                <small class="form-control-feedback">&nbsp;</small> 
            </div>
        </div>

        <hr class="p-b-20">
        <div class="form-group row m-b-0">
            <label class="control-label text-right col-md-2">Action</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="action" value="Forward" readonly>
                <small class="form-control-feedback">&nbsp;</small> 
            </div>
        </div>

        <div class="form-group row m-b-0">
            <label class="control-label text-right col-md-2">Route Mode</label>
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

<hr>
<div class="form-actions">
    <div class="row">
        <div class="col-md-12">
            <div class="float-right">
                <button type="submit" class="btn btn-lg btn-success">Submit</button>
                <button type="button" class="btn btn-lg btn-inverse" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
</form>

<script>
    $(".select2").select2({
        'width': '100%'
    });

    // $('.select2-container').css('width', '100%');

    $("select[name=routeMode]").change(function(){
            
        var $id = $(this).val();
        var token = $("input[name=_token]").val();

        if ( $id == 'all')
        {
            $('div#sendRoute').css('display', 'none');
            $("select#recipient").html('');

        } else {

            $('div#sendRoute').css('display', 'block');
            $.post( "{{ route('doctracker.recipientlist') }}", { office_id: $id, _token:token})
                .done( function( data ) {
                    $("select#recipient").attr('disabled', false);
                    $("select#recipient").html('');
                    $("select#recipient").html(data.options);
                });
        }
    });
</script>