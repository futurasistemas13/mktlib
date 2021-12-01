<?php

namespace FuturaMkt\Utils;

class FuncUtils
{
    public static function buildEndPoint(String $endPoint, String $route, array $params = null): String
    {
        $UrlParams = explode('/', $route);
        $count = 0;
        foreach($UrlParams as $key => $param){

            if(($param != "")){
                if(($param[0] == '{') && ($param[strlen($param)-1] == '}')){
                    if (($params !== null) && ($params[$count] !== '') && ($params[$count] !== null)){
                        $UrlParams[$key] = $params[$count];
                    } else{
                        unset($UrlParams[$key]);
                    }
                    $count ++;
                }
            }
        }
        return $endPoint . implode('/', $UrlParams);
    }

}