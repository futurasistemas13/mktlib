<?php

namespace FuturaMkt\Entity\Produto;

use FuturaMkt\Entity\Produto\Attribute;

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

    function get($group): array
    {
        return $this->attribute[$group];
    }


}