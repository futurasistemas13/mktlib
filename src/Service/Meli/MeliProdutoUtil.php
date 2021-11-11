<?php

namespace FuturaMkt\Service\Meli;

use FuturaMkt\Entity\Produto\Produto;
use FuturaMkt\Type\Http\TypeHttp;
use FuturaMkt\Type\Meli\TypeMeliEndPoints;

class MeliProdutoUtil {

    private MeliHttpMethods $meliHttp;

    public function __construct()
    {
        $this->meliHttp = new MeliHttpMethods();
    }

    function setProduct(Produto $product, String $auth_code){

        $this->meliHttp->setAccessToken($auth_code);

        $productJson = array(
            "title"               => $product->getTitle(),
            "category_id"         => $product->getCategoryId(),
            "currency_id"         => $product->getMoeda()->value,
            "condition"           => $product->getCondition()->value,

            //start - check for the grid
            "price"               => $product->getPrice(),
            "pictures"            => MeliFuncUtils::convertPicture($product->getImage()),
            "available_quantity"  => $product->getQuantity(),
            //end - check for the grid
            "attributes"          => MeliFuncUtils::convertAttr($product->getAttributes()),
        );

        $defaultAttributes = MeliFuncUtils::convertDefaultAttr($product->getAttributes());
        $productJson           = array_merge_recursive($productJson, $defaultAttributes);

        $methodProd = TypeHttp::POST;
        $paramsProd = null;
        if($product->hasMktPlaceId()){
            $methodProd = TypeHttp::PUT;
            $paramsProd = array($product->getMktPlaceId());
        }

        $responseProduct = $this->meliHttp->requestBodyAuthentication(
            $methodProd,
            MeliConstants::buildEndPoint(TypeMeliEndPoints::Product->value, $paramsProd),
            $productJson
        );

        $product->setMktPlaceId($responseProduct['id']);

        $responseDescriptiopn = $this->meliHttp->requestBodyAuthentication(
            TypeHttp::POST,
            MeliConstants::buildEndPoint(TypeMeliEndPoints::ProductDescription->value, [$product->getMktPlaceId()]),
            array('plain_text' => $product->getDescription())
        );

    }


}