<?php

namespace FuturaMkt\Validator\Meli\Product;

use FuturaMkt\Entity\Product\Product;
use FuturaMkt\Validator\ProductValidator;
use FuturaMkt\RootConstants;

class MeliProductValidator extends ProductValidator
{

    public function validate(Product $product): array
    {
        $group = 'default';
        if($product->hasMktPlaceId()){
            $group = 'insert';
        }
        return parent::validateProduct($product, RootConstants::getPathDir() . '/Config/Validator/Product/Meli/MeliProductValidator.yaml', $group);
    }

}