<form id="submitModal" class="form-horizontal" action="{{ route('doctracker.incoming.store') }}" method="POST">
    @csrf
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
                    <p>{{ $tracker['other_document'] }}</p>
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
                <label class="control-label text-right col-md-2">Remarks</label>
                <div class="col-md-10">

                    <div class="custom-control custom-checkbox">
                        <input checked name="remarks[]" type="checkbox" class="custom-control-input" id="customCheck1" value="Received. Thank you. ">
                        <label class="custom-control-label" for="customCheck1">Received. Thank you. </label>
                    </div>

                    <br/>Notes
                    <textarea class="form-control" name="notes" rows="3"></textarea>
                    <small class="form-control-feedback">Include notes on the routed document. </small> 
                </div>
            </div>
        </div>
    </div>

    <hr>
    <div class="form-actions">
        <div class="row">
            <div class="col-md-12">
                <div class="float-right">
                    <button type="submit" class="btn btn-md btn-success">Submit</button>
                    <button type="button" class="btn btn-md btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    $('form#submitModal').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);

        $.ajax({
            method : form.attr('method'),
            url    : form.attr('action'),
            data   : form.serialize(),
            xhr: function() {
                //upload Progress
                var xhr = $.ajaxSettings.xhr();
                if (xhr.upload) {
                    xhr.upload.addEventListener('progress', function(event) {
                        var percent = 0;
                        var position = event.loaded || event.position;
                        var total = event.total;
                        if (event.lengthComputable) {
                            percent = Math.ceil(position / total * 100);
                        }
                        //update progressbar
                        $("#upload-progress .progress-bar").css("width", + percent +"%");
                    }, true);
                }
                return xhr;
            },
            success: function(data) {

                // clear form fields
                $('input[name=code]').val('');

                if ( data.result ) 
                {
                    // increment tracker cards
                    var sum = 1;
                    sum += +$('#count-receive').text();
                    $('#count-receive').text(sum);

                    // prepend to table if data
                    var row = appendTableRowReceived(data);

                    $('tr.footable-empty').remove();
                    $('table#tableRoutedDocument tbody').prepend(row);

                    $('#tableRoutedDocument').trigger('footable_initialize');
                    form.trigger("reset");

                    Swal.fire({
                        title: "Success!",
                        text:  "Document successfully received.",
                        type: "success"
                    }).then( function() {
                        $("#upload-progress .progress-bar").css("width", 0);
                        // close modal
                        $('#modal-incoming').modal('toggle');
                        $("#codeInput").select();
                    });
                } else {
                    Swal.fire({
                        title: "Error!",
                        text:  "Tracking code undefined.",
                        type: "error"
                    }).then( function() {
                        $("#upload-progress .progress-bar").css("width", 0);
                        $("#codeInput").select();
                    });
                }
            },
            error  : function(xhr, err) {
                Swal.fire({
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
    function appendTableRowReceived (item) {
        var row = $('<tr>' +
                        '<td class="text-center"><a href="#" target="_blank">' + item.tracking_code + '</a></td>' +
                        '<td>' + 
                            '<h5 class="font-weight-bold">' + item.subject + '</h5>' +
                                '<small>'+ item.document_type +' &#9679; '+ item.date_created +'</small><br>' +
                                item.date_created + 
                        '</td>' +
                        // '<td>' + item.note + '</td>' +
                        '<td>' + 
                            '<h5 class="font-weight-bold">' + item.action + '</h5>' +
                            item.date_action +  
                        '</td>' +
                        '<td>' + item.remarks +  '</td>' +
                        // '<td>' + item.keywords +  '</td>' +
                        /* '<td class="text-center">' +
                            '<button type="button" class="btn btn-danger btn-sm btnCancelEvent" data-id="'+ item.id +'" title="Cancel"><i class="ti-close"></i></button>' +
                        '</td>' + */
                    '</tr>');
        return row;
    }
</script>