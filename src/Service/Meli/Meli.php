<?php declare(strict_types=1);


namespace FuturaMkt\Service\Meli;

use FuturaMkt\Entity\Authentication\MktConnection;
use FuturaMkt\Entity\Produto\Produto;
use FuturaMkt\Service\Marketplace;

class Meli extends Marketplace{

    private MeliAuthUtil    $meliAuth;
    private MeliProdutoUtil $productUtil;

    function __construct()
    {
        $this->meliAuth    = new MeliAuthUtil();
        $this->productUtil = new MeliProdutoUtil($this->meliAuth);
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
            return $this->meliAuth->genToken($data);
        }
    }

    public function setProduct(Produto $product){
        $this->productUtil->setProduct($product);
    }

}