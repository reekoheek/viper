<?php

use Bono\App;

$config = array();
$app    = App::getInstance();
$path   = $app->config('config.path') . DIRECTORY_SEPARATOR . 'chunks';

if ($directoryHandler = opendir($path)) {
    while (($fileName = readdir($directoryHandler)) !== false) {
        if (is_file($path . DIRECTORY_SEPARATOR . $fileName)) {
            $content = require_once($path . DIRECTORY_SEPARATOR . $fileName);
            $config  = array_merge_recursive($config, $content);
        }
    }

    closedir($directoryHandler);
}

return $config;
