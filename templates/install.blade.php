@section('content')
<?php
use \ROH\BonoComponent\PlainForm as Form;
use \Bono\App;

$app        = App::getInstance();
$form       = new Form('Author');
?>

<div class="row alert-row">
    @if(isset($_SESSION['error']))
        <div class="alert error">
            <button type="button" class="close">×</button>
            {{ $_SESSION['error'] }}
        </div>
    @endif
</div>

<div class="container">
    <h1 class="text-center">Welcome to Viper Installation Page</h1>
    <h3>
        <small>
            The database is empty for the Author field and you must have at least one active Author.
            You can create author once. After this, you would never seen me anymore.
        </small>
    </h3>
</div>

<form action="{{ \Bono\Helper\Url::site('/install') }}" method="POST">
    <fieldset>
        {{ $form->renderFields(@$entry) }}
    </fieldset>
    <div class="row">
        <input type="submit" value="Save" class="button">
    </div>
</form>
@endsection

@section('injector')
<script type="text/javascript" charset="utf-8" src="{{ URL::base('js/vendor/jquery.validation.js') }}"></script>
<script type="text/javascript" charset="utf-8" src="{{ URL::base('js/install.js') }}"></script>
@endsection
