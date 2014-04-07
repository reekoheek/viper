@section('content')
<?php
use \Bono\App;
use \Viper\Component\Form;
use \Bono\Helper\URL;

$app   = App::getInstance();
$clazz = $app->controller->clazz;
$form  = Form::create($clazz)->of($entry);

?>

<div class="row">
    <div class="alert" style="display: none">
        <button type="button" class="close">×</button>
        <span></span>
    </div>
    <form action="">
        {{ $form->input('title') }}

        <label>Tags</label>
        {{ $form->input('tags') }}

        <input type="hidden" name="content">

        <div class="le-editor"></div>
        <div class="le-preview">
            <h1 class="le-holder">PREVIEW</h1>
        </div>
        <div class="le-action">
            <button class="save">Save</button>
            <a href="{{ URL::base('entries') }}" class="button warning">Cancel</a>
        </div>
    </form>
</div>
@endsection

@section('injector')
<script type="text/javascript" charset="utf-8" src="{{ URL::base('js/highlight/highlight.pack.js') }}"></script>
<script type="text/javascript" charset="utf-8" src="{{ URL::base('js/vendor/marked.js') }}"></script>
<script type="text/javascript" charset="utf-8" src="{{ URL::base('js/ace/ace.js') }}"></script>
<script type="text/javascript" charset="utf-8" src="{{ URL::base('js/create.js') }}"></script>
@endsection
