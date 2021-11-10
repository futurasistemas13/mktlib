<?php


namespace FuturaMkt\Entity\Produto;

class ProductImage{

    private String $imageLink;
    private String $mktCode;

    /**
     * @return String
     */
    public function getImageLink(): string
    {
        return $this->imageLink;
    }

    /**
     * @param String $imageLink
     */
    public function setImageLink(string $imageLink): void
    {
        $this->imageLink = $imageLink;
    }

    /**
     * @return String
     */
    public function getMktCode(): string
    {
        return $this->mktCode;
    }

    /**
     * @param String $mktCode
     */
    public function setMktCode(string $mktCode): void
    {
        $this->mktCode = $mktCode;
    }


}