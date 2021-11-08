<?php


namespace FuturaMkt\Authentication\Meli;

use GuzzleHttp\Client;

class Meli{

    private function genRefreshToken($data){
        $client = new \Client();
        $response = $client->request('POST', 'https://api.github.com/repos/guzzle/guzzle', [
            'form_params'       => [
                'grant_type'    => 'authorization_code',
                'client_id'     => '4752671983518627',
                'client_secret' => 'H0bYg015RC2JySAcZl0K1T9gBSixFb37',
                'code'          => 'TG-61893f5625d1cc001ae27213-159563283',
                'redirect_uri'  => 'https://testeoracle.or01.futurasistemas.com.br/info.php'
            ]]);
        return $response;
    }

    private function refreshToken(){
        $client = new \Client();
        $response = $client->request('POST', 'https://api.github.com/repos/guzzle/guzzle', [
            'form_params'       => [
                'grant_type'    => 'refresh_token',
                'client_id'     => '4752671983518627',
                'client_secret' => 'H0bYg015RC2JySAcZl0K1T9gBSixFb37',
                'refresh_token' => 'TG-61893f5625d1cc001ae27213-159563283'
            ]]);
        return $response;
    }

}