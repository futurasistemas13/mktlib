<?php declare(strict_types=1);

namespace FuturaMkt\Service;

use Exception;
use FuturaMkt\Entity\Product\Product;
use FuturaMkt\Entity\Authentication\MktConnection;
use FuturaMkt\Type\TypeMarketplaces;
use FuturaMkt\Validator\ValidatorMarketplace;


class Marketplace implements iMarketplace{
    private TypeMarketplaces $marketplace;

    protected function setMarketplaceType(TypeMarketplaces $marketplace){
        $this->marketplace = $marketplace;
    }

    public function setAuthentication(MktConnection $data): void {}

    /**
     * @throws Exception
     */
    public function setProduct(Product $product): Product{
        $ProductValidator = new ValidatorMarketplace();
        $errors           = $ProductValidator->validateProduct($this->marketplace, $product);
        if (count($errors) > 0) {
            throw new Exception(json_encode($errors));
        }else return $product;

    }
}