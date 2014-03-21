<?php

namespace Viper\Schema;

/**
 * Norm Schema that handle the password form
 *
 * @author      Krisan Alfa Timur <krisan47@gmail.com>
 * @copyright   2013 PT Sagara Xinix Solusitama
 * @link        http://xinix.co.id/products/viper
 * @license     https://raw.github.com/krisanalfa/viper/master/LICENSE
 * @package     Viper
 */
class Password extends \Norm\Schema\Field {

    /**
     * Render read-write form
     *
     * @param  string $key   Norm field name
     * @param  string $value The value of a field
     * @return string        HTML string
     */
    public function input($value, $entry = NULL) {
        if ($this['readonly'])
        {
            return '<span class="field">*hidden*</span>';
        }

        return '
            <div class="row">
                <input type="password" name="'.$this['name'].'" value="" placeholder="Password" autocomplete="off" />
                <input type="password" name="'.$this['name'].'_confirmation" value="" placeholder="Password confirmation" autocomplete="off" />
            </div>
        ';
    }

    /**
     * Render cell table
     *
     * @param  string $key   Norm field name
     * @param  string $value The value of a field
     * @return string        HTML string
     */
    public function cell($value, $entry = NULL)
    {
        if ($this->has('cellFormat'))
        {
            return parent::cell($value, $entry);
        }

        return '*hidden*';
    }
}
