<?php namespace Viper\Component;

use Bono\App;
use Norm\Norm;

/**
 * On the fly table creation (without controller)
 *
 * @author      Krisan Alfa Timur <krisan47@gmail.com>
 * @copyright   2013 PT Sagara Xinix Solusitama
 * @link        http://xinix.co.id/products/viper
 * @license     https://raw.github.com/krisanalfa/viper/master/LICENSE
 * @package     Viper
 */
class Form
{
    /**
     * It's like controller data
     *
     * @var mixed
     */
    protected $data;

    /**
     * Create a new Norm collection
     *
     * @param  string $collection Collection name
     *
     * @return \Norm\Collection
     */
    public static function create($collection = '')
    {
        return new static($collection);
    }

    public function renderFields($entry) {
        $html = '';
        $iterator = $this->fields;

        foreach ($iterator as $key => $v) {
            $field = $this->fields[$key];
            $html .= '<div class="row">';
            $html .= '<div class="span-12">';
            $html .= $field->label();
            $html .= $field->format('input', @$entry[$field['name']], @$entry);
            $html .= '</div>';
            $html .= '</div>';
        }

        return $html;
    }

    /**
     * The class constructor
     *
     * @param string $collection Collection name
     */
    public function __construct($collection)
    {
        $this->collection = Norm::factory($collection);
        $this->data       = &$_POST;
        $this->fields     = $this->collection->schema();
    }

    /**
     * Render read-write form
     *
     * @param  string $key   Norm field name
     * @param  string $value The value of a field
     *
     * @return string        HTML string
     */
    public function input($key, $value = ':empty:')
    {
        if ($value === ':empty:') {
            $value = $this->data($key);
        }

        return $this->fields[$key]->formatInput($value, $this->data);
    }

    /**
     * Render read-only block
     *
     * @param  string $key   Norm field name
     * @param  string $value The value of a field
     *
     * @return string        HTML string
     */
    public function readonly($key, $value = ':empty:')
    {
        $field             = $this->fields[$key];
        $field['readonly'] = true;

        return $this->input($key, $value);
    }

    /**
     * Render table
     *
     * @param  string $key   Norm field name
     * @param  string $value The value of a field
     *
     * @return string        HTML string
     */
    public function cell($key, $value)
    {
        return $this->fields[$key]->cell($value);
    }

    /**
     * Render hidden form
     *
     * @param  string $key   Norm field name
     * @param  string $value The value of a field
     *
     * @return string        HTML string
     */
    public function hidden($key, $value = ':empty:')
    {
        if ($value === ':empty:') {
            $value = $this->data($key);
        }

        return '<input type="hidden" name="'.$key.'" value="'.$value.'">';
    }

    /**
     * Get the field value
     *
     * @param  string $key   Norm field name
     *
     * @return mixed         The field value of a Norm\Model
     */
    public function data($key)
    {
        return @$this->data[$key];
    }

    /**
     * Render read-write form
     *
     * @param  string $data   Norm schema name
     * @return Viper\Form
     */
    public function of(&$data)
    {
        $this->data = &$data;

        return $this;
    }
}
