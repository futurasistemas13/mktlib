<?php declare(strict_types=1);

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
        return ((array_key_exists($group->value, $this->attribute))  && (is_array($this->attribute[$group->value]))) ?  $this->attribute[$group->value] : array();
    }


}