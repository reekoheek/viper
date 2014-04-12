<?php

namespace Viper\Controller;

use \Norm\Controller\NormController;
use \Bono\App;

/**
 * We shouldn't get the data twice from database when render the 'read' page
 *
 * @author      Krisan Alfa Timur <krisan47@gmail.com>
 * @copyright   2013 PT Sagara Xinix Solusitama
 * @link        http://xinix.co.id/products/viper
 * @license     https://raw.github.com/krisanalfa/viper/master/LICENSE
 * @package     Viper
 */
class EntriesController extends NormController
{
    /**
     * Find specific id
     *
     * @return void
     */
    public function read($id)
    {
        $app = App::getInstance();

        if ($app->request->getMediaType() === 'application/json') {
            parent::read($id);
        } else {
            // do nothing
            return;
        }
    }
}
