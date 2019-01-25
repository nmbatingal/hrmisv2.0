<table>
    <thead>
    <tr>
        <th>Tracking Code</th>
        <th>Subject</th>
        <th>Document Type</th>
        <th>Created by</th>
        <th>Action Performed</th>
        <th>Action By</th>
        <th>Remarks</th>
        <th>Notes</th>
        <th>Datetime</th>
    </tr>
    </thead>
    <tbody>
    @foreach($documentsLog as $log)
        <tr>
            <td>{{ $log->tracking_code }}</td>
            <td>{{ $log->documentCode->subject }}</td>
            <td>{{ $log->documentCode->documentType->document_name }}</td>
            <td>{{ $log->documentCode->userEmployee->fullName }}</td>
            <td>{{ $log->action }}</td>
            <td>{{ $log->userEmployee->fullName }}</td>
            <td>{{ $log->remarks }}</td>
            <td>{{ $log->created_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>