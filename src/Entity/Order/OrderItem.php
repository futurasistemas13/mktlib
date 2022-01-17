<?php declare(strict_types=1);

namespace FuturaMkt\Entity\Order;

use Symfony\Component\Validator\Constraints as Assert;
use FuturaMkt\Entity\Product\Attribute;

class OrderItem{

    private string $productName;
    private string $mktProduct;
    private int $quantity;
    private float $unitVal;
    private string $mktVariationId;

    /**
     * Get the value of productName
     */ 
    public function getProductName(): string
    {
        return $this->productName;
    }

    /**
     * Set the value of productName
     *
     * @return  OrderItem
     */ 
    public function setProductName(string $productName): OrderItem
    {
        $this->productName = $productName;

        return $this;
    }

    /**
     * Get the value of mktProductId
     */ 
    public function getMktProduct(): string
    {
        return $this->mktProduct;
    }

    /**
     * Set the value of mktProductId
     *
     * @return  OrderItem
     */ 
    public function setMktProductId(string $mktProduct): OrderItem
    {
        $this->mktProductId = $mktProduct;

        return $this;
    }

    /**
     * Get the value of quantity
     */ 
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     *
     * @return  OrderItem
     */ 
    public function setQuantity(int $quantity): OrderItem
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get the value of unitVal
     */ 
    public function getUnitVal(): float
    {
        return $this->unitVal;
    }

    /**
     * Set the value of unitVal
     *
     * @return  OrderItem
     */ 
    public function setUnitVal(float $unitVal): OrderItem
    {
        $this->unitVal = $unitVal;

        return $this;
    }

    /**
     * Get the value of mktVariationId
     */ 
    public function getMktVariationId(): string
    {
        return $this->mktVariationId;
    }

    /**
     * Set the value of mktVariationId
     *
     * @return  OrderItem
     */ 
    public function setMktVariationId(string $mktVariationId): OrderItem
    {
        $this->mktVariationId = $mktVariationId;

        return $this;
    }
}