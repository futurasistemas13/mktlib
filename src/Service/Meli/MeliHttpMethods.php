<?php declare(strict_types=1);
namespace FuturaMkt\Service\Meli;

use FuturaMkt\Type\Http\TypeHttp;
use FuturaMkt\Type\Meli\TypeMeliEndPoints;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\ClientException;
use FuturaMkt\Exception\HttpMktException;

class MeliHttpMethods{

    private $clientHttp;

    function __construct()
    {
        $this->clientHttp   = new Client();
    }

    private $accessToken = "";

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    /**
     * @param string $accessToken
     */
    public function setAccessToken(string $accessToken): void
    {
        $this->accessToken = $accessToken;
    }

    public function requestBodyAuthentication(TypeHttp $method, String $url, array $dataJson){
        //$retorno  = null;
        //$response = null;
        try{
            $response = $this->clientHttp->request($method->value, $url, [
                'headers' => [
                    'Content-Type'   => 'application/json',
                    'Authorization'  => 'Bearer ' . $this->getAccessToken()
                ],
                'body' => json_encode($dataJson)
            ]);
            return $response->getBody()->getContents();
        }catch(ClientException $cli_e){
            //$retorno = $cli_e->getResponse()->getBody()->getContents();
            throw new HttpMktException($cli_e->getResponse()->getBody()->getContents(), $cli_e->getCode());
        }

        //return json_decode($retorno, true);//json_decode($response->getBody()->getContents());
    }


}