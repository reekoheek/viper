@section('content')
<?php

use \ROH\BonoComponent\PlainTable as Table;
use \Viper\Component\SearchButtonGroup;
use \Bono\App;

$_app               = App::getInstance();
$_controller        = $_app->controller;
$_table             = new Table($_controller->clazz);
$_searchButtonGroup = new SearchButtonGroup();

?>

<h2>{{ $_controller->clazz }}</h2>

{{ $_searchButtonGroup->show() }}

{{ $_table->show($entries) }}
@endsection
