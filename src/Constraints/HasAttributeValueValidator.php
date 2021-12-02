<?php

namespace FuturaMkt\Constraints;

use Exception;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class HasAttributeValueValidator extends ConstraintValidator
{

    /**
     * @throws Exception
     */
    public function validate(mixed $value, Constraint $constraint)
    {
        if (!$constraint instanceof HasAttributeValue) {
            throw new Exception($constraint, __NAMESPACE__ . '\HasAttributeValue');
        }

        return true;
    }
}