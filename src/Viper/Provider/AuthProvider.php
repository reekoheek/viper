<?php

namespace Viper\Provider;

use Bono\Provider\Provider;

/**
 * Resolve this class to the container, so it's being shared over Bono Container
 *
 * @author      Krisan Alfa Timur <krisan47@gmail.com>
 * @copyright   2013 PT Sagara Xinix Solusitama
 * @link        http://xinix.co.id/products/viper
 * @license     https://raw.github.com/krisanalfa/viper/master/LICENSE
 * @package     Viper
 */
class AuthProvider extends Provider
{
    /**
     * Auth Configuration
     *
     * @var array
     */
    protected $config = array();

    /**
     * Initializing, make the AuthProvider into IoC
     *
     * @return void
     */
    public function initialize()
    {
        $app          = $this->app;
        $this->config = $this->app->config('auth');

        $that = $this;

        $app->container->singleton('login', function ($c) use ($that) {
            return $that;
        });
    }

    /**
     * Authenticate a single user
     *
     * @param  array $user The user who is being authenticated
     * @return void
     */
    public function auth($user)
    {
        $id = $this->config['id'];

        $user = $user->toArray();

        $_SESSION['auth'][$id]          = array();
        $_SESSION['auth'][$id]['user']  = $user;
        $_SESSION['auth'][$id]['login'] = true;
    }

    /**
     * Deauth a single user
     *
     * @return void
     */
    public function deauth()
    {
        $id = $this->config['id'];

        $_SESSION['auth'][$id] = array();
        $_SESSION['auth'][$id]['login'] = false;
    }

    /**
     * Get information about the authenticated user
     *
     * @param  string $section The section of user info that we want to investigate
     * @param  string $value   The value that we want to change into something
     * @return mixed           Can be null if the user isn't auth'd
     */
    public function user($section = null, $value = null)
    {
        $id = $this->config['id'];

        if ($this->check()) {
            if (!is_null($value) and (!is_null($section))) {
                $_SESSION['auth'][$id]['user'][$section] = $value;
            }

            if (is_null($section)) {
                return $_SESSION['auth'][$id]['user'];
            } else {
                if (isset($_SESSION['auth'][$id]['user'][$section])) {
                    return $_SESSION['auth'][$id]['user'][$section];
                }

                return null;
            }
        } else {
            return null;
        }
    }

    /**
     * Check whether user is auth'd
     *
     * @return boolean
     */
    public function check()
    {
        $id = $this->config['id'];

        if (isset($_SESSION['auth'][$id])) {
            return (isset($_SESSION['auth'][$id]['login']) ? $_SESSION['auth'][$id]['login'] : false);
        } else {
            $_SESSION['auth'][$id] = array();

            return false;
        }
    }
}
