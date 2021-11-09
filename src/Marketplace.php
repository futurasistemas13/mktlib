<?php

namespace FuturaMkt;

use FuturaMkt\Authentication\Model;
use FuturaMkt\Authentication\Model\Meli;
use FuturaMkt\iPlayer;
use FuturaMkt\Authentication\Model\MktConnection;

class Marketplace implements iMarketplace{
    //private $marketplace = null;

    //function __construct(/*iMarketplace $pmarketplace*/)
    //{
        //$this->marketplace  =  $pmarketplace;
    //}

    public function authenticate(MktConnection $data){
        //$teste = $this->marketplace->genRefreshToken($data);
        //return $teste;
    }

}