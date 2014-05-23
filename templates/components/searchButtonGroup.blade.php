<?php use ROH\Util\Inflector; ?>

<div class="button-group">
    @foreach ($config as $key => $button)
        <a href="{{ URL::site($controller->getBaseUri().'/null/'.$key) }}" class="button">
            {{ Inflector::classify($key) }}
        </a>
    @endforeach
</div>
