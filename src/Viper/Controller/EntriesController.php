<?php

namespace Viper\Controller;

use \Norm\Controller\NormController;
use \Bono\App;

/**
 * We shouldn't get the data twice from database when render the 'read' page
 *
 * @category  App
 * @package   Viper
 * @author    Krisan Alfa Timur <krisan47@gmail.com>
 * @copyright 2013 PT Sagara Xinix Solusitama
 * @license   https://raw.github.com/krisanalfa/viper/master/LICENSE MIT
 * @version   Release: 0.0.1
 * @link      http://xinix.co.id/products/viper
 */
class EntriesController extends NormController
{
    /**
     * Find specific id
     *
     * @param int $id Id you want to search
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

    public function create()
    {
        $entry = $this->getCriteria();

        if ($this->request->isPost()) {
            $this->store(array_merge($entry, $this->request->post()));
        }

        $this->data['entry'] = $entry;
    }

    protected function store(array $entry)
    {
        $model = $this->collection->newInstance();

        try {
            $result = $model->set($entry)->save();

            h('notification.info', $this->clazz.' created.');

            h('controller.create.success', array(
                'model' => $model
            ));

        } catch (\Slim\Exception\Stop $e) {
            throw $e;
        } catch (\Exception $e) {

            h('notification.error', $e);

            h('controller.create.error', array(
                'model' => $model,
                'error' => $e,
            ));
        }
    }
}
