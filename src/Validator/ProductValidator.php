<?php declare(strict_types=1);

namespace FuturaMkt\Validator;

use FuturaMkt\Entity\Product\Product;
use FuturaMkt\RootConstants;

class ProductValidator extends BaseValidator {

    public function validateProduct(Product $product, String $validatorFile, array $group): array
    {
        return $this->validateBase($product, $validatorFile, $group);
    }

}