@section('content')
<?php

use ROH\BonoComponent\PlainForm as Form;
use Bono\App;
use Bono\Helper\URL;

$_app        = App::getInstance();
$_controller = $_app->controller;
$_form       = new Form($_controller->clazz);

?>

<h2>{{ $_controller->clazz }}</h2>

<fieldset> {{ $_form->renderReadonlyFields(@$entry) }} </fieldset>

<div class="row">
    <a href="{{ \Bono\Helper\URL::site($_controller->getRedirectUri()) }}" class="button">Back to List</a>
</div>
@endsection
