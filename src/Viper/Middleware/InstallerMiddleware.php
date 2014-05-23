<?php

namespace Viper\Middleware;

use Norm\Norm;
use Slim\Middleware;

/**
 * Try to add a new user to database if the author table is empty, don't worry, this process run only once for a
 * lifetime
 *
 * @author      Krisan Alfa Timur <krisan47@gmail.com>
 * @copyright   2013 PT Sagara Xinix Solusitama
 * @link        http://xinix.co.id/products/viper
 * @license     https://raw.github.com/krisanalfa/viper/master/LICENSE
 * @package     Viper
 */
class InstallerMiddleware extends Middleware
{
    /**
     * Get either a Gravatar URL or complete image tag for a specified email address.
     *
     * @param  string $email The email address
     * @param  string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
     * @param  string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
     * @param  string $r Maximum rating (inclusive) [ g | pg | r | x ]
     * @return string containing either just a URL or a complete image tag
     * @link   http://gravatar.com/site/implement/images/php/
     */
    protected function getGravatar($email, $s = 80, $d = 'identicon', $r = 'g')
    {
        $url  = 'http://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$s&d=$d&r=$r";

        return $url;
    }

    /**
     * Installer Middleware
     *
     * @return \Bono\Http\Response
     */
    public function call()
    {
        $user = Norm::factory('Author')->find();

        // If there's no entry in `author' field
        if (empty($user->toArray())) {
            // If in `/install' path
            if ($this->app->request->getPathInfo() === '/install' and empty($user->toArray())) {
                // If request type is get, render the install template
                if ($this->app->request->isGet()) {
                    $this->app->response->template('install');
                }

                // If request type is post, insert input to database
                if ($this->app->request->isPost()) {
                    try {
                        $entry  = $this->app->request->post();
                        $model  = Norm::factory('Author')->newInstance();
                        $result = $model->set($entry)->save();

                        h('notification.info', 'New author has been successfully created');
                        $this->app->response->redirect('/login');
                    } catch(\Exception $e) {
                        throw $e;
                    }
                }
            } else {
                // If not in `/install' path, redirect to `/install'
                $this->app->response->redirect('/install');
            }
        } else {
            // If there's an author
            $authors = Norm::factory('Author')->find();

            foreach ($authors as $author) {
                $email   = $author->get('email');
                $twitter = $author->get('twitter');
                $avatar  = __DIR__ . '/../../../www/img/' . $twitter . '.jpeg';

                // Setting up avatar
                if (! file_exists($avatar)) {
                    copy($this->getGravatar($email), $avatar);
                }
            }

            $this->next->call();
        }
    }
}
