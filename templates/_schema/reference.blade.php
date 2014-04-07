<?php
$entries = \Norm\Norm::factory('Tags')->find();
?>

<select name="{{ $self->get('name') }}">
    <option value="">Select one</option>
    @foreach ($entries as $entry)
        <option value="{{ $entry->getId() }}" {{ ($entry->getId() === $value ? 'selected' : '') }}>
            {{ $entry->get('name') }}
        </option>
    @endforeach
</select>
