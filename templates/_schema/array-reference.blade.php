@foreach($entries as $entry)
<?php

if (is_callable($self->get('foreignLabel'))) {
    $getLabel = $self->get('foreignLabel');
    $label    = $getLabel($entry);
} else {
    $label = $entry[$self->get('foreignLabel')];
}

?>
<div class="role-check">
    <label class="placeholder">
        <input
            type="checkbox"
            name="{{ $self['name'] }}[]"
            value="{{ $entry['$id'] }}"
            {{ (in_array($entry['$id'], $value) ? 'checked' : '') }}
        />
        {{ $label }}
    </label>
</div>
@endforeach
