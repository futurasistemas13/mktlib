<?php

namespace FuturaMkt\Authentication;

use FuturaMkt\Authentication\Model;
use FuturaMkt\Authentication\Model\Meli;

class Auth{
    private $marketplace = null;

    function __construct(Meli $pmarketplace)
    {
        $this->marketplace  =  $pmarketplace;
    }

    public function authenticate(iConnection $data){
      echo var_dump($data);
    }

}