<?php

namespace FuturaMkt\Validator;

use Exception;
use FuturaMkt\Entity\Order\Order;
use FuturaMkt\Entity\Product\Product;
use FuturaMkt\Type\TypeMarketplaces;
use FuturaMkt\Validator\Meli\Product\MeliProductValidator;

class ValidatorMarketplace
{

    /**
     * @throws Exception
     */
    public static function validateProduct(TypeMarketplaces $marketplace, Product $product): array{
        if($marketplace == TypeMarketplaces::MercadoLivre){
            $prodVal = new MeliProductValidator();
            return $prodVal->validate($product);
        }else{
            throw new Exception('type of marketplace was not send.');
        }
    }

    /**
     * @throws Exception
     */
    public static function validateOrder(TypeMarketplaces $marketplace, Order $order): array{
        if($marketplace == TypeMarketplaces::MercadoLivre){
            $orderVal = new MeliOrderValidator();
            return $orderVal->validate($order);
        }else{
            throw new Exception('type of marketplace was not send.');
        }
    }

}