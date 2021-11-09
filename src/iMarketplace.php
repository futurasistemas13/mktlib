<?php

namespace FuturaMkt;

use FuturaMkt\Authentication\Model\MktConnection;
use FuturaMkt\Entity\Produto;

interface iMarketplace{

    public function authenticate(MktConnection $data);
    public function createProduct(Produto $product);

}