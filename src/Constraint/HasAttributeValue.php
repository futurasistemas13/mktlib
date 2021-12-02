<?php

namespace FuturaMkt\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class HasAttributeValue extends ConstraintValidator
{

    public function validate(mixed $value, Constraint $constraint)
    {
        echo 'teste';
        return true;
    }
}