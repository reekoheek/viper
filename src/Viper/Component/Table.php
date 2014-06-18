<?php namespace Viper\Component;

use Bono\Helper\URL;
use ROH\Util\Inflector;
use ROH\BonoComponent\PlainTable;
use Norm\Type\NormArray;

class Table extends PlainTable
{
    public function renderColumns($entry = NULL) {
        $html = '';

        $iterator = isset($this->config['columns']) ? $this->config['columns'] : $this->schema;

        if (is_null($entry)) {
            foreach ($iterator as $key => $valueGetter) {
                if ($key[0] !== '$') {
                    $html .= '<th>'.(isset($this->schema[$key]) ? $this->schema[$key]['label'] : Inflector::humanize($key)).'</th>';
                }
            }
        } else {
            $first = true;
            foreach ($iterator as $key => $valueGetter) {
                if ($key[0] !== '$') {
                    $html .= '<td>';
                    if ($first) {
                        $url = URL::site($this->app->controller->getBaseUri().'/'.$entry['$id']);
                        $html .= '<a href="'.$url.'">';
                    }

                    if (isset($valueGetter) && $iterator !== $this->schema) {
                        if ($valueGetter) {
                            $html .= $valueGetter(@$entry[$key], $entry);
                        }
                    } else {
                        $value = @$entry[$key];

                        if (isset($this->schema[$key])) {
                            $value = $this->schema[$key]->format('plain', $value, $entry);
                        }

                        $html .= $value;
                    }

                    if ($first) {
                        $html .= '</a>';
                        $first = false;
                    }

                    $html .= '</td>';
                }
            }
        }
        return $html;
    }
}
