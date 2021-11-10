<?php

namespace FuturaMkt\Entity\Authentication\Meli;

use FuturaMkt\Entity\Authentication\MktConnection;

class MeliConnection extends MktConnection{

    private $client_id     = "";
    private $client_secret = "";
    private $code          = "";
    private $redirect_uri  = "";
    private $access_token  = "";
    private $refresh_token = "";
    private $token_expire  = 0;

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->client_id;
    }

    /**
     * @param string $client_id
     */
    public function setClientId(string $client_id): void
    {
        $this->client_id = $client_id;
    }

    /**
     * @return string
     */
    public function getClientSecret(): string
    {
        return $this->client_secret;
    }

    /**
     * @param string $client_secret
     */
    public function setClientSecret(string $client_secret): void
    {
        $this->client_secret = $client_secret;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getRedirectUri(): string
    {
        return $this->redirect_uri;
    }

    /**
     * @param string $redirect_uri
     */
    public function setRedirectUri(string $redirect_uri): void
    {
        $this->redirect_uri = $redirect_uri;
    }

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->access_token;
    }

    /**
     * @param string $access_token
     */
    public function setAccessToken(string $access_token): void
    {
        $this->access_token = $access_token;
    }

    /**
     * @return string
     */
    public function getRefreshToken(): string
    {
        return $this->refresh_token;
    }

    /**
     * @param string $refresh_token
     */
    public function setRefreshToken(string $refresh_token): void
    {
        $this->refresh_token = $refresh_token;
    }

    /**
     * @return int
     */
    public function getTokenExpire(): int
    {
        return $this->token_expire;
    }

    /**
     * @param int $token_expire
     */
    public function setTokenExpire(int $token_expire): void
    {
        $this->token_expire = $token_expire;
    }


}