<?php namespace Viper\Schema;

use Norm\Schema\NormArray as NArray;

class NormArray extends NArray
{
    public function presetPlain($value, $entry = null)
    {
        $value = $this->prepare($value);

        if (isset($value)) {
            $value = implode(', ', $value->toArray());
        }

        return parent::presetPlain($value, $entry);
    }
}
