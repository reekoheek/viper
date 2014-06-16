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

        <article class="tabs">
            <section>
                <h2>
                    <a class="nav active" href="#source">Source</a>
                </h2>
                <div class="content active" id="source">
                    <div class="editor-wrapper">
                        <textarea class="editor" name="content" data-editor="markdown">{{ $form->data('content') }}</textarea>
                        <span class="help-block"><small>Your input parsed in GitHub Flavored Markdown</small></span>
                    </div>
                </div>
            </section>

            <section>
                <h2>
                    <a class="nav" href="#review">Preview</a>
                </h2>
                <div class="content" id="review"></div>
            </section>
        </article>

        <div class="le-action">
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
