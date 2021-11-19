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
        $this->meliHttp     = new MeliHttpMethods();
        $this->meliAuth     = new MeliAuthUtil($this->meliHttp);
        $this->productUtil  = new MeliProdutoUtil($this->meliAuth, $this->meliHttp);
    }

    public function setAuthentication(MktConnection $data): void
    {
        $this->meliAuth->refreshToken($data);
    }

    public function setProduct(Produto $product){
        $this->productUtil->setProduct($product);
    }

}