<?php declare(strict_types=1);

namespace FuturaMkt\Service\Meli;

use FuturaMkt\Entity\Product\Product;
use FuturaMkt\Exception\HttpMktException;
use FuturaMkt\Transfer\Meli\ProductTransfer;
use FuturaMkt\Type\Http\TypeHttp;
use FuturaMkt\Type\Meli\TypeMeliEndPoints;
use GuzzleHttp\Exception\GuzzleException;

class MeliProductUtil {

    private MeliHttpMethods $meliHttp;

    public function __construct(MeliHttpMethods $httpMethods)
    {
        $this->meliHttp = $httpMethods;
    }

    /**
     * @param Product $product
     * @throws HttpMktException
     * @throws GuzzleException
     */
    function setProduct(Product $product){
        $isUpdating  = $product->hasMktPlaceId();

        $methodProd = TypeHttp::POST;
        $paramsProd = null;
        if($isUpdating){
            $methodProd = TypeHttp::PUT;
            $paramsProd = array($product->getMktPlaceId());
        }
        $productJson = ProductTransfer::productObjectToMeli($product);

        $responseProduct = $this->meliHttp->requestBodyAuthentication(
            $methodProd,
            MeliConstants::buildEndPoint(TypeMeliEndPoints::Product->value, $paramsProd),
            $productJson
        );
        ProductTransfer::meliToProductObject($responseProduct, $product);

        $responseDescription = $this->meliHttp->requestBodyAuthentication(
            $methodProd,
            MeliConstants::buildEndPoint(TypeMeliEndPoints::ProductDescription->value, [$product->getMktPlaceId()]),
            array('plain_text' => $product->getDescription())
        );

    }

}