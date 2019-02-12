<div class="p-20">
    <h5 class="font-weight-bold">{{ $tracker->subject }}</h5>
    <p class="p-l-20 p-r-40">{{ $tracker->details }}</p>
    <p> <small>tags: </small>
        @foreach( $tracker->keywordList as $keyword )
            <span class="badge badge-info">{{ $keyword }}</span>
        @endforeach
    </p>
</div>

<div class="table-responsive p-l-10 p-r-10">
    <table id="table-logs" class="display nowrap table table-hover color-bordered-table muted-bordered-table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Status</th>
                <th></th>
                <th>Notes</th>
                <th>Remarks</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse ( $documents as $log )
                <tr>
                    <td>{{ $log->action }}</td>
                    <td>{{ $log->userEmployee->fullName }}</td>
                    <td>{{ $log->notes }}</td>
                    <td>{{ $log->remarks }}</td>
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
                    window.open("{{ route('doctracker.export.routingcode', $tracker->tracking_code) }}");
                }
            }
        ]
    });

</script>