<?php declare(strict_types=1);

namespace FuturaMkt\Entity\Produto;

use FuturaMkt\Type\TypeAttribute;
use FuturaMkt\Type\TypeMoeda;
use FuturaMkt\Type\Product\TypeProductCondition;

class Produto{
    private String $mktPlaceId         = "";
    private String $title              = "";
    private String $category_id        = "";
    private float $price               = 0;
    private Int $quantity              = 0;
    private TypeMoeda $moeda           = TypeMoeda::BRL;
    private TypeProductCondition $condition;
    private ProdutoAttributes $attributes;
    private array $productImage;
    private String $description = "";

    public function __construct()
    {
        $this->attributes = new ProdutoAttributes();
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
     */
    public function setTitle(string $title) : Produto
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
     */
    public function setCategoryId(string $category_id)
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
     */
    public function setPrice(float $price)
    {
        $this->price = $price;
        return $this;
    }

//    /**
//     * @return ProdutoAttributes
//     */
//    public function getAttributes(): ProdutoAttributes
//    {
//        return $this->Attributes;
//    }
//
//    /**
//     * @param ProdutoAttributes $Attributes
//     */
//    public function setAttributes(ProdutoAttributes $Attributes)
//    {
//        $this->Attributes = $Attributes;
//        return $this;
//    }

    /**
     * @return TypeMoeda
     */
    public function getMoeda(): TypeMoeda
    {
        return $this->moeda;
    }

    /**
     * @param TypeMoeda $moeda
     */
    public function setMoeda(TypeMoeda $moeda)
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
     */
    public function setCondition(TypeProductCondition $condition)
    {
        $this->condition = $condition;
        return $this;
    }

    /**
     * @return array
     */
    public function getImage(): array
    {
        return $this->productImage;
    }

    /**
     * @param String $Image
     * @param String $mktImageCode
     */
    public function setImage(String $Image, String $mktImageCode = '')
    {
        $productImage = new ProductImage();
        $productImage->setImageLink($Image);
        $productImage->setMktCode($mktImageCode);
        $this->productImage[] = $productImage;

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
     */
    public function setQuantity(int $quantity)
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
     */
    public function setDescription(string $description)
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
     * @return string
     */
    public function hasMktPlaceId(): Bool
    {
        return (strlen($this->mktPlaceId) > 0);
    }

    /**
     * @param string $mktPlaceId
     */
    public function setMktPlaceId(string $mktPlaceId)
    {
        $this->mktPlaceId = $mktPlaceId;
        return $this;
    }

    /**
     * @return ProdutoAttributes
     */
    public function getAttributes(): ProdutoAttributes
    {
        return $this->attributes;
    }

    /**
     * @param ProdutoAttributes $attributes
     */
    public function setAttribute(TypeAttribute $group, String $name, String $value)
    {
        $this->attributes->add($group, $name, $value);
        return $this;
    }

}