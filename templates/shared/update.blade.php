@section('content')
<?php
use \ROH\BonoComponent\PlainForm as Form;
use \Bono\App;

$_app        = App::getInstance();
$_controller = $_app->controller;
$_form       = new Form($_controller->clazz);
$entry       = ($entry instanceof \Norm\Model) ? $entry->toArray() : $entry
?>

<h2>{{ $_controller->clazz }}</h2>
<form action="" method="POST">
    <fieldset>
        {{ $_form->renderFields(@$entry) }}
    </fieldset>
    <div class="row">
        <input type="submit" value="Save" class="button">
        <a href="{{ \Bono\Helper\URL::site($_controller->getRedirectUri()) }}" class="button">Back to List</a>
    </div>
</form>
@endsection
