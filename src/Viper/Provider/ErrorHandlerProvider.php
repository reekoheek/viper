<?php

namespace Viper\Provider;

use \Bono\Provider\Provider;

/**
 * Handle the application error event
 *
 * @author      Krisan Alfa Timur <krisan47@gmail.com>
 * @copyright   2013 PT Sagara Xinix Solusitama
 * @link        http://xinix.co.id/products/viper
 * @license     https://raw.github.com/krisanalfa/viper/master/LICENSE
 * @package     Viper
 */
class ErrorHandlerProvider extends Provider
{
    /**
     * Handle application error and not found request
     *
     * @return void
     */
    public function initialize()
    {
        $app = $this->app;

        // If not in debug mode
        if (! $app->config('debug')) {
            $app->error(function () use ($app) {
                $app->render('error', array(), 500);
                $app->stop();
            });

            // Show custom error 404 page
            $app->notFound(function () use ($app) {
                $app->render('notFound', array(), 404);
                $app->stop();
            });
        }
    }
}
