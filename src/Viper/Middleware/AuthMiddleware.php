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
        $app          = $this->app;
        $config       = $app->config('auth');
        $pathInfo     = $app->request->getPathInfo();
        $allow        = $this->_inArray($pathInfo, $config['allow']);
        $inRestricted = $this->_inArray($pathInfo, $config['restricted']);

        // If request is allowed in config and not in restricted page
        if ($allow and ! $inRestricted) {
            $allow = true;
        }

        if (! $allow) {
            // If user is logged in
            if ($app->login->check()) {
                $this->next->call();
            } else {
                $app->render('unauthorized', array(), 401);
                $app->stop();
            }
        } else {
            $this->next->call();
        }
    }
}
