<?php declare(strict_types=1);


namespace FuturaMkt\Service\Meli;

use FuturaMkt\Entity\Authentication\MktConnection;
use FuturaMkt\Type\Http\TypeHttp;
use FuturaMkt\Type\Meli\TypeMeliEndPoints;

class MeliAuthUtil{

    private MktConnection   $dataAuth;
    private MeliHttpMethods $meliHttpMethods;

    public function __construct(MeliHttpMethods $meliHttpMethods)
    {
        $this->meliHttpMethods = $meliHttpMethods;
    }

    public function getAuthData(): MktConnection
    {
        return $this->dataAuth;
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
                'grant_type' => 'refresh_token',
                'client_id' => $data->getClientId(),
                'client_secret' => $data->getClientSecret(),
                'refresh_token' => $data->getRefreshToken()
            );
            return $this->cliToken($data, $form);
        }else{
            $this->dataAuth = $data;
            $this->meliHttpMethods->setAccessToken($data->getAccessToken());
            return $data;
        }
    }

    private function cliToken(MktConnection $data, array $form): MktConnection
    {
        $jsonResp = $this->meliHttpMethods->requestForm(TypeHttp::POST, MeliConstants::buildEndPoint(TypeMeliEndPoints::AuthToken->value), $form);

        if (isset($response['access_token'])){
            $data->setAccessToken($response['access_token']);
        }
        if (isset($jsonResp['refresh_token'])){
            $data->setRefreshToken($jsonResp['refresh_token']);
        }
        $this->dataAuth = $data;
        $this->meliHttpMethods->setAccessToken($response['access_token']);
        return $data;
    }

}