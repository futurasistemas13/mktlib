<?php declare(strict_types=1);

namespace FuturaMkt\Service\Meli;

use FuturaMkt\Entity\Authentication\MktConnection;
use FuturaMkt\Entity\Produto\Produto;
use FuturaMkt\Service\Marketplace;

class Meli extends Marketplace{

    private MeliAuthUtil    $meliAuth;
    private MeliProdutoUtil $productUtil;
    private MeliHttpMethods $meliHttp;

    function __construct()
    {
        $this->meliAuth     = new MeliAuthUtil();
        $this->meliHttp     = new MeliHttpMethods();
        $this->productUtil  = new MeliProdutoUtil($this->meliAuth, $this->meliHttp);
    }

    public function authenticate(MktConnection $data): MktConnection
    {
        return $this->meliAuth->genToken($data);
    }

    public function refreshAuthentication(MktConnection $data): MktConnection{
        //só da refresh se realmente for necessário (refresh token expirado...)
        if( ($data->getTokenExpire() !== 0) &&
            ($data->getAccessToken())       &&
            ($data->getRefreshToken())      &&
            ($data->getTokenExpire() < time() + 1) )
        {
            return $this->meliAuth->refreshToken($data);
        }else{
            return $data;
        }
    }

    public function __call(string $name, array $arguments)
    {
        $this->meliAuth->refreshToken($this->meliAuth->getAuthData());
        $this->meliHttp->setAccessToken($this->meliAuth->getAuthData()->getAccessToken());
    }

    public function setProduct(Produto $product){
        $this->productUtil->setProduct($product);
    }

}