<?php

namespace FuturaMkt\Validator\Meli\Product;

use FuturaMkt\Entity\Product\Product;
use FuturaMkt\Validator\ProductValidator;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;

class MeliProductValidator extends ProductValidator
{

    public function validate(Product $product): array
    {
        $teste = 1;

        $constraint = new Assert\Collection([

        ]);
        return parent::validate($product);
    }

}