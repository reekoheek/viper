<?php

namespace Viper\Observer;

use Bono\App;

/**
 * Save the user info to the database
 *
 * @author      Krisan Alfa Timur <krisan47@gmail.com>
 * @copyright   2013 PT Sagara Xinix Solusitama
 * @link        http://xinix.co.id/products/viper
 * @license     https://raw.github.com/krisanalfa/viper/master/LICENSE
 * @package     Viper
 */
class Ownership
{
    /**
     * Hook when saving
     *
     * @param  \Norm\Model $model The model that we want to sync to database
     * @return void
     */
    public function saving($model)
    {
        $app  = App::getInstance();
        $user = $app->login->user();

        if (is_null($model['$id'])) {
            $model['$updated_by'] = $model['$created_by'] = ($user) ? $user->getId() : 'system';
        } else {
            $model['$updated_by'] = $user->getId();
        }
    }
}
