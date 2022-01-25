<?php declare(strict_types=1);

namespace FuturaMkt\Validator;

use FuturaMkt\Entity\Order\Order;
use FuturaMkt\RootConstants;

class OrderValidator extends BaseValidator {

    public function validateOrder(Order $order, String $validatorFile, array $group): array
    {
        return $this->validateBase($order, $validatorFile, $group);
    }

}