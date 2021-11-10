<?php


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
            $return[] = array(
                $attr->getName() => $attr->getValue(),
            );
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