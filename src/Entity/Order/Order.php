<?php declare(strict_types=1);

namespace FuturaMkt\Entity\Order;

use Symfony\Component\Validator\Constraints as Assert;
use FuturaMkt\Entity\Product\Attribute;
use FuturaMkt\Entity\Customer\Customer;

class Order{

    private Customer  $buyer;
    private array     $items;
    
    /**
     * @Assert\Positive
     */
    private float  $subTotal = 0;

    /**
     * @Assert\NotBlank
     * @Assert\NotNull
     */
    private string $mktId;

    private \datetime $dateCreated;

    /**
     * @Assert\All({
     *    @Assert\Type("FuturaMkt\Entity\Product\Attribute")
     * })
     * @Assert\Valid
     */
    private array $attributeList = array();

    /**
     * @Assert\Positive
     */
    private float $shippingCost  = 0;

    /**
     * @Assert\NotBlank
     * @Assert\NotNull
     */
    private string $shippingName;

    /**
     * @Assert\PositiveOrZero
     */
    private float $discountAmount = 0;

    /**
     * @Assert\PositiveOrZero
     */
    private float $increaseAmount = 0;


    /**
     * Get the value of subTotal
     */ 
    public function getSubTotal(): float
    {
        return $this->subTotal;
    }

    /**
     * Set the value of subTotal
     *
     * @return  Order
     */ 
    public function setSubTotal(float $subTotal): Order
    {
        $this->subTotal = $subTotal;

        return $this;
    }

    /**
     * Get the value of mktId
     */ 
    public function getMktId(): string
    {
        return $this->mktId;
    }

    /**
     * Set the value of mktId
     *
     * @return  Order
     */ 
    public function setMktId(string $mktId): Order
    {
        $this->mktId = $mktId;

        return $this;
    }

    /**
     * Get the value of dateCreated
     */ 
    public function getDateCreated(): \DateTime
    {
        return $this->dateCreated;
    }

    /**
     * Set the value of dateCreated
     *
     * @return  Order
     */ 
    public function setDateCreated(\DateTime $dateCreated): Order
    {
        $this->dateCreated = $dateCreated;
        return $this;
    }

    /**
     * Get all Attributes})
     */ 
    public function getAttributeList(): array
    {
        return $this->attributeList;
    }

    /**
     * Set Attribute})
     *
     * @return  Order
     */ 
    public function setAttribute(string $fieldName, string $fieldValue): Order
    {
        $this->attributeList[] = new Attribute($fieldName, $fieldValue);
        return $this;
    }

    /**
     * Get the value of shippingCost
     */ 
    public function getShippingCost(): float
    {
        return $this->shippingCost;
    }

    /**
     * Set the value of shippingCost
     *
     * @return  Order
     */ 
    public function setShippingCost(float $shippingCost): Order
    {
        $this->shippingCost = $shippingCost;

        return $this;
    }

    /**
     * Get the value of shippingName
     */ 
    public function getShippingName(): string
    {
        return $this->shippingName;
    }

    /**
     * Set the value of shippingName
     *
     * @return  Order
     */ 
    public function setShippingName(string $shippingName): Order
    {
        $this->shippingName = $shippingName;

        return $this;
    }

    /**
     * Get the value of discountAmount
     */ 
    public function getDiscountAmount(): float
    {
        return $this->discountAmount;
    }

    /**
     * Set the value of discountAmount
     *
     * @return  Order
     */ 
    public function setDiscountAmount(float $discountAmount): Order
    {
        $this->discountAmount = $discountAmount;

        return $this;
    }

    /**
     * Get the value of increaseAmount
     */ 
    public function getIncreaseAmount(): float
    {
        return $this->increaseAmount;
    }

    /**
     * Set the value of increaseAmount
     *
     * @return  Order
     */ 
    public function setIncreaseAmount(float $increaseAmount): Order
    {
        $this->increaseAmount = $increaseAmount;

        return $this;
    }

    /**
     * Get the value of buyer
     */ 
    public function getBuyer(): customer
    {
        return $this->buyer;
    }

    /**
     * Set the value of buyer
     *
     * @return  Order
     */ 
    public function setBuyer(Customer $buyer): Order
    {
        $this->buyer = $buyer;

        return $this;
    }

    /**
     * Get the value of items
     */ 
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * Set the value of items
     *
     * @return  Order
     */ 
    public function setItems(array $items): Order
    {
        $this->items = $items;

        return $this;
    }

    /**
     * Set the value of item
     *
     * @return  Order
     */ 
    public function setItem(OrderItem $items): Order
    {
        $this->items[] = $items;

        return $this;
    }
}