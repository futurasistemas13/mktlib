<?php

namespace FuturaMkt\Exception;

use Throwable;

class ValidationException extends \Exception
{

    public function __construct(array $message, $code = 0, Throwable $previous = null)
    {
        $this->setValidation($message);
        $messageCons = "";
        foreach ($message as $mess){
            $messageCons .= ' ' . $mess;
        }
        parent::__construct($messageCons, $code, $previous);
    }

    private array $validation = array();

    /**
     * @return array
     */
    public function getValidation(): array
    {
        return $this->validation;
    }

    /**
     * @param array $validation
     */
    public function setValidation(array $validation): void
    {
        $this->validation = $validation;
    }

}