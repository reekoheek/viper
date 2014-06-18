@section('content')
<?php use Bono\Helper\URL;?>

<div class="row">
    <div id="bloodhound" class="span-3 read">
        <input class="typeahead" name="title" type="text" placeholder="Search entries">
    </div>
</div>

<div class="container post"></div>
@endsection

@section('injector')
<script type="text/javascript" charset="utf-8" src="{{ URL::base('js/highlight/highlight.pack.js') }}"></script>
<script type="text/javascript" charset="utf-8" src="{{ URL::base('js/vendor/marked.js') }}"></script>
<script type="text/javascript" charset="utf-8" src="{{ URL::base('js/vendor/typeahead.bundle.js') }}"></script>
<script type="text/javascript" charset="utf-8" src="{{ URL::base('js/read.js') }}"></script>
@endsection
