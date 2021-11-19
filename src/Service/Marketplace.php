<?php declare(strict_types=1);

namespace FuturaMkt\Service;

use FuturaMkt\Entity\Produto\Produto;
use FuturaMkt\Entity\Authentication\MktConnection;

class Marketplace implements iMarketplace{

    public function setAuthentication(MktConnection $data): void
    {

    }

    public function setProduct(Produto $product){
        //
    }
}