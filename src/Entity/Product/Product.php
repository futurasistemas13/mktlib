<?php declare(strict_types=1);

namespace FuturaMkt\Entity\Product;

use FuturaMkt\Type\TypeAttribute;
use FuturaMkt\Type\TypeMoeda;
use FuturaMkt\Type\Product\TypeProductCondition;

class Product{
    private String    $mktPlaceId         = "";
    private String    $title              = "";
    private String    $category_id        = "";
    private float     $price              = 0;
    private Int       $quantity           = 0;
    private TypeMoeda $moeda              = TypeMoeda::BRL;
    private TypeProductCondition $condition;
    private array  $attributes;
    private array  $productImages;
    private String $description = "";
    private array  $variationList;

    public function __construct()
    {
        //
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Product
     */
    public function setTitle(string $title) : Product
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getCategoryId(): string
    {
        return $this->category_id;
    }

    /**
     * @param string $category_id
     * @return Product
     */
    public function setCategoryId(string $category_id): Product
    {
        $this->category_id = $category_id;
        return $this;
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
     * @return Product
     */
    public function setPrice(float $price): Product
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return TypeMoeda
     */
    public function getMoeda(): TypeMoeda
    {
        return $this->moeda;
    }

    /**
     * @param TypeMoeda $moeda
     * @return Product
     */
    public function setMoeda(TypeMoeda $moeda): Product
    {
        $this->moeda = $moeda;
        return $this;
    }

    /**
     * @return TypeProductCondition
     */
    public function getCondition(): TypeProductCondition
    {
        return $this->condition;
    }

    /**
     * @param TypeProductCondition $condition
     * @return Product
     */
    public function setCondition(TypeProductCondition $condition): Product
    {
        $this->condition = $condition;
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
     * @return Product
     */
    public function setQuantity(int $quantity): Product
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Product
     */
    public function setDescription(string $description): Product
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getMktPlaceId(): string
    {
        return $this->mktPlaceId;
    }

    /**
     * @return bool
     */
    public function hasMktPlaceId(): Bool
    {
        return (strlen($this->mktPlaceId) > 0);
    }

    /**
     * @param string $mktPlaceId
     * @return Product
     */
    public function setMktPlaceId(string $mktPlaceId): Product
    {
        $this->mktPlaceId = $mktPlaceId;
        return $this;
    }

    /**
     * @param TypeAttribute $group
     * @return array
     */
    public function getAttributes(TypeAttribute $group): array
    {
        return ((array_key_exists($group->value, $this->attributes))  && (is_array($this->attributes[$group->value]))) ?  $this->attributes[$group->value] : array();
    }

    /**
     * @param TypeAttribute $group
     * @param String $attrName
     * @param String $attrValue
     * @return Product
     */
    public function setAttribute(TypeAttribute $group, String $attrName, String $attrValue): Product
    {
        $this->attributes[$group->value][] = new Attribute($attrName, $attrValue);
        return $this;
    }

    /**
     * @return array
     */
    public function getAllVariationImages(): array
    {
        $return = array();
        foreach ($this->getVariationList() as $variat){
            $return = array_merge_recursive($return, $variat->getProductImages());
        }
        return $return;
    }

    /**
     * @return array
     */
    public function getImages(): array
    {
        return is_array($this->productImages) ? $this->productImages : array();
    }

    /**
     * @param String $productImage
     * @param $productImageId
     * @return Product
     */
    public function setImage(String $productImage, String $productImageId = ''): Product
    {
        $this->productImages[] = new ProductImage($productImage, $productImageId);
        return $this;
    }

    /**
     * @return array
     */
    public function getVariationList(): array
    {
        return $this->variationList;
    }

    /**
     * @param ProductVariation $productVariation
     * @return Product
     */
    public function setVariation(ProductVariation $productVariation): Product
    {
        $this->variationList[] = $productVariation;
        return $this;
    }

    public function hasVariation(): Bool{
        return (is_array($this->variationList)) && (count($this->variationList) > 0);
    }


}