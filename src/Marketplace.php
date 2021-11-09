<?php

namespace FuturaMkt;

use FuturaMkt\Authentication\Model;
use FuturaMkt\Authentication\Model\Meli;
use FuturaMkt\Entity\Produto;
use FuturaMkt\Authentication\Model\MktConnection;

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