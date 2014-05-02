@section('content')
<?php

use ROH\BonoComponent\PlainForm as Form;
use Bono\App;
use Bono\Helper\URL;
use Norm\Model;

$app        = App::getInstance();
$controller = $app->controller;
$form       = new Form($controller->clazz);
$entry      = ($entry instanceof Model) ? $entry->toArray() : $entry

?>

<h2>{{ $controller->clazz }}</h2>
<form action="" method="POST">
    <fieldset>
        {{ $form->renderFields(@$entry) }}
    </fieldset>
    <div class="row">
        <input type="submit" value="Save" class="button">
        <a href="{{ URL::site($controller->getRedirectUri()) }}" class="button">Back to List</a>
    </div>
</form>
@endsection
