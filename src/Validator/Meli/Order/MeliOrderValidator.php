<?php

namespace FuturaMkt\Validator\Meli\Order;

use FuturaMkt\Entity\Order\Order;
use FuturaMkt\Type\Validation\TypeGroupsValidation;
use FuturaMkt\Validator\OrderValidator;
use FuturaMkt\RootConstants;

class MeliProductValidator extends OrderValidator
{

    public function validate(Order $order): array
    {
        /*$group = array();
        if(!$product->hasMktPlaceId()){
            $group = array_merge_recursive(array(TypeGroupsValidation::Insert->value), $group);
        }
        if(count($product->getVariationList()) <= 0){
            $group = array_merge_recursive(array(TypeGroupsValidation::NonGrid->value), $group);
        }else{
            $group = array_merge_recursive(array(TypeGroupsValidation::Default->value), $group);
        }*/
        $group = array();
        return parent::validateOrder($order, RootConstants::getPathDir() . '/Config/Validator/Product/Meli/MeliProductValidator.yaml', $group);
    }

}