@forelse($employees as $employee)
    <option value="{{ $employee->id }}">{{ $employee->full_name }}</option>
@empty
@endforelse