<?php


namespace FuturaMkt/Authentication/Meli;

use GuzzleHttp\Client;


class Meli{

    private function genRefreshToken(){
        $client = new \Client();
        $response = $client->request('GET', 'https://api.github.com/repos/guzzle/guzzle');

    }


}