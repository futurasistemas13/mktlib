<?php

namespace FuturaMkt\Service\Meli;

use FuturaMkt\Type\Meli;

class MeliConstants{

    const endPoint = 'https://api.mercadolibre.com/';

    public static function buildEndPoint($route, array $params = null): String
    {
        $UrlParams = explode('/', $route);
        $count = 0;
        foreach($UrlParams as $key => $param){

            if(($param != "")){
                if(($param[0] == '{') && ($param[strlen($param)-1] == '}')){
                    if ($params[$count] !== ''){
                        $UrlParams[$key] = $params[$count];
                    } else{
                        unset($UrlParams[$key]);
                    }
                    $count ++;
                }
            }
        }
        return self::endPoint . implode('/', $UrlParams);
    }
}