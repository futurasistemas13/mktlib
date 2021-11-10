<?php


namespace FuturaMkt\Service\Meli;

use FuturaMkt\Entity\Authentication\MktConnection;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class MeliAuthUtil{

    private MktConnection $dataAuth;

    public function getAuthData(): MktConnection
    {
        return $this->dataAuth;
    }

    public function genToken(MktConnection $data) : MktConnection
    {
        $client   = new Client();
        $response = null;
        try {
            $response = $client->request('POST', 'https://api.mercadolibre.com/oauth/token', [
                'form_params' => [
                    'grant_type'    => 'authorization_code',
                    'client_id'     => $data->getClientId(),
                    'client_secret' => $data->getClientSecret(),
                    'code'          => $data->getCode(),
                    'redirect_uri'  => $data->getRedirectUri()
                ]]);
        }catch (ClientException $e){
            //parent::setLastError($e->getMessage(), $response->getStatusCode());
            //deu certo de primeira!!!kkkk

            $this->dataAuth = $data;
            return $data;
        }
        $jsonResp = json_decode($response->getBody()->getContents());

        if (isset($jsonResp->access_token)){
            $data->setAccessToken($jsonResp->access_token);
        }
        if (isset($jsonResp->refresh_token)){
            $data->setRefreshToken($jsonResp->refresh_token);
        }

        $this->dataAuth = $data;
        return $data;
    }

    public function refreshToken(MktConnection $data): MktConnection
    {
        $client   = new Client();
        $response = null;
        try {
            $response = $client->request('POST', 'https://api.mercadolibre.com/oauth/token', [
                'form_params' => [
                    'grant_type'    => 'refresh_token',
                    'client_id'     => $data->getClientId(),
                    'client_secret' => $data->getClientSecret(),
                    'refresh_token' => $data->getRefreshToken()
                ]]);
        } catch (ClientException $e){
            //parent::setLastError($e->getMessage(), $response->getStatusCode());
            $this->dataAuth = $data;
            return $data;
        }
        if (isset($jsonResp->access_token)){
            $data->setAccessToken($jsonResp->access_token);
        }
        if (isset($jsonResp->refresh_token)){
            $data->setRefreshToken($jsonResp->refresh_token);
        }
        $this->dataAuth = $data;
        return $data;
    }
}