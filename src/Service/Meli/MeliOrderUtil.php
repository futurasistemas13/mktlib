<?php declare(strict_types=1);

namespace FuturaMkt\Service\Meli;

use Exception;
use FuturaMkt\Entity\Order\Order;
use FuturaMkt\Exception\HttpMktException;
use FuturaMkt\Transfer\Meli\OrderTransfer;
use FuturaMkt\Type\Http\TypeHttp;
use FuturaMkt\Type\Meli\TypeMeliEndPoints;
use FuturaMkt\Utils\FuncUtils;
use GuzzleHttp\Exception\GuzzleException;
use FuturaMkt\Utils\Meli\MeliConstants;

class MeliOrderUtil {

    private MeliHttpMethods $meliHttp;

    public function __construct(MeliHttpMethods $httpMethods)
    {
        $this->meliHttp = $httpMethods;
    }

    public function getOrder(string $mktOrderId): Order{
        $transferOrder   =  new OrderTransfer();

        $responseOrder = $this->meliHttp->requestWithAuthentication(
            TypeHttp::GET,
            FuncUtils::buildEndPoint(MeliConstants::endPoint, TypeMeliEndPoints::Orders->value, [$mktOrderId])
        );

        $responseShipping = array();
        if($transferOrder->hasShippingId($responseOrder)){
            $responseShipping = $this->meliHttp->requestWithAuthentication(
                TypeHttp::GET,
                FuncUtils::buildEndPoint(MeliConstants::endPoint, TypeMeliEndPoints::Shipments->value, [$transferOrder->getIdShipping($responseOrder)])
            );
        }
        
        $return          =  $transferOrder->MeliToOrderObject($responseOrder, $responseShipping);

        return $return;
    }

 

}