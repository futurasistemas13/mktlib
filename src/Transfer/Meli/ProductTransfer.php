<?php declare(strict_types=1);

namespace FuturaMkt\Transfer\Meli;

use Exception;
use FuturaMkt\Entity\Product\Product;
use FuturaMkt\Type\Product\TypeWarranty;
use FuturaMkt\Type\TypeAttribute;
use FuturaMkt\Type\TypeStatus;
use FuturaMkt\Utils\Meli\MeliConstants;
use FuturaMkt\Utils\Meli\MeliFuncUtils;
use FuturaMkt\Type\Meli\Product\Type_MercadoLivreMercaListType;
use FuturaMkt\Type\Product\TypeProductCondition;

class ProductTransfer{

    //update stock and price...
    public static function productSimpleToMeli(Product $product){         
        if($product->getAttributesValue(TypeAttribute::DefaultAttributes, 'listing_type_id') == ''){
            throw new Exception('attribute "listing_type_id" é obrigatório!');
        }

        $productJson   = array();
        $quantityTotal =  0;
        if($product->hasVariation()){
            foreach($product->getVariationList(true) as $var){
                $quantityTotal += $var->getQuantity();
            }            
        }else{
            $quantityTotal = $product->getQuantity();
        }

        //when it will be gridded, quantity will be the sum in all of them...
        $statusType = $product->getStatus();
        if(($quantityTotal <= 0)){
            $statusType = TypeStatus::Inactive;
        }

        $productJson = array_merge_recursive($productJson, array("status" => MeliConstants::getProductStatus($statusType)));

        if($product->hasVariation()){
            $productJson["variations"]      = MeliFuncUtils::convertVariations($product->getVariationList());
        }else{
            $quantity = 0;
            if(($product->getAttributesValue(TypeAttribute::DefaultAttributes, 'listing_type_id') == Type_MercadoLivreMercaListType::Tp_Free->value) ||
               ($product->getCondition()       == TypeProductCondition::Used)){
                $quantity = 1;
            }else{
                $quantity = $product->getQuantity();
            }
            $productJson["price"]               = $product->getPrice();
            $productJson["available_quantity"]  = $quantity;
        }
        return $productJson;
    }

    public  static function productObjectToMeli(Product $product): array{

        if($product->getAttributesValue(TypeAttribute::DefaultAttributes, 'listing_type_id') == ''){
            throw new Exception('attribute "listing_type_id" é obrigatório!');
        }

        $productJson      = array();
        $attributesIgnore = array();

        if($product->hasMktPlaceId()){//attributes to ignore on update
            $attributesIgnore =  array('listing_type_id');

            if($product->getSoldQuantity() == 0){
                $productJson["category_id"]   = $product->getCategoryId();
                $productJson["title"]         = $product->getTitle();
            }            
        }else{
            $productJson["currency_id"]        = $product->getMoeda()->value;
            $productJson["condition"]          = $product->getCondition()->value;

            if ($product->getStatus() == TypeStatus::Active) {
                throw new Exception("Não é possivel sincronizar produtos desabilitados");
            }

            if ($product->getQuantity() <= 0) {
                throw new Exception("Não é possivel sincronizar produtos com o estoque 0!");
            }

            $productJson["category_id"]   = $product->getCategoryId();
            $productJson["title"]         = $product->getTitle();
        }
        $productJson["attributes"]    = MeliFuncUtils::convertAttr($product->getAttributes(TypeAttribute::Datasheet));        

        $productJson['sale_terms'][] = array(
            "id"        => 'WARRANTY_TYPE',
            "value_id"  => MeliConstants::getWarrantId($product->getWarranty()->getType())
        );
        if($product->getWarranty()->getType() !== TypeWarranty::NoWarranty){
            $productJson['sale_terms'][] = array(
                "id"        => 'WARRANTY_TIME',
                "value_name"  => MeliConstants::getWarrantTime($product->getWarranty()->getUnid(), $product->getWarranty()->getPeriod())
            );
        }

        //when it will be gridded, quantity will be the sum in all of them...
        $statusType = $product->getStatus();
        if(($product->getQuantity() <= 0)){
            $statusType = TypeStatus::Inactive;
        }

        $productJson = array_merge_recursive($productJson, array("status" => MeliConstants::getProductStatus($statusType)));

        if($product->hasVariation()){
            $productJson["pictures"]        = MeliFuncUtils::convertPicture($product->getAllVariationImages());
            $productJson["variations"]      = MeliFuncUtils::convertVariations($product->getVariationList());
        }else{
            $productJson["price"]               = $product->getPrice();
            $productJson["pictures"]            = MeliFuncUtils::convertPicture($product->getImages());
            $quantity = 0;
            if(($product->getAttributesValue(TypeAttribute::DefaultAttributes, 'listing_type_id') == Type_MercadoLivreMercaListType::Tp_Free->value) ||
               ($product->getCondition()       == TypeProductCondition::Used)){
                $quantity = 1;
            }else{
                $quantity = $product->getQuantity();
            }
            $productJson["available_quantity"]  = $quantity;
        }

        //Add default attributes to the main array...
        $defaultAttributes = MeliFuncUtils::convertDefaultAttr($product->getAttributes(TypeAttribute::DefaultAttributes), $attributesIgnore);
        return array_merge_recursive($productJson, $defaultAttributes);
    }

    /**
     * @param array $meliProduct
     * @param Product $product
     */
    public static function meliToProductObject(array $meliProduct, Product &$product): void
    {
        $product->setMktPlaceId($meliProduct['id']);
        $product->setProductLink($meliProduct['permalink']);
        $product->setMktDataReturn($meliProduct);

        //upgrading the attributes...
        if(isset($meliProduct['attributes'])){
            foreach($meliProduct['attributes'] as $attr){
                $product->setAttribute(TypeAttribute::Datasheet, $attr['id'], $attr['value_name']);
            }
        }
        //Upgrading the default attributes
        foreach($meliProduct as $key => $attr){
            $product->setAttribute(TypeAttribute::DefaultAttributes,  $key, $attr, false);
        }

        //Setting the code of the image on meli...
        if ($product->hasVariation()){
            $posVar  = 0;
            foreach ($product->getVariationList() as $var){
                if($var->getStatus() == TypeStatus::Inactive){
                    $var->setVariationId('');
                    $images = $var->getProductImages();
                    foreach($images as $img){
                        $img->setMktCode('');
                    }
                }else{
                    $var->setVariationId(strval($meliProduct['variations'][$posVar]['id']));

                    $images = $var->getProductImages();
                    $imgCount = 0;
                    foreach($images as $img){
                        if(count($meliProduct['variations'][$posVar]['picture_ids']) > 0){
                            $img->setMktCode($meliProduct['variations'][$posVar]['picture_ids'][$imgCount]);
                        }else{
                            $img->setMktCode(''); 
                        }                      
                        $imgCount ++;
                    }
                    $posVar ++;
                }              
            }
        }else{
            $position = 0;
            foreach ($product->getImages() as  $img){
                $img->setMktCode($meliProduct['pictures'][$position]['id']);
                $position ++;
            }
        }
    }

}