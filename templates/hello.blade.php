@section('content')
<?php use \Bono\Helper\URL; ?>

<div class="row">
    <div id="bloodhound" class="span-4">
        <div class="input-button">
            <div class="span-9">
                <input class="typeahead" name="title" type="text" placeholder="Search entries">
            </div>
            <div class="span-3">
                <button class="button search">Search</button>
            </div>
        </div>
    </div>
</div>

<div class="container posts">

</div>
@endsection

@section('injector')
<script type="text/javascript" charset="utf-8" src="{{ URL::base('js/highlight/highlight.pack.js') }}"></script>
<script type="text/javascript" charset="utf-8" src="{{ URL::base('js/marked.js') }}"></script>
<script type="text/javascript" charset="utf-8" src="{{ URL::base('js/typeahead.bundle.js') }}"></script>
<script type="text/javascript" charset="utf-8" src="{{ URL::base('js/hello.js') }}"></script>
@endsection
