<?php

namespace Viper\Provider;

use \Bono\Helper\URL;
use \Bono\Provider\Provider;
use \Norm\Norm;

/**
 * Basic URI mapping that not handled by NormController
 *
 * @author      Krisan Alfa Timur <krisan47@gmail.com>
 * @copyright   2013 PT Sagara Xinix Solusitama
 * @link        http://xinix.co.id/products/viper
 * @license     https://raw.github.com/krisanalfa/viper/master/LICENSE
 * @package     Viper
 */
class ViperProvider extends Provider
{

    /**
     * Initialize the provider
     *
     * @return void
     */
    public function initialize()
    {
        $app = $this->app;

        // Get the index page
        $app->get('/', function () use ($app) {
            $app->render('hello');
        });

        // Get the about page
        $app->get('/about', function () use ($app) {
            $app->render('about');
        });

        // Get the login page
        $app->get('/login', function () use ($app) {
            $app->render('login');
        });

        // Logout process
        $app->get('/logout', function () use ($app) {
            $app->auth->forget();
            h('notification.info', 'Bye bye :(');

            $app->response->redirect('/login');
        });

        // Login process
        $app->post('/login', function () use ($app) {
            $post   = $app->request->post();
            $author = Norm::factory('Author')->findOne(array('username' => $post['username']));

            // Wrong username
            if (is_null($author)) {
                h('notification.error', 'Invalid credentials');

                return $app->render('login');
            }

            // Username and password match
            if (password_verify($post['password'], $author->get('password'))) {
                $app->auth->authenticate($author);
                h('notification.info', 'Hello there :)');

                return $app->response->redirect('/entries');
            } else {
                // Wrong password
                h('notification.error', 'Invalid credentials');

                $app->render('login');
            }
        });
    }
}
