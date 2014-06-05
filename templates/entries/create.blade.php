@section('content')
<?php

use Bono\App;
use Viper\Component\Form;
use Bono\Helper\URL;

$form = Form::create(App::getInstance()->controller->clazz)->of($entry);

?>

<div class="row">
    <form action="" method="POST">
        <div class="row">
            <div class="span-6">
                {{ $form->input('title') }}
            </div>
            <div class="span-6">
                <select id="test" multiple placeholder="Insert tags" name="tags[]"></select>
            </div>
        </div>

        <input type="hidden" name="content">

        <div class="le-editor"></div>

        <div class="le-preview">
            <h1 class="le-holder">PREVIEW</h1>
        </div>

        <div class="le-action">
            <button class="show-preview">Preview</button>
            <button class="save">Save</button>
            <a href="{{ URL::site('entries') }}" class="button warning">Cancel</a>
        </div>
    </form>
</div>
@endsection

@section('injector')
<script type="text/javascript" charset="utf-8" src="{{ URL::base('js/highlight/highlight.pack.js') }}"></script>
<script type="text/javascript" charset="utf-8" src="{{ URL::base('js/vendor/marked.js') }}"></script>
<script type="text/javascript" charset="utf-8" src="{{ URL::base('js/ace/ace.js') }}"></script>
<script type="text/javascript" charset="utf-8" src="{{ URL::base('js/vendor/typeahead.bundle.js') }}"></script>
<script type="text/javascript" charset="utf-8" src="{{ URL::base('js/vendor/tagsinput.js') }}"></script>
<script type="text/javascript" charset="utf-8" src="{{ URL::base('js/create.js') }}"></script>
@endsection
