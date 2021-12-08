<?php declare(strict_types=1);

namespace FuturaMkt\Transfer\Meli;

use FuturaMkt\Entity\Meli\MeliDataSheet;


class DataSheetTransfer{

    public function MeliToDsObjectList(array $meliDs): array{
        $return = array();
        foreach($meliDs as $ds){
            $return[] = new MeliDataSheet($ds['id'], $ds['name']);

            if(isset($ds['allowed_units'])){
                foreach($ds['allowed_units'] as $unit){
                    $isDefaultValue = ($unit['id'] == $ds['default_unit']);
                    $return[array_key_last($return)]->setAllowed_units($unit['id'], $unit['name'], $isDefaultValue);
                }
            }

            if(isset($ds['values'])){
                foreach($ds['values'] as $value){
                    $return[array_key_last($return)]->setValueList($value['id'], $value['name']);
                }
            }
            
        }
        return $return;
    }

    public function DsToArray($ds): array{
        //$return = array();
        //foreach($dsList as $ds){
        return $this->convert($ds);
        //}
        //return $return;
    }

    private function convert($obj): array{

        $return = array();
        $reflection = new \ReflectionClass(get_class($obj));

        foreach($reflection->getProperties() as $prop){
            if(is_array($prop->getValue($obj))){
                if(count($prop->getValue($obj)) > 0){
                    foreach($prop->getValue($obj) as $item){
                        if(is_object($item)){
                            $return[$prop->getName()][]  =  $this->convert($item);  
                        }else{
                            $return[$prop->getName()] =  $prop->getValue($obj);  
                        }
                    }
                }else{
                    $return[$prop->getName()] = array();
                }

            }elseif(is_object($prop->getValue($obj))){
                $return[$prop->getName()][] = $this->convert($prop->getValue());
            }else{
                $return[$prop->getName()] =  $prop->getValue($obj);
            }
        }

        return $return;

    }



}