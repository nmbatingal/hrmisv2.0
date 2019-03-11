<form id="frm-example" action="{{ route('semester.store') }}" class="form-horizontal" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="form-group row m-b-0">

                <label class="control-label text-right col-md-2">Month from</label>
                <div class="col-md-4">
                    <input type="month" class="form-control" name="month_from" required>
                    <small class="form-control-feedback">&nbsp;</small> 
                </div>

                <label class="control-label text-right col-md-2">Month to</label>
                <div class="col-md-4">
                    <input type="month" class="form-control" name="month_to" required>
                    <small class="form-control-feedback">&nbsp;</small> 
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group row m-b-0">
                <label class="control-label text-right col-md-2">Status</label>
                <div class="col-md-10">
                    <select class="form-control custom-select" name="status">
                        <option value="0">Inactive</option>
                        <option value="1">Active</option>
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
                                <th>
                                    <label class="custom-control custom-checkbox m-b-0">
                                        <input id="example-select-all" type="checkbox" name="select_all" class="custom-control-input" value="1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                </th>
                                <th>Survey Questions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ( $questions as $question )
                                <tr data-id="{{ $question->id }}">
                                    <td data-id="{{ $question->id }}"></td>
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
                    <button type="submit" class="btn btn-lg btn-success">Submit</button>
                    <button type="button" class="btn btn-lg btn-inverse" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    var table;
    $(document).ready(function() { 
        table = $('#example').DataTable( {
            dom: 'Bfrtip',
            'columnDefs': [{
                 'targets': 0,
                 'searchable': false,
                 'orderable': false,
                 'className': 'text-center',
                 'render': function (data, type, full, meta){
                    $checkbox = '<label class="custom-control custom-checkbox m-b-0">' +
                                    '<input type="checkbox" class="custom-control-input" checked>' +
                                    '<span class="custom-control-label"></span>' +
                                '</label>';

                    return $checkbox;
                 }
            }, {
               'targets': 1,
                'searchable': false,
                'orderable': false
            }],
            select: {
                style:    'os',
                selector: 'td:first-child'
            },
            "lengthChange": false,
            "searching": false,
            "bPaginate": false
        } );

        // Handle click on "Select all" control
        $('#example-select-all').on('click', function(){
            // Check/uncheck all checkboxes in the table
            var rows = table.rows({ 'search': 'applied' }).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });

        $('#frm-example').on('submit', function(e){
          var form = this;

          // Iterate over all checkboxes in the table
          table.$('input[type="checkbox"]').each(function(){
                // If checkbox is checked
                if(this.checked){

                    var $val = $(this).closest('tr').data('id');
                    // Create a hidden element 
                    $(form).append(
                      $('<input>')
                         .attr('type', 'hidden')
                         .attr('name', 'question_id[]')
                         .val($val)
                    );
                }
          });
            form.submit();
          // Prevent actual form submission
          e.preventDefault();
       });
    });
</script>