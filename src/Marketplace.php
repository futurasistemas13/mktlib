<?php

namespace FuturaMkt;

use FuturaMkt\Authentication;
use FuturaMkt\Authentication\Meli;
use FuturaMkt\Entity\Produto\Produto;
use FuturaMkt\Authentication\MktConnection;

class Marketplace implements iMarketplace{

    private $lastError = null;
    private $errorCode = null;

    public function authenticate(MktConnection $data){
        //
    }

    public function createProduct(Produto $product){
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