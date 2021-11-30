<?php declare(strict_types=1);

namespace FuturaMkt\Service\Meli;

use FuturaMkt\Entity\Authentication\MktConnection;
use FuturaMkt\Entity\Product\Product;
use FuturaMkt\Exception\HttpMktException;
use FuturaMkt\Service\Marketplace;
use FuturaMkt\Validator\ProductValidator;

class Meli extends Marketplace{

    private MeliAuthUtil    $meliAuth;
    private MeliProductUtil $productUtil;
    private MeliHttpMethods $meliHttp;

    function __construct()
    {
        $this->meliHttp     = new MeliHttpMethods();
        $this->meliAuth     = new MeliAuthUtil($this->meliHttp);
        $this->productUtil  = new MeliProductUtil($this->meliHttp);
    }

    public function setAuthentication(MktConnection $data): void
    {
        $this->meliAuth->refreshToken($data);
    }

    /**
     * @throws HttpMktException
     * @throws \Exception|\GuzzleHttp\Exception\GuzzleException
     */
    public function setProduct(Product $product): Product | array{
        parent::setProduct($product);
        return $this->productUtil->setProduct($product);
    }

}