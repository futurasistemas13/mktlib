<?php declare(strict_types=1);

namespace FuturaMkt\Service;

use Exception;
use FuturaMkt\Entity\Product\Product;
use FuturaMkt\Entity\Authentication\MktConnection;
use FuturaMkt\Validator\Meli\Product\MeliProductValidator;
use FuturaMkt\Validator\ProductValidator;


class Marketplace implements iMarketplace{

    public function setAuthentication(MktConnection $data): void
    {

    }

    /**
     * @throws Exception
     */
    public function setProduct(Product $product): Product{
        $ProductValidator = new MeliProductValidator();
        $errors           = $ProductValidator->validate($product);
        if (count($errors) > 0) {
            throw new Exception(json_encode($errors));
        }else return $product;

    }
}