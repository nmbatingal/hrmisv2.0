<div class="p-20">
    <p>keywords:
        @foreach( $tracker->documentKeywords as $keyword )
            <span class="badge badge-info">{{ $keyword->keywords }}</span>
        @endforeach
    </p>
</div>

<div class="table-responsive p-l-10 p-r-10">
    <table id="table-logs" class="display nowrap table table-hover color-bordered-table muted-bordered-table table-striped" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>User</th>
                <th>Status</th>
                <th></th>
                <th>Note</th>
                <th>Datetime</th>
            </tr>
        </thead>
        <tbody>
            @forelse ( $documents as $log )
                <tr>
                    <td>{{ $log->userEmployee->fullName }}</td>
                    <td>{{ $log->action }}</td>
                    <td >
                        @if ( $log->action == "Forward" )
                            @if ( !is_null( $log->recipients ) )
                                @foreach( $log->recipients as $recipient)
                                    <li>{{ $recipient['name'] }}<br>
                                @endforeach
                            @else
                                All
                            @endif
                        @endif
                    </td>
                    <td>
                        {!! $log->forSignature ? 'For signature.&nbsp;' : '' !!}
                        {!! $log->forCompliance ? 'For Compliance.&nbsp;' : '' !!}
                        {!! $log->forInformation ? 'For Information.&nbsp;' : '' !!}
                        {{ $log->notes ?: '' }}
                    </td>
                    <td>{{ $log->dateAction}}</td>
                </tr>
            @empty
            @endforelse
        </tbody>
    </table>
</div>

<script>
    $(document).on("click", "#btnCancelEvent", function (e) {

        e.preventDefault();
        
        var btn    = $(this),
            token  = "{{ csrf_token() }}";

        $.ajax({
            url: btn.attr('href'),
            type: 'POST',
            data: {
                "id": btn.data('id'),
                "_method": 'DELETE',
                "_token": token,
            },
            success: function (data) {
                
                console.log(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                Swal.fire("Error deleting!", thrownError, "error");
            }
        });
    });
</script>

<script>
    var tableLog = $('#table-logs').DataTable({
        fixedHeader: true,
        columnDefs: [{ 
            orderable: false, 
            targets: [0,1,2,3] 
        }],
        order: [[ 4, "desc" ]],
        dom: '<"top"l<"float-right"i>>rt<"bottom"<"float-left"B><p>><"clear">',
        buttons: [
            {
                text: 'Export Log',
                className: 'btn btn-primary',
                action: function ( e, dt, node, config ) {
                    window.open("{{ route('optima.route-documents.export.code', $tracker->tracking_code) }}");
                }
            },
            {
                text: '<i class="ti-printer"></i> Print Code',
                className: 'btn btn-danger btnDocOwner',
                action: function ( e, dt, node, config ) {
                    var url = "{{ route('optima.print.barcode', $tracker->tracking_code) }}";
                    window.open(url, "Print Barcode", "width=800,height=600");
                }
            }
        ]
    });
</script>