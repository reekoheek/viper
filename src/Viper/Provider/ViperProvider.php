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

        // Handle error
        if(! $app->config('debug'))
        {
            $app->error(function() use ($app) {
                $app->view->render('error', array(), 500);
            });

            // Handle not found
            $app->notFound(function() use ($app) {
                $app->view->render('notFound', array(), 404);
            });
        }

        // Get the index page
        $app->get('/', function() use ($app)
        {
            $app->view->render('hello');
        });

        // Get the about page
        $app->get('/about', function() use ($app)
        {
            $app->view->render('about');
        });

        // Get the login page
        $app->get('/login', function() use ($app)
        {
            return $app->view->render('login');
        });

        // Logout process
        $app->get('/logout', function() use ($app)
        {
            $app->login->deauth();
            $app->flashNow('info', 'Successfully log out!');
            return $app->response->redirect('/login');
        });

        // Login process
        $app->post('/login', function() use ($app)
        {
            $post   = $app->request->post();
            $author = Norm::factory('Author')->findOne(array('username' => $post['username']));

            // Wrong username
            if (is_null($author))
            {
                $app->flashNow('error', 'Wrong credentials!');
                return $app->response->template('login');
            }

            // Username and password match
            if (password_verify($post['password'], $author->get('password')))
            {
                $app->login->auth($author);
                $app->flash('info', 'Successfully log in!');
                return $app->response->redirect('/entries');
            }
            // Wrong password
            else
            {
                $app->flashNow('error', 'Wrong credentials!');
                return $app->response->template('login');
            }
        });
    }
}
