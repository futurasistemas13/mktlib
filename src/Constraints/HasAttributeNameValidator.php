<?php

namespace FuturaMkt\Constraints;

use Exception;
use FuturaMkt\Entity\Product\AttributeGroup;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class HasAttributeNameValidator extends ConstraintValidator
{

    /**
     * @throws Exception
     */
    public function validate(mixed $value, Constraint $constraint): bool
    {
        if (!$constraint instanceof HasAttributeName) {
            throw new Exception($constraint, __NAMESPACE__ . '\HasAttributeName');
        }

        if (is_array($value)){
            if($value[array_key_first($value)] instanceof AttributeGroup){
                foreach ($value as $attrGroupList){
                    return $this->validateAttr($attrGroupList->getAttribute(), $constraint);
                }
            }else{
                return $this->validateAttr($value, $constraint);
            }
        }

        $this->context->addViolation(
            $constraint->message,
            array('{{ attrValue }}' => $constraint->attrName)
        );
        return false;
    }

    private function validateAttr($attributeList, Constraint $constraint): bool{
        foreach ($attributeList as $attr){
            if($attr->getName() == $constraint->attrName){
                return true;
            }
        }
        $this->context->addViolation(
            $constraint->message,
            array('{{ attrValue }}' => $constraint->attrName)
        );
        return false;
    }
}