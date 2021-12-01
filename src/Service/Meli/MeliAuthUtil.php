<?php declare(strict_types=1);


namespace FuturaMkt\Service\Meli;

use FuturaMkt\Entity\Authentication\MktConnection;
use FuturaMkt\Exception\HttpMktException;
use FuturaMkt\Type\Http\TypeHttp;
use FuturaMkt\Type\Meli\TypeMeliEndPoints;
use FuturaMkt\Utils\FuncUtils;
use FuturaMkt\Utils\Meli\MeliConstants;
use GuzzleHttp\Exception\GuzzleException;

class MeliAuthUtil{

    private MeliHttpMethods $meliHttpMethods;

    public function __construct(MeliHttpMethods $meliHttpMethods)
    {
        $this->meliHttpMethods = $meliHttpMethods;
    }

    public function genToken(MktConnection $data): MktConnection
    {
        $form = array(
            'grant_type'    => 'authorization_code',
            'client_id'     => $data->getClientId(),
            'client_secret' => $data->getClientSecret(),
            'code'          => $data->getRefreshToken(),
            'redirect_uri'  => $data->getRedirectUri()
        );
        return $this->cliToken($data, $form);
    }

    public function refreshToken(MktConnection $data): MktConnection
    {
        //só da refresh se realmente for necessário (refresh token expirado...)
        if( ($data->getTokenExpire() !== 0) &&
            ($data->getAccessToken())       &&
            ($data->getRefreshToken())      &&
            ($data->getTokenExpire() < time() + 1) ) {
            $form = array(
                'grant_type'    => 'refresh_token',
                'client_id'     => $data->getClientId(),
                'client_secret' => $data->getClientSecret(),
                'refresh_token' => $data->getRefreshToken()
            );
            return $this->cliToken($data, $form);
        }else{
            $this->meliHttpMethods->setAccessToken($data->getAccessToken());
            return $data;
        }
    }

    /**
     * @throws GuzzleException
     * @throws HttpMktException
     */
    private function cliToken(MktConnection $data, array $form): MktConnection
    {
        $jsonResp = $this->meliHttpMethods->requestForm(TypeHttp::POST, FuncUtils::buildEndPoint(MeliConstants::endPoint, TypeMeliEndPoints::AuthToken->value), $form);

        if (isset($jsonResp['access_token'])){
            $data->setAccessToken($jsonResp['access_token']);
        }
        if (isset($jsonResp['refresh_token'])){
            $data->setRefreshToken($jsonResp['refresh_token']);
        }
        $this->meliHttpMethods->setAccessToken($jsonResp['access_token']);
        return $data;
    }

}