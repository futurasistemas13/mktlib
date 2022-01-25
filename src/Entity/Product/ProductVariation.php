<?php declare(strict_types=1);

namespace FuturaMkt\Entity\Product;

use Symfony\Component\Validator\Constraints as Assert;
use FuturaMkt\Type\TypeStatus;

class ProductVariation
{

    private string $sku = '';

    private String $variationId = '';

    /**
     * @Assert\All({
     *    @Assert\Type("FuturaMkt\Entity\Product\Attribute")
     * })
     * @Assert\Valid
     */
    private array  $attributes;

    /**
     * @Assert\Positive
     */
    private float  $price;

    /**
     * @Assert\PositiveOrZero
     */
    private Int    $quantity = 0;

    /**
     * @Assert\All({
     *    @Assert\Type("FuturaMkt\Entity\Product\ProductImage")
     * })
     * @Assert\Valid
     */
    private array  $productImages;

    private TypeStatus $status;


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
        if($quantity <= 0){
            $this->quantity = 0;
        }else{
            $this->quantity = $quantity;
        }
        
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
     * @return TypeStatus
     */
    public function getStatus(): TypeStatus
    {
        return $this->status;
    }

    /**
     * @param TypeStatus $status
     * @return ProductVariation
     */
    public function setStatus(TypeStatus $status): ProductVariation
    {
        $this->status = $status;
        return $this;

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


    /**
     * Get the value of sku
     */ 
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * Set the value of sku
     *
     * @return  ProductVariation
     */ 
    public function setSku(string $sku): ProductVariation
    {
        $this->sku = $sku;

        return $this;
    }
}