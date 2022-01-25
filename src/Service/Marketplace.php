<?php declare(strict_types=1);

namespace FuturaMkt\Service;

use Exception;
use FuturaMkt\Entity\Product\Product;
use FuturaMkt\Entity\Authentication\MktConnection;
use FuturaMkt\Entity\Order\Order;
use FuturaMkt\Exception\ValidationException;
use FuturaMkt\Type\TypeMarketplaces;
use FuturaMkt\Validator\ValidatorMarketplace;


class Marketplace implements iMarketplace{
    private TypeMarketplaces $marketplace;

    protected function setMarketplaceType(TypeMarketplaces $marketplace){
        $this->marketplace = $marketplace;
    }

    public function setAuthentication(MktConnection $data): void {}

    /**
     * @param Product $product
     * @return Product
     * @throws ValidationException
     * @throws Exception
     */
    public function setProduct(Product $product): Product{
        $ProductValidator = new ValidatorMarketplace();
        $errors           = $ProductValidator->validateProduct($this->marketplace, $product);
        if (count($errors) > 0) {
            throw new ValidationException($errors);
        }else return $product;
    }

    /**
     * @param Product $product
     * @return Product
     * @throws ValidationException
     * @throws Exception
     */
    public function setProductSimple(Product $product): Product{
        $ProductValidator = new ValidatorMarketplace();
        $errors           = $ProductValidator->validateProduct($this->marketplace, $product);
        if (count($errors) > 0) {
            throw new ValidationException($errors);
        }else return $product;
    }

    public function getOrder(string $mktOrderId): Order
    {
        /*$orderValidator = new ValidatorMarketplace();
        $errors           = $orderValidator->validateOrder($this->marketplace, $product);
        if (count($errors) > 0) {
            throw new ValidationException($errors);
        }else return null;*/

        if(empty($mktOrderId)){
            throw new Exception('you should send the parameter mktOrderId!');
        }

        return new Order();
    }
}