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
                    <td>
                        @if ( $log->action == "Forward" )
                            @if ( !is_null( $log->recipients ) )
                                @foreach( $log->recipients as $recipient)
                                    {{ $recipient['name'] }},&nbsp;
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
            }
        ]
    });

</script>