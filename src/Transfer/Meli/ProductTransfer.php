<?php declare(strict_types=1);

namespace FuturaMkt\Transfer\Meli;

use FuturaMkt\Entity\Product\Product;
use FuturaMkt\Type\TypeAttribute;

class ProductTransfer{

    public  static function productObjectToMeli(Product $product): array{
        $productJson = array(
            "title"               => $product->getTitle(),
            "category_id"         => $product->getCategoryId(),
            "currency_id"         => $product->getMoeda()->value,
            "condition"           => $product->getCondition()->value,
            "attributes"          => MeliFuncUtils::convertAttr($product->getAttributes(TypeAttribute::Datasheet)),
        );

        if($product->hasVariation()){
            $productJson["pictures"]        = MeliFuncUtils::convertPicture($product->getAllVariationImages());
            $productJson["variations"]      = MeliFuncUtils::convertVariations($product->getVariationList());
        }else{
            $productJson["price"]               = $product->getPrice();
            $productJson["pictures"]            = MeliFuncUtils::convertPicture($product->getImages());
            $productJson["available_quantity"]  = $product->getQuantity();
        }

        //Add default attributes to the main array...
        $defaultAttributes = MeliFuncUtils::convertDefaultAttr($product->getAttributes(TypeAttribute::DefaultAttributes));
        return array_merge_recursive($productJson, $defaultAttributes);
    }

    /**
     * @param array $meliProduct
     * @param Product $product
     */
    public static function meliToProductObject(array $meliProduct, Product &$product): void
    {
        $product->setMktPlaceId($meliProduct['id']);
    }

}