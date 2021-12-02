<?php declare(strict_types=1);

namespace FuturaMkt\Validator;

use FuturaMkt\Entity\Product\Product;
use FuturaMkt\RootConstants;

class ProductValidator extends BaseValidator {

    public function validate(Product $product): array
    {
        return $this->validateBase($product, RootConstants::getPathDir() . '/Config/Validator/Product/Meli/MeliProductValidator.yaml');
    }

}