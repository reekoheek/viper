<?php

namespace Viper\Controller;

use \Norm\Controller\NormController;


/**
 * Norm cannot hide the Author password, so we hide it right here
 *
 * @author      Krisan Alfa Timur <krisan47@gmail.com>
 * @copyright   2013 PT Sagara Xinix Solusitama
 * @link        http://xinix.co.id/products/viper
 * @license     https://raw.github.com/krisanalfa/viper/master/LICENSE
 * @package     Viper
 */
class AuthorController extends NormController {

    /**
     * Get all the author resource
     *
     * @return void
     */
    public function search()
    {
        $entries = $this->collection->find($this->getCriteria())->sort($this->getSort());
        $data    = array();

        foreach ($entries as $entry)
        {
            $entry  = $entry->toArray();
            unset($entry['password']);
            $data[] = $entry;
        }

        $this->data['entries'] = $data;
    }

}
