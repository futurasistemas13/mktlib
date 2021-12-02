<?php

namespace FuturaMkt\Validator;

use FuturaMkt\RootConstants;
use Symfony\Component\Validator\Validation;

class BaseValidator
{
    /**
     * @param mixed $entity
     * @param string $yamlPathValidator
     * @return array
     */
    protected function validateBase(mixed $entity, string $yamlPathValidator = ''): array
    {
        $validatorObject = Validation::createValidatorBuilder()
                            ->enableAnnotationMapping()
                            ->addDefaultDoctrineAnnotationReader();

        if($yamlPathValidator != ''){
            $validatorObject->addYamlMapping($yamlPathValidator);
        }
        $validatorObject = $validatorObject->getValidator();
        $errorList       = $validatorObject->validate($entity);
        $fieldError      = array();

        foreach ($errorList as $error){
            $fieldError[$error->getPropertyPath()] = $error->getMessage();
        }
        return $fieldError;
    }



}