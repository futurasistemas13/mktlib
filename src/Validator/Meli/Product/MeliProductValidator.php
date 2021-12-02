<?php

namespace FuturaMkt\Validator\Meli\Product;

use FuturaMkt\Entity\Product\Product;
use FuturaMkt\Type\Validation\TypeGroupsValidation;
use FuturaMkt\Validator\ProductValidator;
use FuturaMkt\RootConstants;

class MeliProductValidator extends ProductValidator
{

    public function validate(Product $product): array
    {
        $group = array();
        if(!$product->hasMktPlaceId()){
            $group = array_merge_recursive(array(TypeGroupsValidation::Insert->value), $group);
        }
        if(count($product->getVariationList()) <= 0){
            $group = array_merge_recursive(array(TypeGroupsValidation::NonGrid->value), $group);
        }else{
            $group = array_merge_recursive(array(TypeGroupsValidation::Default->value), $group);
        }
        return parent::validateProduct($product, RootConstants::getPathDir() . '/Config/Validator/Product/Meli/MeliProductValidator.yaml', $group);
    }

}