<?php

namespace FuturaMkt\Meli;

use FuturaMkt\Entity\Produto;
use FuturaMkt\Entity\ProdutoAttributes;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class MeliProdutoUtil {

    function addProduct(Produto $product, String $auth_code){
        $produto = array(
            "title"         => $product->getTitle(),
            "category_id"   => $product->getCategoryId(),
            "attributes"    => $this->convertAttr($product->getAttributes())
        );

        $client   = new Client([
            'headers' => [
                'Content-Type'   => 'application/json',
                'Authorization'  => 'Bearer ' . $auth_code
            ],

        ]);

        try {
            $response = $client->request('POST', 'https://api.mercadolibre.com/items', [
                'body' => json_encode($produto)
            ]);
        }catch (ClientException $e){
            //throw new ClientException($e);
            echo $e->getMessage();
        }
    }

    private function convertAttr(ProdutoAttributes $attributes){
        $return = array();
        foreach($attributes->get('ficha_tecnica') as $attr){
            $return[] = array(
                'id'         => $attr->getName(),
                'value_name' => $attr->getValue()
            );
        }
        return $return;
    }


}