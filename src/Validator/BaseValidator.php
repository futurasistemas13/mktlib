<?php

namespace FuturaMkt\Validator;

use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class BaseValidator
{

    private array $validationList;
    public function __construct()
    {
        //
    }

    /**
     * @param mixed $entity
     * @return BaseValidator
     */
    protected function validateBase(mixed $entity): BaseValidator
    {
        $validatorObject = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->addDefaultDoctrineAnnotationReader()
            ->getValidator();
        $error = $validatorObject->validate($entity);
        $this->validationList[$entity::class] =  $error;
        return $this;
    }

    /**
     * @param mixed $entity
     * @return BaseValidator
     */
    protected function validateBaseArrayObjects(array $entityList): BaseValidator
    {
        $validatorObject = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->addDefaultDoctrineAnnotationReader()
            ->getValidator();
        foreach ($entityList as $entity){
            $error = $validatorObject->validate($entity);
            $this->validationList[$entity::class] =  $error;
        }
        return $this;
    }

    public function toArray(): array{
        $fieldError = array();
        foreach ($this->validationList as $key => $errorList){
            foreach($errorList as $error){
                $fieldError[$key . '.' . $error->getPropertyPath()] = $error->getMessage();
            }
        }
        return $fieldError;
    }

}