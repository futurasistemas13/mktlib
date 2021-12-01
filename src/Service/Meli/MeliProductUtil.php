<?php declare(strict_types=1);

namespace FuturaMkt\Service\Meli;

use FuturaMkt\Entity\Product\Product;
use FuturaMkt\Exception\HttpMktException;
use FuturaMkt\Transfer\Meli\ProductTransfer;
use FuturaMkt\Type\Http\TypeHttp;
use FuturaMkt\Type\Meli\TypeMeliEndPoints;
use FuturaMkt\Utils\FuncUtils;
use GuzzleHttp\Exception\GuzzleException;
use FuturaMkt\Utils\Meli\MeliConstants;

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
    function setProduct(Product $product): Product{
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
            FuncUtils::buildEndPoint(MeliConstants::endPoint,TypeMeliEndPoints::Product->value, $paramsProd),
            $productJson
        );
        ProductTransfer::meliToProductObject($responseProduct, $product);

        $responseDescription = $this->meliHttp->requestBodyAuthentication(
            $methodProd,
            FuncUtils::buildEndPoint(MeliConstants::endPoint, TypeMeliEndPoints::ProductDescription->value, [$product->getMktPlaceId()]),
            array('plain_text' => $product->getDescription())
        );
        return $product;
    }

}