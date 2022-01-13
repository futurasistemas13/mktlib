<?php declare(strict_types=1);

namespace FuturaMkt\Transfer\Meli;

use FuturaMkt\Entity\Meli\MeliProductListingType;

class ProductListingTypeTransfer{

    public function MeliToObjectList(array $meliListingType): array{
         $return = array();

         foreach($meliListingType as $lType){
            $return[] = new MeliProductListingType($lType['id'], $lType['name']);  
         }

         return $return;

    }
}