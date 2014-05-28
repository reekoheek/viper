<?php

namespace Viper\Observer;

use Bono\App;

/**
 * Save the user info to the database
 *
 * @category  App
 * @package   Viper
 * @author    Krisan Alfa Timur <krisan47@gmail.com>
 * @copyright 2013 PT Sagara Xinix Solusitama
 * @license   https://raw.github.com/krisanalfa/viper/master/LICENSE MIT
 * @version   Release: 0.0.1
 * @link      http://xinix.co.id/products/viper
 */
class Ownership
{
    /**
     * Hook when saving
     *
     * @param \Norm\Model $model The model that we want to sync to database
     *
     * @return void
     */
    public function saving($model)
    {
        $app  = App::getInstance();
        $user = $app->login->user();

        $userId = ($user) ? $user['$id'] : 'system';

        if (is_null($model['$id'])) {
            $model['$updated_by'] = $model['$created_by'] = $userId;
        } else {
            $model['$updated_by'] = $userId;
        }
    }
}
