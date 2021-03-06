<?php declare(strict_types=1);

namespace FuturaMkt\Entity\Product;

use Symfony\Component\Validator\Constraints as Assert;

class ProductImage{

    /**
     * @Assert\NotBlank
     * @Assert\NotNull
     * @Assert\url(
     *      message="the URL '{{ value }}' is not a valid url"
     * )
     */
    private String $imageLink;

    private String $mktCode;

    public function __construct(String $imgLink = '', String $mktCod = '')
    {
        $this->setImageLink($imgLink);
        $this->setMktCode($mktCod);
    }

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