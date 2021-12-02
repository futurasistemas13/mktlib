<?php

namespace FuturaMkt\Constraints;

use Exception;
use FuturaMkt\Entity\Product\AttributeGroup;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class HasAttributeValueValidator extends ConstraintValidator
{

    /**
     * @throws Exception
     */
    public function validate(mixed $value, Constraint $constraint): bool
    {
        if (!$constraint instanceof HasAttributeValue) {
            throw new Exception($constraint, __NAMESPACE__ . '\HasAttributeValue');
        }

        if (is_array($value)){
            foreach ($value as $attrGroupList){
                if($attrGroupList instanceof AttributeGroup){
                    foreach($attrGroupList as $attr){
                        return $this->validateAttr($attr, $constraint);
                    }
                }else{
                    return $this->validateAttr($value, $constraint);
                }

            }
        }

        return true;
    }

    private function validateAttr($attributeList, Constraint $constraint): bool{
        foreach ($attributeList as $attr){
            if($attr->getName() == $constraint->attrValue){
                return true;
            }
        }
        $this->context->addViolation(
            $constraint->message,
            array('{{ attrValue }}' => $constraint->attrValue)
        );
        return false;
    }
}