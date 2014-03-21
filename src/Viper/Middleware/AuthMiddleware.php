<?php

namespace Viper\Middleware;

/**
 * Check user access based on config and authentication
 *
 * @author      Krisan Alfa Timur <krisan47@gmail.com>
 * @copyright   2013 PT Sagara Xinix Solusitama
 * @link        http://xinix.co.id/products/viper
 * @license     https://raw.github.com/krisanalfa/viper/master/LICENSE
 * @package     Viper
 */
class AuthMiddleware extends \Slim\Middleware
{

    /**
     * Checking config match against request
     *
     * @param  string $string The request path info
     * @param  array  $array  A stack of URI that we want to check against the request
     * @return bool
     */
    private function inArray($string, $array = array())
    {
        foreach ($array as $key => $value)
        {
            if (fnmatch($key, $string))
            {
                return true;
            }
        }

        return false;
    }

    /**
     * Check user access based on config and authentication
     *
     * @return \Bono\Http\Response
     */
    public function call()
    {
        $config   = $this->app->config('auth');
        $pathInfo = $this->app->request->getPathInfo();
        $app      = $this->app;
        $allow    = false;

        // If request is allowed in config and not in restricted page
        if ($this->inArray($pathInfo, $config['allow']) and ! $this->inArray($pathInfo, $config['restricted']))
        {
            $allow = true;
        }

        if (! $allow)
        {
            // If user is logged in
            if ($app->login->check()) {
                $this->next->call();
            }
            else
            {
                $this->app->render('unauthorized', array(), 401);
                $this->app->stop();
            }
        }
        else
        {
            $this->next->call();
        }

    }
}
