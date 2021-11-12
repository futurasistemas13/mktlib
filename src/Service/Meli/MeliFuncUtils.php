<?php declare(strict_types=1);

namespace FuturaMkt\Service\Meli;

use FuturaMkt\Entity\Produto\ProdutoAttributes;
use FuturaMkt\Type\TypeAttribute;

class MeliFuncUtils{
    public static function convertAttr(ProdutoAttributes $attributes): array
    {
        $return = array();
        foreach($attributes->get(TypeAttribute::Datasheet) as $attr){
            $return[] = array(
                'id'         => $attr->getName(),
                'value_name' => $attr->getValue()
            );
        }
        return $return;
    }

    public static function convertDefaultAttr(ProdutoAttributes $attributes): array
    {
        $return = array();
        foreach($attributes->get(TypeAttribute::DefaultAttributes) as $attr){
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