@section('content')
<?php

use ROH\BonoComponent\PlainTable as Table;
use Viper\Component\SearchButtonGroup;
use Bono\App;

$app               = App::getInstance();
$table             = new Table($app->controller->clazz);
$searchButtonGroup = new SearchButtonGroup();

?>

<h2>{{ $app->controller->clazz }}</h2>

{{ $searchButtonGroup->show() }}

{{ $table->show($entries) }}
@endsection
