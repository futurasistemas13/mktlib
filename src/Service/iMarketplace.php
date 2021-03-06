<?php declare(strict_types=1);

namespace FuturaMkt\Service;

use FuturaMkt\Entity\Authentication\MktConnection;
use FuturaMkt\Entity\Order\Order;
use FuturaMkt\Entity\Product\Product;

interface iMarketplace{

    public function setProduct(Product $product): Product;
    public function setAuthentication(MktConnection $data): void;
    public function setProductSimple(Product $product): Product;
    public function getOrder(string $mktOrderId): Order;

}