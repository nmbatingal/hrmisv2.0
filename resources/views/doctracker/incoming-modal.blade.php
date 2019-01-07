<form id="submitModal" class="form-horizontal" action="{{ route('doctracker.incoming.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <!-- SHOW DIV ON ACTION CHANGE TO FORWARDED -->
            <div class="form-group row m-b-0">
                <label class="control-label text-right col-md-2">Tracking Code</label>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="code" value="{{ $tracker['tracking_code'] }}" readonly>
                    <small class="form-control-feedback">&nbsp;</small> 
                </div>

                <label class="control-label text-right col-md-3">Type</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" value="{{ $tracker['other_document'] }}" readonly>
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
                <label class="control-label text-right col-md-2">Details</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" value="{{ $tracker['details'] }}" readonly>
                    <small class="form-control-feedback">&nbsp;</small> 
                </div>
            </div>

            <hr class="p-b-20">
            <div class="form-group row m-b-0">
                <label class="control-label text-right col-md-2">Remarks</label>
                <div class="col-md-10">
                    <textarea class="form-control" name="remarks" rows="3" required></textarea>
                    <small class="form-control-feedback">Include remarks on the routed document.</small> 
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
                    <button type="button" class="btn btn-md btn-inverse" data-dismiss="modal">Cancel</button>
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

                if ( data.result ) 
                {
                    var sum = 1;
                    sum += +$('#count-received').text();
                    $('#count-received').text(sum);

                    var row = appendTableRowReceived(data);

                    $('tr.footable-empty').remove();
                    $('table#document-tracker-received tbody').prepend(row);

                    $('#document-tracker-received').trigger('footable_initialize');
                    form.trigger("reset");

                    swal({
                        title: "Success!",
                        text:  "Document successfully received.",
                        type: "success"
                    }).then( function() {
                       $("#upload-progress .progress-bar").css("width", 0);
                    });
                } else {
                    swal({
                        title: "Error!",
                        text:  "Tracking code undefined.",
                        type: "error"
                    }).then( function() {
                       $("#upload-progress .progress-bar").css("width", 0);
                    });
                }
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
    function appendTableRowReceived (item) {
        var row = $('<tr>' +
                        '<td><a href="#" target="_blank">' + item.tracking_code + '</a></td>' +
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
                        '<td>' + 
                            item.remarks +  
                        '</td>' +
                    '</tr>');
        return row;
    }
</script>