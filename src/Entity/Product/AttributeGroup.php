<?php

namespace FuturaMkt\Entity\Product;

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
    private $teste = 'teste';

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
     * @return AttributeGroup
     */
    public function setAttributeGroup(TypeAttribute $attributeGroup): AttributeGroup
    {
        $this->attributeGroup = $attributeGroup;
        return $this;
    }

    /**
     * @return array
     */
    public function getAttribute(): array
    {
        return $this->attribute;
    }

    /**
     * @param Attribute $attribute
     * @return AttributeGroup
     */
    public function setAttribute(Attribute $attribute): AttributeGroup
    {
        $this->attribute[] = $attribute;
        return $this;
    }

}