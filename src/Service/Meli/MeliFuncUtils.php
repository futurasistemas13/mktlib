<?php declare(strict_types=1);

namespace FuturaMkt\Service\Meli;

use FuturaMkt\Type\TypeAttribute;

class MeliFuncUtils{
    public static function convertAttr(array $attributes): array
    {
        $return = array();
        foreach($attributes[TypeAttribute::Datasheet->value] as $attr){
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
        foreach($attributes[TypeAttribute::DefaultAttributes->value] as $attr){
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

}