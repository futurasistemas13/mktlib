<?php

namespace FuturaMkt;

use FuturaMkt\Authentication\Model;
use FuturaMkt\Authentication\Model\Meli;
use FuturaMkt\iPlayer;

class Marketplace implements iMarketplace{
    private $marketplace = null;

    function __construct(iPlayer $pmarketplace)
    {
        $this->marketplace  =  $pmarketplace;
    }

    public function authenticate(iConnection $data){
        $teste = $this->marketplace->genRefreshToken();
        return $teste;
    }

}