<?php declare(strict_types=1);

namespace FuturaMkt\Service;

use FuturaMkt\Entity\Authentication\MktConnection;
use FuturaMkt\Entity\Produto\Produto;

interface iMarketplace{

    public function authenticate(MktConnection $data);
    public function setProduct(Produto $product);

}