<form id="submitModal" action="{{ route('doctracker.outgoing.store') }}" class="form-horizontal" method="POST">
    @csrf
    <input type="hidden" name="tracker_id" value="{{ $tracker['id'] }}">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group row m-b-0">
                <label class="control-label text-right col-md-2">Tracking Code: </label>
                <div class="col-md-3">
                    <input type="hidden" class="form-control" name="code" value="{{ $tracker['tracking_code'] }}" readonly>
                    <p>{{ $tracker['tracking_code'] }}</p>
                </div>

                <label class="control-label text-right col-md-3">Type: </label>
                <div class="col-md-4">
                    <p>{{ $tracker['other_document'] }}"</p>
                </div>
            </div>

            <div class="form-group row m-b-0">
                <label class="control-label text-right col-md-2">Subject: </label>
                <div class="col-md-10">
                    <p>{{ $tracker['subject'] }}</p>
                </div>
            </div>

            <div class="form-group row m-b-0">
                <label class="control-label text-right col-md-2">Details: </label>
                <div class="col-md-10">
                    <p>{{ $tracker['details'] }}</p>
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
                    <textarea class="form-control" name="note" rows="3"></textarea>
                    <small class="form-control-feedback">Additional notes on routing the document.</small> 
                </div>
            </div>
        </div>
    </div>

    <hr>
    <div class="form-actions">
        <div class="row">
            <div class="col-md-6">
                <button type="button" id="trackerClose" class="btn btn-md btn-danger">Close tracker activity</button>
            </div>
            <div class="col-md-6">
                <div class="float-right">
                    <button type="submit" class="btn btn-md btn-success">Submit</button>
                    <button type="button" class="btn btn-md btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    $(".select2").select2({
        'width': '100%'
    });

    $('#trackerClose').on('click', function() {
        var buttons = $('<div>')
            .append(
                $('<button class="btn btn-secondary btn-md">Complete Routing</button>').on('click', function() {
                    swal.close();
                })
            ).append(
                $('<button class="btn btn-secondary btn-md">Cancel Routing</button>').on('click', function() {
                    swal.close();
                })
            );
        
        swal({
            title: "Continue...",
            html: buttons,
            type: "warning",
            showConfirmButton: false,
            showCancelButton: false
        });
    });

    $("select[name=routeMode]").change(function(){
            
        var $id = $(this).val();
        var token = $("input[name=_token]").val();

        if ( $id == 'all')
        {
            $('div#sendRoute').css('display', 'none');
            $("select#recipient").html('');

        } else {

            $('div#sendRoute').css('display', 'block');
            $.post( "{{ route('doctracker.recipientsList') }}", { office_id: $id, _token:token})
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
                $('table#tableRoutedDocument tbody').prepend(row);

                $('#tableRoutedDocument').trigger('footable_initialize');
                form.trigger("reset");
                // ----------------------------------------------------------- //

                // increment tracker cards
                var sum = 1;
                sum += +$('#count-release').text();
                $('#count-release').text(sum);

                // clear form fields
                $('input[name=code]').val('');
                $("#upload-progress .progress-bar").css("width", + 0);
                // close modal
                $('#modal-outgoing').modal('toggle');
                $("#codeInput").select();
            },
            error  : function(xhr, err) {
                swal({
                    title: "Error!",
                    text:  "Could not retrieve the data.",
                    type: "error"
                }).then( function() {
                    $("#upload-progress .progress-bar").css("width", 0);
                    $("#codeInput").select();
                });
            }
        });

        return false;
    });

    // row to be added
    function prependTableRowReceived (item) {
        var row = $('<tr id="row-'+item.id+'">' +
                        '<td><a href="#" target="_blank">' + item.tracking_code + '</a></td>' +
                        '<td>' + 
                            '<h5 class="font-weight-bold">' + item.subject + '</h5>' +
                                '<h5>' + item.created_by + '</h5>' +  
                                '(' + item.document_type + ')<br>' +
                                item.date_created + 
                        '</td>' +
                        '<td>' + item.note + '</td>' +
                        '<td>' + item.remarks + '</td>' +
                        '<td>' + 
                            '<h5 class="font-weight-bold">' + item.action + '</h5>' +
                            item.date_action +  
                        '</td>' +
                        '<td class="text-center">' +
                            '<button type="button" class="btn btn-danger btn-sm btnCancelEvent" data-id="'+ item.id +'" title="Cancel"><i class="ti-close"></i></button>' +
                        '</td>' +
                    '</tr>');
        return row;
    }
</script>