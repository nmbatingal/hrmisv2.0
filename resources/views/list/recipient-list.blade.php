@forelse( $list['recipients'] as $recipient )

<option value="{{ $recipient['id'] }},{{ $recipient['type'] }}" data-img="img/blank.png" selected>
	{{ $recipient['name'] }}
</option>

@empty
@endforelse

<option value="00,all" data-img="img/blank.png">
	All employee
</option>
@forelse($employees as $employee)
    <option value="{{ $employee->id }},individual" data-img="{{ $employee->user_image }}">
    	{{ $employee->full_name }} ({{ $employee->office->div_acronym }})
    </option>
@empty
@endforelse
@forelse($groups as $group)
    <option value="{{ $group->id }},group" data-img="img/blank.png">
    	{{ $group->group_name }} ({{ $group->acronym }})
    </option>
@empty
@endforelse