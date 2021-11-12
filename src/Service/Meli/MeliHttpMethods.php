<?php declare(strict_types=1);
namespace FuturaMkt\Service\Meli;

use FuturaMkt\Type\Http\TypeHttp;
use GuzzleHttp\Client;
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
        try{
            $response = $this->clientHttp->request($method->value, $url, [
                'headers' => [
                    'Content-Type'   => 'application/json',
                    'Authorization'  => 'Bearer ' . $this->getAccessToken()
                ],
                'body' => json_encode($dataJson)
            ]);

            $arrayConvert = json_decode($response->getBody()->getContents(), true);
            if ((is_array($arrayConvert)) && (($response->getStatusCode() >= 200) && ($response->getStatusCode() < 300)) ){
                return $arrayConvert;
            }else{
                throw new HttpMktException($response->getBody()->getContents(), $response->getStatusCode());
            }

        }catch(ClientException $cli_e){
            throw new HttpMktException($cli_e->getResponse()->getBody()->getContents(), $cli_e->getCode());
        }
    }

    public function requestForm(TypeHttp $method, String $url, array $dataJson, Bool $includeAuth = false){

        $cliParams = null;
        if($includeAuth){
            $cliParams = array(
                'headers' => [
                    'Content-Type'   => 'application/json',
                    'Authorization'  => 'Bearer ' . $this->getAccessToken()
                ]);
        }
        $cliParams['form_params'] = $dataJson;

        try{
            $response = $this->clientHttp->request($method->value, $url, $cliParams);

            $arrayConvert = json_decode($response->getBody()->getContents(), true);
            if ((is_array($arrayConvert)) && (($response->getStatusCode() >= 200) && ($response->getStatusCode() < 300)) ){
                return $arrayConvert;
            }else{
                throw new HttpMktException($response->getBody()->getContents(), $response->getStatusCode());
            }

        }catch(ClientException $cli_e){
            throw new HttpMktException($cli_e->getResponse()->getBody()->getContents(), $cli_e->getCode());
        }
    }


}