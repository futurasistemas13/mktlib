<?php declare(strict_types=1);

namespace FuturaMkt\Validator;

use FuturaMkt\Entity\Product\Product;

class ProductValidator extends BaseValidator {

    public function validate(Product $product): array
    {
        return $this->validateBase(entity: $product);
    }

}