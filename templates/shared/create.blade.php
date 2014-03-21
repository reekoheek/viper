@section('content')
<?php
use \ROH\BonoComponent\PlainForm as Form;
use \Bono\App;

$app        = App::getInstance();
$controller = $app->controller;
$form       = new Form($controller->clazz);

?>
<h2 class="module">{{ $controller->clazz }}</h2>

<form action="" method="POST">
    <fieldset>
        {{ $form->renderFields(@$entry) }}
    </fieldset>
    <div class="row">
        <input type="submit" value="Save" class="button">
        <a href="{{ \Bono\Helper\URL::site($controller->getRedirectUri()) }}" class="button">Back to List</a>
    </div>
</form>

@endsection
