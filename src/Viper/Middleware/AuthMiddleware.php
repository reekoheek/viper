<?php

namespace Viper\Middleware;

use Slim\Middleware;

/**
 * Check user access based on config and authentication
 *
 * @category  App
 * @package   Viper
 * @author    Krisan Alfa Timur <krisan47@gmail.com>
 * @copyright 2013 PT Sagara Xinix Solusitama
 * @license   https://raw.github.com/krisanalfa/viper/master/LICENSE MIT
 * @version   Release: 0.0.1
 * @link      http://xinix.co.id/products/viper
 */
class AuthMiddleware extends Middleware
{
    /**
     * Check user access based on config and authentication
     *
     * @return void
     */
    public function call()
    {
        $config   = $this->app->config('auth');
        $pathInfo = $this->app->request->getPathInfo();
        $allow    = $this->app->auth->check();

        if($pathInfo === '') $pathInfo ='/';

        foreach ($config['allow'] as $key => $value) {
            if ($this->checkURL($key, $pathInfo)) return $this->next->call();
        }

        if ($allow) {
            $this->next->call();
        } else {
            $this->app->render('unauthorized', array(), 401);
            $this->app->stop();
        }
    }

    /**
     * Determine if URL can be accessed
     *
     * @param  string $uri
     * @param  string $request
     *
     * @return bool
     */
    protected function checkURL($uri, $request)
    {
        $pattern = "@^" . preg_replace('/(:id)+/', '([a-zA-Z0-9\-\_\.\?\:]+)', $uri) . "$@D";

        return (preg_match($pattern, $request) > 0) ? true : false;
    }
}
