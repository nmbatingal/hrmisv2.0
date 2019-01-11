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
                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                        <label class="custom-control-label" for="customCheck1">Check this custom checkbox</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck2">
                        <label class="custom-control-label" for="customCheck2">Check this custom checkbox</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck3">
                        <label class="custom-control-label" for="customCheck3">Check this custom checkbox</label>
                    </div>
                    Others
                    <textarea class="form-control" name="remarks" rows="3" required></textarea>
                    <small class="form-control-feedback">Include remarks regarding on the routed document.</small> 
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
                
                $('input[name=code]').val('');

                if ( data.result ) 
                {
                    var sum = 1;
                    sum += +$('#count-receive').text();
                    $('#count-receive').text(sum);

                    var row = appendTableRowReceived(data);

                    $('tr.footable-empty').remove();
                    $('table#tableRoutedDocument tbody').prepend(row);

                    $('#tableRoutedDocument').trigger('footable_initialize');
                    form.trigger("reset");

                    swal({
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
                    swal({
                        title: "Error!",
                        text:  "Tracking code undefined.",
                        type: "error"
                    }).then( function() {
                        $("#upload-progress .progress-bar").css("width", 0);
                        // clear form fields
                        $("#codeInput").select();
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
                    $("#codeInput").select();
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
                            item.remarks +  
                        '</td>' +
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