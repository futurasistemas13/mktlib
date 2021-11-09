<?php


namespace FuturaMkt\Meli;

use FuturaMkt\Authentication\Model\MktConnection;
use FuturaMkt\Entity\Produto;
use FuturaMkt\Marketplace;

class Meli extends Marketplace{

    private MeliAuthUtil    $meliAuth;
    private MeliProdutoUtil $productUtil;

    function __construct()
    {
        $this->meliAuth    = new MeliAuthUtil();
        $this->productUtil = new MeliProdutoUtil();
    }

    public function authenticate(MktConnection $data): MktConnection
    {
        if( ($data->getTokenExpire() !== 0) &&
            ($data->getAccessToken())       &&
            ($data->getRefreshToken())      &&
            ($data->getTokenExpire() < time() + 1) )
        {
            return $this->meliAuth->refreshToken($data);
        }else{
            return $this->meliAuth->getAccessToken($data);
        }
    }

    public function createProduct(Produto $product){
        $this->productUtil->addProduct($product, $this->meliAuth->getAuthData()->getAccessToken());
    }

}