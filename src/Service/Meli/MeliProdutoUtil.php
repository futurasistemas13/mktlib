<?php declare(strict_types=1);

namespace FuturaMkt\Service\Meli;

use FuturaMkt\Entity\Produto\Produto;
use FuturaMkt\Type\Http\TypeHttp;
use FuturaMkt\Type\Meli\TypeMeliEndPoints;
use http\Exception;

class MeliProdutoUtil {

    private MeliHttpMethods $meliHttp;
    private MeliAuthUtil    $meliAuth;

    public function __construct(MeliAuthUtil $auth)
    {
        $this->meliAuth = $auth;
        $this->meliHttp = new MeliHttpMethods();
        $this->meliHttp->setAccessToken($this->meliAuth->getAuthData()->getAccessToken());
    }

    function setProduct(Produto $product){

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
        if($product->hasMktPlaceId()){
            $methodProd = TypeHttp::PUT;
            $paramsProd = array($product->getMktPlaceId());
        }

        $responseProduct = $this->meliHttp->requestBodyAuthentication(
            $methodProd,
            MeliConstants::buildEndPoint(TypeMeliEndPoints::Product->value, $paramsProd),
            $productJson
        );

        if (!$this->validate($responseProduct)){
            throw new \Exception('ERROO!!');
        }

        $product->setMktPlaceId($responseProduct->id);
        $responseDescriptiopn = $this->meliHttp->requestBodyAuthentication(
            $methodProd,
            MeliConstants::buildEndPoint(TypeMeliEndPoints::ProductDescription->value, [$product->getMktPlaceId()]),
            array('plain_text' => $product->getDescription())
        );
    }

    public function validate(array $meliReturn){


        return true;

    }
}