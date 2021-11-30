<?php declare(strict_types=1);

namespace FuturaMkt\Entity\Product;

use Symfony\Component\Validator\Constraints as Assert;

class ProductVariation
{
    private String $variationId = '';

    private array  $attributes;

    /**
     * @Assert\Positive
     */
    private float  $price;

    /**
     * @Assert\PositiveOrZero
     */
    private Int    $quantity = 0;

    private array  $productImages;


    public function __construct()
    {
        $this->attributes    = array();
        $this->productImages = array();
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return ProductVariation
     */
    public function setPrice(float $price): ProductVariation
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     * @return ProductVariation
     */
    public function setQuantity(int $quantity): ProductVariation
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param String $name
     * @param String $value
     * @return ProductVariation
     */
    public function setAttribute(String $name, String $value): ProductVariation
    {
        $this->attributes[] = new Attribute($name, $value);
        return $this;
    }

    /**
     * @return array
     */
    public function getProductImages(): array
    {
        return $this->productImages;
    }

    /**
     * @param String $productImage
     * @param String $imgCode
     * @return ProductVariation
     */
    public function setProductImage(String $productImage, String $imgCode  = ''): ProductVariation
    {
        $prodImg = new ProductImage();
        $prodImg->setImageLink($productImage);
        $prodImg->setMktCode($imgCode);
        $this->productImages[] = $prodImg;
        return $this;
    }

    /**
     * @return string
     */
    public function getVariationId(): string
    {
        return $this->variationId;
    }

    /**
     * @param string $variationId
     * @return ProductVariation
     */
    public function setVariationId(string $variationId): ProductVariation
    {
        $this->variationId = $variationId;
        return $this;
    }

}