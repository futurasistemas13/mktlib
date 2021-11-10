<?php

namespace FuturaMkt\Service\Meli;

use FuturaMkt\Entity\Produto\Produto;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;


class MeliProdutoUtil {

    function addProduct(Produto $product, String $auth_code){
        $produto = array(
            "title"             => $product->getTitle(),
            "category_id"       => $product->getCategoryId(),
            "currency_id"       => $product->getMoeda()->value,
            "condition"         => $product->getCondition()->value,

            //start - check for the grid
            "price"               => $product->getPrice(),
            "pictures"            => MeliFuncUtils::convertPicture($product->getImage()),
            "available_quantity"  => $product->getQuantity(),
            //end - check for the grid
            "attributes"       => MeliFuncUtils::convertAttr($product->getAttributes())
        );

        $defaultAttributes = MeliFuncUtils::convertDefaultAttr($product->getAttributes());
        $produto           = array_merge_recursive($produto, $defaultAttributes);

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
            throw $e;
        }
    }


}