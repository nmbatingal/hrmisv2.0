<table>
    <thead>
    <tr>
        <th>Tracking Code</th>
        <th>Action</th>
        <th>Datetime</th>
        <th>Document Type</th>
        <th>Created by</th>
        <th>Subject</th>
        <th>Forwarded To</th>
        <th>Action By</th>
        <th>Remarks</th>
        <th>Notes</th>
    </tr>
    </thead>
    <tbody>
    @foreach($documentsLog as $log)
        <tr>
            <td>{{ $log->tracking_code }}</td>
            <td>{{ $log->action }}</td>
            <td>{{ $log->created_at }}</td>
            <td>{{ $log->documentCode->documentType->document_name }}</td>
            <td>{{ $log->documentCode->userEmployee->fullName }}</td>
            <td>{{ $log->documentCode->subject }}</td>
            <td>
                @if ( !is_null( $log->recipients ) )
                    @foreach( $log->recipients as $recipient)
                        <li>{{ $recipient['name'] }}</li>
                    @endforeach
                @endif
            </td>
            <td>{{ $log->userEmployee->fullName }}</td>
            <td>{{ $log->remarks }}</td>
            <td>{{ $log->notes }}</td>
        </tr>
    @endforeach
    </tbody>
</table>