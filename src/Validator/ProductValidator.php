<?php declare(strict_types=1);

namespace FuturaMkt\Validator;

use FuturaMkt\Entity\Product\Product;
use Symfony\Component\Validator\Validation;

class ProductValidator{

    public function validate(Product $product): array
    {
        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping(true)
            ->addDefaultDoctrineAnnotationReader()
            ->getValidator();

        $errors = $validator->validate($product);
        $errorsString = array();
        if (count($errors) > 0) {
            $errorsString = $errors;
        }

        return $errorsString;
    }

}