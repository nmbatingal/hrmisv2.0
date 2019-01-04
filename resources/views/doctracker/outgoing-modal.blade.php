<form id="submitModal" action="{{ route('doctracker.outgoing.store') }}" class="form-horizontal" method="POST">
    @csrf
    <input type="hidden" name="tracker_id" value="{{ $tracker['id'] }}">
    <div class="row">
        <div class="col-md-12">
            <!-- SHOW DIV ON ACTION CHANGE TO FORWARDED -->
            <div class="form-group row m-b-0">
                <label class="control-label text-right col-md-2">Tracking Code</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" value="{{ $tracker['tracking_code'] }}" readonly>
                    <small class="form-control-feedback">&nbsp;</small> 
                </div>
            </div>
            <div class="form-group row m-b-0">
                <label class="control-label text-right col-md-2">Subject</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" value="{{ $tracker['subject'] }}" readonly>
                    <small class="form-control-feedback">&nbsp;</small> 
                </div>
            </div>
            <div class="form-group row m-b-0">
                <label class="control-label text-right col-md-2">Type</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" value="{{ $tracker['other_document'] }}" readonly>
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
                    <textarea class="form-control" name="note" rows="1" required></textarea>
                    <small class="form-control-feedback">Additional notes on routing the document.</small> 
                </div>
            </div>
        </div>
    </div>

    <hr>
    <div class="form-actions">
        <div class="row">
            <div class="col-md-6">
                <a id="trackerClose" href="javascript:void(0)" class="btn btn-md btn-danger">Close tracker activity</a>
            </div>
            <div class="col-md-6">
                <div class="float-right">
                    <button type="submit" class="btn btn-md btn-success">Submit</button>
                    <button type="button" class="btn btn-md btn-inverse" data-dismiss="modal">Cancel</button>
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

    $('form#submitModal').on('submit', function(e) {
        e.preventDefault();
        var form = $(this); 

        $.ajax({
            method : 'POST',
            url    : form.attr('action'),
            data   : form.serialize(),
            success: function(data) {

                // prepend to table if data
                var row = prependTableRowReceived(data);

                $('tr.footable-empty').remove();
                $('table#document-tracker-received tbody').prepend(row);

                $('#document-tracker-received').trigger('footable_initialize');
                form.trigger("reset");
                // ----------------------------------------------------------- //

                // increment tracker cards
                var sum = 1;
                sum += +$('#count-outgoing').text();
                $('#count-outgoing').text(sum);

                // clear form fields
                $('input[name=code]').val('');
                $("#upload-progress .progress-bar").css("width", + 0);
                // close modal
                $('#modal-outgoing').modal('toggle');
            },
            error  : function(xhr, err) {
                swal({
                    title: "Error!",
                    text:  "Could not retrieve the data.",
                    type: "error"
                }).then( function() {
                   $("#upload-progress .progress-bar").css("width", 0);
                });
            }
        });

        return false;
    });

    // row to be added
    function prependTableRowReceived (item) {
        var row = $('<tr>' +
                        '<td><a href="{!! route('doctracker.incoming.show', "") !!}/'+ item.tracking_code +'" target="_blank">' + item.tracking_code + '</a></td>' +
                        '<td>' + 
                            '<h5 class="font-weight-bold">' + item.subject + '</h5>' +
                                '<h5>' + item.created_by + '</h5>' +  
                                '(' + item.document_type + ')<br>' +
                                item.date_created + 
                        '</td>' +
                        '<td>' + item.note + '</td>' +
                        '<td>' + 
                            '<h5 class="font-weight-bold">' + item.action + '</h5>' +
                            item.date_action +  
                        '</td>' +
                    '</tr>');
        return row;
    }
</script>