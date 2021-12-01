<?php declare(strict_types=1);

namespace FuturaMkt\Entity\Product;

use FuturaMkt\Type\TypeAttribute;
use FuturaMkt\Type\TypeMoeda;
use FuturaMkt\Type\Product\TypeProductCondition;
use FuturaMkt\Type\TypeStatus;
use Symfony\Component\Validator\Constraints as Assert;

class Product{

    private String                  $mktPlaceId         = "";

    /**
     * @Assert\NotBlank
     * @Assert\NotNull
     */
    private String                  $title              = "";

    private String                  $category_id        = "";

    /**
     * @Assert\PositiveOrZero
     */
    private float                   $price              = 0;

    /**
     * @Assert\PositiveOrZero
     */
    private Int                     $quantity           = 0;

    private TypeMoeda               $moeda              = TypeMoeda::BRL;

    private TypeProductCondition    $condition;

    private array                   $attributes;

    private array                   $productImages;

    private String                  $description        = "";

    private array                   $variationList;

    /**
     * @Assert\Url
     */
    private String                  $productLink;

    private array                   $MktDataReturn;

    private TypeStatus              $status;

    private Warranty                $warranty;

    public function __construct()
    {
        $this->variationList     = array();
        $this->MktDataReturn     = array();
        $this->attributes        = array();
        $this->warranty          = new Warranty();
        $this->productImages     = array();
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
     * @param int $quantity
     * @return Product
     */
    public function addQuantity(int $quantity): Product
    {
        $this->quantity = $this->quantity + $quantity;
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
    public function setAttribute(TypeAttribute $group, String $attrName, mixed $attrValue, bool $addNotExists = true): Product
    {
        if(array_key_exists($group->value, $this->attributes)){
            foreach($this->attributes[$group->value] as $attr){
                if(strtolower($attr->getName()) == $attrName){
                    $attr->setValue($attrValue);
                    return $this;
                }
            }
        }
        if($addNotExists){
            $this->attributes[$group->value][] = new Attribute($attrName, $attrValue);
        }
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
        return $this->productImages;
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
        $this->addQuantity($productVariation->getQuantity());
        $this->variationList[] = $productVariation;
        return $this;
    }

    public function hasVariation(): Bool{
        return (is_array($this->variationList)) && (count($this->variationList) > 0);
    }

    /**
     * @return String
     */
    public function getProductLink(): string
    {
        return $this->productLink;
    }

    /**
     * @param String $productLink
     * @return Product
     */
    public function setProductLink(string $productLink): Product
    {
        $this->productLink = $productLink;
        return $this;
    }

    /**
     * @return array
     */
    public function getMktDataReturn(): array
    {
        return $this->MktDataReturn;
    }

    /**
     * @param array $MktDataReturn
     * @return Product
     */
    public function setMktDataReturn(array $MktDataReturn): Product
    {
        $this->MktDataReturn = $MktDataReturn;
        return $this;
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
     * @return Product
     */
    public function setStatus(TypeStatus $status): Product
    {
        $this->status = $status;
        return $this;

    }

    /**
     * @return Warranty
     */
    public function getWarranty(): Warranty
    {
        return $this->warranty;
    }

    /**
     * @param Warranty $warranty
     * @return Product
     */
    public function setWarranty(Warranty $warranty): Product
    {
        $this->warranty = $warranty;
        return $this;
    }


}