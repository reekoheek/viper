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
     * Checking config match against request
     *
     * @param string $string The request path info
     * @param array  $array  Array of URI that we want to check against the request
     *
     * @return bool
     */
    private function _inArray($string, $array = array())
    {
        foreach ($array as $key => $value) {
            if (fnmatch($key, $string)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check user access based on config and authentication
     *
     * @return void
     */
    public function call()
    {
        $config   = $this->app->config('auth');
        $pathInfo = $this->app->request->getPathInfo();
        $allow    = false;

        if($pathInfo === '') $pathInfo ='/';

        foreach ($config['allow'] as $key => $value) {
            if ($this->checkURL($key, $pathInfo)) return $this->next->call();
        }

        $allow = $this->app->auth->check();

        if ($allow) {
            $this->next->call();
        } else {
            $this->app->render('unauthorized', array(), 401);
            $this->app->stop();
        }
    }

    protected function checkURL($uri, $request)
    {
        if($uri == '*') return true;

        $pattern = "@^" . preg_replace('/(:id)+/', '([a-zA-Z0-9\-\_\.\?\:]+)', $uri) . "$@D";

        return (preg_match($pattern, $request) > 0) ? true : false;
    }
}
