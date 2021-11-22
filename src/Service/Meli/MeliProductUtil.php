<?php declare(strict_types=1);

namespace FuturaMkt\Service\Meli;

use FuturaMkt\Entity\Product\Product;
use FuturaMkt\Exception\HttpMktException;
use FuturaMkt\Type\Http\TypeHttp;
use FuturaMkt\Type\Meli\TypeMeliEndPoints;
use FuturaMkt\Type\TypeAttribute;

class MeliProductUtil {

    private MeliHttpMethods $meliHttp;

    public function __construct(MeliHttpMethods $httpMethods)
    {
        $this->meliHttp = $httpMethods;
    }

    /**
     * @throws HttpMktException
     */
    function setProduct(Product $product){
        $isUpdating  = $product->hasMktPlaceId();

        $productJson = array(
            "title"               => $product->getTitle(),
            "category_id"         => $product->getCategoryId(),
            "currency_id"         => $product->getMoeda()->value,
            "condition"           => $product->getCondition()->value,
            //start - check for the grid
            "price"               => $product->getPrice(),
            "pictures"            => MeliFuncUtils::convertPicture($product->getImages()),
            "available_quantity"  => $product->getQuantity(),
            //end - check for the grid
            "attributes"          => MeliFuncUtils::convertAttr($product->getAttributes(TypeAttribute::Datasheet)),
        );

        //Add default attributes to the main array...
        $defaultAttributes = MeliFuncUtils::convertDefaultAttr($product->getAttributes(TypeAttribute::DefaultAttributes));
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