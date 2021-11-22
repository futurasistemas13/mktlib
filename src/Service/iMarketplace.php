<?php declare(strict_types=1);

namespace FuturaMkt\Service;

use FuturaMkt\Entity\Authentication\MktConnection;
use FuturaMkt\Entity\Product\Product;

interface iMarketplace{

    public function setProduct(Product $product);
    public function setAuthentication(MktConnection $data): void;

}