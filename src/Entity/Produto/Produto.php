<?php


namespace FuturaMkt\Entity\Produto;

use FuturaMkt\Type\TypeMoeda;
use FuturaMkt\Type\Product\TypeProductCondition;


class Produto{
    private String $title              = "";
    private String $category_id        = "";
    private float $price               = 0;
    private TypeMoeda $moeda           = TypeMoeda::BRL;
    private TypeProductCondition $condition;
    private ProdutoAttributes $Attributes;
    private array $productImage;


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
    public function setTitle(string $title): void
    {
        $this->title = $title;
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
    public function setCategoryId(string $category_id): void
    {
        $this->category_id = $category_id;
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
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return ProdutoAttributes
     */
    public function getAttributes(): ProdutoAttributes
    {
        return $this->Attributes;
    }

    /**
     * @param ProdutoAttributes $Attributes
     */
    public function setAttributes(ProdutoAttributes $Attributes): void
    {
        $this->Attributes = $Attributes;
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
     */
    public function setMoeda(TypeMoeda $moeda): void
    {
        $this->moeda = $moeda;
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
    public function setCondition(TypeProductCondition $condition): void
    {
        $this->condition = $condition;
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
    public function setImage(String $Image, String $mktImageCode = ''):  Produto
    {
        $productImage = new ProductImage();
        $productImage->setImageLink($Image);
        $productImage->setMktCode($mktImageCode);
        $this->productImage[] = $productImage;

        return $this;
    }

}