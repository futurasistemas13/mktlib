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
        return $this->meliAuth->genToken($data);
    }

    public function createProduct(Produto $product){
        $this->productUtil->addProduct($product, $this->meliAuth->getAuthData()->getAccessToken());
    }

}