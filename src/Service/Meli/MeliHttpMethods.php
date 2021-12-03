<?php declare(strict_types=1);
namespace FuturaMkt\Service\Meli;

use FuturaMkt\Type\Http\TypeHttp;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use FuturaMkt\Exception\HttpMktException;
use GuzzleHttp\Exception\GuzzleException;

class MeliHttpMethods{

    private Client $clientHttp;
    private String $accessToken = "";

    function __construct()
    {
        $this->clientHttp   = new Client();
    }

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

    /**
     * @throws GuzzleException
     * @throws HttpMktException
     */
    public function requestWithAuthentication(TypeHttp $method, String $url, array $dataJson = array()){
        try{
            $cliParams['headers'] = array([
                'Content-Type'   => 'application/json',
                'Authorization'  => 'Bearer ' . $this->getAccessToken()
            ]);

            if(!($method === TypeHttp::GET) && (count($dataJson) > 0)){
                $cliParams['body'] = json_encode($dataJson);
            }

            $response = $this->clientHttp->request($method->value, $url, [$cliParams]);

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

    /**
     * @throws GuzzleException
     * @throws HttpMktException
     */
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