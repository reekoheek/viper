@section('content')
<?php

use Bono\App;
use Viper\Component\Form;
use Bono\Helper\URL;

$form = Form::create(App::getInstance()->controller->clazz)->of($entry);
$tags = $entry['tags'] ?: array();
$array = array();

if ($tags instanceof \Norm\Type\NormArray) {
    $tags = $tags->toArray();
}

foreach ($tags as $id) {
    $model = \Norm::factory('Tags')->findOne($id);
    if ($model) {
        $array[] = $model->toArray();
    }
}
?>

<div class="row">
    <div class="alert" style="display: none">
        <button type="button" class="close">×</button>
        <span></span>
    </div>

    <form action="" method="POST">
        <div class="row">
            <div class="span-6">
                {{ $form->input('title') }}
            </div>
            <div class="span-6">
                <select id="test" multiple placeholder="Insert tags" name="tags[]">
                    <option value="Amsterdam">Amsterdam</option>
                    @foreach ($array as $tag)
                        <option value="{{ $tag['$id'] }}"> {{ $tag['name'] }} </option>
                    @endforeach
                </select>
            </div>
        </div>

        <input type="hidden" name="content">

        <div class="le-editor">{{ $form->data('content') }}</div>

        <div class="le-preview"></div>

        <div class="le-action">
            <button class="show-preview">Preview</button>
            <button class="save">Save</button>
            <a href="{{ URL::site('/entries') }}" class="button warning">Cancel</a>
        </div>
    </form>
</div>
@endsection

@section('injector')
<script type="text/javascript">
    var arr  = window.arr = [];
    @foreach ($array as $tag)
        arr.push({
            'id' : '{{ $tag['$id'] }}',
            'text': '{{ $tag['name'] }}'
        });
    @endforeach
</script>
<script type="text/javascript" charset="utf-8" src="{{ URL::base('js/highlight/highlight.pack.js') }}"></script>
<script type="text/javascript" charset="utf-8" src="{{ URL::base('js/vendor/marked.js') }}"></script>
<script type="text/javascript" charset="utf-8" src="{{ URL::base('js/ace/ace.js') }}"></script>
<script type="text/javascript" charset="utf-8" src="{{ URL::base('js/vendor/typeahead.bundle.js') }}"></script>
<script type="text/javascript" charset="utf-8" src="{{ URL::base('js/vendor/tagsinput.js') }}"></script>
<script type="text/javascript" charset="utf-8" src="{{ URL::base('js/update.js') }}"></script>
@endsection
