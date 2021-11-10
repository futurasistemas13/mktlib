<?php

namespace FuturaMkt\Entity\Produto;

use FuturaMkt\Type\TypeAttribute;

class ProdutoAttributes{
    private $attribute;

    function __construct()
    {
    }

    function add(TypeAttribute $group, String $name, String $value)
    {
        $attr = new Attribute();
        $attr->setName($name);
        $attr->setValue($value);
        $this->attribute[$group->value][] = $attr;
        return $this;
    }

    function get(TypeAttribute $group): array
    {
        return $this->attribute[$group->value];
    }


}