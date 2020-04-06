<?php

namespace WP_Hide_Fields;

class Field
{
    public $name;

    public function __construct($fieldName)
    {
        $this->name = $fieldName;
    }

    public function getPricedIdField()
    {
        return 'wc_'.$this->name.'_priced';
    }

    public function getFreeIdField()
    {
        return 'wc_'.$this->name.'_free';
    }
}
