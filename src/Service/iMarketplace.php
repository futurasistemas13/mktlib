<?php declare(strict_types=1);

namespace FuturaMkt\Service;

use FuturaMkt\Entity\Authentication\MktConnection;
use FuturaMkt\Entity\Produto\Produto;

interface iMarketplace{

    public function authenticate(MktConnection $data): MktConnection;
    public function setProduct(Produto $product);
    public function refreshAuthentication(MktConnection $data): MktConnection;

}