<?php

namespace Viper\Component;

use \Bono\App;
use \Slim\View;

/**
 * Search Button Group (It's above the resource table)
 *
 * @author      Krisan Alfa Timur <krisan47@gmail.com>
 * @copyright   2013 PT Sagara Xinix Solusitama
 * @link        http://xinix.co.id/products/viper
 * @license     https://raw.github.com/krisanalfa/viper/master/LICENSE
 * @package     Viper
 */
class SearchButtonGroup
{
    protected $config;

    /**
     * Contstructor, build the basic configuration
     *
     * @return void
     */
    public function __construct()
    {
        $app    = App::getInstance();
        $config = $app->config('component.searchButtonGroup');

        if (isset($config['mapping'][$app->controller->clazz]))
        {
            $this->config = $config['mapping'][$app->controller->clazz];
        }
        else
        {
            $this->config = $config['default'];
        }
    }

    /**
     * Show the search button group
     *
     * @return string A partial component
     */
    public function show()
    {
        $app = App::getInstance();

        return $app->theme->partial('components/searchButtonGroup', array(
            'self'       => $this,
            'controller' => $app->controller,
            'config'     => $this->config,
        ));
    }
}
