<?php declare(strict_types=1);

namespace FuturaMkt\Service\Meli;

use Exception;
use FuturaMkt\Entity\Product\Product;
use FuturaMkt\Exception\HttpMktException;
use FuturaMkt\Transfer\Meli\DataSheetTransfer;
use FuturaMkt\Transfer\Meli\ProductTransfer;
use FuturaMkt\Type\Http\TypeHttp;
use FuturaMkt\Type\Meli\TypeMeliEndPoints;
use FuturaMkt\Utils\FuncUtils;
use GuzzleHttp\Exception\GuzzleException;
use FuturaMkt\Utils\Meli\MeliConstants;
use FuturaMkt\Transfer\Meli\ProductListingTypeTransfer;

class MeliProductUtil {

    private MeliHttpMethods $meliHttp;

    public function __construct(MeliHttpMethods $httpMethods)
    {
        $this->meliHttp = $httpMethods;
    }

    /**
     * @param Product $product
     * @return Product
     * @throws GuzzleException
     * @throws HttpMktException
     */
    function setProductSimple(Product $product): Product{
        if (!$product->hasMktPlaceId()){
            throw new Exception('Atualização simples de produto apenas disponivel para atualizações');
        }
 
        $productJson = ProductTransfer::productSimpleToMeli($product);

        $responseProduct = $this->meliHttp->requestWithAuthentication(
            TypeHttp::PUT,
            FuncUtils::buildEndPoint(MeliConstants::endPoint, TypeMeliEndPoints::Product->value, array($product->getMktPlaceId())),
            $productJson
        );
        ProductTransfer::meliToProductObject($responseProduct, $product);

        return $product;
    }


    /**
     * @param Product $product
     * @return Product
     * @throws GuzzleException
     * @throws HttpMktException
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

        $responseProduct = $this->meliHttp->requestWithAuthentication(
            $methodProd,
            FuncUtils::buildEndPoint(MeliConstants::endPoint, TypeMeliEndPoints::Product->value, $paramsProd),
            $productJson
        );
        ProductTransfer::meliToProductObject($responseProduct, $product);

        if($product->getDescription() !== ""){
            $this->meliHttp->requestWithAuthentication(
                $methodProd,
                FuncUtils::buildEndPoint(MeliConstants::endPoint, TypeMeliEndPoints::ProductDescription->value, [$product->getMktPlaceId()]),
                array('plain_text' => $product->getDescription())
            );
        }

        return $product;
    }

    /**
     * @throws GuzzleException
     * @throws HttpMktException
     */
    function getCategoriesAttributes($category_id): array{
        $responseAttribute = $this->meliHttp->requestWithAuthentication(
            TypeHttp::GET,
            FuncUtils::buildEndPoint(MeliConstants::endPoint, TypeMeliEndPoints::ProductAttributes->value, [$category_id])
        );

        $dsTransfer = new DataSheetTransfer();
        $arrayObj   = $dsTransfer->MeliToDsObjectList($responseAttribute);

        return $arrayObj;
    }

    function getProductListingType(): array{
        $responseAttribute = $this->meliHttp->requestWithAuthentication(
            TypeHttp::GET,
            FuncUtils::buildEndPoint(MeliConstants::endPoint, TypeMeliEndPoints::ListingTypes->value)
        );

        $transferLT   =  new ProductListingTypeTransfer();
        $listingTypes =  $transferLT->MeliToObjectList($responseAttribute);

        return $listingTypes;
    }

}