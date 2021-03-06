<?php declare(strict_types=1);

namespace FuturaMkt\Entity\Product;

use FuturaMkt\Type\TypeMoeda;

use FuturaMkt\Type\TypeStatus;
use FuturaMkt\Type\TypeAttribute;
use FuturaMkt\Type\Product\TypeProductCondition;
use Symfony\Component\Validator\Constraints as Assert;

class Product{

    private String $mktPlaceId = "";

    /**
     * @Assert\NotBlank
     * @Assert\NotNull
     */
    private String $title = "";

    private String $category_id = "";

    /**
     * @Assert\Positive(groups={"non_grid"})
     */
    private float $price = 0;

    /**
     * @Assert\PositiveOrZero
     */
    private Int $quantity = 0;

    /**
     * @Assert\PositiveOrZero
     */
    private Int $soldQuantity = 0;

    private TypeMoeda $moeda = TypeMoeda::BRL;

    private TypeProductCondition $condition;

    /**
     * @Assert\All({
     *    @Assert\Type("FuturaMkt\Entity\Product\AttributeGroup")
     * })
     * @Assert\Valid
     */
    private array $attributeGroups;

    /**
     * @Assert\All({
     *    @Assert\Type("FuturaMkt\Entity\Product\ProductImage")
     * })
     * @Assert\Valid
     */
    private array $productImages;

    private String $description        = "";

    /**
     * @Assert\All({
     *    @Assert\Type("FuturaMkt\Entity\Product\ProductVariation")
     * })
     * @Assert\Valid
     */
    private array $variationList;

    /**
     * @Assert\Url
     */
    private String $productLink;

    private array $MktDataReturn;

    private TypeStatus $status;


    /**
     * @Assert\Type("FuturaMkt\Entity\Product\Warranty")
     * @Assert\Valid
     */
    private Warranty                $warranty;

    public function __construct()
    {
        $this->variationList     = array();
        $this->MktDataReturn     = array();
        $this->attributeGroups   = array();
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
     * @param string $field
     * @return array
     */
    public function getAttributesValue(TypeAttribute $group, string $field): string
    {
        $attributes = $this->getAttributes($group);
        $return = array_filter($attributes, function($p) use ($field){
            return $p->getName() == $field;
        }, ARRAY_FILTER_USE_BOTH);

        if(count($return) > 0){
            return $return[0]->getValue();
        }else{
            return '';
        }
        
    }

    /**
     * @param TypeAttribute $group
     * @return array
     */
    public function getAttributes(TypeAttribute $group): array
    {        
        $return = array_filter($this->attributeGroups, function($p) use ($group){
            return $p->getAttributeGroup() === $group;
        }, ARRAY_FILTER_USE_BOTH);

        if(count($return) > 0){
            return $return[array_key_last($return)]->getAttribute();
        }else{
            return array();
        }
        
    }

    /**
     * @param TypeAttribute $group
     * @param String $attrName
     * @param String $attrValue
     * @param bool $addNotExists
     * @return Product
     */
    public function setAttribute(TypeAttribute $group, String $attrName, mixed $attrValue, bool $addNotExists = true): Product
    {
        foreach ($this->attributeGroups as $attr){
            if($attr->getAttributeGroup() == $group){

                $return = array_filter($attr->getAttribute($group), function($p) use ($attrName){
                    return $p->getName() === $attrName;
                }, ARRAY_FILTER_USE_BOTH);

                if(count($return) > 0){
                    $return[array_key_last($return)]->setValue($attrValue);
                }else{
                    if($addNotExists){
                        $attr->setAttribute(new Attribute($attrName, $attrValue));
                    }                    
                }                
                return $this;
            }
        }

        if($addNotExists){
            $this->attributeGroups[] = new AttributeGroup($group, $attrName, $attrValue);
        }
        return $this;
    }

    /**
     * @return array
     */
    public function getAllVariationImages(bool $justEnabledFields = false): array
    {
        $return = array();
        foreach ($this->getVariationList() as $variate){
            if($justEnabledFields){
                if(($variate->getStatus() == TypeStatus::Active)){
                    $return = array_merge_recursive($return, $variate->getProductImages());
                }
            }else{
                $return = array_merge_recursive($return, $variate->getProductImages());
            }
            
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
     * @param String $productImageId
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
    public function getVariationList(bool $justActiveVariations = false): array
    {
        if($justActiveVariations){
            return array_filter($this->variationList, function($p){
                return $p->getStatus() == TypeStatus::Active;
            }, ARRAY_FILTER_USE_BOTH);
        }else{
            return $this->variationList;
        }
        
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



    /**
     * Get the value of soldQuantity
     */ 
    public function getSoldQuantity(): Int
    {
        return $this->soldQuantity;
    }

    /**
     * Set the value of soldQuantity
     *
     * @return  Product
     */ 
    public function setSoldQuantity($soldQuantity): Product
    {
        $this->soldQuantity = $soldQuantity;

        return $this;
    }
}