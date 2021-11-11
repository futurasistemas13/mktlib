<?php

namespace FuturaMkt\Service;

use FuturaMkt\Entity\Authentication;
use FuturaMkt\Entity\Authentication\Meli;
use FuturaMkt\Entity\Produto\Produto;
use FuturaMkt\Entity\Authentication\MktConnection;

class Marketplace implements iMarketplace{

    private $lastError = null;
    private $errorCode = null;

    public function authenticate(MktConnection $data){
        //
    }

    public function setProduct(Produto $product){
        //
    }

    public function getLastError()
    {
        return $this->lastError;
    }

    public function getLastErrorCode()
    {
        return $this->errorCode;
    }

    public function setLastError($lastError, $errorCode): void
    {
        if(trim($this->lastError) == ''){
            $this->lastError = null;
            $this->errorCode = null;
        }else{
            $this->lastError = $lastError;
            $this->errorCode = $errorCode;
        }

    }

}