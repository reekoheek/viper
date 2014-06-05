<?php

namespace Viper\Provider;

use Bono\Provider\Provider;

/**
 * Resolve this class to the container, so it's being shared over Bono Container
 *
 * @category  App
 * @package   Viper
 * @author    Krisan Alfa Timur <krisan47@gmail.com>
 * @copyright 2013 PT Sagara Xinix Solusitama
 * @license   https://raw.github.com/krisanalfa/viper/master/LICENSE MIT
 * @version   Release: 0.0.1
 * @link      http://xinix.co.id/products/viper
 */
class AuthProvider extends Provider
{
    /**
     * Auth Configuration
     *
     * @var array
     */
    protected $config = array();

    protected $sessionId = '';

    protected $session = array();

    /**
     * Initializing, make the LoginProvider into IoC
     * @return void
     */
    public function initialize()
    {
        $app          = $this->app;
        $this->config = $this->app->config('auth');
        $that         = $this;

        if (! $this->check()) $this->forget();

        $app->container->singleton('auth', function ($c) use ($that) {
            return $that;
        });
    }

    /**
     * Authenticate a single user
     * @param  array $user The user who is being authenticated
     * @return void
     */
    public function authenticate($user)
    {
        $_SESSION['auth'][$this->config['id']]['user']         = $user->toArray();
        $_SESSION['auth'][$this->config['id']]['login']        = true;
    }

    /**
     * Deauth a single user
     * @return void
     */
    public function forget()
    {
        $_SESSION['auth'][$this->config['id']]          = array();
        $_SESSION['auth'][$this->config['id']]['login'] = false;
        $_SESSION['auth'][$this->config['id']]['user']  = null;
    }

    /**
     * Get information about the authenticated user
     * @return mixed           Can be null if the user isn't auth'd
     */
    public function user()
    {
        return isset($_SESSION['auth'][$this->config['id']]['user']) ? $_SESSION['auth'][$this->config['id']]['user'] : null;
    }

    /**
     * Check whether user is auth'd
     * @return boolean
     */
    public function check()
    {
        $auth = false;

        if (isset($_SESSION['auth'][$this->config['id']]['login'])) {
            $auth = $_SESSION['auth'][$this->config['id']]['login'];
        } else {
            $this->forget();
        }

        return $auth;
    }
}
