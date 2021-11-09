<?php

namespace FuturaMkt\Entity;

use FuturaMkt\Entity\Attribute;

class ProdutoAttributes{
    private $attribute;

    function __construct()
    {

    }

    function add($group, String $name, String $value) : Attribute
    {
        $attr = new Attribute();
        $attr->setName($name);
        $attr->setValue($value);
        return $this->attribute[$group][] = $attr;
    }

    function get($group) : Attribute
    {
        return $this->attribute[$group];
    }


}