<?php

namespace FuturaMkt\Entity\Product;

use FuturaMkt\Entity\Product\Attribute;
use FuturaMkt\Type\TypeAttribute;
use Symfony\Component\Validator\Constraints as Assert;

class AttributeGroup
{
    private TypeAttribute $attributeGroup;

    /**
     * @Assert\All({
     *    @Assert\Type("FuturaMkt\Entity\Product\Attribute")
     * })
     * @Assert\Valid
     */
    private array         $attribute;

    public function __construct(TypeAttribute $group = TypeAttribute::DefaultAttributes, string $name = '', string $value = '')
    {
        $this->setAttributeGroup($group);
        $this->setAttribute(new Attribute($name, $value));
    }

    /**
     * @return TypeAttribute
     */
    public function getAttributeGroup(): TypeAttribute
    {
        return $this->attributeGroup;
    }

    /**
     * @param TypeAttribute $attributeGroup
     */
    public function setAttributeGroup(TypeAttribute $attributeGroup): void
    {
        $this->attributeGroup = $attributeGroup;
    }

    /**
     * @return array
     */
    public function getAttribute(): array
    {
        return $this->attribute;
    }

    /**
     * @param array $attribute
     */
    public function setAttribute(Attribute $attribute): void
    {
        $this->attribute[] = $attribute;
    }

}