<?php

namespace FuturaMkt\Entity;

use FuturaMkt\Entity\Attribute;


class ProdutoAttributes{
    private $attribute;

    function __construct()
    {

    }

    function add() : Attribute
    {
        return $this->attribute[] = new Attribute();
    }

    function get() : Attribute
    {
        return $this->attribute;
    }


}