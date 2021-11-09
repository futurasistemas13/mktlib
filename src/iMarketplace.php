<?php

namespace FuturaMkt;

use FuturaMkt\Authentication\MktConnection;
use FuturaMkt\Entity\Produto\Produto;

interface iMarketplace{

    public function authenticate(MktConnection $data);
    public function createProduct(Produto $product);

}