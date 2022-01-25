<?php declare(strict_types=1);

namespace FuturaMkt\Service\Meli;

use Exception;
use FuturaMkt\Entity\Authentication\MktConnection;
use FuturaMkt\Entity\Order\Order;
use FuturaMkt\Entity\Product\Product;
use FuturaMkt\Exception\HttpMktException;
use FuturaMkt\Service\Marketplace;
use FuturaMkt\Type\TypeMarketplaces;
use GuzzleHttp\Exception\GuzzleException;

class Meli extends Marketplace{

    private MeliAuthUtil    $meliAuth;
    private MeliProductUtil $productUtil;
    private MeliHttpMethods $meliHttp;

    function __construct()
    {
        $this->meliHttp     = new MeliHttpMethods();
        $this->meliAuth     = new MeliAuthUtil($this->meliHttp);
        $this->productUtil  = new MeliProductUtil($this->meliHttp);
        $this->orderUtil    = new MeliOrderUtil($this->meliHttp);
        parent::setMarketplaceType(TypeMarketplaces::MercadoLivre);
    }

    public function setAuthentication(MktConnection $data): void
    {
        $this->meliAuth->refreshToken($data);
    }

    /**
     * @throws HttpMktException
     * @throws Exception|GuzzleException
     */
    public function setProduct(Product $product): Product{
        parent::setProduct($product);
        return $this->productUtil->setProduct($product);
    }

    /**
     * @param Product $product
     * @return Product
     * @throws ValidationException
     * @throws Exception
     */
    public function setProductSimple(Product $product): Product{
        parent::setProduct($product);
        return $this->productUtil->setProductSimple($product);
    }

    public function getCategoriesAttributes($category_id){
        return $this->productUtil->getCategoriesAttributes($category_id);
    }

    public function getProductListingType(): array{
        return $this->productUtil->getProductListingType();
    }

    public function getOrder(string $mktOrderId): Order
    {
        return $this->orderUtil->getOrder($mktOrderId);
    }

}