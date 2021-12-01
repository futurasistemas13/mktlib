<?php

namespace FuturaMkt\Validator;

use Symfony\Component\Validator\Validation;

class BaseValidator
{

    private array $validationList = array();
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
        if(count($error) > 0) {
            $this->validationList[$entity::class] = $error;
        }
        return $this;
    }

    /**
     * @param array $entityList
     * @return BaseValidator
     */
    protected function validateBaseArrayObjects(array $entityList): BaseValidator
    {
        $validatorObject = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->addDefaultDoctrineAnnotationReader()
            ->getValidator();
        $count = 0;
        foreach ($entityList as $entity){
            $error = $validatorObject->validate($entity);
            if(count($error) > 0){
                $this->validationList[$entity::class . '[' . $count . ']'] =  $error;
                $count ++;
            }
        }
        return $this;
    }

    /**
     * @return array
     */
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