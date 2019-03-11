@forelse($offices as $office)
    <option value="{{ $office->id }}">{{ $office->division_name }}</option>
@empty
@endforelse