<?php


namespace FuturaMkt\Entity;

use FuturaMkt\Entity\ProdutoAttributes;

class Produto{
    private $title              = "";
    private $category_id        = "";
    private $price              = 0;
    private ProdutoAttributes $Attributes;

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
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    /**
     * @return \FuturaMkt\Entity\ProdutoAttributes
     */
    public function getAttributes(): \FuturaMkt\Entity\ProdutoAttributes
    {
        return $this->Attributes;
    }

    /**
     * @param \FuturaMkt\Entity\ProdutoAttributes $Attributes
     */
    public function setAttributes(\FuturaMkt\Entity\ProdutoAttributes $Attributes): void
    {
        $this->Attributes = $Attributes;
    }

}