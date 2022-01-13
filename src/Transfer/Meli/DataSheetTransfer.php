<?php declare(strict_types=1);

namespace FuturaMkt\Transfer\Meli;

use FuturaMkt\Entity\Meli\MeliDataSheet;
use Serializable;


class DataSheetTransfer{

    public function MeliToDsObjectList(array $meliDs): array{
         $return = array();

         $components = array();
         foreach($meliDs['groups'] as $group){
            $components  = array_merge($components, $group['components']);
         }

         foreach($components as $ds){
            $attribute = $ds['attributes'][0];   
            $uiConfig  = $ds['ui_config'];       

            $AttributeHidden    = false;
            $attributeVariation = false;
            $fixedValue         = false;
            $multiValued        = false;
            $requiredValue      = false;
            if(array_key_exists('tags', $attribute)){
                foreach($attribute['tags'] as $tags){
                    if(($tags == 'hidden') || ($tags == 'vip_hidden')){
                        $AttributeHidden = true;
                    }
                    if($tags == 'allow_variations'){
                        $attributeVariation = true;
                    }
                    if($tags == 'fixed'){
                        $fixedValue = true;
                    }                     
                    if($tags == 'multivalued'){
                        $multiValued  = true;
                    }  
                    if($tags == 'required'){
                        $requiredValue  = true;
                    }   
                }
            }
            
            if(($AttributeHidden)){
                continue;
            }

            $return[] = new MeliDataSheet($attribute['id'], $attribute['name']);

            if((array_key_exists('hint', $uiConfig)) && (is_string($uiConfig['hint']))){
                $return[array_key_last($return)]->setHint($uiConfig['hint']);
            }     
            
            if((array_key_exists('tooltip', $uiConfig)) && (is_string($uiConfig['tooltip']))){
                $return[array_key_last($return)]->setToolTip($uiConfig['tooltip']);
            }  

            if(isset($attribute['values'])){
                foreach($attribute['values'] as $value){
                    $return[array_key_last($return)]->setValueList($value['id'], $value['name']);
                }
            }

            if(array_key_exists('units', $attribute)){
                foreach($attribute['units'] as $unit){
                    $isDefaultValue = ($unit['id'] == $attribute['default_unit_id']);
                    $return[array_key_last($return)]->setAllowed_units($unit['id'], $unit['name'], $isDefaultValue);
                }
            }

            $return[array_key_last($return)]->setAttributeVariation($attributeVariation)
                                            ->setFixed($fixedValue)
                                            ->setMultiValued($multiValued)
                                            ->setRequired($requiredValue);
        }

        return $return;
    }
}