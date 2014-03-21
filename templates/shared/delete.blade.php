@section('content')
<?php

use \Bono\App;

$_app        = App::getInstance();
$_controller = $_app->controller;

?>

<h2>{{ $_controller->clazz }}</h2>

<form action="" method="POST">
    <input type="hidden" name="confirm" value="1">
    <fieldset>
        Are you sure want to delete?
    </fieldset>

    <input type="submit" value="OK" class="button alert">
    <a href="{{ \Bono\Helper\URL::site($_controller->getRedirectUri()) }}" class="button">Cancel</a>
</form>
@endsection
