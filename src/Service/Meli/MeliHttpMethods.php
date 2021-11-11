<?php
  namespace FuturaMkt\Service\Meli;

  use FuturaMkt\Type\Http\TypeHttp;
  use FuturaMkt\Type\Meli\TypeMeliEndPoints;
  use GuzzleHttp\Client;
  use GuzzleHttp\Exception\ClientException;

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

      public function requestBodyAuthentication(TypeHttp $method, String $url, $dataJson){
          $response = $this->clientHttp->reques($method->value, $url, [
              'headers' => [
                  'Content-Type'   => 'application/json',
                  'Authorization'  => 'Bearer ' . $this->getAccessToken()
              ],
              'body' => json_encode($dataJson)
          ]);

          return json_encode($response->getBody()->getContents());
      }


  }