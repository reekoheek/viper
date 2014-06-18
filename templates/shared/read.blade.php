@section('content')
<?php

use Viper\Component\Form;
use Bono\App;
use Bono\Helper\URL;

$app        = App::getInstance();
$controller = $app->controller;
$form       = new Form($controller->clazz);

?>

<h2>{{ $controller->clazz }}</h2>

<fieldset> {{ $form->renderReadonlyFields(@$entry) }} </fieldset>

<div class="row">
    <a href="{{ URL::site($controller->getRedirectUri()) }}" class="button">Back to List</a>
</div>
@endsection
