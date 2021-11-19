<?php declare(strict_types=1);

namespace FuturaMkt\Service\Meli;

use FuturaMkt\Entity\Produto\Produto;
use FuturaMkt\Type\Http\TypeHttp;
use FuturaMkt\Type\Meli\TypeMeliEndPoints;

class MeliProdutoUtil {

    private MeliHttpMethods $meliHttp;
    private MeliAuthUtil    $meliAuth;

    public function __construct(MeliAuthUtil $auth, MeliHttpMethods $httpMethods)
    {
        $this->meliAuth = $auth;
        $this->meliHttp = $httpMethods;
    }

    function setProduct(Produto $product){
        //$this->meliAuth->refreshToken($this->meliAuth->getAuthData());
        //$this->meliHttp->setAccessToken($this->meliAuth->getAuthData()->getAccessToken());
        $isUpdating  = $product->hasMktPlaceId();

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
        $productJson       = array_merge_recursive($productJson, $defaultAttributes);

        $methodProd = TypeHttp::POST;
        $paramsProd = null;
        if($isUpdating){
            $methodProd = TypeHttp::PUT;
            $paramsProd = array($product->getMktPlaceId());
        }

        $responseProduct = $this->meliHttp->requestBodyAuthentication(
            $methodProd,
            MeliConstants::buildEndPoint(TypeMeliEndPoints::Product->value, $paramsProd),
            $productJson
        );

        $product->setMktPlaceId($responseProduct['id']);
        $responseDescription = $this->meliHttp->requestBodyAuthentication(
            $methodProd,
            MeliConstants::buildEndPoint(TypeMeliEndPoints::ProductDescription->value, [$product->getMktPlaceId()]),
            array('plain_text' => $product->getDescription())
        );

    }

}