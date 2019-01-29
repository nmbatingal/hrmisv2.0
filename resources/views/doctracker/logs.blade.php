<form class="form-horizontal">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group row m-b-0">
                <label class="control-label text-right font-weight-bold col-md-2">Tracking Code: </label>
                <div class="col-md-3">
                    <input type="hidden" class="form-control" name="code" value="{{ $tracker->tracking_code }}" readonly>
                    <p>{{ $tracker->tracking_code }}</p>
                </div>

                <label class="control-label text-right font-weight-bold col-md-3">Type: </label>
                <div class="col-md-4">
                    <p>{{ $tracker->other_document }}</p>
                </div>
            </div>

            <div class="form-group row m-b-0">
                <label class="control-label text-right font-weight-bold col-md-2">Subject: </label>
                <div class="col-md-9">
                    <p>{{ $tracker->subject }}</p>
                </div>
            </div>

            <div class="form-group row m-b-0">
                <label class="control-label text-right font-weight-bold col-md-2">Details: </label>
                <div class="col-md-9">
                    <p>{{ $tracker->details }}</p>
                </div>
            </div>

            <div class="form-group row m-b-0">
                <label class="control-label text-right font-weight-bold col-md-2">Keywords: </label>
                <div class="col-md-9">
                    @foreach( $tracker->keywordList as $keyword )
                        <span class="badge badge-info">{{ $keyword }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</form>

<div class="table-responsive">
    <table id="table-logs" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <!-- <th>Name</th> -->
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
                    <!-- <td>{{ $log->userEmployee->fullName }}</td> -->
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