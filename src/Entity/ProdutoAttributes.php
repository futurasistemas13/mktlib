<?php

namespace FuturaMkt\Entity;

use FuturaMkt\Entity\Attribute;

class ProdutoAttributes{
    private $attribute;

    function __construct()
    {
    }

    function add($group, String $name, String $value) : ProdutoAttributes
    {
        $attr = new Attribute();
        $attr->setName($name);
        $attr->setValue($value);
        $this->attribute[$group][] = $attr;
        return $this;
    }

    function get($group)
    {
        return $this->attribute[$group];
    }


}