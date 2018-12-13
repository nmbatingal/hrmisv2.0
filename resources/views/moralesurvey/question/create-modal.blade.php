<form id="submitModal" action="{{ route('question.store') }}" class="form-horizontal" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <p>Create a morale survey question.</p>
        </div>
        <div class="col-md-12">
            <div class="form-group row m-b-0">
                <label class="control-label text-right col-md-2">Question</label>
                <div class="col-md-10">
                    <textarea type="text" rows="5" class="form-control" name="question" required></textarea>
                    <small class="form-control-feedback">Enter question in a sentence case form.</small> 
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
    $('form#submitModal').on('submit', function(e) {
        e.preventDefault();
        var form = $(this); 

        $.ajax({
            method : 'POST',
            url    : form.attr('action'),
            data   : form.serialize(),
            success: function(data) {

                // console.log(data);

                // prepend to table if data
                var row = appendRow(data);

                $('table#myTable tbody').append(row);
                // $('#myTable').DataTable().draw();
                // ----------------------------------------------------------- //

                // close modal
                $('#modal-question').modal('toggle');
            },
            error  : function(xhr, err) {
                alert("Error! Could not retrieve the data.");
            }
        });

        return false;
    });

    // row to be added
    function appendRow (item) {
        var row = $('<tr id="'+ item.id +'">' +
                        '<td></td>' +
                        '<td>'+ item.question +'</td>' +
                        '<td class="text-center">' +
                            '<a href="javascript:void(0)" title="update" class="btn btn-info btn-outline btn-sm"><i class="ti-pencil"></i></a>' +
                            '<a href="javascript:void(0)" title="delete" class="btn btn-secondary btn-danger btn-sm"><i class="ti-trash"></i></a>' +
                        '</td>' +
                    '</tr>');
        return row;
    }
</script>