<?php declare(strict_types=1);

namespace FuturaMkt\Service\Meli;

class MeliFuncUtils{
    public static function convertAttr(array $attributes): array
    {
        $return = array();
        foreach($attributes as $attr){
            $return[] = array(
                'id'         => $attr->getName(),
                'value_name' => $attr->getValue()
            );
        }
        return $return;
    }

    public static function convertDefaultAttr(array $attributes): array
    {
        $return = array();
        foreach($attributes as $attr){
            $aux = array();
            $aux[$attr->getName()] = $attr->getValue();
            $return = array_merge($return, $aux);
        }
        return $return;
    }

    public static function convertPicture(array $images): array
    {
        $return = array();
        foreach ($images as $img){
            $return[] = array(
              'source' => $img->getImageLink()
            );
        }
        return $return;
    }

    public static function convertPictureSimpleArray(array $images): array
    {
        $return = array();
        foreach ($images as $img){
            $return[] =  $img->getImageLink();
        }
        return $return;
    }

    public static function convertVariations(array $variations): array
    {
        $result = array();
        foreach($variations as $attr_variation){

            $comb = array();
            foreach($attr_variation->getAttributes() as $attr){
                $comb[] = array(
                    'id'           =>  $attr->getName(),
                    'name'         =>  $attr->getName(),
                    'value_name'   =>  $attr->getValue(),
                );
            }
            $result[] = array(
                "attribute_combinations" => $comb,
                "price"                  => $attr_variation->getPrice(),
                "available_quantity"     => $attr_variation->getQuantity(),
                "picture_ids"            => MeliFuncUtils::convertPictureSimpleArray($attr_variation->getProductImage()),
            );
        }
        return $result;
    }

}