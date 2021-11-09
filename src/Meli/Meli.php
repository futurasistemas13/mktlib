<?php


namespace FuturaMkt\Meli;

use FuturaMkt\Authentication\Model\MktConnection;
use GuzzleHttp\Client;
use FuturaMkt\iPlayer;

class Meli implements iPlayer{

    public function genRefreshToken(MktConnection $data){
        $client = new \Client();
        $response = $client->request('POST', 'https://api.github.com/repos/guzzle/guzzle', [
            'form_params'       => [
                'grant_type'    => 'authorization_code',
                'client_id'     => $data->getClientId(),
                'client_secret' => $data->getClientSecret(),
                'code'          => $data->getCode(),
                'redirect_uri'  => $data->getRedirectUri()
            ]]);
        return $response;
    }

    public function refreshToken(MktConnection $data){
        $client = new \Client();
        $response = $client->request('POST', 'https://api.github.com/repos/guzzle/guzzle', [
            'form_params'       => [
                'grant_type'    => 'refresh_token',
                'client_id'     => $data->getClientId(),
                'client_secret' => $data->getClientSecret(),
                'refresh_token' => 'TG-61893f5625d1cc001ae27213-159563283'
            ]]);
        return $response;
    }

}