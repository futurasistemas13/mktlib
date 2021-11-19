<?php declare(strict_types=1);

namespace FuturaMkt\Service;

use FuturaMkt\Entity\Authentication;
use FuturaMkt\Entity\Authentication\Meli;
use FuturaMkt\Entity\Produto\Produto;
use FuturaMkt\Entity\Authentication\MktConnection;

class Marketplace implements iMarketplace{

    public function authenticate(MktConnection $data): MktConnection{
        //
    }

    public function refreshAuthentication(MktConnection $data): MktConnection{
        //
    }

    public function setProduct(Produto $product){
        //
    }
}