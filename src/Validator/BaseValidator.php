<?php

namespace FuturaMkt\Validator;

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
            ->getValidator();
        $errorList = $validatorObject->validate($entity);

        $fieldError = array();
        foreach ($errorList as $key => $error){
                $fieldError[$key . '.' . $error->getPropertyPath()] = $error->getMessage();
        }
        return $fieldError;
    }



}