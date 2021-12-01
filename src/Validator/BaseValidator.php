<?php

namespace FuturaMkt\Validator;

use FuturaMkt\RootConstants;
use Symfony\Component\Validator\Validation;

class BaseValidator
{
    /**
     * @param mixed $entity
     * @return array
     */
    protected function validateBase(mixed $entity): array
    {
        $validatorObject = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->addDefaultDoctrineAnnotationReader()
            ->addYamlMapping(RootConstants::getPathDir() . 'Config/Validator/Product/Meli/MeliProductValidator.yaml')
            ->getValidator();
        $errorList = $validatorObject->validate($entity);

        $fieldError = array();
        foreach ($errorList as $error){
                $fieldError[$error->getPropertyPath()] = $error->getMessage();
        }
        return $fieldError;
    }



}