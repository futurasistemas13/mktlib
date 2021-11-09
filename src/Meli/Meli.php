<?php


namespace FuturaMkt\Meli;

use FuturaMkt\Authentication\Model\MktConnection;
use FuturaMkt\iMarketplace;
use GuzzleHttp\Client;


class Meli implements iMarketplace{

    private function genRefreshToken(MktConnection $data){
        $client = new Client();
        $response = $client->request('POST', 'https://api.mercadolibre.com/oauth/token', [
            'form_params'       => [
                'grant_type'    => 'authorization_code',
                'client_id'     => $data->getClientId(),
                'client_secret' => $data->getClientSecret(),
                'code'          => $data->getCode(),
                'redirect_uri'  => $data->getRedirectUri()
            ]]);
        $jsonResp = json_decode($response->getBody()->getContents());

        if (isset($jsonResp['access_token'])){
            $data->setAccessToken($jsonResp['access_token']);
        }
        if (isset($jsonResp['refresh_token'])){
            $data->setRefreshToken($jsonResp['access_token']);
        }
        return $response;
    }

    private function refreshToken(MktConnection $data){
        $client = new Client();
        $response = $client->request('POST', 'https://api.mercadolibre.com/oauth/token', [
            'form_params'       => [
                'grant_type'    => 'refresh_token',
                'client_id'     => $data->getClientId(),
                'client_secret' => $data->getClientSecret(),
                'refresh_token' => $data->getRefreshToken()
            ]]);
        return $response;
    }

    public function authenticate(MktConnection $data)
    {
        $data    = $this->genRefreshToken($data);
        $retorno = $this->refreshToken($data);
        return $retorno;
    }
}