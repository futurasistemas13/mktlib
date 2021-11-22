<?php declare(strict_types=1);

namespace FuturaMkt\Entity\Authentication\Meli;

use FuturaMkt\Entity\Authentication\MktConnection;

class MeliConnection extends MktConnection{

    private String $client_id     = "";
    private String $client_secret = "";
    private String $redirect_uri  = "";
    private String $access_token  = "";
    private String $refresh_token = "";
    private int    $token_expire  = 0;

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->client_id;
    }

    /**
     * @param string $client_id
     * @return MeliConnection
     */
    public function setClientId(string $client_id): MeliConnection
    {
        $this->client_id = $client_id;
        return $this;
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
     * @return MeliConnection
     */
    public function setClientSecret(string $client_secret): MeliConnection
    {
        $this->client_secret = $client_secret;
        return $this;
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
     * @return MeliConnection
     */
    public function setRedirectUri(string $redirect_uri): MeliConnection
    {
        $this->redirect_uri = $redirect_uri;
        return $this;
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
     * @return MeliConnection
     */
    public function setAccessToken(string $access_token): MeliConnection
    {
        $this->access_token = $access_token;
        return $this;
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
     * @return MeliConnection
     */
    public function setRefreshToken(string $refresh_token): MeliConnection
    {
        $this->refresh_token = $refresh_token;
        return $this;
    }

    /**
     * @return int
     */
    public function getTokenExpire(): int
    {
        return time() + $this->token_expire;
    }

    /**
     * @param int $token_expire
     * @return MeliConnection
     */
    public function setTokenExpire(int $token_expire): MeliConnection
    {
        $this->token_expire = $token_expire;
        return $this;
    }


}