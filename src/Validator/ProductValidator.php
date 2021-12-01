<?php declare(strict_types=1);

namespace FuturaMkt\Validator;

use FuturaMkt\Entity\Product\Product;

class ProductValidator extends BaseValidator {

    public function validate(Product $product): array
    {
        return $this->validateBase($product)
                    ->validateBase($product->getWarranty())
                    ->validateBaseArrayObjects($product->getImages())
                    ->validateBaseArrayObjects($product->getAllVariationImages())->toArray();
        //todo: Validate attributes
        //todo: validade attributes variations
        //todo: validate attribute of atrribute variations
    }

}